<nav class="page-sidebar" id="sidebar">
    <div id="sidebar-collapse">
        <div class="admin-block d-flex">
            <div class="admin-info">
                <div class="font-strong">{{ Session::get('username') }}</div><small>{{ Session::get('role') }}</small>
            </div>
        </div>
        <ul class="side-menu metismenu">
            <li class="heading">Menu</li>
            <li>
                <a href="index.html"><i class="sidebar-item-icon fa fa-th-large"></i>
                    <span class="nav-label">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#"><i class="sidebar-item-icon fa fa-bookmark"></i>
                    <span class="nav-label">Data Master</span><i class="fa fa-angle-down arrow"></i></a>
                <ul class="nav-2-level collapse in">
                    <li>
                        <a @if(Request::segment(1) == 'pengguna') class="active" @endif href="{{ url('pengguna') }}">Pengguna</a>
                    </li>
                    <li>
                        <a @if(Request::segment(1) == 'pegawai') class="active" @endif href="{{ url('pegawai') }}">Pegawai</a>
                    </li>
                    <li>
                        <a @if(Request::segment(1) == 'ruangan') class="active" @endif href="{{ url('ruangan') }}">Ruangan</a>
                    </li>
                    <li>
                        <a @if(Request::segment(1) == 'waktu_reguler') class="active" @endif href="{{ url('waktu_reguler') }}">Jam Kerja Reguler</a>
                    </li>
                    <li>
                        <a @if(Request::segment(1) == 'jam_kerja_shift') class="active" @endif href="{{ url('jam_kerja_shift') }}">Jam Kerja Shift</a>
                    </li>
                    <li>
                        <a @if(Request::segment(1) == 'ruletelat') class="active" @endif href="{{ url('ruletelat') }}">Rule Telat</a>
                    </li>
                    <!-- <li>
                        <a @if(Request::segment(1) == 'harilibur') class="active" @endif href="{{ url('harilibur') }}">Hari Libur</a>
                    </li> -->

                </ul>
            </li>
            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-edit"></i>
                    <span class="nav-label">Presensi</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse in">
                    <li>
                        <a @if(Request::segment(1) == 'sinkronisasi') class="active" @endif href="{{ url('sinkronisasi') }}">Sinkronisasi</a>
                    </li>
                    <li>
                        <a @if(Request::segment(1) == 'riwayat_presensi') class="active" @endif href="{{ url('riwayat_presensi') }}">Hasil Presensi</a>
                    </li>
                    <li>
                        <a href="form_masks.html">Cuti</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>