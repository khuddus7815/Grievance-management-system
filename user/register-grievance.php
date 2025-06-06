
<?php
session_start();
include('include/config.php');
error_reporting(0);
if(strlen($_SESSION['id'])==0)
    {   
header('location:index.php');
}
else{
date_default_timezone_set('Asia/Kolkata');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );


if(isset($_POST['submit']))
{
$uid=$_SESSION['id'];
$category=$_POST['category'];
$subcat=$_POST['subcategory'];
$complaintype=$_POST['complaintype'];
$complaintdetials=$_POST['complaindetails'];
$compfile=$_FILES["compfile"]["name"];
//rename the image file
$compfilenew=md5($compfile).$extension;

// Code for move image into directory
move_uploaded_file($_FILES["compfile"]["tmp_name"],"complaintdocs/".$compfilenew);

$query=mysqli_query($con,"insert into tblcomplaints(userId,category,subcategory,complaintType,noc,complaintDetails,complaintFile) values('$uid','$category','$subcat','$complaintype','$noc','$complaintdetials','$compfilenew')");
// code for show complaint number
$sql=mysqli_query($con,"select complaintNumber from tblcomplaints  order by complaintNumber desc limit 1");
while($row=mysqli_fetch_array($sql))
{
 $cmpn=$row['complaintNumber'];
}
$complainno=$cmpn;
echo '<script> alert("Your complain has been successfully filled and your complaintno is  "+"'.$complainno.'")</script>';
}
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register Grievance</title>
   

    <!-- vendor css -->
    <link rel="stylesheet" href="../admin/assets/css/style.css">
    
   <script>
function getCat(val) {
  //alert('val');

  $.ajax({
  type: "POST", 
  url: "getsubcat.php",
  data:'catid='+val,
  success: function(data){
    $("#subcategory").html(data);
    
  }
  });
  }
  </script> 

</head>
<body class="">
	<?php include('include/sidebar.php');?>
	<!-- [ navigation menu ] end -->
	<!-- [ Header ] start -->
	<?php include('include/header.php');?>

<!-- [ Main Content ] start -->
<section class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Register Grievance</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="register-grievance.php">Register Grievance</a></li>
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
          
            <!-- [ form-element ] start -->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Register Grievance</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-10">
                            	
                                    <br />
                                <form method="post" name="complaint" enctype="multipart/form-data">
                                	
                                  
                                     <div class="form-group">
                                        <label for="exampleInputEmail1">Category Name</label>
                                        <select name="category" id="category" class="form-control" onChange="getCat(this.value);" required="">
<option value="">Select Category</option>
<?php $sql=mysqli_query($con,"select id,categoryName from category ");
while ($rw=mysqli_fetch_array($sql)) {
  ?>
  <option value="<?php echo htmlentities($rw['id']);?>"><?php echo htmlentities($rw['categoryName']);?></option>
<?php
}
?>
</select>
                                        
                                    </div>
                                     <div class="form-group">
                                        <label for="exampleInputEmail1">Sub Category</label>
                                        <select name="subcategory" id="subcategory" class="form-control" >
<option value="">Select Subcategory</option>
</select>
                                        
                                    </div>
                                     <div class="form-group">
                                        <label for="exampleInputEmail1">Grievance Type</label>
                                        <select name="complaintype" class="form-control" required="">
                <option value=" Complaint"> Grievances</option>
                  <option value="General Query">General Query</option>
                </select> 
                                        
                                     <div class="form-group">
                                        <label for="exampleInputEmail1">Grievance Details (max 2000 words)</label>
                                        <textarea  name="complaindetails" required="required" cols="10" rows="10" class="form-control" maxlength="2000"></textarea>
                                        
                                    </div>
                                     
                                     <div class="form-group">
                                        <label for="exampleInputEmail1">Grievance Related Doc(if any)</label>
                                        <input type="file" name="compfile" class="form-control" value="">
                                        
                                    </div>
                                    <button type="submit" class="btn  btn-primary" name="submit">Submit</button>
                                </form>
                            </div>
                           
                        </div>
             
                   
                    </div>
                </div>
          
            </div>
            <!-- [ form-element ] end -->
        </div>
        <!-- [ Main Content ] end -->

    </div>
</section>


    <!-- Required Js -->
    <script src="../admin/assets/js/vendor-all.min.js"></script>
    <script src="../admin/assets/js/plugins/bootstrap.min.js"></script>




</body>

</html>
<?php ?>