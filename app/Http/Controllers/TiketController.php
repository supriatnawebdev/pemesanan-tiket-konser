<?php

namespace App\Http\Controllers;

use App\Models\Konser;
use Illuminate\Http\Request;
use \App\Models\Tiket as Model;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreTiketRequest;
use App\Http\Requests\UpdateTiketRequest;

class TiketController extends Controller
{
    private $viewIndex = 'tiket_index';
    private $viewCreate = 'tiket_form';
    private $viewEdit = 'tiket_form';
    private $viewShow = 'tiket_show';
    private $routePrefix = 'tiket';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

       $models = Model::with('konser')->latest()->paginate('30');


       return view('administrator.' . $this->viewIndex, [
            'models' => $models,
            'routePrefix' => $this->routePrefix,
            'title' => 'Data tiket'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'model'  => new  Model(),
            'method' => 'POST',
            'route'  => $this->routePrefix . '.store',
            'button' => 'SIMPAN',
            'konser_id' => Konser::pluck('nama_konser', 'id'),
            'title' => 'Form Data tiket',

        ];

        return view('administrator.' .$this->viewCreate, $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTiketRequest $request)
    {


        $requestData = $request->validated();

        Model::create($request->validated());
        // dd($requestData);
        flash('Data berhasil diupdate');
        return redirect()->route('tiket.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        return view('administrator.' .$this->viewShow, [
            'model' => Model::findOrFail($id),
            'title' => 'Detail Tiket',
            'routePrefix' => $this->routePrefix,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'model'  => Model::findOrFail($id),
            'method' => 'PUT',
            'route'  => [ $this->routePrefix . '.update', $id],
            'button' => 'UPDATE',
            'konser_id' => Konser::pluck('nama_konser', 'id'),
            'title' => 'Form Edit Tiket',
        ];

        return view('administrator.' . $this->viewEdit, $data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTiketRequest $request, $id)
    {
        $model = Model::findOrFail($id);
        $model->fill($request->validated());
        $model->save();
        flash('Data berhasil diupdate');
        return redirect()->route('tiket.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Model::firstOrFail();
        $model->delete();
        flash('Data berhasil dihapus');
        return back();
    }
}
