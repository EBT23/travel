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
								<form action="{{ route('update.kota', ['id' => $kota['id']]) }}" method="POST"
									enctype="multipart/form-data">
									@csrf
									<div class="form-group mt-3">
										<label for="nama_kota">Nama Kota</label>
										<input type="text" class="form-control" id="nama_kota"
											value="{{ $kota['nama_kota'] }}" name="nama_kota"
											aria-describedby="nama_kota" required>
									</div>
									<button type="submit" class="btn btn-primary mt-3">Submit</button>
									<a href="{{ route('kota') }}" class="btn btn-secondary mt-3">Kembali</a>
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
