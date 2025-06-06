<?php
session_start();
error_reporting(0);
include("include/config.php");
if(isset($_POST['submit']))
{
   $email=$_POST['emailid'];
   $password=$_POST['inputuserpwd'];
$query=mysqli_query($con,"SELECT id,fullName FROM users WHERE userEmail='$email' and password='$password'");
$num=mysqli_fetch_array($query);
//If Login Suceesfull
if($num>0)
{
$_SESSION['login']=$_POST['email'];
$_SESSION['id']=$num['id'];
$_SESSION['username']=$num['name'];
echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
}
//If Login Failed
else{
    echo "<script>alert('Invalid login details');</script>";
    echo "<script type='text/javascript'> document.location ='index.php'; </script>";
exit();
}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Student Login</title>
	<link rel="stylesheet" href="../admin/assets/css/style.css">	
</head>
<!-- [ auth-signin ] start -->
<div class="auth-wrapper">
	<div class="auth-content text-center">
		<h4>Student Grievance system <hr /><span style="color:black;">Student Login</span></h4>
		<div class="card borderless">
			<div class="row align-items-center ">
				<div class="col-md-12">
					<form method="post">
						<div class="card-body">
							<h4 class="mb-3 f-w-400">Login</h4>
							<div class="form-group mb-3">
								<!-- Email Type -->
								<input type="Email" name="emailid" id="emailid" class="form-control" onBlur="emailAvailability()" required placeholder="Username">
							</div>
							<div class="form-group mb-4">
								<input type="password" name="inputuserpwd" class="form-control" required placeholder="Enter Password">
							</div>
							<button class="btn btn-block btn-primary mb-4"  type="submit" name="submit">Login</button>
						</div>
					</form>
						<a class="" href="../index.php">
		                    <button>Home</button>
		                </a>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- [ auth-signin ] end -->

<!-- Required Js -->
<script src="../admin/assets/js/vendor-all.min.js"></script>
<script src="../admin/assets/js/plugins/bootstrap.min.js"></script>





</body>

</html>
