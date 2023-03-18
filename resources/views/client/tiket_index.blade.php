@extends('layouts.client')
@section('profilname')
<span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
@endsection
@section('content')

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $title }}</div>

                <div class="card-body">
                    <a href="{{ route($routePrefix . '.create') }}" class="btn btn-primary btn-sm">Tambah Data</a>

                    <div class="container text-center py-0 mt-2">
                        @include('flash::message')
                    </div>
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Tiket</th>
                                    <th>Nama konser</th>
                                    <th>nama artis</th>
                                    <th>Tanggal Konser</th>
                                    <th>Harga Tiket</th>
                                    <th>Stock</th>
                                    <th width="20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($models as $item)
                                    <tr>

                                        <td>{{ $loop->iteration }}</td>
                                        <th>{{ $item->kode_tiket }}</th>
                                        <td>{{ $item->konser->nama_konser}}</td>
                                        <td>{{ $item->konser->nama_artis }}</td>
                                        <td>{{ $item->konser->tanggal_konser }}</td>
                                        <th>{{ $item->harga_tiket }}</th>
                                        <th>{{ $item->stock }}</th>

                                        {{-- <td>{{ formatRupiah($item->jumlah, "IDR. ") }}</td> --}}
                                        <td class="">
                                            {!! Form::open([
                                                'route' => [ $routePrefix . '.destroy', $item->id],
                                                'method' => 'DELETE',
                                                'onsubmit' => 'return confirm("Yakin ingin hapus data ?")',
                                                ]) !!}
                                                <a href="{{ route( $routePrefix . '.edit', $item->id) }}" class="btn btn-warning  btn-sm  mr-1">
                                                    <i class="fas fa-edit"></i></a>

                                                {!! Form::submit('Hapus', ['class' => 'btn btn-danger btn-sm']) !!}
                                           {!! Form::close() !!}
                                        </td>
                                        </td>
                                    </tr>
                                @empty
                                <tr>
                                    <td colspan="4">Belum ada data</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{-- {!! $models->links() !!} --}}
                    </div>
                </div>
            </div>
        </div>





@endsection
