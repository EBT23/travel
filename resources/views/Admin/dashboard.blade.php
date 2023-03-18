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
                            <h4 class="card-title">Pilih Tiket</h4>
                            <form>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3 ajax-select mt-3 mt-lg-0">
                                            <label class="form-label">Asal -</label>
                                            <select class="form-control select2-ajax"></select>

                                        </div>
                                        <div class="mb-2">
                                            <label>Pilih Tanggal</label>
                                            <div class="input-group" id="datepicker1">
                                                <input type="text" class="form-control" placeholder="dd M, yyyy" data-date-format="dd M, yyyy" data-date-container='#datepicker1' data-provide="datepicker">
                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            </div><!-- input-group -->
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3 ajax-select mt-3 mt-lg-0">
                                            <label class="form-label">Tujuan -</label>
                                            <select class="form-control select2-ajax"></select>
                                        </div>
                                        <div class="mb-2">
                                            <label>Jumlah -</label>
                                            <div class="input-group">
                                                <input type="number" name="jumlah" class="form-control" placeholder="jumlah">
                                            </div><!-- input-group -->
                                        </div>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-success w-md">Cari Tiket</i></button>
                                    </div>
                                </div>

                            </form>

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