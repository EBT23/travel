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
                            <h4 class="card-title">FORM TAMBAH DATA AGEN</h4>
                            <form action="{{ route('tambah.agen') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg">
                                        <div class="mb-3  mt-3 mt-lg-0">
                                            <label for="nama_kota">kota</label>
										    <select class="form-control" id="nama_kota" name="nama_kota" required>
											<option value="">Pilih kota</option>
											@foreach ($kota as $kt)
												<option <?= $kt['nama_kota'] ? 'selected' : '' ?> value="{{ $kt['id'] }}">
													{{ $kt['nama_kota'] }}</option>
											@endforeach
										</select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg">
                                        <div class="mb-3  mt-3 mt-lg-0">
                                            <label class="form-label" for="tempat_agen">Masukkan Data</label>
                                            <input class="form-control" name="tempat_agen" id="tempat_agen">
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-success w-md">Tambah Agen</i></button>
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
                            <h4 class="card-title my-2">Data Agen</h4>
                            <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100 text-center">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Nama Kota</th>
                                        <th>Lokasi Agen</th>
                                        <th width="15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tempat_agen as $index => $ta)
                                    <tr>
                                        <td>{{ $index+1 }}</td>
                                        <td>{{ $ta['nama_kota'] }}</td>
                                        <td>{{ $ta['tempat_agen'] }}</td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-4">
                                                <a href="{{ route('edit.agen', ['id' => $ta['id']]) }}" type="button"
                                                    class="btn btn-soft-primary waves-effect waves-light">
                                                   <i class="dripicons-document-edit"></i></a>

                                                   <form action="{{ route('delete.tempat.agen', ['id' => $ta['id']]) }}" method="POST">
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