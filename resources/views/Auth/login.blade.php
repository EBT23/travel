@extends('auth.layouts.app-login')

@section('content')

<body>
	<div class="account-pages my-5 pt-sm-5">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-8 col-lg-6 col-xl-5">
					<div class="card overflow-hidden">
						<div class="bg-primary bg-soft">
							<div class="row">
								<div class="col-7">
									<div class="text-primary p-4">
										<h5 class="text-primary">Nunut Berkah Tour and Travel</h5>
										<p>Sign in.</p>
									</div>
								</div>
								<div class="col-5 align-self-end">
									<img src="assets/images/profile-img.png" alt="" class="img-fluid">
								</div>
							</div>
						</div>
						<div class="card-body pt-0">
							<div class="auth-logo">
								<a href="index.html" class="auth-logo-light">
									<div class="avatar-md profile-user-wid mb-4">
										<span class="avatar-title rounded-circle bg-light">
											<img src="assets/images/nunut_berkah.jpg" alt="" class="rounded-circle"
												height="34">
										</span>
									</div>
								</a>

								<a href="index.html" class="auth-logo-dark">
									<div class="avatar-md profile-user-wid mb-4">
										<span class="avatar-title rounded-circle bg-light">
											<img src="assets/images/logo.svg" alt="" class="rounded-circle" height="34">
										</span>
									</div>
								</a>
							</div>
							<div class="p-2">
								<form class="form-horizontal" action="{{ route('aksi_login') }}">

									<div class="mb-3">
										<label for="email" class="form-label">Email</label>
										<input type="email" class="form-control" id="email" name="email"
											placeholder="Enter email">
									</div>

									<div class="mb-3">
										<label class="form-label">Password</label>
										<div class="input-group auth-pass-inputgroup">
											<input type="password" class="form-control" placeholder="Enter password"
												name="password" aria-label="Password" aria-describedby="password-addon">
											<button class="btn btn-light " type="button" id="password-addon"><i
													class="mdi mdi-eye-outline"></i></button>
										</div>
									</div>

									<div class="form-check">
										<input class="form-check-input" type="checkbox" id="remember-check">
										<label class="form-check-label" for="remember-check">
											Remember me
										</label>
									</div>

									<div class="mt-3 d-grid">
										<button class="btn btn-primary waves-effect waves-light" type="submit">Log
											In</button>
									</div>

									<div class="mt-4 text-center">
										<a href="auth-recoverpw.html" class="text-muted"><i
												class="mdi mdi-lock me-1"></i> Forgot your
											password?</a>
									</div>
								</form>
							</div>

						</div>
					</div>
					<div class="mt-5 text-center">

						<div>
							<p>Don't have an account ? <a href="{{ route('register') }}" class="fw-medium text-primary">
									Signup now </a> </p>

						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
	<!-- end account-pages -->
	@endsection