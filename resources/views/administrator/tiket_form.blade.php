@extends('layouts.admin')
@section('profilname')
<span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
@endsection
@section('content')


        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $title }}</div>

                <div class="card-body">
                    {!! Form::model($model,
                        [
                        'route' => $route,
                        'method' => $method,
                        ]) !!}



                        <div class="form-group mb-3">
                            <label for="kode_tiket">Kode tiket</label>
                            {!! Form::text('kode_tiket', null, ['class' => 'form-control  rupiah','autofocus',]) !!}
                            <span class="text-danger">{{ $errors->first('kode_tiket') }}</span>
                        </div>

                        <div class="form-group mb-3">
                            <label for="konser_id">Nama Konser</label>
                            {!! Form::select('konser_id', $konser_id, null, ['class' => 'form-select', 'placeholder' => 'Pilih konser']) !!}
                            <span class="text-danger">{{ $errors->first('konser_id') }}</span>
                        </div>

                        <div class="form-group mb-3">
                            <label for="harga_tiket">Harga tiket</label>
                            {!! Form::text('harga_tiket', null, ['class' => 'form-control  rupiah','autofocus',]) !!}
                            <span class="text-danger">{{ $errors->first('harga_tiket') }}</span>
                        </div>

                        <div class="form-group mb-3">
                            <label for="tock">Stock</label>
                            {!! Form::text('stock', null, ['class' => 'form-control  rupiah','autofocus',]) !!}
                            <span class="text-danger">{{ $errors->first('stock') }}</span>
                        </div>



                        {!! Form::submit($button, ['class' => 'btn btn-primary mt-4']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>


@endsection
