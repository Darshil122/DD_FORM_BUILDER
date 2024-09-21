<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <img src="dist/img/logo.png" alt="FormBuilder" style="height: 9vmin; width: 30vmin;">

    <!-- Sidebar -->
    <div class="sidebar mt-3">
        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>
        <?php
                    $page = basename($_SERVER['PHP_SELF']);
                ?>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="index.php" class="nav-link <?= $page == 'index.php'?'active':''; ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="user.php" class="nav-link <?= $page == 'user.php'?'active':''; ?>">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Users
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="formlist.php" class="nav-link <?= $page == 'formlist.php'?'active':''; ?>">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Form
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="feedback.php" class="nav-link <?= $page == 'feedback.php'?'active':''; ?>">
                        <i class="nav-icon fas fa-comments"></i>
                        <p>
                            Feedback
                        </p>
                    </a>
                </li>
                <li class="nav-item text-white fixed-bottom ml-4 mb-4">
                    <h4>
                        <?php
                            echo $_SESSION['email'];
                        ?>
                    </h4>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>