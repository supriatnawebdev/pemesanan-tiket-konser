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
                          <label for="nama_konser">Nama Konser</label>
                          {!! Form::text('nama_konser', null, ['class' => 'form-control','autofocus',]) !!}
                          <span class="text-danger">{{ $errors->first('nama_konser') }}</span>
                        </div>
                        <div class="form-group mb-3">
                          <label for="nama_artis">Nama Artis</label>
                          {!! Form::text('nama_artis', null, ['class' => 'form-control','autofocus',]) !!}
                          <span class="text-danger">{{ $errors->first('nama_artis') }}</span>
                        </div>

                        <div class="form-group mb-3">
                            <label for="tanggal_konser">Tanggal Konser</label>
                            {!! Form::date('tanggal_konser', $model->tanggal_konser ?? date('Y-m-d'), ['class' => 'form-control','autofocus']) !!}
                            <span class="text-danger">{{ $errors->first('tanggal_konser') }}</span>
                        </div>


                        {!! Form::submit($button, ['class' => 'btn btn-primary mt-4']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>


@endsection
