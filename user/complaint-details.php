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
    <title>Grievance Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../admin/assets/css/style.css">
    
<script language="javascript" type="text/javascript">
var popUpWin=0;
function popUpWindow(URLStr, left, top, width, height)
{
 if(popUpWin)
{
if(!popUpWin.closed) popUpWin.close();
}
popUpWin = open(URLStr,'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width='+600+',height='+600+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
}
</script>   

<style>
    /* Responsive styles for the details section */
    .details-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); /* Responsive grid */
        gap: 1.5rem; /* Space between items */
    }
    .detail-item {
        padding: 1rem;
        background-color: #f8f9fa;
        border-radius: 5px;
        border-left: 4px solid #eae6f5;
    }
    .detail-item b {
        display: block;
        color: #555;
        margin-bottom: 5px;
        font-size: 0.9rem;
    }
    .detail-item span {
        font-size: 1rem;
        color: #333;
    }
    .full-width {
        grid-column: 1 / -1; /* Makes an item span the full width */
    }
    .map-container {
        height: 300px;
        width: 100%;
        margin-top: 10px;
        border-radius: 5px;
        border: 1px solid #ddd;
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
                            <h5 class="m-b-10">Grievance Details</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="grievance-history.php">Grievance History</a></li>
                            <li class="breadcrumb-item">Grievance Details</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h5>View Grievance Details</h5>
                        <hr>
                        <?php 
                        $cid=intval($_GET['cid']);
                        $query=mysqli_query($con,"select tblcomplaints.*,users.fullName as name,users.userEmail as UserID,category.categoryName as catname from tblcomplaints join users on users.id=tblcomplaints.userId join category on category.id=tblcomplaints.category where tblcomplaints.complaintNumber='$cid'");
                        while($row=mysqli_fetch_array($query))
                        {
                        ?>
                        <div class="details-grid">
                            <div class="detail-item">
                                <b>Grievance Number</b>
                                <span><?php echo htmlentities($row['complaintNumber']);?></span>
                            </div>
                            <div class="detail-item">
                                <b>Complainant Name</b>
                                <span><?php echo htmlentities($row['name']);?></span>
                            </div>
                            <div class="detail-item">
                                <b>User ID</b>
                                <span><?php echo htmlentities($row['UserID']);?></span>
                            </div>
                            <div class="detail-item">
                                <b>Reg Date</b>
                                <span><?php echo htmlentities($row['regDate']);?></span>
                            </div>
                            <div class="detail-item">
                                <b>Category</b>
                                <span><?php echo htmlentities($row['catname']);?></span>
                            </div>
                            <div class="detail-item">
                                <b>SubCategory</b>
                                <span><?php echo htmlentities($row['subcategory']);?></span>
                            </div>
                            <div class="detail-item">
                                <b>Complaint Type</b>
                                <span><?php echo htmlentities($row['complaintType']);?></span>
                            </div>
                            <div class="detail-item">
                                <b>File (if any)</b>
                                <span>
                                    <?php $cfile=$row['complaintFile'];
                                    if($cfile=="" || $cfile=="NULL") {
                                        echo "File NA";
                                    } else { ?>
                                       <a href="complaintdocs/<?php echo htmlentities($row['complaintFile']);?>" target="_blank"> View File</a>
                                    <?php } ?>
                                </span>
                            </div>
                            <div class="detail-item full-width">
                                <b>Grievance Details</b>
                                <span><?php echo htmlentities($row['complaintDetails']);?></span>
                            </div>
                            
                            <div class="detail-item full-width">
                                <b>Location</b>
                                <?php 
                                $lat = htmlentities($row['latitude']);
                                $long = htmlentities($row['longitude']);
                                if(!empty($lat) && !empty($long)) {
                                ?>
                                    <div id="map-container">
                                        <iframe width="100%" height="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.openstreetmap.org/export/embed.html?bbox=<?php echo $long-0.01; ?>,<?php echo $lat-0.01; ?>,<?php echo $long+0.01; ?>,<?php echo $lat+0.01; ?>&layer=mapnik&marker=<?php echo $lat; ?>,<?php echo $long; ?>"></iframe>
                                    </div>
                                <?php } else {
                                    echo "<span>Not Provided</span>";
                                } ?>
                            </div>

                            <div class="detail-item full-width">
                                <b>Final Status</b>
                                <span>
                                    <?php $status=$row['status'];
                                    if($status==''): ?>
                                        <span class="badge badge-danger">Not Processed Yet</span>
                                    <?php elseif($status=='in process'):?>
                                        <span class="badge badge-warning">In Process</span>
                                    <?php elseif($status=='closed'):?>
                                        <span class="badge badge-success">Closed</span>
                                    <?php endif;?>
                                </span>
                            </div>
                        </div>
                        <?php } ?>
                        
                        <hr>
                        <h5>Remark History</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Remark</th>
                                        <th>Status</th>
                                        <th>Remark Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $ret=mysqli_query($con,"select complaintremark.remark as remark,complaintremark.status as sstatus,complaintremark.remarkDate as rdate from complaintremark join tblcomplaints on tblcomplaints.complaintNumber=complaintremark.complaintNumber where complaintremark.complaintNumber='$cid'");
                                $cnt=1;
                                while($rw=mysqli_fetch_array($ret))
                                {
                                ?>
                                    <tr>
                                        <td><?php echo htmlentities($cnt);?></td>
                                        <td><?php echo htmlentities($rw['remark']); ?></td>
                                        <td><?php echo htmlentities($rw['sstatus']); ?></td>
                                        <td><?php echo htmlentities($rw['rdate']); ?></td>
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