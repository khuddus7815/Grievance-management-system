<?php
session_start();
error_reporting(0);
include('include/config.php');
if(strlen($_SESSION['id'])==0){   
    header('location:index.php');
} else {
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
    <!-- Font Awesome for icons (used in cards + How It Works) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

    <style>
    /* Keep layout tidy on small screens */
    .card.flat-card { margin-bottom: 20px; }
    .pcoded-content { overflow-x: hidden; }

    @media (max-width: 575px) {
        .flat-card .row-table {
            display: flex;
            align-items: center;
            padding: 1rem;
        }
        .flat-card .row-table .card-body {
            flex: 0 0 60px;
            padding: 0;
            text-align: center;
        }
        .flat-card .row-table .col-sm-9 {
            flex: 1;
            text-align: left;
            padding-left: 15px;
        }
        .page-header-title h5 { font-size: 1.1rem; }
    }

    /* Sections below */
    .section-block {
        padding: 40px 10px;
        background: inherit; /* match admin bg */
    }
    .section-block h2 {
        font-size: 1.6rem;
        font-weight: 700;
        margin-bottom: 25px;
        text-align: center; /* centered headers */
    }

    /* How It Works */
    .how-step { text-align: center; padding: 15px; }
    .how-step i { font-size: 36px; margin-bottom: 10px; color: #3f51b5; }
    .how-step h5 { margin: 8px 0; font-weight: 600; }
    .how-step p { margin: 0; color: #6c757d; }

    /* Rewards Gallery */
    .reward-card { border-radius: 10px; overflow: hidden; height: 100%; }
    .reward-card img { 
        width: 100%; 
        height: 160px; 
        object-fit: contain; /* changed from cover to contain */
        background: #fff; /* ensures white padding if aspect ratio differs */
    }
    .reward-card .card-body { padding: 12px; text-align: center; }
    .reward-card .card-body h6 { margin: 0; font-weight: 600; }

    /* Sponsor Highlights */
    .sponsor-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 16px;
        border-radius: 999px;
        background: #f1f3f5;
        margin: 6px;
        font-weight: 600;
    }
    .sponsor-pill i { opacity: 0.8; }
    /* Reward Tracking Section */
.progress {
    background-color: #e9ecef;
}
.progress-bar {
    font-weight: 600;
    font-size: 0.9rem;
    color: #fff;
    transition: width 0.5s ease;
}

</style>

</head>
<body>
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

    <!-- Your ORIGINAL Complaint Cards (restored) -->
    <div class="row">       
      <div class="col-md-6 col-xl-6">               
        <div class="card flat-card widget-primary-card">
          <div class="row-table">
            <div class="card-body">
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
            <div class="card-body">
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
    </div><!-- /row (cards) -->
<?php
// Fetch closed complaints count
$user_id = $_SESSION['id'];
$query = mysqli_query($con, "SELECT COUNT(*) as closed_count FROM tblcomplaints WHERE userId='$user_id' AND status='closed'");
$data = mysqli_fetch_assoc($query);
$closed_count = (int)$data['closed_count'];

// Each level requires 10 closed complaints
$level = floor($closed_count / 10) + 1; // Start at Level 1
$completed_in_level = $closed_count % 10; // Progress inside current level
$progress_percent = ($completed_in_level / 10) * 100;
$next_level_target = 10 - $completed_in_level; // How many more needed
?>

<section class="section-block">
    <h2>Reward Tracking</h2>
    <div class="text-center mb-3">
        <p><strong>Total Closed Complaints:</strong> <?php echo $closed_count; ?></p>
        <p><strong>Current Level:</strong> <?php echo $level; ?></p>
    </div>

    <!-- Progress Bar -->
    <div class="progress" style="height: 25px; border-radius: 15px; overflow: hidden;">
        <div class="progress-bar bg-success" role="progressbar" 
             style="width: <?php echo $progress_percent; ?>%;" 
             aria-valuenow="<?php echo $progress_percent; ?>" 
             aria-valuemin="0" aria-valuemax="100">
            <?php echo round($progress_percent); ?>%
        </div>
    </div>

    <?php if ($completed_in_level == 0 && $closed_count > 0): ?>
        <div class="alert alert-success mt-3">
            🎉 Congratulations! You’ve completed <strong>Level <?php echo $level - 1; ?></strong> and earned your reward!
        </div>
    <?php else: ?>
        <p class="mt-3 text-center">
            Complete <strong><?php echo $next_level_target; ?></strong> more closed complaints to reach Level <?php echo $level; ?>.
        </p>
    <?php endif; ?>
</section>


    <!-- HOW IT WORKS -->
    <section class="section-block">
      <h2>How It Works</h2>
      <div class="row">
        <div class="col-md-4 how-step">
          <i class="fas fa-file-alt"></i>
          <h5>Submit Report</h5>
          <p>Identify an issue and share it with us.</p>
        </div>
        <div class="col-md-4 how-step">
          <i class="fas fa-hands-helping"></i>
          <h5>Take Action</h5>
          <p>Participate in initiatives to create change.</p>
        </div>
        <div class="col-md-4 how-step">
          <i class="fas fa-gift"></i>
          <h5>Earn Reward</h5>
          <p>Receive points and redeem them for rewards.</p>
        </div>
      </div>
    </section>

    <!-- REWARDS GALLERY -->
    <section class="section-block">
      <h2>Rewards Gallery</h2>
      <div class="row">
        <div class="col-sm-6 col-md-3 mb-3">
          <div class="card reward-card">
            <img src="../images/Thumbsup.jpg" alt="Thumbsup Cola 1L">
            <div class="card-body"><h6>Thumbsup Cola 1L</h6></div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3 mb-3">
          <div class="card reward-card">
            <img src="../images/atta.jpg" alt="Ashirvad Chakki Atta 1kg">
            <div class="card-body"><h6>Ashirvad Chakki Atta 1kg</h6></div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3 mb-3">
          <div class="card reward-card">
            <img src="../images/Saffola.jpg" alt="Saffola Gold Cooking Oil 3kg">
            <div class="card-body"><h6>Saffola Gold Cooking Oil 3kg</h6></div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3 mb-3">
          <div class="card reward-card">
            <img src="../images/colgate.jpeg" alt="Colgate Paste 100gm">
            <div class="card-body"><h6>Colgate Paste 100gm</h6></div>
          </div>
        </div>
      </div>
    </section>

    <!-- SPONSOR HIGHLIGHTS -->
    <section class="section-block">
      <h2>Sponsor Highlights</h2>
      <div>
        <span class="sponsor-pill">
          <i class="fas fa-shield-alt"></i> SafeDrive+
        </span>
        <span class="sponsor-pill">
          <i class="fas fa-code"></i> Arjun Infotech Solutions
        </span>
      </div>
    </section>

  </div>
</div>

<script src="../admin/assets/js/vendor-all.min.js"></script>
<script src="../admin/assets/js/plugins/bootstrap.min.js"></script>
<script src="../admin/assets/js/pcoded.min.js"></script>
</body>
</html>
<?php } ?>
