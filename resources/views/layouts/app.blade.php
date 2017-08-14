<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Gestion Incidencias') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://bootswatch.com/united/bootstrap.css" >
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger  En login no se muestra -->
                   @if (!Auth::guest())
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                   @endif

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Gestion de Incidencias') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                         @if(auth()->check())
                         <form class="navbar-form">
                            <div class="form-group">
                                <select name="list-of-projects" id="list-of-projects" class="form-control">
                                @if(count(auth()->user()->list_of_projects)>0)
                                    @foreach(auth()->user()->list_of_projects as $project)
                                        <option @if($project->id==auth()->user()->selected_project_id) selected @endif value="{{ $project->id }}">{{ $project->name }}</option>
                                    @endforeach
                                @else
                                     <option value="">Sin proyectos</option>
                                @endif
                                </select>
                            </div>
                         </form>  
                         @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                       {{--
                        <li><a href="{{ route('login') }}">Login</a></li>
                             @if(auth()->user()->is_admin) 
                                 <li><a href="{{ route('register') }}">Register</a></li>
                             @endif    
                        --}}
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                {{--     @include("includes.registeradmin") --}}
                                    <li>
                                    
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include("includes.menu")
            </div>
            <div class="col-md-9">
                @yield('content')
            </div>
        </div>
    </div>
        
    </div>

    <!-- Scripts -->
    <script src="http://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="/js/app.js" ></script>
    @yield('scripts')
</body>
</html>
