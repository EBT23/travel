@extends('layouts.base', ['title' => 'Dashboard - Administrator - Laravel 9'])

@section('content')
@include('layouts.header', ['title' => 'Dashboard', 'action' => 'Dashboard'])
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">FORM TAMBAH SUPIR</h4>
                            <form>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3  mt-3 mt-lg-0">
                                            <label class="form-label" for="nama">Masukkan Supir</label>
                                            <input class="form-control" name="nama" id="nama">
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    
                                    <button type="submit" class="btn btn-success w-md">Tambah Supir</i></button>
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

                            <h4 class="card-title my-2">Data Supir</h4>
                            <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100 text-center">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Nama Supir</th>
                                        <th width="15%">Aksi</th>

                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($nama as $index => $item)
                                    <tr>
                                        <td>{{ $index+1 }}</td>
                                        <td>{{ $item['nama'] }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary"> <i class="dripicons-document-edit"></i></button>
                                            <button type="button" class="btn btn-danger"> <i class="dripicons-trash"></i></button>
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