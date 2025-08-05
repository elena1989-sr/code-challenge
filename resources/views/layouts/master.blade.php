<!doctype html>
<html lang="en">
  <head>
  	<title>code-challenge</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="{{ asset('navbar/css/style.css') }}">
  </head>
  <body>
		<div class="wrapper d-flex align-items-stretch">
			
      <div id="app" class="p-4 p-md-5" style="margin:auto">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                  <img src="{{ asset('images/job-search-logo.png') }}" alt="auth" width="35px">
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}">Jobs</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Gross-net calculation</a>
              </li>
              <li class="nav-item">
                
                @auth
                  @if (Auth::user()->role === 'seeker')
                    <li class="nav-item">
                        <a class="nav-link" href="{{  route('jobs.saved')  }}">Saved jobs</a>
                    </li>
                  @endif
                @endauth
              </li>
               
              <li class="nav-item">
                
                @auth
                  @if (Auth::user()->role === 'owner')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('createjob') }}">Add a job</a>
                    </li>
                  @endif
                @endauth
              </li>
            </ul>
        
            @if(auth()->check())
              @auth
                @if(auth()->user()->role === 'owner')
                    <p style="margin-bottom:0;margin-right:4px">{{ auth()->user()->email }}!</p>
                @elseif(auth()->user()->role === 'seeker')
                    <p style="margin-bottom:0;margin-right:4px">Looking for a job?</p>
                @endif
              @endauth
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-primary">Logout</button>
              </form>
             
            @else
                <a class="nav-link" href="{{ route('login')}}" style="font-weight:bold">Login</a>
            @endif

          </div>
        </nav>

      @yield('content')
    </div>
	
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>

  </body>
</html>