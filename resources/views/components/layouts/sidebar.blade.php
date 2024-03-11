<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{ asset('adminlte-v3') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block">{{ session()->get('user_name') }}</a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
   with font-awesome or any other icon font library -->
            <li class="nav-item has-treeview">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="nav-icon fas fa-home"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            <li class="nav-header">MAIN</li>

            <li class="nav-item has-treeview">
                <a href="pages/widgets.html" class="nav-link">
                    <i class="nav-icon fas fa-user"></i>
                    <p>
                        Profile Me
                        <span class="right badge badge-danger">New</span>
                    </p>
                </a>
            </li>
            <li class="nav-header">SETTING</li>
            <li class="nav-item has-treeview">
                <a href="{{ route('role') }}" class="nav-link">
                    <i class="nav-icon fas fa-sitemap"></i>
                    <p>Role</p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="{{ route('permission') }}" class="nav-link">
                    <i class="nav-icon fas fa-user-tie"></i>
                    <p>Permission</p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="{{ route('user') }}" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>User</p>
                </a>
            </li>
            <li class="nav-item">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-link w-100 bg-gray ">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>
                    </button>
                </form>
            </li>


        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
