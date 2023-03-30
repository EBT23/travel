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
								<form action="{{ route('update.agen', ['id' => $tempat_agen['id']]) }}" method="POST"
									enctype="multipart/form-data">
									@csrf
									<div class="form-group mt-3">
										<label for="kota_id">Nama Kota</label>
										<input type="text" class="form-control" id="kota_id"
											value="{{ $tempat_agen['nama_kota'] }}" name="kota_id"
											aria-describedby="kota_id" required>
									</div>

									<div class="form-group mt-3">
										<label for="tempat_agen">Tempat Agen</label>
										<input type="text" class="form-control" id="tempat_agen"
											value="{{ $tempat_agen['tempat_agen'] }}" name="tempat_agen"
											aria-describedby="tempat_agen" required>
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
