<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
            <a href="{{ route('profile.show') }}" class="d-block">{{ Auth::user()->name }}</a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
            data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        {{ __('dashboard.home') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('users.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        {{ __('dashboard.users') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('serials.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-list"></i>
                    <p>
                        {{ __('dashboard.serials') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('reviews.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-eye"></i>
                    <p>
                        {{ __('dashboard.reviews') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('attributes.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-text-height"></i>
                    <p>
                        {{ __('dashboard.attributes') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('attribute-values.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-database"></i>
                    <p>
                        {{ __('dashboard.attribute_values') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('about') }}" class="nav-link">
                    <i class="nav-icon far fa-address-card"></i>
                    <p>
                        {{ __('About us') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-circle nav-icon"></i>
                    <p>
                        Two-level menu
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Child menu</p>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
