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
                            <h4 class="card-title">FORM TAMBAH ROLE</h4>
                            <form action="{{ route('tambah.roles') }}" method="POST">
                                @csrf

                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <div class="mb-3  mt-3 mt-lg-0">
                                            <label class="form-label" for="roles">Nama Role</label>
                                            <input class="form-control" name="roles" id="roles">
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-success w-md">Tambah Role</i></button>
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

                            <h4 class="card-title my-2">Data Role</h4>
                            <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th class="text-center">Nama Role</th>
                                        <th class="text-center" width="15%">Aksi</th>

                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($roles as $index => $item)
                                    <tr>
                                        <td>{{ $index+1 }}</td>
                                        <td>{{ $item->roles }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}"> <i
                                                    class="dripicons-document-edit"></i></button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel">Edit Data Role</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('edit.roles', $item->id) }}" method="POST">
                                                            @csrf
                                                            <div class="row ">
                                                                <div class="col-lg">
                                                                    <div class="mb-3">
                                                                        <label for="roles" class="form-label">Nama Role</label>
                                                                        <input type="text" class="form-control" name="roles" id="roles" placeholder="Masukan Nama"
                                                                        value="{{ $item->roles }}">
                                                                      </div>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal{{ $item->id }}"> <i
                                                    class="dripicons-trash"></i></button>
                                             <!-- Modal -->
                                             <div class="modal fade" id="hapusModal{{ $item->id }}" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="hapusModalLabel">Hapus Data</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('hapus.supir',$item->id) }}" method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                          <div class="modal-body">
                                                            <div class="py-3 text-center">
                                                              <i class="ni ni-bell-55 ni-3x text-warning"></i><br>
                                                              <h7 class="text-gradient text-danger">Apakah kamu yakin, ingin menghapus data role <b>?</b></h7>
                                                              <p>{{ $item->roles }}</p>
                                                            </div>
                                                          </div>
                                                          <div class="modal-footer">
                                                            <button type="submit" class="btn btn-info">Ya, Hapus</button>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                          </div>
                                                          </form>
                                                    </div>
                                                </div>
                                                </div>
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