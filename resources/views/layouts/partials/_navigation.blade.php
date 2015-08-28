<div class="container-fluid">
    <nav class="navbar navbar-light bg-faded" style="background: white">
        <a class="navbar-brand" href="{{ route('home_path') }}">Michael Norris</a>
        <ul class="nav navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('home_path') }}">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Features</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Pricing</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">About</a>
            </li>
            @if ( auth()->check() )
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout_path') }}">Sign out</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login_path') }}">Sign in</a>
                </li>
            @endif
        </ul>
        <form class="form-inline navbar-form pull-right">
            <input class="form-control input-search" type="text" placeholder="Search..." v-model="search" autofocus>
        </form>
    </nav>
</div>