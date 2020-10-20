@php
    $user = auth()->user();
@endphp
<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">
            <li>
                <a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
            </li>
            @can('admin')
                <li>
                    <a href="{{ route('posisi.index') }}"><i class="fa fa-gear"></i> Posisi / Divisi</a>
                </li>
                <li>
                    <a href="{{ route('sekolah.index') }}"><i class="fa fa-building-o"></i> Sekolah</a>
                </li>
                <li>
                    <a href="{{ route('program-keahlian.index') }}"><i class="fa fa-list"></i> Program Keahlian</a>
                </li>
                <li>
                    <a href="{{ route('kategori.index') }}"><i class="fa fa-list-alt"></i> Kategori Penilaian</a>
                </li>
            @endcan
            @can('pembimbing')
                <li>
                    <a href="{{ route('kelola-masalah.index') }}"><i class="fa fa-list-alt"></i> Kelola Permasalahan Kerja</a>
                </li>
                <li>
                    <a href="{{ route('kelola-bimbingan.index') }}"><i class="fa fa-list-alt"></i> Kelola Bimbingan</a>
                </li>
                <li>
                    <a href="{{ route('kelola-nilai.index') }}"><i class="fa fa-archive"></i> Nilai</a>
                </li>
            @endcan
            @can('peserta')
                <li>
                    <a href="{{ route('kegiatan.index') }}"><i class="fa fa-list-alt"></i> Log Kegiatan</a>
                </li>
                <li>
                    <a href="{{ route('bimbingan.index') }}"><i class="fa fa-list-alt"></i> Bimbingan</a>
                </li>
                <li>
                    <a href="{{ route('absensi.index') }}"><i class="fa fa-list-alt"></i> Absensi</a>
                </li>
                <li>
                    <a href="{{ route('permasalahan-kerja.index') }}"><i class="fa fa-archive"></i> Permasalahan Kerja</a>
                </li>
                <li>
                    <a href="{{ route('nilai.index') }}"><i class="fa fa-sort-numeric-asc"></i> Nilai</a>
                </li>
            @endcan
            @canany(['admin','pembimbing'])
                <li>
                    <a href="{{ route('pkl.index') }}"><i class="fa fa-briefcase"></i> Kelola Peserta PKL</a>
                </li>
            @endcanany
            @can('admin')
                <li>
                    <a href="#"><i class="fa fa-user"></i> List Akun<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('peserta.index') }}">Peserta</a>
                        </li>
                        <li>
                            <a href="{{ route('pembimbing.index') }}">Pembimbing</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.index') }}">Admin</a>
                        </li>
                    </ul>
                </li>
            @endcan
            {{--            <li>--}}
            {{--                <a href="ui-elements.html"><i class="fa fa-desktop"></i> UI Elements</a>--}}
            {{--            </li>--}}

            {{--            <li>--}}
            {{--                <a href="#"><i class="fa fa-sitemap"></i> Charts<span class="fa arrow"></span></a>--}}
            {{--                <ul class="nav nav-second-level">--}}
            {{--                    <li>--}}
            {{--                        <a href="chart.html">Charts JS</a>--}}
            {{--                    </li>--}}
            {{--                    <li>--}}
            {{--                        <a href="morris-chart.html">Morris Chart</a>--}}
            {{--                    </li>--}}
            {{--                </ul>--}}
            {{--            </li>--}}
            {{--            <li>--}}
            {{--                <a href="tab-panel.html"><i class="fa fa-qrcode"></i> Tabs & Panels</a>--}}
            {{--            </li>--}}

            {{--            <li>--}}
            {{--                <a href="table.html"><i class="fa fa-table"></i> Responsive Tables</a>--}}
            {{--            </li>--}}
            {{--            <li>--}}
            {{--                <a href="form.html"><i class="fa fa-edit"></i> Forms </a>--}}
            {{--            </li>--}}


            {{--            <li>--}}
            {{--                <a href="#"><i class="fa fa-sitemap"></i> Multi-Level Dropdown<span class="fa arrow"></span></a>--}}
            {{--                <ul class="nav nav-second-level">--}}
            {{--                    <li>--}}
            {{--                        <a href="#">Second Level Link</a>--}}
            {{--                    </li>--}}
            {{--                    <li>--}}
            {{--                        <a href="#">Second Level Link</a>--}}
            {{--                    </li>--}}
            {{--                    <li>--}}
            {{--                        <a href="#">Second Level Link<span class="fa arrow"></span></a>--}}
            {{--                        <ul class="nav nav-third-level">--}}
            {{--                            <li>--}}
            {{--                                <a href="#">Third Level Link</a>--}}
            {{--                            </li>--}}
            {{--                            <li>--}}
            {{--                                <a href="#">Third Level Link</a>--}}
            {{--                            </li>--}}
            {{--                            <li>--}}
            {{--                                <a href="#">Third Level Link</a>--}}
            {{--                            </li>--}}

            {{--                        </ul>--}}

            {{--                    </li>--}}
            {{--                </ul>--}}
            {{--            </li>--}}
            {{--            <li>--}}
            {{--                <a href="empty.html"><i class="fa fa-fw fa-file"></i> Empty Page</a>--}}
            {{--            </li>--}}
        </ul>

    </div>

</nav>
