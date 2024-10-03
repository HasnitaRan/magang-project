<div id="layoutSidenav">

    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <a class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}"
                        href="{{ url('admin/dashboard') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>

                    <a class="nav-link {{ Request::is('admin/users') ? 'active' : '' }}"
                        href="{{ url('admin/users') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Data User
                    </a>

                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                        data-bs-target="#collapsePosts" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Master Data
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapsePosts" aria-labelledby="headingTwo"
                        data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link {{ Request::is('admin/sekolah') ? 'active' : '' }}"
                                href="{{ url('admin/sekolah') }}">Data Sekolah</a>
                            <a class="nav-link {{ Request::is('admin/guru') ? 'active' : '' }}"
                                href="{{ url('admin/guru') }}">Data Guru</a>
                            <a class="nav-link" href="#">Data Kelas</a>
                            <a class="nav-link" href="#">Data Siswa</a>
                            <a class="nav-link" href="#">Data Ekskul</a>
                            <a class="nav-link" href="#">Data Anggota Ekskul</a>
                            <a class="nav-link" href="#">Tahun Ajaran</a>
                            <a class="nav-link" href="#">Data Rombel</a>
                            <a class="nav-link" href="#">Data Pembelajaran</a>
                        </nav>
                    </div>

                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                        data-bs-target="#collapseMapel" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Mapel
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseMapel" aria-labelledby="headingTwo"
                        data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="#">Data Kelompok</a>
                            <a class="nav-link" href="#">Data Mapel</a>
                            <a class="nav-link" href="#">Data Sub Mapel</a>
                            <a class="nav-link" href="#">Pembelajaran</a>
                        </nav>
                    </div>

                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                        data-bs-target="#collapsePenilaian" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Penilaian
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapPenilaian" aria-labelledby="headingTwo"
                        data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <!-- <a class="nav-link" href="#">Data Kelompok</a>
                            <a class="nav-link" href="#">Data Mapel</a>
                            <a class="nav-link" href="#">Data Sub Mapel</a>
                            <a class="nav-link" href="#">Pembelajaran</a> -->
                        </nav>
                    </div>

                    <a class="nav-link" href="charts.html">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        Rekap Kehadiran
                    </a>

                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                        data-bs-target="#collapseCetak" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Cetak
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseCetak" aria-labelledby="headingTwo"
                        data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="#">Rapor UTS</a>
                            <a class="nav-link" href="#">Rapor UAS</a>
                        </nav>
                    </div>

                    <a class="nav-link" href="#">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Logout
                    </a>

                </div>
            </div>
        </nav>
    </div>
