<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

  <div class="d-flex align-items-center justify-content-between">
    <a href="index.html" class="logo d-flex align-items-center">
      <img src="assets/img/logo.png" alt="">
      {{-- <span class="d-none d-lg-block">MUP Admin</span> --}}
    </a>
    <!-- <i class="bi bi-list toggle-sidebar-btn"></i> -->
  </div><!-- End Logo -->

  <!-- Navigation with Left-Aligned and Right-Aligned Dropdowns -->
  <nav class="header-nav w-100 d-flex align-items-center">
    <ul class="d-flex align-items-center w-100">
      
      <!-- Left-Aligned Dropdowns (Manage Stocks and Manage Sales) -->
      <div class="d-flex me-auto align-items-center">
        <!-- Manage Stocks Dropdown -->
        <li class="nav-item dropdown me-3">
          <a class="nav-link dropdown-toggle" href="#" id="manageStocksDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Manage Stocks
          </a>
          <ul class="dropdown-menu" aria-labelledby="manageStocksDropdown">
            <li><a class="dropdown-item" href="{{ route('dashboard') }}">Add Books</a></li>
            <li><a class="dropdown-item" href="{{ route('manageStocks') }}">Manage Stocks</a></li>
          </ul>
        </li>

        <!-- Manage Sales Dropdown -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="manageSalesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Manage Sales
          </a>
          <ul class="dropdown-menu" aria-labelledby="manageSalesDropdown">
            <li><a class="dropdown-item"  href="{{ route('manageSaleEntry') }}">Sale Entry</a></li>
          </ul>
        </li>
      </div><!-- End Left-Aligned Dropdowns -->

      <!-- Right-Aligned Profile Dropdown -->
      <li class="nav-item dropdown pe-3 ms-auto">
        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
          <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
          {{-- <span class="d-none d-md-block dropdown-toggle ps-2">K. Anderson</span> --}}
          <span class="d-none d-md-block dropdown-toggle ps-2">
            {{ Auth::user() ? Auth::user()->name : 'Guest' }}
        </span>
        </a><!-- End Profile Image Icon -->

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
          <li class="dropdown-header">
            <h6>{{ Auth::user() ? Auth::user()->name : 'Guest' }}</h6>
            <span>Position</span>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li>
            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
              <i class="bi bi-person"></i>
              <span>My Profile</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li>
            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
              <i class="bi bi-gear"></i>
              <span>Account Settings</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li>
            <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
              <i class="bi bi-question-circle"></i>
              <span>Need Help?</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>
          {{-- <li>
            <a class="dropdown-item d-flex align-items-center" href="#">
              <i class="bi bi-box-arrow-right"></i>
              <span>Sign Out</span>
            </a>
          </li> --}}
          <li>
            <a class="dropdown-item d-flex align-items-center" href="#"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="bi bi-box-arrow-right"></i>
              <span>Sign Out</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
          </li>
        </ul><!-- End Profile Dropdown Items -->
      </li><!-- End Profile Nav -->

    </ul>
  </nav><!-- End Icons Navigation -->

</header><!-- End Header -->
