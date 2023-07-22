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
								<form action="{{ route('update.rute', $rute->id) }}" method="POST"
									enctype="multipart/form-data">
									@csrf
									<div class="form-group mt-3">
										<label for="keberangkatan">Keberangkatan</label>
										<input type="text" class="form-control" id="keberangkatan"
											value="{{ $rute->keberangkatan }}" name="keberangkatan"
											aria-describedby="keberangkatan" required>
									</div>

									<div class="form-group mt-3">
										<label for="tujuan">Tujuan</label>
										<input type="text" class="form-control" id="tujuan"
											value="{{ $rute->tujuan }}" name="tujuan"
											aria-describedby="tujuan" required>
									</div>

									<div class="form-group mt-3">
										<label for="waktu">Waktu</label>
										<input type="text" class="form-control" id="waktu"
											value="{{ $rute->waktu }}" name="waktu"
											aria-describedby="waktu" required>
									</div>

									<button type="submit" class="btn btn-primary mt-3">Simpan</button>
									<a href="{{ route('rute') }}" class="btn btn-secondary mt-3">Kembali</a>
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
