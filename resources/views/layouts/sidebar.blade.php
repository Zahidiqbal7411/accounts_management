<!-- Sidebar -->
<aside class="sidebar">
    <div class="sidebar-header">
        <h2>Accounts</h2>
    </div>

    <nav class="sidebar-nav">
        <ul>
            <li>
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('accounts.index') }}" class="{{ request()->routeIs('accounts.*') ? 'active' : '' }}">
                    <i class="fas fa-wallet"></i> Accounts
                </a>
            </li>
            <li>
                <a href="{{ route('products.index') }}" class="{{ request()->routeIs('products.*') ? 'active' : '' }}">
                    <i class="fas fa-box"></i> Products
                </a>
            </li>
            <li>
                <a href="{{ route('services.index') }}" class="{{ request()->routeIs('services.index') ? 'active' : '' }}">
                    <i class="fas fa-cogs"></i> Services
                </a>
            </li>
            <li>
                <a href="{{ route('services.expiry') }}" class="{{ request()->routeIs('services.expiry') ? 'active' : '' }}">
                    <i class="fas fa-calendar-times"></i> Service Expiry
                </a>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </form>
            </li>
        </ul>
    </nav>
</aside>

