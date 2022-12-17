<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use App\Models\Expense;
use App\Models\House;
use App\Models\Reservation;
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

        $records = $this->monthlyReservations($month, $year)->sum('price');
        $expenses = round($this->monthlyExpenses($month, $year)->sum('price'), 2);
        $bilanco = round($this->bilancoMonthly($month, $year), 2);
        $hesaplasma = $this->hesaplasmaMonthly($month, $year);
        $houses = House::all();

        $doluluks = array();

        foreach ($houses as $house) {
            $doluluks[$house->id] = $this->doluluk($month, $year, $house->id);
        }

        print_r($doluluks);

        return view('dashboard')->with(compact('records', 'expenses', 'bilanco', 'hesaplasma'));
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
            return $records = Reservation::where('house_id', $h)->where(function ($query) use ($m, $y) {
                $query->whereMonth('start', $m)->whereMonth('finish', $m)->whereYear('start', $y)->whereYear('finish', $y);
            })->orWhere(function ($query) use ($m, $y) {
                $query->where('start', '<', Carbon::create($y, $m))->where(function ($query) use ($m, $y) {
                    $query->whereMonth('finish', $m)->orWhere('finish', '>', Carbon::create($y, $m));
                });
            })->orWhere(function ($query) use ($m, $y) {
                $query->whereMonth('start', $m)->where('finish', '>', Carbon::create($y, $m));
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
