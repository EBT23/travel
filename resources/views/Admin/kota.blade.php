@extends('layouts.base', ['title' => "$title - Admin"])

@section('content')
@include('layouts.header', ['title' => 'Dashboard', 'action' => 'Dashboard'])
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
             <!-- start page title -->
             <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Kelola Kota</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="">Tables</a></li>
                                <li class="breadcrumb-item active">Data Tables</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body ">
                            
                            <h4 class="card-title ">Data Kota</h4>
                           
                            <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                    <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($kota as $item)
                            <tr>
                                <td>{{ $item['nama_kota'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- end row -->
</div>
<!-- container-fluid -->
</div>
<!-- End Page-content -->

</div>
@endsection