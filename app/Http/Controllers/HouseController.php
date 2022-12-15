<?php

namespace App\Http\Controllers;

use App\Models\House;
use Illuminate\Http\Request;

/**
 * Class HouseController
 * @package App\Http\Controllers
 */
class HouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $houses = House::paginate();

        return view('house.index', compact('houses'))
            ->with('i', (request()->input('page', 1) - 1) * $houses->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $house = new House();
        return view('house.create', compact('house'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(House::$rules);

        $house = House::create($request->all());

        return redirect()->route('houses.index')
            ->with('success', 'House created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $house = House::find($id);

        return view('house.show', compact('house'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $house = House::find($id);

        return view('house.edit', compact('house'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  House $house
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, House $house)
    {
        request()->validate(House::$rules);

        $house->update($request->all());

        return redirect()->route('houses.index')
            ->with('success', 'House updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $house = House::find($id)->delete();

        return redirect()->route('houses.index')
            ->with('success', 'House deleted successfully');
    }
}
