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
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">FORM TAMBAH KOTA</h4>
                            <form action="{{ route('tambah.kota') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3  mt-3 mt-lg-0">
                                            <label class="form-label" for="nama_kota">Masukkan Kota</label>
                                            <input class="form-control" name="nama_kota" id="nama_kota">


                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-success w-md">Tambah Kota</i></button>
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

                            <h4 class="card-title my-2">Data Kota</h4>
                            <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100 text-center">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Nama Kota</th>
                                        <th width="15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($nama_kota as $index => $nk)
                                    <tr>
                                        <td>{{ $index+1 }}</td>
                                        <td>{{ $nk['nama_kota'] }}</td>
                                        <td>
                                             <!-- Button trigger modal -->
                                             <span>

                                                 <a href="{{ route('form.edit.kota', ['id' => $nk['id']]) }}" type="button"
                                                    class="btn btn-primary">
                                                    <i class="dripicons-document-edit"></i></a>
                                                </span>
                                                <span>

                                                    <form action="{{ route('delete.kota', ['id' => $nk['id']]) }}" method="POST">
                                                        {{ csrf_field() }}
                                                        {{ method_field('DELETE') }}
                                                        <button onclick="return confirm('Anda yakin akan menghapus ini? ')" type="submit"
                                                        class="btn btn-danger"> <i class="dripicons-trash"></i></button>
                                                    </form>
                                                </span>
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

    <!-- Static Backdrop Modal -->
    {{-- <div class="modal fade" id="staticBackdrop" data-id="{{ $nk['id'] }} " data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Kota</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('update.kota', ['id' => $nk['id']]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf>
                        <div class="mb-3">
                            <label for="nama_kota" class="form-label">Nama Kota</label>
                            <input type="text" class="form-control" id="nama_kota" value="{{ $nk['nama_kota'] }}">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="Submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
</div>

@endsection