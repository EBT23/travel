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
							<div class="card-body">
								<h4 class="card-title">FORM TAMBAH DATA ARMADA</h4>
								<hr>
								<form action="{{ route('tambah.shuttle') }}" method="POST" enctype="multipart/form-data">
									@csrf
									<div class="row">
										<div class="col-lg-6">
											<div class="mb-3  mt-3 mt-lg-0">
												<label class="form-label" for="jenis_mobil">Jenis Mobil</label>
												<input type="text" class="form-control" id="jenis_mobil" name="jenis_mobil" placeholder="Masukkan Jenis Mobil">
											</div>
											<div class="mb-3  mt-3 mt-lg-0">
												<label class="form-label" for="kapasitas">Kapasitas</label>
												<input type="text" class="form-control" id="kapasitas" name="kapasitas" placeholder="Masukan kapasitas">
											</div>
											<div class="mb-3  mt-3 mt-lg-0">
												<label class="form-label" for="fasilitas">Fasilitas</label>
												<input type="text" class="form-control" id="fasilitas" name="fasilitas" placeholder="Masukan fasilitas">
											</div>
										</div>
									</div>
									<div>
										<button type="submit" class="btn btn-success w-md">Tambah</i></button>
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
								<h4 class="card-title my-2">Data Armada</h4>
								<table id="datatable" class="table table-bordered dt-responsive  nowrap w-100 text-center">
									<thead>
										<tr>
											<th width="5%">No</th>
											<th>Jenis Armada</th>
											<th>Kapasitas</th>
											<th>Nama Fasilitas</th>
											<th width="15%">Aksi</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($shuttle as $index => $s)
											<tr>
												<td>{{ $index + 1 }}</td>
												<td>{{ $s['jenis_mobil'] }}</td>
												<td>{{ $s['kapasitas'] }}</td>
												<td>{{ $s['fasilitas'] }}</td>
												<td>
													<div class="d-flex flex-wrap gap-4">
														<a href="{{ route('edit.shuttle', ['id' => $s['id']]) }}" type="button"
															class="btn btn-soft-primary waves-effect waves-light">
														   <i class="dripicons-document-edit"></i></a>
		
														   <form action="{{ route('delete.shuttle', ['id' => $s['id']]) }}" method="POST">
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
