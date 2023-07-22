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
								<form action="{{ route('tambah.jadwal') }}" method="POST" enctype="multipart/form-data">
									@csrf
									<div class="form-group mt-3">
										<label for="tgl_keberangkatan">Tanggal Keberangkatan</label>
										<input type="date" class="form-control" id="tgl_keberangkatan" name="tgl_keberangkatan"
											aria-describedby="tgl_keberangkatan" required>
									</div>
									<div class="form-group mt-3">
										<label for="id_armada">Armada(Kendaraan)</label>
										<select class="form-control" id="id_armada" name="id_armada" required>
											<option value="">-- pilih armada --</option>
											@foreach ($armada as $ta)
												<option value="{{ $ta->id }}">{{ $ta->jenis_mobil}} - ({{ $ta->nopol }})</option>
											@endforeach
										</select>
									</div>
									<div class="form-group mt-3">
										<label for="rute">Rute</label>
										<select class="form-control" id="rute" name="rute" required>
											<option value="">-- pilih rute --</option>
											@foreach ($rute as $ta)
												<option value="{{ $ta->id }}">{{ $ta->keberangkatan}} ke {{ $ta->tujuan}} - (Pukul {{ $ta->waktu}} WIB)</option>
											@endforeach
										</select>
									</div>
									<div class="form-group mt-3">
										<label for="supir">Supir</label>
										<select class="form-control" id="id_user" name="id_user" required>
											<option value="">-- pilih supir --</option>
											@foreach ($supir as $sh)
												<option value="{{ $sh->id }}">{{ $sh->nama }}</option>
											@endforeach
										</select>
									</div>
									{{-- <div class="form-group mt-3">
										<label for="kuota">Kuota</label>
										<input type="number" class="form-control" id="kuota" name="kuota" aria-describedby="kuota">
									</div> --}}
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
														<th  class="text-center" width="5%">No</th>
														<th  class="text-center">Tanggal Keberangkatan</th>
														<th  class="text-center">Armada</th>
														<th  class="text-center">Jumlah Kursi</th>
														<th  class="text-center">Rute</th>
														<th  class="text-center">Supir</th>
														{{-- <th  class="text-center">Kuota</th> --}}
														<th  class="text-center">Estimasi Perjalanan</th>
														<th  class="text-center">Harga</th>
														<th  class="text-center" width="15%">Aksi</th>
													</tr>
												</thead>
												<tbody>
													<?php $no = 1; ?>
													@foreach ($getJadwal as $pt)
														<tr>
															<td>{{ $no++ }}</td>
															<td class="text-center">{{ date('l, d F Y', strtotime($pt->tgl_keberangkatan)) }}</td>
															{{-- <td class="text-center">{{ date('H:i', strtotime($pt['tgl_keberangkatan'])) . ' WIB' }}</td> --}}
															<td class="text-center">{{ $pt->jenis_mobil }} - ({{ $pt->nopol }})</td>
															<td class="text-center">{{ $pt->kapasitas }}</td>
															<td>
																<p class="text-xs font-weight-bold mb-0">{{ $pt->keberangkatan }} ke {{ $pt->tujuan }}</p>
																<p class="text-xs text-secondary mb-0">pukul {{ date('H:i', strtotime($pt->waktu)) . ' WIB' }}</p>
															  </td>
															{{-- <td class="text-center"></td> --}}
															<td class="text-center">{{ $pt->nama }}</td>
															{{-- <td class="text-center">{{ $pt->kuota }}</td> --}}
															<td class="text-center">{{ $pt->estimasi_perjalanan . ' Jam' }}</td>
															<td class="text-center">Rp. {{ number_format($pt->harga) }}</td>
															<td class="d-sm-flex">
																<span class="text-center">
																	<a href="{{ route('edit.jadwal', $pt->id) }}" type="button"
																		class="btn btn-primary m-md-1">
																		<i class="dripicons-document-edit"></i></a>
																</span>
																<span>
																	<form action="{{ route('delete.jadwal', $pt->id) }}" method="POST">
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
