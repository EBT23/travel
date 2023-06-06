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
											<h4 class="card-title my-2">Data Persediaan</h4>
											<table id="datatable" class="table table-bordered dt-responsive  nowrap w-100 text-center">
												<thead>
													<tr>
														<th width="5%">No</th>
														<th>Tanggal Keberangkatan</th>
														<th>Jam Keberangkatan</th>
														<th>Asal</th>
														<th>Tujuan</th>
														<th>Kuota</th>
														<th>estimasi_perjalanan</th>
														<th>Harga</th>
														<th width="15%">Aksi</th>
													</tr>
												</thead>
												<tbody>
													<?php $no = 1; ?>
													@foreach ($persediaan_tiket as $pt)
														<tr>
															<td>{{ $no++ }}</td>
															<td>{{ date('d-m-Y', strtotime($pt['tgl_keberangkatan'])) }}</td>
															<td>{{ date('H:i', strtotime($pt['tgl_keberangkatan'])) . ' WIB' }}</td>
															<td>{{ $pt['asal'] }}</td>
															<td>{{ $pt['tujuan'] }}</td>
															<td>{{ $pt['kuota'] }}</td>
															<td>{{ $pt['estimasi_perjalanan'] . ' Jam' }}</td>
															<td>{{ $pt['harga'] }}</td>
															<td class="d-flex">
																<span>
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
