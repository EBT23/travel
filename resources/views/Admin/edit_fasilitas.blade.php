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
								<form action="{{ route('update.fasilitas', ['id' => $fasilitas['id']]) }}" method="POST"
									enctype="multipart/form-data">
									@csrf
									<div class="form-group mt-3">
										<label for="nama_fasilitas">Nama Fasilitas</label>
										<input type="text" class="form-control" id="nama_fasilitas"
											value="{{ $fasilitas['nama_fasilitas'] }}" name="nama_fasilitas"
											aria-describedby="nama_fasilitas" required>
									</div>

									<button type="submit" class="btn btn-primary mt-3">Simpan</button>
									<a href="{{ route('fasilitas') }}" class="btn btn-secondary mt-3">Kembali</a>
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
