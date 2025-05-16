<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>Student Management</title>

  <!-- Bootstrap CSS -->
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
  />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
  />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />

  <style>
    body {
      margin: 0;
      padding: 0;
      transition: background-color 0.3s, color 0.3s;
    }

    .sidebar {
      width: 220px;
      background-color: #09153f;
      position: fixed;
      height: 100%;
      overflow: auto;
      z-index: 999;
      top: 0;
      left: 0;
      transition: background-color 0.3s, width 0.3s;
    }

    .sidebar .logo img {
      margin: 20px 0 10px 45px;
      width: 120px;
      height: 120px;
      border: 2px solid white;
      border-radius: 50%;
      transition: border-color 0.3s;
    }

    .sidebar a {
      display: block;
      color: white;
      padding: 16px;
      text-decoration: none;
      transition: background-color 0.3s, color 0.3s;
      cursor: pointer;
    }

    .sidebar a i {
      margin-right: 15px;
      font-size: 18px;
    }

    .sidebar a.active {
      background-color: #082a7b;
      color: white;
    }

    .sidebar a:hover:not(.active) {
      background-color: #555;
      color: white;
    }

    .content {
      margin-left: 220px;
      padding-top: 80px;
      background-color: #f8f9fa;
      min-height: 100vh;
      transition: margin-left 0.3s, background-color 0.3s, color 0.3s;
      color: black;
    }

    .navbar {
      position: fixed;
      top: 0;
      left: 220px;
      width: calc(100% - 220px);
      background-color: #f8f9fa !important;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      z-index: 1000;
      color: black;
      transition: background-color 0.3s, color 0.3s, box-shadow 0.3s;
    }

    .content-container {
      padding: 20px;
    }

    .overlay {
      display: none;
    }

    .modal-content {
      border-radius: 10px;
      max-width: 400px;
      margin: auto;
    }

    /* Dark Mode Styles */
    body.dark-mode {
      background-color: #121212 !important;
      color: white !important;
    }

    body.dark-mode .sidebar {
      background-color: rgb(17, 16, 16) !important;
    }

    body.dark-mode .sidebar .logo img {
      border-color: #bbb !important;
    }

    body.dark-mode .sidebar a {
      color: white !important;
    }

    body.dark-mode .sidebar a.active {
      background-color: gray !important;
      
      color: white !important;
    }

    body.dark-mode .sidebar a:hover:not(.active) {
      background-color: gray !important;
      color: white !important;
    }

    body.dark-mode .content {
      background-color: #1e1e1e !important;
      color: black !important;
    }

    body.dark-mode .navbar {
      background-color: #1f1f1f !important;
      box-shadow: none !important;
      color: white !important;
    }
    body.dark-mode .navbar-brand {
      box-shadow: none !important;
      color: white !important;
    }
    body.dark-mode #telegramQRModal {
      box-shadow: none !important;
      background-color: gray;
    }
  

    body.dark-mode .navbar .form-control {
      background-color: #333 !important;
      color: white !important;
      border-color: #444 !important;
    }

    body.dark-mode .btn-outline-success {
      color: white !important;
      border-color: #666 !important;
    }

    body.dark-mode .btn-outline-success:hover {
      background-color: #444 !important;
      border-color: #888 !important;
      color: white !important;
    }

    /* Responsive */
    @media screen and (max-width: 768px) {
      .sidebar {
        width: 0;
        overflow: hidden;
      }

      .sidebar.active {
        width: 220px;
        overflow: auto;
        background-color: rgba(9, 21, 63, 0.95);
      }

      .navbar {
        left: 0;
        width: 100%;
      }

      .content {
        margin-left: 0;
      }

      .content.shifted {
        margin-left: 220px;
      }

      .overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 998;
      }

      .overlay.show {
        display: block;
      }
    }

    @media screen and (max-width: 400px) {
      .sidebar a {
        text-align: center;
        float: none;
      }
    }
  </style>
</head>
<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <div class="logo">
      <img src="/image/logo.png" alt="Student Management System Logo" />
    </div>
    <a href="{{ url('/') }}" class="{{ Request::is('/') ? 'active' : '' }}">
      <i class="fas fa-home"></i> Home
    </a>
    <a href="{{ url('/students') }}" class="{{ Request::is('students*') ? 'active' : '' }}">
      <i class="fas fa-users"></i> Students
    </a>
    <a href="{{ url('/teachers') }}" class="{{ Request::is('teachers*') ? 'active' : '' }}">
      <i class="fas fa-chalkboard-teacher"></i> Teacher
    </a>
    <a href="{{ url('/courses') }}" class="{{ Request::is('courses*') ? 'active' : '' }}">
      <i class="fas fa-book"></i> Courses
    </a>
    <a href="{{ url('/batches') }}" class="{{ Request::is('batches*') ? 'active' : '' }}">
      <i class="fas fa-cogs"></i> Batches
    </a>
    <a href="{{ url('/enrollments') }}" class="{{ Request::is('enrollments*') ? 'active' : '' }}">
      <i class="fas fa-clipboard-check"></i> Enrollment
    </a>
    <a href="{{ url('/payments') }}" class="{{ Request::is('payments*') ? 'active' : '' }}">
      <i class="fas fa-credit-card"></i> Payment
    </a>

    <!-- Telegram link opens QR code modal -->
    <a href="#" data-toggle="modal" data-target="#telegramQRModal">
      <i class="fab fa-telegram"></i> Telegram
    </a>

    <!-- Dark Mode toggle button -->
    <a href="#" id="darkModeToggle">
      <i class="fas fa-moon"></i> Dark Mode
    </a>
  </div>

  <!-- Overlay for sidebar on mobile -->
  <div class="overlay" id="overlay"></div>

  <!-- Page Content -->
  <div class="content">
    <!-- Navbar -->
    <nav
      class="navbar navbar-expand-lg navbar-light animate__animated animate__fadeInDown"
    >
      <button
        class="btn btn-primary d-md-none mr-2"
        id="sidebarToggle"
        aria-label="Toggle sidebar"
      >
        <i class="fas fa-bars"></i>
      </button>
      <a class="navbar-brand" href="#">
        <h2 class="h5">Student Management System</h2>
      </a>
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <form class="form-inline my-2 my-lg-0 ml-auto">
          <input
            class="form-control mr-sm-2"
            type="search"
            placeholder="Search"
            aria-label="Search"
          />
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
            Search
          </button>
        </form>
      </div>
    </nav>

    <!-- Main Content -->
    <div
      class="content-container animate__animated animate__fadeInUp animate__faster"
    >
      @yield('content')
    </div>
  </div>

  <!-- Telegram QR Modal -->
  <div
    class="modal fade"
    id="telegramQRModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="telegramQRModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content text-center p-4">
        <h5 class="modal-title mb-4" id="telegramQRModalLabel">
          Scan Telegram QR Code
        </h5>
        <img
          src="/image/telegram-qr.png"
          alt="Telegram QR Code"
          style="max-width: 100%; width: 300px; height: 300px; margin: 0 auto;"
          class="img-fluid"
        />
        <button
          type="button"
          class="btn btn-secondary mt-4"
          data-dismiss="modal"
        >
          Close
        </button>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>

  <script>
    $(document).ready(function () {
      // Sidebar toggle for mobile
      $('#sidebarToggle').click(function () {
        $('.sidebar').toggleClass('active');
        $('#overlay').toggleClass('show');
      });

      $('#overlay').click(function () {
        $('.sidebar').removeClass('active');
        $(this).removeClass('show');
      });

      // Dark mode toggle
      $('#darkModeToggle').click(function (e) {
        e.preventDefault();
        $('body').toggleClass('dark-mode');

        // Save preference to localStorage
        if ($('body').hasClass('dark-mode')) {
          localStorage.setItem('darkMode', 'enabled');
        } else {
          localStorage.removeItem('darkMode');
        }
      });

      // On page load, check localStorage for dark mode
      if (localStorage.getItem('darkMode') === 'enabled') {
        $('body').addClass('dark-mode');
      }
    });
  </script>
</body>
</html>
