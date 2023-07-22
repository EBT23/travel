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
								<form action="{{ route('update.armada', ['id' => $armada['id']]) }}" method="POST"
									enctype="multipart/form-data">
									@csrf
									<div class="form-group mt-3">
										<label for="nopol">Nomor Polisi</label>
										<input type="text" class="form-control" id="nopol"
											value="{{ $armada['nopol'] }}" name="nopol"
											aria-describedby="nopol" required>
									</div>

									<div class="form-group mt-3">
										<label for="jenis_mobil">Jenis Mobil</label>
										<input type="text" class="form-control" id="jenis_mobil"
											value="{{ $armada['jenis_mobil'] }}" name="jenis_mobil"
											aria-describedby="jenis_mobil" required>
									</div>
									
									<div class="form-group mt-3">
										<label for="kapasitas">Jumlah Kursi</label>
										<input type="number" class="form-control" id="kapasitas"
											value="{{ $armada['kapasitas'] }}" name="kapasitas"
											aria-describedby="kapasitas" required>
									</div>
									
									<button type="submit" class="btn btn-primary mt-3">Simpan</button>
									<a href="{{ route('armada') }}" class="btn btn-secondary mt-3">Kembali</a>
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
