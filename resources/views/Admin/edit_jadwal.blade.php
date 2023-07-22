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
								<h4 class="card-title">{{ $title }}</h4>
								<form action="{{ route('update.jadwal', $jadwal->id) }}" method="POST"
									enctype="multipart/form-data">
									@csrf
									<div class="form-group mt-3">
										<label for="tgl_keberangkatan">Tanggal Keberangkatan</label>
										<input type="datetime-local" class="form-control" id="tgl_keberangkatan"
											value="{{ date('Y-m-d H:i:s', strtotime($jadwal['tgl_keberangkatan'])) }}" name="tgl_keberangkatan"
											aria-describedby="tgl_keberangkatan" required>
									</div>
									<div class="form-group mt-3">
										<label for="id_armada">Armada</label>
										<select class="form-control" id="id_armada" name="id_armada" required>
											<option value="">pilih armada</option>
											@foreach ($armada as $ta)
												<option <?= $jadwal->id_armada == $ta->id ? 'selected' : '' ?> value="{{ $ta->id }}">
													{{ $ta->jenis_mobil}} - ({{ $ta->nopol }})</option>
											@endforeach
										</select>
									</div>

									<div class="form-group mt-3">
										<label for="rute">Rute</label>
										<select class="form-control" id="rute" name="rute" required>
											<option value="">pilih rute</option>
											@foreach ($rute as $r)
												<option <?= $jadwal->rute == $r->id ? 'selected' : '' ?> value="{{ $r->id }}">
													{{ $r->keberangkatan}} ke {{ $r->tujuan}} - (Pukul {{ $r->waktu}} WIB)</option>
											@endforeach
										</select>
									</div>
									
									<div class="form-group mt-3">
										<label for="id_user">Supir</label>
										<select class="form-control" id="id_user" name="id_user" required>
											<option value="">pilih supir</option>
											@foreach ($supir as $r)
												<option <?= $jadwal->id_user == $r->id ? 'selected' : '' ?> value="{{ $r->id }}">
													{{ $r->nama}}</option>
											@endforeach
										</select>
									</div>
									{{-- <div class="form-group mt-3">
										<label for="kuota">Kuota</label>
										<input type="number" class="form-control" id="kuota" name="kuota" value="{{ $persediaan['kuota'] }}"
											aria-describedby="kuota">
									</div> --}}
							
									<div class="form-group mt-3">
										<label for="estimasi_perjalanan">Estimasi Perjalanan</label>
										<input type="number" class="form-control" id="estimasi_perjalanan"
											value="{{ $jadwal->estimasi_perjalanan }}" name="estimasi_perjalanan"
											aria-describedby="estimasi_perjalanan">
									</div>
									<div class="form-group mt-3">
										<label for="harga">Harga</label>
										<input type="number" class="form-control" id="harga" name="harga" value="{{ $jadwal->harga }}"
											aria-describedby="harga">
									</div>
									<button type="submit" class="btn btn-primary mt-3">Submit</button>
									<a href="{{ route('jadwal') }}" class="btn btn-secondary mt-3">Kembali</a>
								</form>
							</div>
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
