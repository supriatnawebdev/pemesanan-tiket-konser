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
                            <label for="nama_pemesan">Nama Pemesan</label>
                            {!! Form::text('nama_pemesan', null, ['class' => 'form-control  rupiah','autofocus',]) !!}
                            <span class="text-danger">{{ $errors->first('nama_pemesan') }}</span>
                        </div>

                        <div class="form-group mb-3">
                            <label for="nohp_pemesan">Nohp Pemesan</label>
                            {!! Form::text('nohp_pemesan', null, ['class' => 'form-control  rupiah','autofocus',]) !!}
                            <span class="text-danger">{{ $errors->first('nohp_pemesan') }}</span>
                        </div>

                        <div class="form-group mb-3">
                            <label for="email_pemesan">email Pemesan</label>
                            {!! Form::text('email_pemesan', null, ['class' => 'form-control  rupiah','autofocus',]) !!}
                            <span class="text-danger">{{ $errors->first('email_pemesan') }}</span>
                        </div>

                        <div class="form-group mb-3">
                            <label for="alamat_pemesan">alamat Pemesan</label>
                            {!! Form::text('alamat_pemesan', null, ['class' => 'form-control  rupiah','autofocus',]) !!}
                            <span class="text-danger">{{ $errors->first('alamat_pemesan') }}</span>
                        </div>



                        <div class="form-group mb-3">
                            <label for="tiket_id">Kode tiket</label>
                            {!! Form::select('tiket_id', $tiket_id, null, ['class' => 'form-select', 'placeholder' => 'Pilih tiket']) !!}
                            <span class="text-danger">{{ $errors->first('tiket_id') }}</span>
                        </div>

                        {!! Form::submit($button, ['class' => 'btn btn-primary mt-4']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>


@endsection
