<?php

namespace App\Http\Controllers;

use App\Models\Tiket;
use App\Models\Konser;
use App\Models\OrderTiket;
use Illuminate\Http\Request;
use \App\Models\BayarTiket as Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreBayarTiketRequest;
use App\Http\Requests\UpdateBayarTiketRequest;

class BayarTiketController extends Controller
{
    private $viewIndex = 'pembayarantiket_index';
    private $viewCreate = 'pembayarantiket_form';
    private $viewEdit = 'pembayarantiket_form';
    private $viewShow = 'pembayarantiket_show';
    private $routePrefix = 'pembayarantiket';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

       $models = Model::with('orderTiket')->paginate('30');


       return view('administrator.' . $this->viewIndex, [
            'models' => $models,
            'routePrefix' => $this->routePrefix,
            'title' => 'Data Pembayaran Tiket'
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
            'order_tiket_id' => OrderTiket::pluck('nama_pemesan', 'id'),
            'title' => 'Form Data Pembayaran Tiket',

        ];

        return view('administrator.' .$this->viewCreate, $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBayarTiketRequest $request)
    {


        $requestData = $request->validated();

        $requestData['status'] = 'active';

        Model::create($requestData);
        // dd($requestData);
        flash('Data berhasil diupdate');
        return redirect()->route('pembayarantiket.index');
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
            'title' => 'Form Edit Pembayaran Tiket',
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
    public function update(UpdateBayarTiketRequest $request, $id)
    {
        $model = Model::findOrFail($id);
        $model->fill($request->validated());
        $model->save();
        flash('Data berhasil diupdate');
        return redirect()->route('pembayarantiket.index');
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
