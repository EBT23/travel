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
								<form action="{{ route('update.detail.fasilitas', $detfasilitas->id) }}" method="POST"
									enctype="multipart/form-data">
									@csrf
									<div class="form-group mt-3">
										<label for="id_armada">Nama Armada</label>
										<select name="id_armada" id="id_armada" class="form-control">
											<option selected>-Pilih Fasilitas-</option>
											@foreach($armada as $gs)
											<option @if($detfasilitas->id_armada == $gs->id) selected @endif value="{{ $gs->id }}">{{ $gs->jenis_mobil}}</option>
											@endforeach
										</select>
									</div>

									<div class="form-group mt-3">
										<label for="id_fasilitas">Nama Fasilitas</label>
										<select name="id_fasilitas" id="id_fasilitas" class="form-control">
											<option selected>-Pilih Fasilitas-</option>
											@foreach($fasilitas as $gs)
											<option @if($detfasilitas->id_fasilitas == $gs->id) selected @endif value="{{ $gs->id }}">{{ $gs->nama_fasilitas}}</option>
											@endforeach
										</select>
									</div>

									<button type="submit" class="btn btn-primary mt-3">Simpan</button>
									<a href="{{ route('detail_fasilitas') }}" class="btn btn-secondary mt-3">Kembali</a>
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
