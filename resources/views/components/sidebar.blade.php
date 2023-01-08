<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item dropdown {{ $type_menu === 'dashboard' ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('dashboard-manager') ? 'active' : '' }}'>
                        <a class="nav-link" href="{{ url('dashboard-manager') }}">Manager Dashboard</a>
                    </li>
                    <li class='{{ Request::is('dashboard-company') ? 'active' : '' }}'>
                        <a class="nav-link" href="{{ url('dashboard-company') }}">Company Dashboard</a>
                    </li>
                    <li class='{{ Request::is('dashboard-general') ? 'active' : '' }}'>
                        <a class="nav-link" href="{{ url('dashboard-general') }}">User Dashboard</a>
                    </li>
                </ul>
            </li>
            <li class="menu-header">Control</li>
            <li class="nav-item dropdown {{ $type_menu === 'transaction' ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Transaction</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('form-buy-saham/1') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('form-buy-saham/1') }}">Beli Saham</a>
                    </li>
                    <li class="{{ Request::is('detail-sell-saham') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('detail-sell-saham') }}">Jual Saham</a>
                    </li>
                    <li class="{{ Request::is('layout-top-navigation') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('layout-top-navigation') }}">Top Navigation</a>
                    </li>
                </ul>
            </li>
            <li class="{{ Request::is('detail-saham/1') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('detail-saham/1') }}"><i class="far fa-file-alt"></i>
                    <span>Detail Saham</span></a>
            </li>

            <li class="menu-header">Info</li>
            <li class="nav-item dropdown {{ $type_menu === 'components' ? 'active' : '' }}">
            <li class="{{ Request::is('faq') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('faq') }}"><i class="far fa-question-circle"></i>
                    <span>FAQ</span></a>
            </li>
            </li>
        </ul>
    </aside>
</div>
