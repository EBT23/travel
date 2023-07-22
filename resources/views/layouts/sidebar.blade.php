<div class="vertical-menu">

	<div data-simplebar class="h-100">

		<!--- Sidemenu -->
		<div id="sidebar-menu">
			<!-- Left Menu Start -->
			<ul class="metismenu list-unstyled" id="side-menu">
				<li class="menu-title" key="t-menu">Home</li>
				<li>
					<a href="{{ route('dashboard') }}" class="waves-effect">
						<i class="bx bx-home"></i>
						<span key="t-dashboards">Dashboard</span>
					</a>
				</li>
				<li class="menu-title" key="t-menu">Menu Tiket</li>

				<li>
					<a href="javascript: void(0);" class="has-arrow waves-effect">
						<i class="bx bx-book"></i>
						<span key="t-dashboards">Tiket</span>
					</a>
					<ul class="sub-menu" aria-expanded="false">
						<li><a href="{{ route('pemesanan') }}" key="t-saas">Pemesanan</a></li>
						<li><a href="{{ route('jadwal') }}" key="t-saas">Jadwal Keberangkatan</a></li>
						<li><a href="{{ route('armada') }}" key="t-crypto">Armada</a></li>
						<li><a href="{{ route('fasilitas') }}" key="t-crypto">Fasilitas</a></li>
						<li><a href="{{ route('detail_fasilitas') }}" key="t-crypto">Detail Fasilitas</a></li>
						<li><a href="{{ route('tracking') }}" key="t-crypto">Tracking</a></li>
						<li><a href="{{ route('rute') }}" key="t-blog">Rute</a></li>
						{{-- <li><a href="{{ route('kota') }}" key="t-blog">Kota</a></li> --}}
					</ul>
				</li>



				<li class="menu-title" key="t-apps">Admin</li>
				<li>
					<a href="javascript: void(0);" class="has-arrow waves-effect">
						<i class="bx bx-edit"></i>
						<span key="t-dashboards">Admin</span>
					</a>
					<ul class="sub-menu" aria-expanded="false">
						<li><a href="{{ route('roles') }}" key="t-saas">Role</a></li>
						<li><a href="{{ route('supir') }}" key="t-blog">Supir</a></li>
					</ul>
				</li>




			</ul>
		</div>
		<!-- Sidebar -->
	</div>
</div>