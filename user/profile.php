<?php
session_start();
include('include/config.php');
if (strlen($_SESSION['id']) == 0) {
    header('location:index.php');
} else {
    if (isset($_POST['submit'])) {
        $fname = $_POST['fullname'];
        $contactno = $_POST['contactno'];
        $id = $_SESSION["id"];
        $sql = mysqli_query($con, "update users set fullName='$fname',contactNo='$contactno' where id='$id'");
        echo "<script>alert('Profile Updated successfully');</script>";
        echo "<script>window.location.href='profile.php'</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>User Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../admin/assets/css/style.css">
    <style>
        /* Simple responsive styles */
        .profile-image {
            max-width: 150px; /* Smaller image size on all screens */
            height: auto;
            display: block; /* Center the image */
            margin-bottom: 10px;
        }
    </style>
</head>

<body class="">
    <?php include('include/sidebar.php'); ?>
    <?php include('include/header.php'); ?>

    <section class="pcoded-main-container">
        <div class="pcoded-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">User Profile</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard.php"><i class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="profile.php">User Profile</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>User Profile</h5>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center"> <div class="col-md-8 col-lg-6"> <?php
                                    $id = intval($_SESSION["id"]);
                                    $query = mysqli_query($con, "select * from users where id='$id'");
                                    while ($row = mysqli_fetch_array($query)) {
                                    ?>
                                        <form method="post">
                                            <div class="form-group">
                                                <label for="fname">Full Name</label>
                                                <input type="text" id="fname" name="fullname" required="required" value="<?php echo htmlentities($row['fullName']); ?>" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>User ID</label>
                                                <input type="email" name="useremail" required="required" value="<?php echo htmlentities($row['userEmail']); ?>" class="form-control" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="mobno">Contact Number</label>
                                                <input type="text" name="contactno" id="mobno" required='true' maxlength="10" pattern="\d{10}" value="<?php echo htmlentities($row['contactNo']); ?>" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>User Photo</label>
                                                <div>
                                                    <?php $userphoto = $row['userImage'];
                                                    if ($userphoto == ""):
                                                    ?>
                                                        <img src="userimages/noimage.png" class="profile-image">
                                                    <?php else: ?>
                                                        <img src="userimages/<?php echo htmlentities($userphoto); ?>" class="profile-image">
                                                    <?php endif; ?>
                                                    <a href="update-image.php">Change Photo</a>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                        </form>
                                    <?php } ?>
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
        document.addEventListener('DOMContentLoaded', (event) => {
            const nameInput = document.getElementById('fname');
            nameInput.addEventListener('input', function (event) {
                this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
            });
        });

        document.addEventListener('DOMContentLoaded', (event) => {
            const form = document.querySelector('form');
            const mobileNumberInput = document.getElementById('mobno');
            mobileNumberInput.addEventListener('input', function (event) {
                this.value = this.value.replace(/\D/g, '');
            });
            form.addEventListener('submit', function (event) {
                const mobileNumber = mobileNumberInput.value;
                const mobileNumberPattern = /^\d{10}$/;
                if (mobileNumber && !mobileNumberPattern.test(mobileNumber)) {
                    alert('Please enter a valid 10-digit mobile number.');
                    event.preventDefault();
                }
            });
        });
    </script>
</body>
</html>
<?php } ?>