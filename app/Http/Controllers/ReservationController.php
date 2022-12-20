<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\Reservation;
use App\Models\Worker;
use Illuminate\Http\Request;
use Carbon\Carbon;

/**
 * Class ReservationController
 * @package App\Http\Controllers
 */
class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
        if (isset($request->c)) {
            $c = $request->c;
        } else {
            $c = "1";
        }
        $houses = House::all();
        $turkishMonth = Carbon::create($year, $month)->translatedFormat('F');
        $oncekiAy = Carbon::create($year, $month)->subMonth();
        $sonrakiAy = Carbon::create($year, $month)->addMonth();
        if ($c == 10) {
            $resQuery = Reservation::whereMonth('start', $month)->whereYear('start', $year)->orderBy('start', 'asc');
        } else {
            $resQuery = Reservation::whereMonth('start', $month)->whereYear('start', $year)->whereHouse_id($c)->orderBy('start', 'asc');
        }

        $reservations = $resQuery->paginate();
        $resSum = $resQuery->sum('price');

        return view('reservation.index', compact('c', 'month', 'year', 'houses', 'resSum', 'turkishMonth','oncekiAy', 'sonrakiAy', 'reservations'))
            ->with('i', (request()->input('page', 1) - 1) * $reservations->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Reservation::class);
        $reservation = new Reservation();
        $houses = House::all();
        $workers = Worker::all();
        return view('reservation.create', compact('reservation', 'houses', 'workers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Reservation::class);
        request()->validate(Reservation::$rules);

        $reservation = Reservation::create($request->all());

        return redirect()->route('reservations.index')
            ->with('success', 'Reservation created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('create', Reservation::class);
        $reservation = Reservation::find($id);

        return view('reservation.show', compact('reservation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('create', Reservation::class);
        $reservation = Reservation::find($id);
        $houses = House::all();
        $workers = Worker::all();

        return view('reservation.edit', compact('reservation', 'houses', 'workers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Reservation $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        $this->authorize('create', Reservation::class);
        request()->validate(Reservation::$rules);

        $reservation->update($request->all());

        return redirect()->route('reservations.index')
            ->with('success', 'Reservation updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $this->authorize('create', Reservation::class);
        $reservation = Reservation::find($id)->delete();

        return redirect()->route('reservations.index')
            ->with('success', 'Reservation deleted successfully');
    }
}
