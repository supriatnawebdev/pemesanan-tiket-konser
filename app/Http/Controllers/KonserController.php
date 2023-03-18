<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKonserRequest;
use App\Http\Requests\UpdateKonserRequest;
use Illuminate\Http\Request;
use \App\Models\Konser as Model;
use Illuminate\Support\Facades\Storage;

class KonserController extends Controller
{
    private $viewIndex = 'konser_index';
    private $viewCreate = 'konser_form';
    private $viewEdit = 'konser_form';
    private $viewShow = 'konser_show';
    private $routePrefix = 'konser';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

       $models = Model::latest()->paginate('30');


       return view('administrator.' . $this->viewIndex, [
            'models' => $models,
            'routePrefix' => $this->routePrefix,
            'title' => 'Data konser'
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
            'title' => 'Form Data Konser',
        ];

        return view('administrator.' .$this->viewCreate, $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKonserRequest $request)
    {

        $requestData = $request->validated();

        if($request->hasFile('gambar')) {
            $requestData['gambar'] = $request->file('gambar')->store('public/gambar');
        }

        Model::create($request->validated());
        // dd($requestData);
        flash('Data berhasil ditambahkan');
        return redirect()->route('konser.index');
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
            'title' => 'Detail Konser',
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
            'title' => 'Form Edit Konser',
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
    public function update(UpdateKonserRequest $request, $id)
    {
        $model = Model::findOrFail($id);

        if($request->hasFile('gambar')) {
            if ($model->gambar != null && Storage::exists($model->gambar)) {
                # code...
                Storage::delete($model->gambar);
            }

            $requestData['gambar'] = $request->file('gambar')->store('public/gambar');
        }
        $model->fill($request->validated());
        $model->save();
        flash('Data berhasil diupdate');
        return redirect()->route('konser.index');
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
