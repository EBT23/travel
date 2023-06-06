@extends('layouts.base', ['title' => 'Dashboard - Administrator - Laravel 9'])

@section('content')
@include('layouts.header', ['title' => 'Dashboard', 'action' => 'Dashboard'])
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
            @if (Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @elseif (Session::has('errors'))
                <div class="alert alert-danger">
                    {{ Session::get('errors') }}
                </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title my-2">Pemesanan Tiket</h4>
                            <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th class="text-center">Tanggal Keberangkatan</th>
                                        <th class="text-center">Asal</th>
                                        <th class="text-center">Tujuan</th>
                                        <th class="text-center">Nama Pemesan</th>
                                        <th class="text-center">No HP</th>
                                        <th class="text-center">Harga</th>
                                        <th class="text-center">status</th>
                                        {{-- <th width="15%">Aksi</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    @foreach ($pemesanan as $pt)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td class="text-center">{{ date('d-m-Y', strtotime($pt->tgl_keberangkatan)) }}</td>
                                            <td>{{ $pt->asal }}</td>
                                            <td>{{ $pt->tujuan }}</td>
                                            <td>{{ $pt->nama_pemesan }}</td>
                                            <td>{{ $pt->no_hp }}</td>
                                            <td>Rp. {{ number_format($pt->harga) }}</td>
                                            <td class="text-center"> @if ($pt->status === 'lunas')
                                                <span class="badge bg-success">{{ $pt->status }}</span>
                                            @else
                                            <span class="badge bg-warning">{{ $pt->status }}</span>
                                            @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
</div>

@endsection