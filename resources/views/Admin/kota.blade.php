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


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title my-4 text-center">Data Pemesan</h4>
                            <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Office</th>
                                        <th>Age</th>
                                        <th>Start date</th>
                                        <th>Salary</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    <tr>
                                        <td>Tiger Nixon</td>
                                        <td>System Architect</td>
                                        <td>Edinburgh</td>
                                        <td>61</td>
                                        <td>2011/04/25</td>
                                        <td>$320,800</td>
                                    </tr>
                                    <tr>
                                        <td>Garrett Winters</td>
                                        <td>Accountant</td>
                                        <td>Tokyo</td>
                                        <td>63</td>
                                        <td>2011/07/25</td>
                                        <td>$170,750</td>
                                    </tr>
                                    <tr>
                                        <td>Ashton Cox</td>
                                        <td>Junior Technical Author</td>
                                        <td>San Francisco</td>
                                        <td>66</td>
                                        <td>2009/01/12</td>
                                        <td>$86,000</td>
                                    </tr>
                                    <tr>
                                        <td>Cedric Kelly</td>
                                        <td>Senior Javascript Developer</td>
                                        <td>Edinburgh</td>
                                        <td>22</td>
                                        <td>2012/03/29</td>
                                        <td>$433,060</td>
                                    </tr>
                                    <tr>
                                        <td>Airi Satou</td>
                                        <td>Accountant</td>
                                        <td>Tokyo</td>
                                        <td>33</td>
                                        <td>2008/11/28</td>
                                        <td>$162,700</td>
                                    </tr>
                                    <tr>
                                        <td>Brielle Williamson</td>
                                        <td>Integration Specialist</td>
                                        <td>New York</td>
                                        <td>61</td>
                                        <td>2012/12/02</td>
                                        <td>$372,000</td>
                                    </tr>
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