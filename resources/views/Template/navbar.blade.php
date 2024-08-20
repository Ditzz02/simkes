<header id="header" class="header fixed-top d-flex align-items-center">
  <div class="d-flex align-items-center justify-content-between">
      <a href="/beranda" class="logo d-flex align-items-center">
        <img src="{{ asset('img/Logo_Polimdo.png')}}" alt="">
        <span class="d-none d-lg-block">SIMKES</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

   

    <nav class="header-nav ms-auto ">
          <a class="nav-link nav-profile d-flex align-items-center pe-0 m-3" href="#" data-bs-toggle="dropdown">
            <img src="{{ Auth::user()->level === 'Admin' ? asset('NiceAdmin/assets/img/profile-img.jpg') : asset('storage/' . Auth::user()->foto) }}" alt="" class="rounded-circle" style="height:55px; width: 38px; object-fit:cover; border-radius:50%; display:block;">
            <span class="d-none d-md-block dropdown-toggle ps-2" style="color: white">{{ Auth::user()->name }}</span>
          </a><!-- End Profile Image Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>{{ Auth::user()->name }}</h6>
              <span>{{ Auth::user()->level }}</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route('profil') }}">
                <i class="bi bi-person"></i>
                <span>Profil Saya</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}">
                <i class="bi bi-box-arrow-right"></i>
                <span>Keluar</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->
  </header><!-- End Header -->