<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('css/NavBar.css') }}">
  <title>Aston Events - @yield('title')</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light" id = navBar1>
    <a class="navbar-brand" href="/">
    <img src="https://is3-ssl.mzstatic.com/image/thumb/Purple115/v4/7f/98/56/7f9856bd-45ca-f108-8618-f4f2701d0a2c/source/256x256bb.jpg" width="30" height="30" class="d-inline-block align-top" alt="">
    Aston Events
  </a>
    <form class="form-inline  " action="/Search" method="POST">
      @CSRF
      <!-- Search Bar input -->
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" id="Search" name="Search">

    </form>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <div class="mr-auto"></div>
      <ul class="navbar-nav my-2 my-lg-0">
<li class="nav-item active">
        <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
      </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-display="static" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Profile
        </a>
            @if (Auth::check())
            <div class="dropdown-menu dropdown-menu-lg-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('ViewProfile')}}">View Profile</a>
            <a class="dropdown-item" href="{{ route('CreateEvent')}}">Create Events</a>
            <a class="dropdown-item" href="{{ route('logout')}}">Logout</a>
          </div>
            @else
          <div class="dropdown-menu dropdown-menu-lg-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('Login')}}">Login</a>
            <a class="dropdown-item" href="{{ route('Register')}}">Signup</a>
          </div>
          @endif

        </li>

      </ul>

      </div>
  </nav>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
