<?php

namespace App\Http\Controllers;

use App\Models\Tiket;
use App\Models\Konser;
use Illuminate\Http\Request;
use \App\Models\OrderTiket as Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreOrderTiketRequest;
use App\Http\Requests\UpdateOrderTiketRequest;

class OrderTiketController extends Controller
{
    private $viewIndex = 'ordertiket_index';
    private $viewCreate = 'ordertiket_form';
    private $viewEdit = 'ordertiket_form';
    private $viewShow = 'ordertiket_show';
    private $routePrefix = 'ordertiket';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

       $models = Model::with('user', 'tiket')->paginate('30');


       return view('administrator.' . $this->viewIndex, [
            'models' => $models,
            'routePrefix' => $this->routePrefix,
            'title' => 'Data Order tiket'
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
            'tiket_id' => Tiket::pluck('kode_tiket', 'id'),
            'title' => 'Form Data Order tiket',

        ];

        return view('administrator.' .$this->viewCreate, $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderTiketRequest $request)
    {



        $requestData = $request->validated();


        $requestData['user_id'] = Auth::user()->id;

        Model::create($requestData);
        flash('Data berhasil diupdate');
        return redirect()->route('ordertiket.index');
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
            'tiket_id' => Tiket::pluck('kode_tiket', 'id'),
            'title' => 'Form Edit Order Tiket',
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
    public function update(UpdateOrderTiketRequest $request, $id)
    {
        $model = Model::findOrFail($id);
        $model->fill($request->validated());
        $model->save();
        flash('Data berhasil diupdate');
        return redirect()->route('ordertiket.index');
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
