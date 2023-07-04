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
								<form action="{{ route('update.shuttle', ['id' => $shuttle['id']]) }}" method="POST"
									enctype="multipart/form-data">
									@csrf
									<div class="form-group mt-3">
										<label for="jenis_mobil">Jenis Mobil</label>
										<input type="text" class="form-control" id="jenis_mobil"
											value="{{ $shuttle['jenis_mobil'] }}" name="jenis_mobil"
											aria-describedby="jenis_mobil" required>
									</div>
									<div class="form-group mt-3">
										<label for="kapasitas">Kapasitas</label>
										<input type="text" class="form-control" id="kapasitas"
											value="{{ $shuttle['kapasitas'] }}" name="kapasitas"
											aria-describedby="kapasitas" required>
									</div>
									<div class="form-group mt-3">
										<label for="fasilitas">Fasilitas</label>
										<input type="text" class="form-control" id="fasilitas"
											value="{{ $shuttle['fasilitas'] }}" name="fasilitas"
											aria-describedby="fasilitas" required>
									</div>
									<button type="submit" class="btn btn-primary mt-3">Submit</button>
									<a href="{{ route('shuttle.index') }}" class="btn btn-secondary mt-3">Kembali</a>
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
