<?php
session_start();
error_reporting(0);
include('include/config.php');
if(strlen($_SESSION['id'])==0)
    {   
header('location:index.php');
}
else{
    ?>
<!DOCTYPE html>
<html lang="en"> 

<head>
    <title>Grievance Management System || Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Grievance Management System" />
    <meta name="keywords" content="Grievance Management System" />
    <meta name="author" content="codedthemes" />
    <link rel="icon" href="../admin/assets/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" />
    <link rel="stylesheet" href="../admin/assets/css/style.css">

    <style>
        /* Simple inline styles for responsiveness */
        .card.flat-card {
            margin-bottom: 20px;
        }
        
        /* Styles FOR MOBILE DEVICES to align content correctly */
        @media (max-width: 575px) {
            .flat-card .row-table {
                display: flex;          /* Use flexbox for better alignment */
                align-items: center;    /* Vertically center the icon and text */
                padding: 1rem;          /* Add some padding inside the card */
            }

            .flat-card .row-table .card-body {
                flex: 0 0 60px;         /* Give the icon a fixed width */
                padding: 0;             /* Remove extra padding from the icon's container */
                text-align: center;
            }

            .flat-card .row-table .col-sm-9 {
                flex: 1;                /* Allow the text to take the remaining space */
                text-align: left;       /* Align the text to the left */
                padding-left: 15px;     /* Add space between icon and text */
            }

            .page-header-title h5 {
                font-size: 1.1rem;
            }
        }
    </style>
</head>
<body class="">
<?php include('include/sidebar.php');?>
    <?php include('include/header.php');?>
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Dashboard Analytics</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Dashboard Analytics</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">       
              <div class="col-md-6 col-xl-6">               
                <div class="card flat-card widget-primary-card">
                    <div class="row-table">
                        <div class=" card-body">
                            <i class="fas fa-file"></i>
                        </div>
                        <div class="col-sm-9">
                           <?php 
$uid=$_SESSION['id'];
$query5=mysqli_query($con,"select complaintNumber from tblcomplaints where userId='$uid'");
$totcom=mysqli_num_rows($query5);
?>
                            <h4><?php echo $totcom;?></h4>
                            <h6>Total Complaints</h6>
                        </div>
                    </div>
                </div>
            </div>
              <div class="col-md-6 col-xl-6">    
                <div class="card flat-card bg-danger">
                    <div class="row-table">
                        <div class="col-sm-3 card-body">
                            <i class="fas fa-file"></i>
                        </div>
                        <div class="col-sm-9">
<?php 
$query5=mysqli_query($con,"select complaintNumber from tblcomplaints where userId='$uid' and status is null");
$newcom=mysqli_num_rows($query5);
?>
                            <h4><?php echo $newcom;?></h4>
                            <h6>Pending Complaints</h6>
                        </div>
                    </div>
                </div>
            </div>
              <div class="col-md-6 col-xl-6">               
                <div class="card flat-card bg-warning">
                    <div class="row-table">
                        <div class="col-sm-3 card-body">
                            <i class="fas fa-file"></i>
                        </div>
                        <div class="col-sm-9">
<?php 
$query5=mysqli_query($con,"select complaintNumber from tblcomplaints where userId='$uid' and status='in process'");
$inprocesscom=mysqli_num_rows($query5);
?>
                            <h4><?php echo $inprocesscom;?></h4>
                            <h6>Inprocess Complaints</h6>
                        </div>
                    </div>
                </div>
            </div>
              <div class="col-md-6 col-xl-6">
                <div class="card flat-card widget-purple-card">
                    <div class="row-table">
                        <div class=" card-body">
                            <i class="fas fa-file"></i>
                        </div>
                        <div class="col-sm-9">
<?php 
$query5=mysqli_query($con,"select complaintNumber from tblcomplaints where userId='$uid' and status='closed'");
$closedcom=mysqli_num_rows($query5);
?>
                            <h4><?php echo $closedcom;?></h4>
                            <h6>Closed Complaints</h6>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
    <script src="../admin/assets/js/vendor-all.min.js"></script>
    <script src="../admin/assets/js/plugins/bootstrap.min.js"></script>
    <script src="../admin/assets/js/pcoded.min.js"></script>
</body>

</html>
<?php } ?>