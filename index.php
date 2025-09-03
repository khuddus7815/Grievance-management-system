<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>TRANETRA - Civic Reporting Platform</title>
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700&display=swap" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet" />

    <style>
        .slider_section {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
        }

        /* On small screens: center illustration and move it above the text */
        @media (max-width: 767.98px) {
            .slider_section {
                flex-direction: column;
                text-align: center;
            }
            .illustration-image {
                order: -1; /* Moves illustration to the top */
                margin-bottom: 20px;
                display: flex;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="hero_area">
        <!-- Glassy Navbar -->
        <header class="header_section glass-navbar">
            <div class="container">
                <nav class="navbar navbar-expand-lg">
                    <a class="navbar-brand" href="index.php">
                        <span>TRANETRA</span>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMenu">
                        More
                    </button>
                    <div class="collapse navbar-collapse" id="navbarMenu">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="index.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="user/index.php">Citizen Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="admin/index.php">Official Login</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>

        <section class="slider_section">
            <div class="slider_content">
                <h1 class="main-title">Report Civic Issues,<br> Drive Change.</h1>
                <p class="main-subtitle">
                    Welcome to TRANETRA. Your platform to report traffic violations, public nuisances,
                    safety concerns, and electricity issues. Your voice matters in making our community safer and more efficient.
                </p>
                <a href="user/report.php" class="main-btn">File a Report</a>
            </div>

            <div class="illustration-image">
                <img src="images/illustration.png" alt="Illustration" class="img-fluid">
            </div>
        </section>
    </div>

    <!-- Bootstrap JS -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
