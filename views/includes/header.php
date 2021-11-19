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
        
        <!-- Custom CSS -->
        <link href="/assets/css/style.css" rel="stylesheet">
    </head>
    <body>
        <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
            <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="/"><strong>Ontario Tech</strong> Library</a>
            
            <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
            
            <div class="navbar-nav">
                <div class="nav-item text-nowrap">
                    <a class="nav-link px-3" href="/logout">Logout</a>
                </div>
            </div>
        </header>
        <div class="container-fluid">
        <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">
                            <i class="fas fa-chart-line"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/books">
                            <i class="fas fa-book"></i> Books
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/clients">
                            <i class="fas fa-users"></i> Clients
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/rentals">
                            <i class="fas fa-barcode"></i> Rentals
                        </a>
                    </li>
                </ul>
                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>Administration</span>
                </h6>
                <ul class="nav flex-column mb-2">
                    <li class="nav-item">
                        <a class="nav-link" href="/users">
                            <i class="fas fa-users"></i> Users
                        </a>
                    </li>
                </ul>
            </div>
        </nav>