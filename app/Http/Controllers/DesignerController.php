<?php

namespace App\Http\Controllers;

use App\Models\Designer;
use App\Models\House;
use App\Models\Worker;
use Illuminate\Http\Request;

/**
 * Class DesignerController
 * @package App\Http\Controllers
 */
class DesignerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        if (isset($request->c)) {
            $c = $request->c;
        } else {
            $c = "10";
        }
        if (isset($request->completed)) {
            $completed = $request->completed;
        } else {
            $completed = "3";
        }
        $houses = House::all();

        if ($c == 10) {
            if ($completed == 3) {
                $resQuery = Designer::where('id', '>', 0)->orderBy('created_at', 'desc');
            } else {
                $resQuery = Designer::where('id', '>', 0)->where('completed', $completed)->orderBy('created_at', 'desc');
            }
        } else {
            if ($completed == 3) {

                $resQuery = Designer::whereHouse_id($c)->orderBy('created_at', 'desc');
            } else {

                $resQuery = Designer::whereHouse_id($c)->where('completed', $completed)->orderBy('created_at', 'desc');
            }
        }

        $designers = $resQuery->paginate();
        $desSum = $resQuery->sum('price');


        session(['urlres' => url()->full()]);
        return view('designer.index', compact('designers', 'houses', 'c', 'desSum'))
            ->with('i', (request()->input('page', 1) - 1) * $designers->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Designer::class);
        $designer = new Designer();
        $houses = House::all();
        $workers = Worker::all();
        return view('designer.create', compact('designer', 'houses', 'workers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Designer::class);
        request()->validate(Designer::$rules);

        $designer = Designer::create($request->all());
        if ($designer->taksit == null or $designer->taksit == 0) {
            $designer->taksit = 1;
            $designer->save();
        }

        return redirect()->route('designers.index')
            ->with('success', 'Designer created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $this->authorize('create', Designer::class);
        $designer = Designer::find($id);

        return view('designer.show', compact('designer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('create', Designer::class);
        $designer = Designer::find($id);
        $houses = House::all();
        $workers = Worker::all();

        return view('designer.edit', compact('designer', 'houses', 'workers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Designer $designer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Designer $designer)
    {
        $this->authorize('create', Designer::class);
        request()->validate(Designer::$rules);

        $designer->update($request->all());

        return redirect(session('urlres'))
            ->with('success', 'Designer updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $this->authorize('create', Designer::class);
        $designer = Designer::find($id)->delete();

        return redirect()->route('designers.index')
            ->with('success', 'Designer deleted successfully');
    }
}
