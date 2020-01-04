<nav class="navbar navbar-expand navbar-dark bg-primary">
    <div class="navbar-nav w-100">
        <a class="navbar-brand text-color" href="/">TravelPlanet</a>
        
        @if(Auth::user())
        <a class="nav-item nav-link" href="/dashboard">Dashboard</a>
        <a class="nav-item nav-link" href="/hotels">Hotels</a>
        @endif
        @if (Route::has('login'))
        <div class="ml-auto">
            @auth
            <a class="nav-item nav-link float-left mr-2" href="javascipt:void(0)">{{ Auth::user()->name}}</a>
            <a class="nav-item float-right">
                <form action="/logout" method="POST">
                    @csrf
                    <!-- <input type="submit" value="Logout" class="btn btn-danger"> -->
                    <button type="submit" class="btn btn-outline-light">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </a>
            @else
            @if (Route::has('register'))
            <a class="nav-item float-right nav-link @if(Request::path() === 'register') active @endif"
                href="{{ url('/register') }}">Sign Up</a>
            @endif
            <a class="nav-item float-right nav-link @if(Request::path() === 'login') active @endif"
                href="{{ url('/login') }}">Sign In</a>
            @endauth
        </div>
        @endif
    </div>
</nav>