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
								<form action="{{ route('update.persediaan.tiket', ['id' => $persediaan['id']]) }}" method="POST"
									enctype="multipart/form-data">
									@csrf
									<div class="form-group mt-3">
										<label for="tgl_keberangkatan">Tanggal Keberangkatan</label>
										<input type="datetime-local" class="form-control" id="tgl_keberangkatan"
											value="{{ date('Y-m-d H:i:s', strtotime($persediaan['tgl_keberangkatan'])) }}" name="tgl_keberangkatan"
											aria-describedby="tgl_keberangkatan" required>
									</div>
									<div class="form-group mt-3">
										<label for="asal">Asal</label>
										<select class="form-control" id="asal" name="asal" required>
											<option value="">Pilih asal</option>
											@foreach ($tempat_agen as $ta)
												<option <?= $persediaan['asal'] == $ta['tempat_agen'] ? 'selected' : '' ?> value="{{ $ta['id'] }}">
													{{ $ta['tempat_agen'] }}</option>
											@endforeach
										</select>
									</div>
									<div class="form-group mt-3">
										<label for="tujuan">tujuan</label>
										<select class="form-control" id="tujuan" name="tujuan" required>
											<option value="">Pilih tujuan</option>
											@foreach ($tempat_agen as $ta)
												<option <?= $persediaan['tujuan'] == $ta['tempat_agen'] ? 'selected' : '' ?> value="{{ $ta['id'] }}">
													{{ $ta['tempat_agen'] }}</option>
											@endforeach
										</select>
									</div>
									<div class="form-group mt-3">
										<label for="kuota">Kuota</label>
										<input type="number" class="form-control" id="kuota" name="kuota" value="{{ $persediaan['kuota'] }}"
											aria-describedby="kuota">
									</div>
									<div class="form-group mt-3">
										<label for="estimasi_perjalanan">Estimasi Perjalanan</label>
										<input type="number" class="form-control" id="estimasi_perjalanan"
											value="{{ $persediaan['estimasi_perjalanan'] }}" name="estimasi_perjalanan"
											aria-describedby="estimasi_perjalanan">
									</div>
									<div class="form-group mt-3">
										<label for="harga">Harga</label>
										<input type="number" class="form-control" id="harga" name="harga" value="{{ $persediaan['harga'] }}"
											aria-describedby="harga">
									</div>
									<button type="submit" class="btn btn-primary mt-3">Submit</button>
									<a href="{{ route('persediaan_tiket') }}" class="btn btn-secondary mt-3">Kembali</a>
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
