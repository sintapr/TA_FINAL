<div class="nk-sidebar">           
    <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu">
            <!-- DASHBOARD -->
            <li>
                <a href="{{route('dashboard')}}" aria-expanded="false">
                    <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
                </a>
            </li>

            <!-- AKADEMIK -->
            <li>
                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                    <i class="icon-graduation menu-icon"></i><span class="nav-text">Akademik</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('siswa.index') }}">Data Siswa</a></li>
                    <li><a href="{{ route('kelas.index') }}">Data Kelas</a></li>
                    <li><a href="{{ route('orangtua.index') }}">Data Orangtua</a></li>
                    <li><a href="{{ route('guru.index') }}">Data Guru</a></li>
                    <li><a href="{{ route('tahun-ajaran.index') }}">Data Tahun Ajaran</a></li>  
                </ul>
            </li>

            <!-- ASSESMENT -->
            <li>
                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                    <i class="icon-pencil menu-icon"></i><span class="nav-text">Assesment</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('fase.index') }}">Data Fase</a></li>
                    <li><a href="./data-fase.html">Data Materi</a></li>
                    <li><a href="./data-fase.html">Data Indikator</a></li>
                    <li><a href="{{ route('surat.index') }}">Data Hafalan Surat</a></li>
                    <li><a href="{{ route('perkembangan.index') }}">Data Perkembangan</a></li>
                    <li><a href="{{ route('kondisi-siswa.index') }}">Data Kondisi Siswa</a></li>
                    <li><a href="{{ route('tujuan.index') }}">Data Tujuan Pembelajaran</a></li>
                </ul>
            </li>

            <!-- LAPORAN -->
            <li>
                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                    <i class="icon-docs menu-icon"></i><span class="nav-text">Laporan</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="./laporan-mingguan.html">Laporan Mingguan</a></li>
                    <li><a href="./laporan-semester.html">Laporan Semester</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
