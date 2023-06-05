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
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title my-2">Tracking</h4>
                                <table id="datatable"
                                    class="table table-bordered dt-responsive  nowrap w-100 text-center">
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th>Asal</th>
                                            <th>Tujuan</th>
                                            <th>Lat, Long</th>
                                            <th>Nama Lokasi</th>
                                            <th>Waktu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tracking as $index => $ta)
                                        <tr>
                                            <td>{{ $index+1 }}</td>
                                            <td>{{ $ta->nama_kota }}</td>
                                            <td>{{ $ta->tujuan }}</td>
                                            <td>{{ $ta->lat_long }}</td>
                                            <td>{{ $ta->nama_lokasi }}</td>
                                            <td>{{ $ta->tgl.' '.$ta->jam }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div> <!-- end col -->
                </div>
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->


    </div>


    @endsection