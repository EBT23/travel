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
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body col-lg">
                            <h4 class="card-title">FORM TAMBAH DATA RUTE</h4>
                            <form action="{{ route('tambah.rute') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg">
                                        <div class="mb-3  mt-3 mt-lg-0">
                                            <label class="form-label" for="keberangkatan">Keberangkatan</label>
                                            <input type="text" class="form-control" name="keberangkatan" id="keberangkatan">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg">
                                        <div class="mb-3  mt-3 mt-lg-0">
                                            <label class="form-label" for="tujuan">Tujuan</label>
                                            <input type="text" class="form-control" name="tujuan" id="tujuan">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg">
                                        <div class="mb-3  mt-3 mt-lg-0">
                                            <label class="form-label" for="waktu">Waktu</label>
                                            <input type="time" class="form-control" name="waktu" id="waktu">
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-success w-md">Tambah Rute</i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title my-2">Data Rute</h4>
                            <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100 text-center">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Keberangkatan</th>
                                        <th>Tujuan</th>
                                        <th>Waktu Keberangkatan</th>
                                        <th width="15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($getRute as $index => $ta)
                                    <tr>
                                        <td>{{ $index+1 }}</td>
                                        <td>{{ $ta['keberangkatan'] }}</td>
                                        <td>{{ $ta['tujuan'] }}</td>
                                        <td>Pukul {{ $ta['waktu'] }} WIB</td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-4">
                                                <a href="{{ route('edit.rute', ['id' => $ta['id']]) }}" type="button"
                                                    class="btn btn-soft-primary waves-effect waves-light">
                                                   <i class="dripicons-document-edit"></i></a>

                                                   <form action="{{ route('delete.rute', ['id' => $ta['id']]) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <button onclick="return confirm('Anda yakin akan menghapus ini? ')" type="submit"
                                                    class="btn btn-soft-danger waves-effect waves-light"> <i class="dripicons-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>
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