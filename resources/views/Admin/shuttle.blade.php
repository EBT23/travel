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
								<h4 class="card-title">FORM TAMBAH DATA SHUTTLE</h4>
								<form>
									<div class="row">
										<div class="col-lg-6">
											<div class="mb-3  mt-3 mt-lg-0">
												<label class="form-label" for="jenis_mobil">Masukkan Data</label>
												<input class="form-control" name="jenis_mobil" id="jenis_mobil">
											</div>
										</div>
									</div>
									<div>
										<button type="submit" class="btn btn-success w-md">Tambah Shuttle</i></button>
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
								<h4 class="card-title my-2">Data Shuttle</h4>
								<table id="datatable" class="table table-bordered dt-responsive  nowrap w-100 text-center">
									<thead>
										<tr>
											<th width="5%">No</th>
											<th>Jenis Shuttle</th>
											<th>Nama Fasilitas</th>
											<th width="15%">Aksi</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($shuttle as $index => $s)
											<tr>
												<td>{{ $index + 1 }}</td>
												<td>{{ $s['jenis_mobil'] }}</td>
												<td>{{ $s['nama_fasilitas'] }}</td>
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
