<aside id="sidebar" class="sidebar">
  <ul class="sidebar-nav" id="sidebar-nav">
      <li class="nav-item" data-toggle="collapse" data-target=".navbar-collapse.show">
          <a class="nav-link @if(Route::currentRoutename() !='beranda') collapsed @endif" href="{{ Route('beranda') }}">
              <i class="bi bi-grid"></i>
              <span>Dashboard</span>
          </a>
      </li><!-- End Dashboard Nav -->

      @if(Auth::guard('user')->check())
      <li class="nav-item" data-toggle="collapse" data-target=".navbar-collapse.show">
          <a class="nav-link @if(Route::currentRoutename() !='daftar_mahasiswa') collapsed @endif" data-bs-target="#mahasiswa-nav" data-bs-toggle="collapse" href="#">  
          <i class="bi bi-people"></i>
          <span>Mahasiswa</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="mahasiswa-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
              <li>
                  <a class="nav-link @if(Route::currentRoutename() =='daftar_mahasiswa') active @endif" href="{{ route('daftar_mahasiswa') }}">  
                  <i class="bi bi-circle"></i><span>Daftar Mahasiswa</span>
                  </a>
              </li>
              <li>
                  <a class="nav-link @if(Route::currentRoutename() =='tambah_mahasiswa') active @endif" href="{{ route('tambah_mahasiswa') }}">  
                  <i class="bi bi-circle"></i><span>Tambah Mahasiswa</span>
                  </a>
              </li>
          </ul>
      </li>
      <li class="nav-item" data-toggle="collapse" data-target=".navbar-collapse.show">
          <a class="nav-link @if(Route::currentRoutename() !='daftar_dosen') collapsed @endif" data-bs-target="#dosen-nav" data-bs-toggle="collapse" href="#">  
          <i class="ri-contacts-fill"></i>
          <span>Dosen</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="dosen-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
              <li>
                  <a class="nav-link @if(Route::currentRoutename() =='daftar_dosen') active @endif" href="{{ route('daftar_dosen') }}">  
                  <i class="bi bi-circle"></i><span>Daftar Dosen</span>
                  </a>
              </li>
              <li>
                  <a class="nav-link @if(Route::currentRoutename() =='tambah_dosen') active @endif" href="{{ route('tambah_dosen') }}">  
                  <i class="bi bi-circle"></i><span>Tambah Dosen</span>
                  </a>
              </li>
          </ul>
      </li>
      <li class="nav-item" data-toggle="collapse" data-target=".navbar-collapse.show">
        <a class="nav-link @if(Route::currentRoutename() !='daftar_mk') collapsed @endif" data-bs-target="#mk-nav" data-bs-toggle="collapse" href="#">  
        <i class="ri-book-2-fill"></i>
        <span>Mata Kuliah</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="mk-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a class="nav-link @if(Route::currentRoutename() =='daftar_mk') active @endif" href="{{ route('daftar_mk') }}">  
                <i class="bi bi-circle"></i><span>Daftar Mata Kuliah</span>
                </a>
            </li>
            <li>
                <a class="nav-link @if(Route::currentRoutename() =='tambah_mk') active @endif" href="{{ route('tambah_mk') }}">  
                <i class="bi bi-circle"></i><span>Tambah Mata Kuliah</span>
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-item" data-toggle="collapse" data-target=".navbar-collapse.show">
        <a class="nav-link @if(Route::currentRoutename() !='prodi') collapsed @endif" data-bs-target="#prodi-nav" data-bs-toggle="collapse" href="#">  
        <i class="bx bx-network-chart"></i>
        <span>Prodi</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="prodi-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a class="nav-link @if(Route::currentRoutename() =='prodi') active @endif" href="{{ route('prodi') }}">  
                <i class="bi bi-circle"></i><span>Daftar Prodi</span>
                </a>
            </li>
            <li>
                <a class="nav-link @if(Route::currentRoutename() =='prodi-tambah') active @endif" href="{{ route('prodi-tambah') }}">  
                <i class="bi bi-circle"></i><span>Tambah Prodi</span>
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-item" data-toggle="collapse" data-target=".navbar-collapse.show">
        <a class="nav-link @if(Route::currentRoutename() !='daftar-krs') collapsed @endif" data-bs-target="#krs-nav" data-bs-toggle="collapse" href="#">  
        <i class="bx bxs-graduation"></i>
        <span>Akademik</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="krs-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a class="nav-link @if(Route::currentRoutename() =='show-nilai') active @endif" href="{{ route('show-nilai') }}">  
                <i class="bi bi-circle"></i><span>Input Nilai</span>
                </a>
            </li>
            <li>
                <a class="nav-link @if(Route::currentRoutename() =='tambah-krs') active @endif" href="{{ route('tambah-krs') }}">  
                <i class="bi bi-circle"></i><span>Tambah KRS</span>
                </a>
            </li>
            <li>
                <a class="nav-link @if(Route::currentRoutename() =='show-khs') active @endif" href="{{ route('show-khs') }}">  
                <i class="bi bi-circle"></i><span>KHS</span>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item" data-toggle="collapse" data-target=".navbar-collapse.show">
        <a class="nav-link @if(Route::currentRoutename() !='atur-konsul') collapsed @endif" data-bs-target="#konsul-nav" data-bs-toggle="collapse" href="#">  
        <i class="bx bxs-user-voice"></i>
        <span>Bimbingan</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="konsul-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a class="nav-link @if(Route::currentRoutename() =='daftar-bimbigan') active @endif" href="{{ route('daftar-bimbingan') }}">  
                <i class="bi bi-circle"></i><span>Daftar</span>
                </a>
            </li>
        </ul>
    </li>
    @endif
    @if(Auth::guard('mahasiswa')->check())
    <li class="nav-item" data-toggle="collapse" data-target=".navbar-collapse.show">
        <a class="nav-link @if(Route::currentRoutename() !='konsul-index') collapsed @endif" data-bs-target="#konsultasi-nav" data-bs-toggle="collapse" href="#">  
        <i class="bx bx-paper-plane"></i>
        <span>Konsultasi</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="konsultasi-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a class="nav-link @if(Route::currentRoutename() =='konsul-index') active @endif" href="{{ route('konsul-index') }}">  
                <i class="bi bi-circle"></i><span>Daftar Konsultasi</span>
                </a>
            </li>
            <li>
                <a class="nav-link @if(Route::currentRoutename() =='konsul-create') active @endif" href="{{ route('konsul-create') }}">  
                <i class="bi bi-circle"></i><span>Buat Konsultasi</span>
                </a>
            </li>
        </ul>
    </li>
    @endif

    @if(Auth::guard('dosen')->check())
    <li class="nav-item" data-toggle="collapse" data-target=".navbar-collapse.show">
        <a class="nav-link @if(Route::currentRoutename() !='konsul-index') collapsed @endif" data-bs-target="#konsultasi-nav" data-bs-toggle="collapse" href="#">  
        <i class="bx bx-paper-plane"></i>
        <span>Konsultasi</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="konsultasi-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a class="nav-link @if(Route::currentRoutename() =='konsul-index') active @endif" href="{{ route('konsul-index') }}">  
                <i class="bi bi-circle"></i><span>Daftar Konsultasi</span>
                </a>
            </li>
        </ul>
    </li>
    @endif
    @if(Auth::guard('kaprodi')->check())
    <li class="nav-item" data-toggle="collapse" data-target=".navbar-collapse.show">
        <a class="nav-link @if(Route::currentRoutename() !='beranda') collapsed @endif" href="{{ Route('kaprodi-index') }}">
            <i class="bx bxs-message-square-check"></i>
            <span>Daftar Konsultasi</span>
        </a>
    </li>
    @endif  

  </ul>
</aside><!-- End Sidebar-->