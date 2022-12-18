<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use Illuminate\Http\Request;

/**
 * Class WorkerController
 * @package App\Http\Controllers
 */
class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workers = Worker::paginate();

        return view('worker.index', compact('workers'))
            ->with('i', (request()->input('page', 1) - 1) * $workers->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $worker = new Worker();
        return view('worker.create', compact('worker'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Worker::$rules);

        $worker = Worker::create($request->all());

        return redirect()->route('workers.index')
            ->with('success', 'Worker created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $worker = Worker::find($id);

        return view('worker.show', compact('worker'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $worker = Worker::find($id);

        return view('worker.edit', compact('worker'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Worker $worker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Worker $worker)
    {
        request()->validate(Worker::$rules);

        $worker->update($request->all());

        return redirect()->route('workers.index')
            ->with('success', 'Worker updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $worker = Worker::find($id)->delete();

        return redirect()->route('workers.index')
            ->with('success', 'Worker deleted successfully');
    }
}
