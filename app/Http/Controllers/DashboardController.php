<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use App\Models\Expense;
use App\Models\House;
use App\Models\Reservation;
use App\Models\Worker;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        if (isset($request->m)) {
            $month = $request->m;
        } else {
            $month = date('m');
        }
        if (isset($request->y)) {
            $year = $request->y;
        } else {
            $year = date('Y');
        }
        $today = Carbon::now()->format('Y-m-d');

        $lastReservations = Reservation::orderBy('start', 'desc')->limit(10)->get();

        $mesaiUcreti = 3000;
        $huzurOrani = 0;
        $huzurSahibi = 2; //worker ID Zafer;
        $turkishMonth = Carbon::create($year, $month)->translatedFormat('F');

        $oncekiAy = Carbon::create($year, $month)->subMonth();
        $sonrakiAy = Carbon::create($year, $month)->addMonth();

        $workers = Worker::all();
        $records = $this->monthlyReservations($month, $year)->sum('price');
        $expenses = round($this->monthlyExpenses($month, $year)->sum('price'), 2);
        $bilanco = round($this->bilancoMonthly($month, $year), 2);
        $hesaplasma = $this->hesaplasmaMonthly($month, $year);
        $houses = House::all();

        $lastExpenses = Expense::whereMonth('created_at', $month)->whereYear('created_at', $year)->orderBy('id', 'desc')->limit(10)->get();


        $kisiHarcamas = array();

        // Kişilere göre
        foreach ($workers as $worker) {
            $kisiHarcamas[] = array($worker->name, $this->monthlyExpensesByWorker($month, $year, $worker->id));
        }

        // Hesaplaşma hesaplamaları

        // burada 2den 1i çıkarıyoruz
        //Yani pozitif çıkarsa 2'ye borçluyuz
        // Negatif çıkarsa 1'ye borçluyuz
        $harcamaDengesi = round((($this->monthlyExpensesByWorker($month, $year, 2) - $this->monthlyExpensesByWorker($month, $year, 1)) / 2), 2);

        //huzurcu 2 olduğu için başa onu yazıyoruz
        $huzurVeMesaitoplamiFarklari = round(((($this->mesaiSayisi($month, $year, 2) * $mesaiUcreti) + ($bilanco * $huzurOrani / 100) - ($this->mesaiSayisi($month, $year, 1) * $mesaiUcreti)) / 2), 2);

        $huzurMesaiveHarcamaFarki = $huzurVeMesaitoplamiFarklari + $harcamaDengesi;

        // Bugün evlerin durumu
        $todaysStays = Reservation::where('start', '<', $today)->where('finish', '>', $today)->get();
        $todaysEntrys = Reservation::where('start', '=', $today)->get();
        $todaysExits = Reservation::where('finish', '=', $today)->get();


        // Evlere göre
        $doluluks = array();
        $harcamas = array();
        $bilancos = array();
        $mesais = array();
        foreach ($workers as $worker) {
            if ($worker->id == $huzurSahibi) {
                $huzurHakki = $bilanco * $huzurOrani / 100;
            } else {
                $huzurHakki = 0;
            }
            $mesaiSayisi = $this->mesaiSayisi($month, $year, $worker->id);
            $mesais[] = array($worker->name, $mesaiSayisi, $huzurHakki);
        }

        foreach ($houses as $house) {
            $doluluks[] = array($house->name, $this->doluluk($month, $year, $house->id));
            $harcamas[] = array($house->name, round($this->monthlyExpensesByHouse($month, $year, $house->id), 2));
            $bilancos[] = array($house->name, round($this->bilancoByHouseMonthly($month, $year, $house->id), 2));
        }

        return view('dashboard')->with(compact('todaysStays','todaysEntrys', 'todaysExits', 'huzurMesaiveHarcamaFarki', 'lastReservations','records', 'expenses', 'bilanco', 'hesaplasma', 'doluluks', 'harcamas', 'bilancos', 'turkishMonth', 'oncekiAy', 'sonrakiAy', 'mesais', 'mesaiUcreti', 'huzurOrani', 'huzurSahibi', 'kisiHarcamas', 'lastExpenses'));
    }

    public function mesaiSayisi($m, $y, $w)
    {
        $records = Reservation::whereMonth('start', $m)->whereYear('start', $y)->whereWorker_id($w)->count();
        $records2 = Reservation::where('info', 'mesaisiz')->whereMonth('start', $m)->whereYear('start', $y)->whereWorker_id($w)->count();

        return $records - $records2;
    }

    public function monthlyReservations($m, $y, $h = "")
    {
        if ($h == "") {
            return $records = Reservation::where(function ($query) use ($m, $y) {
                $query->whereMonth('start', $m)->whereMonth('finish', $m)->whereYear('start', $y)->whereYear('finish', $y);
            })->orWhere(function ($query) use ($m, $y) {
                $query->where('start', '<', Carbon::create($y, $m))->where(function ($query) use ($m, $y) {
                    $query->whereMonth('finish', $m)->orWhere('finish', '>', Carbon::create($y, $m));
                });
            })->orWhere(function ($query) use ($m, $y) {
                $query->whereMonth('start', $m)->where('finish', '>', Carbon::create($y, $m));
            })->get();
        } else {
            return $records = Reservation::where(function ($query) use ($m, $y, $h) {
                $query->whereHouse_id($h)->whereMonth('start', $m)->whereMonth('finish', $m)->whereYear('start', $y)->whereYear('finish', $y);
            })->orWhere(function ($query) use ($m, $y, $h) {
                $query->whereHouse_id($h)->where('start', '<', Carbon::create($y, $m))->where(function ($query) use ($m, $y, $h) {
                    $query->whereHouse_id($h)->whereMonth('finish', $m)->orWhere('finish', '>', Carbon::create($y, $m));
                });
            })->orWhere(function ($query) use ($m, $y, $h) {
                $query->whereHouse_id($h)->whereMonth('start', $m)->where('finish', '>', Carbon::create($y, $m));
            })->get();
        }

    }

    public function bilancoMonthly($m, $y)
    {
        $sonuc = 0;
        $records = $this->monthlyReservations($m, $y);
        foreach ($records as $record) {
            $price = $record->price;
            $start = Carbon::create($record->start);
            $start2 = Carbon::create($record->start);
            $finish = Carbon::create($record->finish);

            if ($start->format('m') == $m and $finish->format('m') == $m) {
                $tutar = $price;
            } elseif ($finish->format('m') == $m) {
                $gun = $finish->format('j') - 1;
                $tutar = ($price / $finish->diff($start)->days) * $gun;
            } elseif ($start->format('m') == $m) {
                $endofMonth = $start->endOfMonth()->format('j');
                $today = $start2->format('j');
                $fark = $endofMonth - $today + 1;
                $birim = $price / $finish->diff($start2)->days;
                $tutar = $birim * $fark;
            } else {
                $gun = Carbon::create($y, $m)->endOfMonth()->format('j');
                $tutar = ($price / $finish->diff($start)->days) * $gun;
            }

            $sonuc += $tutar;
        }

        return $sonuc;
    }

    public function bilancoByHouseMonthly($m, $y, $h)
    {
        $sonuc = 0;
        $records = $this->monthlyReservations($m, $y, $h);
        foreach ($records as $record) {
            $price = $record->price;
            $start = Carbon::create($record->start);
            $start2 = Carbon::create($record->start);
            $finish = Carbon::create($record->finish);

            if ($start->format('m') == $m and $finish->format('m') == $m) {
                $tutar = $price;
            } elseif ($finish->format('m') == $m) {
                $gun = $finish->format('j') - 1;
                $tutar = ($price / $finish->diff($start)->days) * $gun;
            } elseif ($start->format('m') == $m) {
                $endofMonth = $start->endOfMonth()->format('j');
                $today = $start2->format('j');
                $fark = $endofMonth - $today + 1;
                $birim = $price / $finish->diff($start2)->days;
                $tutar = $birim * $fark;
            } else {
                $gun = Carbon::create($y, $m)->endOfMonth()->format('j');
                $tutar = ($price / $finish->diff($start)->days) * $gun;
            }

            $sonuc += $tutar;
        }

        return $sonuc;
    }

    public function hesaplasmaMonthly($m, $y)
    {
        $sonuc = 0;
        $records = $this->monthlyReservations($m, $y);
        foreach ($records as $record) {
            $start = Carbon::create($record->start);
            if ($start->format('m') == $m) {
                $tutar = $record->price;

                $sonuc += $tutar;
            }
        }

        return $sonuc;
    }

    public function monthlyExpenses($m, $y)
    {
        return $expenses = Expense::whereMonth('created_at', $m)->whereYear('created_at', $y)->get();
    }

    public function monthlyExpensesByHouse($m, $y, $h)
    {
        return $expenses = Expense::whereHouse_id($h)->whereMonth('created_at', $m)->whereYear('created_at', $y)->sum('price');
    }

    public function monthlyExpensesByWorker($m, $y, $w)
    {
        return $expenses = Expense::whereWorker_id($w)->whereMonth('created_at', $m)->whereYear('created_at', $y)->sum('price');
    }

    public function doluluk($m, $y, $h)
    {
        $sonuc = 0;
        $records = $this->monthlyReservations($m, $y, $h);
        foreach ($records as $record) {
            $start = Carbon::create($record->start);
            $start2 = Carbon::create($record->start);
            $finish = Carbon::create($record->finish);

            if ($start->format('m') == $m and $finish->format('m') == $m) {
                $guns = $finish->diff($start)->days;
            } elseif ($finish->format('m') == $m) {
                $guns = $finish->format('j') - 1;
            } elseif ($start->format('m') == $m) {
                $endofMonth = $start->endOfMonth()->format('j');
                $today = $start2->format('j');
                $guns = $endofMonth - $today + 1;
            } else {
                $guns = Carbon::create($y, $m)->endOfMonth()->format('j');
            }
            $sonuc += $guns;
        }

        return $sonuc;
    }
}
