<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-light navbar-light">
        <div class="container">
         <b><a class="navbar-brand fs-2" href="#">{{ Auth::user()->name }}</a></b>
          <button class="navbar-toggler" type="button" data-mdb-collapse-init data-mdb-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto align-items-center">
              {{-- <li class="nav-item">
                <a class="nav-link mx-2" href="#!"><i class="fas fa-plus-circle pe-2"></i>Post</a>
              </li>
              <li class="nav-item">
                <a class="nav-link mx-2" href="#!"><i class="fas fa-bell pe-2"></i>Alerts</a>
              </li>
              <li class="nav-item">
                <a class="nav-link mx-2" href="#!"><i class="fas fa-heart pe-2"></i>Trips</a>
              </li> --}}
              <li class="nav-item ms-3">
                <a class="btn btn-dark btn-rounded" href="{{ route('logout') }}" >Sign Out</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      <div class="container mt-4">
        @yield('content')
    </div>
        <!-- Bootstrap JS Bundle (popper.js included) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js">
    </script>
</body>
</html>