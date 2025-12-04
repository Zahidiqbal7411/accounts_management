<!-- Navbar -->
<nav class="navbar">
    <div class="navbar-left">
        <span>@yield('page-title', 'Dashboard')</span>
    </div>
    <div class="navbar-right">
        <span>{{ Auth::user()->name ?? 'User' }}</span>
    </div>
</nav>
