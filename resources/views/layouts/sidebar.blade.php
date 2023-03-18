<div class="vertical-menu">

	<div data-simplebar class="h-100">

		<!--- Sidemenu -->
		<div id="sidebar-menu">
			<!-- Left Menu Start -->
			<ul class="metismenu list-unstyled" id="side-menu">
				<li class="menu-title" key="t-menu">Menu Tiket</li>

				<li>
					<a href="javascript: void(0);" class="has-arrow waves-effect">
						<i class="bx bx-book"></i>
						<span key="t-dashboards">Tiket</span>
					</a>
					<ul class="sub-menu" aria-expanded="false">
						<li><a href="dashboard-saas.html" key="t-saas">Pemesanan</a></li>
						<li><a href="{{ route('persediaan_tiket') }}" key="t-saas">Persediaan</a></li>
						<li><a href="dashboard-crypto.html" key="t-crypto">Shuttle</a></li>
						<li><a href="dashboard-crypto.html" key="t-crypto">Tracking</a></li>
						<li><a href="dashboard-blog.html" key="t-blog">Tempat Agen</a></li>
						<li><a href="{{ route('kota') }}" key="t-blog">Kota</a></li>
					</ul>
				</li>



				<li class="menu-title" key="t-apps">Admin</li>
				<li>
					<a href="javascript: void(0);" class="has-arrow waves-effect">
						<i class="bx bx-edit"></i>
						<span key="t-dashboards">Admin</span>
					</a>
					<ul class="sub-menu" aria-expanded="false">
						<li><a href="dashboard-saas.html" key="t-saas">Role</a></li>
						<li><a href="{{ route('supir') }}" key="t-blog">Supir</a></li>


					</ul>
				</li>




			</ul>
		</div>
		<!-- Sidebar -->
	</div>
</div>
