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
// Getting location data from the form
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];

// get file extension
$extension = substr($compfile,strlen($compfile)-4,strlen($compfile));
// allowed extensions
$allowed_extensions = array(".jpg","jpeg",".png",".gif");
// Validation for allowed extensions .in_array() function searches an array for a specific value.
if(!empty($compfile) && !in_array($extension,$allowed_extensions))
{
echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
}
else
{
//rename the image file
$compfilenew = "";
if(!empty($compfile)){
    $compfilenew=md5($compfile).$extension;
    // Code for move image into directory
    move_uploaded_file($_FILES["compfile"]["tmp_name"],"complaintdocs/".$compfilenew);
}


$query=mysqli_query($con,"insert into tblcomplaints(userId,category,subcategory,complaintType,complaintDetails,complaintFile,latitude,longitude) values('$uid','$category','$subcat','$complaintype','$complaintdetials','$compfilenew','$latitude','$longitude')");
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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" href="../admin/assets/css/style.css">
    
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script>
function getCat(val) {
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
  
  <style>
    .form-control {
        width: 100% !important;
    }
    #map-container {
        height: 300px;
        width: 100%;
        margin-top: 15px;
        border-radius: 5px;
        border: 1px solid #ddd;
        display: none; /* Hidden by default */
    }
    .location-btn {
        margin-bottom: 15px;
    }
    /* Force dropdowns to stay within screen width */
select.form-control {
    display: block;
    max-width: 100% !important;
    width: 100% !important;
    box-sizing: border-box;
    overflow: hidden;
    text-overflow: ellipsis; /* Trim long text */
    white-space: nowrap; /* Prevent horizontal expansion */
}

/* Make dropdowns more touch-friendly on small screens */
@media (max-width: 576px) {
    select.form-control {
        font-size: 14px;
        padding: 10px;
        white-space: normal; /* Allow wrapping on mobile */
        word-break: break-word; /* Break long words */
    }
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
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Register Grievance</h5>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-8">
                                <form method="post" name="complaint" enctype="multipart/form-data">
                                     <div class="form-group">
                                        <label for="category">Category Name</label>
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
                                        <label for="subcategory">Sub Category</label>
                                        <select name="subcategory" id="subcategory" class="form-control" >
                                            <option value="">Select Subcategory</option>
                                        </select>
                                    </div>

                                     <div class="form-group">
                                        <label for="complaintype">Grievance Type</label>
                                        <select name="complaintype" class="form-control" required="">
                                            <option value=" Complaint"> Grievances</option>
                                            <option value="General Query">General Query</option>
                                        </select> 
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="complaindetails">Grievance Details (max 2000 words)</label>
                                        <textarea  name="complaindetails" required="required" cols="10" rows="10" class="form-control" maxlength="2000"></textarea>
                                    </div>
                                    
                                     <div class="form-group">
                                        <label for="compfile">Grievance Related Doc(if any)</label>
                                        <input type="file" name="compfile" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>Location</label>
                                        <div>
                                            <button type="button" class="btn btn-secondary location-btn" id="getLocationBtn">Get My Current Location</button>
                                        </div>
                                        <div id="map-container"></div>
                                        <input type="hidden" name="latitude" id="latitude">
                                        <input type="hidden" name="longitude" id="longitude">
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                </form>
                            </div>
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

    <script>
        document.getElementById('getLocationBtn').addEventListener('click', function() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        });

        function showPosition(position) {
            var lat = position.coords.latitude;
            var lon = position.coords.longitude;

            // Set values of hidden input fields
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lon;

            // Show the map container
            var mapContainer = document.getElementById('map-container');
            mapContainer.style.display = 'block';
            
            // Display map using OpenStreetMap (no API key needed)
            mapContainer.innerHTML = `<iframe width="100%" height="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.openstreetmap.org/export/embed.html?bbox=${lon-0.01}%2C${lat-0.01}%2C${lon+0.01}%2C${lat+0.01}&layer=mapnik&marker=${lat}%2C${lon}"></iframe>`;

            alert('Location fetched successfully!');
        }

        function showError(error) {
            switch(error.code) {
                case error.PERMISSION_DENIED:
                    alert("User denied the request for Geolocation.");
                    break;
                case error.POSITION_UNAVAILABLE:
                    alert("Location information is unavailable.");
                    break;
                case error.TIMEOUT:
                    alert("The request to get user location timed out.");
                    break;
                case error.UNKNOWN_ERROR:
                    alert("An unknown error occurred.");
                    break;
            }
        }
    </script>
</body>
</html>
<?php } ?>