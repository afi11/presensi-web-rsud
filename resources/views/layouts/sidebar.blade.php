<nav class="page-sidebar" id="sidebar">
    <div id="sidebar-collapse">
        <div class="admin-block d-flex">
            <div>
                <img src="./assets/img/admin-avatar.png" width="45px" />
            </div>
            <div class="admin-info">
                <div class="font-strong">James Brown</div><small>Administrator</small>
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
                        <a href="colors.html">Pengguna</a>
                    </li>
                    <li>
                        <a @if(Request::segment(1) == 'pegawai') class="active" @endif href="{{ url('pegawai') }}">Pegawai</a>
                    </li>
                    <li>
                        <a @if(Request::segment(1) == 'ruangan') class="active" @endif href="{{ url('ruangan') }}">Ruangan</a>
                    </li>
                    <li>
                        <a @if(Request::segment(1) == 'shift') class="active" @endif href="{{ url('shift') }}">Shift</a>
                    </li>
                    <li>
                        <a @if(Request::segment(1) == 'harilibur') class="active" @endif href="{{ url('harilibur') }}">Hari Libur</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-edit"></i>
                    <span class="nav-label">Presensi</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse in">
                    <li>
                        <a href="form_basic.html">Jadwal</a>
                    </li>
                    <li>
                        <a href="form_advanced.html">Hasil Presensi</a>
                    </li>
                    <li>
                        <a href="form_masks.html">Cuti</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>