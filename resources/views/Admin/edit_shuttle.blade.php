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
										<label for="kota_id">Jenis Mobil</label>
										<input type="text" class="form-control" id="kota_id"
											value="{{ $shuttle['jenis_mobil'] }}" name="kota_id"
											aria-describedby="kota_id" required>
									</div>
									<div class="form-group mt-3">
										<label for="id_fasilitas">Fasilitas</label>
										<input type="text" class="form-control" id="id_fasilitas"
											value="{{ $shuttle['nama_fasilitas'] }}" name="id_fasilitas"
											aria-describedby="id_fasilitas" required>
									</div>
									<button type="submit" class="btn btn-primary mt-3">Submit</button>
									<a href="{{ route('agen.index') }}" class="btn btn-secondary mt-3">Kembali</a>
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
