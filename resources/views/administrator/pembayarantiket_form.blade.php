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
                            <label for="order_tiket_id">Nomor Order Tiket</label>
                            {!! Form::select('order_tiket_id', $order_tiket_id, null, ['class' => 'form-select', 'placeholder' => 'Pilih data order']) !!}
                            <span class="text-danger">{{ $errors->first('order_tiket_id') }}</span>
                        </div>

                        <div class="form-group mb-3">
                            <label for="jumlah_dibayar">Jumlah Bayar tiket</label>
                            {!! Form::text('jumlah_dibayar', null, ['class' => 'form-control  rupiah','autofocus',]) !!}
                            <span class="text-danger">{{ $errors->first('jumlah_dibayar') }}</span>
                        </div>




                        {!! Form::submit($button, ['class' => 'btn btn-primary mt-4']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>


@endsection
