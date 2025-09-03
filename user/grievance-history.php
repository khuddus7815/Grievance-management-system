<?php
session_start();
include('include/config.php');
if(strlen($_SESSION['id'])==0)
    {   
header('location:index.php');
}
else{
date_default_timezone_set('Asia/Kolkata');
$currentTime = date( 'd-m-Y h:i:s A', time () );


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Grievance History</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../admin/assets/css/style.css">
    
<script language="javascript" type="text/javascript">
    var popUpWin=0;
    function popUpWindow(URLStr, left, top, width, height){
    if(popUpWin){
        if(!popUpWin.closed) popUpWin.close();
    }
    popUpWin = open(URLStr,'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width='+600+',height='+600+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
    }
</script>   

<style>
    /* This makes the table scroll horizontally on small screens */
    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch; /* for smooth scrolling on iOS */
    }
    /* This prevents the text in table cells from wrapping to a new line */
    .table-responsive table td, 
    .table-responsive table th {
        white-space: nowrap;
    }
</style>

</head>
<body class="">
    <?php include('include/sidebar.php');?>
    <?php include('include/header.php');?>
<section class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Grievance History</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="grievance-history.php">Grievance History</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h5>View Grievance History</h5>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Grievance No</th>
                                        <th>Complainant Name</th>
                                        <th>Reg Date</th>
                                        <th>Status</th>
                                        <th>Location</th> <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
$uid=$_SESSION['id'];
$query=mysqli_query($con,"select tblcomplaints.*,users.fullName as name from tblcomplaints join users on users.id=tblcomplaints.userId where tblcomplaints.userId='$uid'");
$cnt=1;
while($row=mysqli_fetch_array($query))
{
?>  
                                    <tr>
                                        <td><?php echo htmlentities($cnt);?></td>
                                        <td><?php echo htmlentities($row['complaintNumber']);?></td>
                                        <td><?php echo htmlentities($row['name']);?></td>
                                        <td><?php echo htmlentities($row['regDate']);?></td>
                                        <td>
                                            <?php $status=$row['status'];
                                                if($status==''): ?>
                                                <span class="badge badge-danger">Not Processed Yet</span>
                                            <?php elseif($status=='in process'):?>
                                             <span class="badge badge-warning">In Process</span>
                                          <?php elseif($status=='closed'):?>
                                             <span class="badge badge-success">Closed</span>
                                          <?php endif;?>
                                        </td>

                                        <td>
                                            <?php 
                                            $lat = htmlentities($row['latitude']);
                                            $long = htmlentities($row['longitude']);
                                            if(!empty($lat) && !empty($long)) {
                                                // Create a link to Google Maps
                                                echo "<a href='https://www.google.com/maps?q={$lat},{$long}' target='_blank' class='btn btn-info btn-sm'>View on Map</a>";
                                            } else {
                                                echo "Not Provided";
                                            }
                                            ?>
                                        </td>
                                        <td><a href="complaint-details.php?cid=<?php echo htmlentities($row['complaintNumber']);?>" class="btn btn-primary btn-sm"> View Details</a></td>
                                    </tr>
                                    <?php $cnt=$cnt+1; } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    <script src="../admin/assets/js/vendor-all.min.js"></script>
    <script src="../admin/assets/js/plugins/bootstrap.min.js"></script>
    <script src="../admin/assets/js/pcoded.min.js"></script>
</body>

</html>
<?php } ?>