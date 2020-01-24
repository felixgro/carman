<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DependencyRequest;

class DependencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dep = \DB::table('dependencies')->where('vehicle_id', session('vehicle'))->get();

        return view('home.dependencies.all', [
            'title' => 'Dependencies Dashboard',
            'currentPage' => 'dependency',
            'dep' => $dep
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('home.dependencies.create', [
            'title' => 'Add Dependency',
            'currentPage' => 'dependency'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DependencyRequest $request)
    {
        $data = $request->validated();

        if (!$request->session()->has('vehicle')) {
            $request->session()->flash('notification', ["Action Failed", "Please select a Vehicle."]);
            return redirect('expenses');
        }

        \DB::table('dependencies')->insert([
            'vehicle_id' => session('vehicle'),
            'title' => $data['title'],
            'description' => $data['description'],
            'created_at' => new \Carbon\Carbon()
        ]);

        $request->session()->flash('notification', ["Added Dependency", "{$data['title']}"]);

        return redirect('dependencies');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DependencyRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
