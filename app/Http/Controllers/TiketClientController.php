<?php

namespace App\Http\Controllers;
use \App\Models\Tiket as Model;
use Illuminate\Http\Request;

class TiketClientController extends Controller
{
    private $viewIndex = 'tiket_index';
    private $viewCreate = 'tiket_form';
    private $viewEdit = 'tiket_form';
    private $viewShow = 'tiket_show';
    private $routePrefix = 'tiket';

    public function index(){

        $models = Model::with('konser')->latest()->paginate('30');


        return view('client.' . $this->viewIndex, [
             'models' => $models,
             'routePrefix' => $this->routePrefix,
             'title' => 'Data tiket'
         ]);
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, $id)
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
