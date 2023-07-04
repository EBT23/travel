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
								<form action="{{ route('update.agen', $tempat_agen->id) }}" method="POST"
									enctype="multipart/form-data">
									@csrf
									<div class="form-group mt-3">
										<label for="nama_kota">kota</label>
										<select class="form-control" id="kota_id" name="kota_id" required>
										<option value="" selected disabled>Pilih kota</option>
										@foreach ($kota as $sh)
												<option <?= $tempat_agen->kota_id == $sh->id ? 'selected' : '' ?> value="{{ $sh->id }}">
													{{ $sh->nama_kota }}</option>
											@endforeach
									</select>
									</div>

									<div class="form-group mt-3">
										<label for="tempat_agen">Tempat Agen</label>
										<input type="text" class="form-control" id="tempat_agen"
											value="{{ $tempat_agen->tempat_agen }}" name="tempat_agen"
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
