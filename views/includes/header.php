<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Ontario Tech Library</title>

        <!-- Bootstrap -->
        <link href="/assets/css/bootstrap.min.css" rel="stylesheet">

        <!-- FontAwesome -->
        <link href="/assets/css/fontawesome.min.css" rel="stylesheet">

        <!-- FlatPickr (via CDN) -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

        <!-- Select2 (via CDN) -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.2.0/dist/select2-bootstrap-5-theme.min.css" />
        
        <!-- Custom CSS -->
        <link href="/assets/css/style.css" rel="stylesheet">
    </head>
    <body>
        <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
            <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="/"><strong>Ontario Tech</strong> Library</a>
            
            <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!--<input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">-->

            <?php if (empty($_SESSION['user'])): ?>

            <div class="container-fluid">
                <span class="navbar-text ms-auto">Please login to access the full library!</span></span>
            </div>

            <div class="navbar-nav">
                <div class="nav-item text-nowrap">
                    <a class="nav-link px-3" href="/login">Login <small><i class="fa fa-sign-in-alt"></i></small></a>
                </div>         
            </div>

            <?php else: ?>

            <div class="container-fluid">
                <span class="navbar-text ms-auto">Logged in as <span class="text-light"><?= $_SESSION['user']['name'] ?></span></span>
            </div>

            <div class="navbar-nav">
                <div class="nav-item text-nowrap">
                    <a class="nav-link px-3" href="/logout">Logout <small><i class="fa fa-sign-out-alt"></i></small></a>
                </div>         
            </div>

            <?php endif; ?>
        </header>
        <div class="container-fluid">
        <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link<?= ($route == '/') ? ' active' : '' ?>" href="/">
                            <i class="fas fa-home"></i> Homepage
                        </a>
                    </li>
                </ul>

                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>Library</span>
                </h6>

                <ul class="nav flex-column mb-2">
                    <li class="nav-item">
                        <a class="nav-link<?= (str_starts_with($route, '/book')) ? ' active' : '' ?>" href="/books">
                            <i class="fas fa-book"></i> Books
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?= (str_starts_with($route, '/author')) ? ' active' : '' ?>" href="/authors">
                            <i class="fas fa-feather-alt"></i> Authors
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?= (str_starts_with($route, '/genre')) ? ' active' : '' ?>" href="/genres">
                            <i class="fas fa-theater-masks"></i> Genres
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?= (str_starts_with($route, '/publisher')) ? ' active' : '' ?>" href="/publishers">
                            <i class="fas fa-user-edit"></i> Publishers
                        </a>
                    </li>
                </ul>

                <?php if (isset($_SESSION['user'], $_SESSION['user']['role']) && ($_SESSION['user']['role'] == 'admin')): ?>
                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>Administration</span>
                </h6>

                <ul class="nav flex-column mb-2">
                    <li class="nav-item">
                        <a class="nav-link<?= (str_starts_with($route, '/user')) ? ' active' : '' ?>" href="/users">
                            <i class="fas fa-user"></i> Users
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?= (str_starts_with($route, '/client')) ? ' active' : '' ?>" href="/clients">
                            <i class="fas fa-users"></i> Clients
                        </a>
                    </li>
                </ul>
                <?php endif; ?>

                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>Account</span>
                </h6>

                <ul class="nav flex-column mb-2">
                    <?php if (isset($_SESSION['user'])): ?>

                    <li class="nav-item">
                        <a class="nav-link<?= (str_starts_with($route, '/account')) ? ' active' : '' ?>" href="/account">
                            <i class="fas fa-user"></i> My Account
                        </a>
                    </li>

                    <?php else: ?>

                    <li class="nav-item">
                        <a class="nav-link<?= (str_starts_with($route, '/login')) ? ' active' : '' ?>" href="/login">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link<?= (str_starts_with($route, '/register')) ? ' active' : '' ?>" href="/register">
                            <i class="fas fa-user-plus"></i> Register
                        </a>
                    </li>

                    <?php endif; ?>
                </ul>
            </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
