<?php
$uid = $_SESSION['id'];
$query = mysqli_query($con, "SELECT fullName, userImage FROM users WHERE id='$uid'");
$row = mysqli_fetch_array($query);
?>
<head>
    <style>
        /* Navbar base layout */
        .navbar {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px 15px;
            background: #222;
            position: relative;
        }

        /* Title always centered */
        .b-brand h1 {
            margin: 0;
            color: white;
            font-size: 2rem;
            text-align: center;
        }

        /* Left & right buttons */
        .mobile-menu,
        .navbar-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            align-items: center;
            color: white;
        }

        .mobile-menu {
            left: 15px;
        }

        .navbar-nav {
            right: 15px;
            margin: 0;
        }

        .mobile-menu span,
        .feather.icon-user {
            font-size: 1.5rem;
            cursor: pointer;
            color: grey; /* Profile icon in grey */
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .b-brand h1 {
                font-size: 1.6rem;
            }
        }

        @media (max-width: 575px) {
            .b-brand h1 {
                font-size: 1.3rem;
            }
            .pcoded-header .navbar-nav > li {
                padding: 0 5px;
            }
        }
    </style>
</head>
<header class="navbar pcoded-header navbar-expand-lg navbar-light header-dark">
    <!-- Left side menu toggle -->
    <a class="mobile-menu" id="mobile-collapse" href="#!">
        <span></span>
    </a>

    <!-- Center title -->
    <a href="dashboard.php" class="b-brand">
        <h1>Tranetra</h1>
    </a>

    
</header>
