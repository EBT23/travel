@extends('layouts.base', ['title' => "$title - Admin"])

@section('content')
@include('layouts.header', ['title' => 'Dashboard', 'action' => 'Dashboard'])
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Data Supir</h4>
<table>
    <thead>
        <tr>
            <th>Nama</th>
            <th>No HP</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $user)
        <tr>
            <td>{{ $user['nama'] }}</td>
            <td>{{ $user['no_hp'] }}</td>
            <td>{{ $user['email'] }}</td>
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