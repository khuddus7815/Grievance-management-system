
<?php
session_start();
include('include/config.php');
if(strlen($_SESSION['id'])==0)
	{	
header('location:index.php');
}
else{
if(isset($_POST['submit']))
{
	$fname=$_POST['fullname'];
    $contactno=$_POST['contactno'];
    $id=$_SESSION["id"];
$sql=mysqli_query($con,"update users set fullName='$fname',contactNo='$contactno' where id='$id'");
echo "<script>alert('Profile Updated successfully');</script>";
echo "<script>window.location.href='profile.php'</script>";
}
	?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Student Profile</title>
    <link rel="stylesheet" href="../admin/assets/css/style.css">
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
                            <h5 class="m-b-10">Student Profile</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="profile.php">Student Profile</a></li>
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Student Profile</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-10">
                            	<?php
$id=intval($_SESSION["id"]);
$query=mysqli_query($con,"select * from users where id='$id'");
while($row=mysqli_fetch_array($query))
{
?>	
                                <form method="post">
                                	
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Full Name</label>
                                        <input type="text" id="fname" name="fullname" required="required" value="<?php echo htmlentities($row['fullName']);?>" class="form-control" > 
                                    </div>

                                      <div class="form-group">
                                        <label for="exampleInputEmail1">User ID</label>
                                        <input type="email" name="useremail" required="required" value="<?php echo htmlentities($row['userEmail']);?>" class="form-control" readonly>
                                    </div>

                                       <div class="form-group">
                                        <label for="exampleInputEmail1">Contact Number</label>
                                        <input type="text" name="contactno" id="mobno" tabindex="3" required='true' maxlength="10" pattern="\d{10}" inputmode="numeric" value="<?php echo htmlentities($row['contactNo']);?>" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">User Photo</label>
                                       <?php $userphoto=$row['userImage'];
if($userphoto==""):
?>
<img src="userimages/noimage.png" width="256" height="256" >
<a href="update-image.php">Change Photo</a>
<?php else:?>
    <img src="userimages/<?php echo htmlentities($userphoto);?>" width="256" height="256">
    <a href="update-image.php">Change Photo</a>
<?php endif;?>
                                    </div><?php } ?>
                                    <button type="submit" class="btn  btn-primary" name="submit">Submit</button>
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

    <!-- JAVASCRIPT FOR NAME VALIDATION -->
    <script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const nameInput = document.getElementById('fname');

        nameInput.addEventListener('input', function(event) {
            this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
        });
        const form = document.getElementById('nameForm');
        form.addEventListener('submit', function(event) {
            const name = nameInput.value;
            if (/[^a-zA-Z\s]/.test(name)) {
                alert('Please enter only characters.');
                event.preventDefault(); 
            }
        });
    });
    </script>

    <!--JAVASCRIPT FOR PHONE NUMBER VALIDATION-->
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
        const form = document.querySelector('form');
        const mobileNumberInput = document.getElementById('mobno');

        mobileNumberInput.addEventListener('input', function(event) {
            this.value = this.value.replace(/\D/g, '');
        });

        form.addEventListener('submit', function(event) {
            const mobileNumber = mobileNumberInput.value;
            const mobileNumberPattern = /^\d{10}$/;

            if (!mobileNumberPattern.test(mobileNumber)) {
                alert('Please enter a valid 10-digit mobile number.');
                event.preventDefault();
            }
        });
    });
    </script>
</body>
</html>
<?php } ?>