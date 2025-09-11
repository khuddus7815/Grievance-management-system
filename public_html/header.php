<?php $currentPage = basename($_SERVER['PHP_SELF']); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>TRANETRA - Civic Reporting Platform</title>
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700&display=swap" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
    body {
        margin: 0;
        padding: 0;
        overflow-x: hidden;
        background: #ffffff;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }
    main {
        flex: 1;
    }
    .header_section {
        padding-top: 15px;
        background: #fff;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .top-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 25px 15px 25px;
    }
    .header-logo { height: 80px; width: auto; }
    .header-title h1 { margin: 0; font-size: 2.5rem; font-weight: 700; color: #333; }
    .main-nav { display: flex; justify-content: center; padding: 10px 0; border-top: 1px solid #eee; background-color: #f8f9fa; }
    .main-nav .navbar-nav { flex-direction: row; }
    .main-nav .nav-item { margin: 0 20px; }
    .main-nav .nav-link { font-weight: 600; color: #555 !important; }
    .main-nav .navbar-toggler { display: none; border: 1px solid #ccc; padding: .25rem .75rem; font-size: 1.25rem; }
    
    /* Page Content Sections */
    .page-section { padding: 60px 0; }
    .page-section h2 { text-align: center; margin-bottom: 40px; font-weight: 700; }
    
    /* Footer */
    .footer_section { background-color: #343a40; color: white; padding: 40px 0; margin-top: auto; }
    .footer_section a { color: #f8f9fa; text-decoration: none; }
    .footer_section a:hover { color: #ccc; }

    @media (max-width: 768px) {
        .header-logo { height: 60px; }
        .header-title h1 { font-size: 1.5rem; }
        .main-nav { justify-content: flex-end; padding-right: 25px; }
        .main-nav .navbar-toggler { display: block; }
        .main-nav .navbar-collapse { width: 100%; }
        .main-nav .navbar-nav { flex-direction: column; align-items: center; padding-top: 10px; }
        .main-nav .nav-item { margin: 8px 0; }
    }
</style>
</head>
<body>
    <header class="header_section">
        <div class="top-header">
            <a href="index.php">
                <img src="images/gov_logo.png" alt="Government Logo" class="header-logo">
            </a>
            <div class="header-title">
                <h1>TRANETRA</h1>
            </div>
            <a href="#">
                <img src="images/traffic_emblem.png" alt="Traffic Emblem" class="header-logo">
            </a>
        </div>
        <nav class="main-nav navbar navbar-expand-lg">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNavMenu">
                &#9776; </button>
            <div class="collapse navbar-collapse justify-content-center" id="mainNavMenu">
                <ul class="navbar-nav">
                    <li class="nav-item <?php echo ($currentPage == 'index.php') ? 'active' : '' ?>">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item <?php echo ($currentPage == 'about.php') ? 'active' : '' ?>">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                    <li class="nav-item <?php echo ($currentPage == 'contact.php') ? 'active' : '' ?>">
                        <a class="nav-link" href="contact.php">Contact Us</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Login
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="user/index.php">Citizen Login</a>
                            <a class="dropdown-item" href="admin/index.php">Official Login</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <main>