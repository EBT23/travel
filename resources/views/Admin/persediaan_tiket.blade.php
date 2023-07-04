@extends('layouts.base', ['title' => 'Dashboard - Administrator - Laravel 9'])

@section('content')
	@include('layouts.header', ['title' => 'Dashboard', 'action' => 'Dashboard'])
	<div class="main-content">
		<div class="page-content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<div>
							@if (Session::has('success'))
								<div class="alert alert-success">
									{{ Session::get('success') }}
								</div>
							@elseif (Session::has('errors'))
								<div class="alert alert-danger">
									{{ Session::get('errors') }}
								</div>
							@endif
						</div>
						<div class="card">
							<div class="card-body">
								<h4 class="card-title">{{ $title }}</h4>
								<form action="{{ route('tambah.persediaan.tiket') }}" method="POST" enctype="multipart/form-data">
									@csrf
									<div class="form-group mt-3">
										<label for="tgl_keberangkatan">Tanggal Keberangkatan</label>
										<input type="date" class="form-control" id="tgl_keberangkatan" name="tgl_keberangkatan"
											aria-describedby="tgl_keberangkatan" required>
									</div>
									<div class="form-group mt-3">
										<label for="asal">Asal</label>
										<select class="form-control" id="asal" name="asal" required>
											<option value="">Pilih asal</option>
											@foreach ($tempat_agen as $ta)
												<option value="{{ $ta['id'] }}">{{ $ta['tempat_agen'] }}</option>
											@endforeach
										</select>
									</div>
									<div class="form-group mt-3">
										<label for="asal">tujuan</label>
										<select class="form-control" id="tujuan" name="tujuan" required>
											<option value="">Pilih tujuan</option>
											@foreach ($tempat_agen as $ta)
												<option value="{{ $ta['id'] }}">{{ $ta['tempat_agen'] }}</option>
											@endforeach
										</select>
									</div>
									<div class="form-group mt-3">
										<label for="kuota">Kuota</label>
										<input type="number" class="form-control" id="kuota" name="kuota" aria-describedby="kuota">
									</div>
									<div class="form-group mt-3">
										<label for="asal">Armada</label>
										<select class="form-control" id="id_shuttle" name="id_shuttle" required>
											<option value="">Pilih armada</option>
											@foreach ($shuttle as $sh)
												<option value="{{ $sh['id'] }}">{{ $sh['jenis_mobil'] }}</option>
											@endforeach
										</select>
									</div>
									<div class="form-group mt-3">
										<label for="estimasi_perjalanan">Estimasi Perjalanan</label>
										<input type="number" class="form-control" id="estimasi_perjalanan" name="estimasi_perjalanan"
											aria-describedby="estimasi_perjalanan">
									</div>
									<div class="form-group mt-3">
										<label for="harga">Harga</label>
										<input type="number" class="form-control" id="harga" name="harga" aria-describedby="harga">
									</div>
									<button type="submit" class="btn btn-primary mt-3">Submit</button>
								</form>
							</div>
							<div class="row">
								<div class="col-12">
									<div class="card">
										<div class="card-body">
											<h4 class="card-title my-2">Data Jadwal Keberangkatan</h4>
											<table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
												<thead>
													<tr>
														<th rowspan="2" class="text-center" width="5%">No</th>
														<th rowspan="2" class="text-center">Tanggal Keberangkatan</th>
														<th rowspan="2" class="text-center">Jam Keberangkatan</th>
														<th colspan="2" class="text-center">Rute</th>
														<th rowspan="2" class="text-center">Kuota</th>
														<th rowspan="2" class="text-center">Armada</th>
														<th rowspan="2" class="text-center">Estimasi Perjalanan</th>
														<th rowspan="2" class="text-center">Harga</th>
														<th rowspan="2" class="text-center" width="15%">Aksi</th>
													</tr>
													<tr>
														<th class="text-center">Asal</th>
														<th class="text-center">Tujuan</th>
													</tr>
												</thead>
												<tbody>
													<?php $no = 1; ?>
													@foreach ($persediaan_tiket as $pt)
														<tr>
															<td>{{ $no++ }}</td>
															<td class="text-center">{{ date('d-m-Y', strtotime($pt['tgl_keberangkatan'])) }}</td>
															<td class="text-center">{{ date('H:i', strtotime($pt['tgl_keberangkatan'])) . ' WIB' }}</td>
															<td class="text-center">{{ $pt['asal'] }}</td>
															<td class="text-center">{{ $pt['tujuan'] }}</td>
															<td class="text-center">{{ $pt['kuota'] }}</td>
															<td class="text-center">{{ $pt['jenis_mobil'] }}</td>
															<td class="text-center">{{ $pt['estimasi_perjalanan'] . ' Jam' }}</td>
															<td class="text-center">{{ $pt['harga'] }}</td>
															<td class="d-sm-flex">
																<span class="text-center">
																	<a href="{{ route('form.edit.persediaan', ['id' => $pt['id']]) }}" type="button"
																		class="btn btn-primary m-md-1">
																		<i class="dripicons-document-edit"></i></a>
																</span>
																<span>
																	<form action="{{ route('delete.persediaan.tiket', ['id' => $pt['id']]) }}" method="POST">
																		{{ csrf_field() }}
																		{{ method_field('DELETE') }}
																		<button onclick="return confirm('Anda yakin akan menghapus ini? ')" type="submit"
																			class="btn btn-danger mt-1"> <i class="dripicons-trash"></i></button>
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
					</div>
				</div>
				<!-- end row -->
			</div>
			<!-- container-fluid -->
		</div>
		<!-- End Page-content -->
	</div>
@endsection
