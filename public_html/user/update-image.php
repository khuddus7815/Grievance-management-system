<?php
session_start();
include('include/config.php');

// Redirect to index if user is not logged in
if (strlen($_SESSION['id']) == 0) {
    header('location:index.php');
    exit(); // It's good practice to exit after a header redirect
}

// Handle form submission
if (isset($_POST['submit'])) {
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $imgfile = $_FILES["image"]["name"];

        // Get the image extension
        $extension = strtolower(substr($imgfile, strlen($imgfile) - 4, strlen($imgfile)));
        // Allowed extensions
        $allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");

        // Validation for allowed extensions
        if (!in_array($extension, $allowed_extensions)) {
            echo "<script>alert('Invalid format. Only jpg / jpeg / png / gif format allowed');</script>";
        } else {
            // Rename the image file to prevent conflicts
            $imgnewfile = md5($imgfile . time()) . $extension; // Added time() for more uniqueness
            
            // Move the uploaded image into the 'userimages' directory
            if (move_uploaded_file($_FILES["image"]["tmp_name"], "userimages/" . $imgnewfile)) {
                $id = $_SESSION["id"];
                // Update the user's image in the database
                $sql = mysqli_query($con, "update users set userImage='$imgnewfile' where id='$id'");
                
                if ($sql) {
                    echo "<script>alert('Profile photo updated successfully');</script>";
                    echo "<script>window.location.href='profile.php'</script>";
                } else {
                    echo "<script>alert('Database could not be updated. Please try again.');</script>";
                }
            } else {
                 echo "<script>alert('Failed to upload image. Check directory permissions.');</script>";
            }
        }
    } else {
        echo "<script>alert('Please select a file to upload.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Profile</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="../admin/assets/css/style.css">

    <style>
        .profile-image-container {
            max-width: 256px;
            margin-left: auto;
            margin-right: auto;
        }
        .profile-image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border: 3px solid #eee;
            aspect-ratio: 1 / 1; /* Ensures the image container is always square */
        }

        /* --- STYLES FOR IMAGE PREVIEW --- */
        .preview-wrapper {
            position: relative; /* Needed for positioning the cancel button */
        }
        #cancelNewPreview {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 30px;
            height: 30px;
            background-color: rgba(0, 0, 0, 0.6);
            color: white;
            border-radius: 50%;
            text-align: center;
            font-size: 16px;
            line-height: 30px;
            cursor: pointer;
            font-family: sans-serif;
            font-weight: bold;
        }
        #cancelNewPreview:hover {
            background-color: rgba(255, 0, 0, 0.8);
        }
    </style>
</head>
<body class="">
    <?php include('include/sidebar.php'); ?>
    <?php include('include/header.php'); ?>

    <section class="pcoded-main-container">
        <div class="pcoded-content">
            <div class="page-header">
                </div>
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Update Profile Picture</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <?php
                                    $id = intval($_SESSION["id"]);
                                    $query = mysqli_query($con, "select * from users where id='$id'");
                                    if ($row = mysqli_fetch_array($query)) {
                                    ?>
                                        <form method="post" enctype="multipart/form-data">
                                            
                                            <div class="form-group text-center">
                                                <label class="font-weight-bold">Current Photo</label>
                                                <div class="profile-image-container mb-3">
                                                    <?php 
                                                    $userphoto = $row['userImage'];
                                                    // Simplified check: If the database field is empty, use the placeholder.
                                                    if ($userphoto == ""):
                                                        $imgSrc = "userimages/noimage.png";
                                                    else:
                                                        $imgSrc = "userimages/" . htmlentities($userphoto);
                                                    endif;
                                                    ?>
                                                    <img src="<?php echo $imgSrc; ?>" alt="Current Profile Photo" class="img-fluid rounded-circle">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="imageUpload">Upload New Photo</label>
                                                <input type="file" name="image" id="imageUpload" class="form-control" required accept="image/png, image/jpeg, image/gif"/>
                                            </div>

                                            <div class="form-group text-center" id="newImagePreviewContainer" style="display: none;">
                                                <label class="font-weight-bold">New Photo Preview</label>
                                                <div class="profile-image-container preview-wrapper mb-3">
                                                    <img src="#" id="newImagePreview" alt="New Photo Preview" class="img-fluid rounded-circle">
                                                    <span id="cancelNewPreview" title="Cancel Selection">X</span>
                                                </div>
                                            </div>
                                            
                                            <button type="submit" class="btn btn-primary" name="submit">Update</button>
                                        </form>
                                    <?php } else {
                                        // This will show if the user ID is not found in the database.
                                        echo "<p class='text-danger'>Error: User profile not found.</p>";
                                    }?>
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
        document.addEventListener('DOMContentLoaded', function() {
            const imageUpload = document.getElementById('imageUpload');
            const newImagePreviewContainer = document.getElementById('newImagePreviewContainer');
            const newImagePreview = document.getElementById('newImagePreview');
            const cancelNewPreviewBtn = document.getElementById('cancelNewPreview');

            imageUpload.addEventListener('change', function(event) {
                const file = event.target.files[0];
                
                if (file) {
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        newImagePreview.src = e.target.result;
                        newImagePreviewContainer.style.display = 'block';
                    }
                    
                    reader.readAsDataURL(file);
                }
            });

            cancelNewPreviewBtn.addEventListener('click', function() {
                newImagePreviewContainer.style.display = 'none';
                imageUpload.value = '';
                newImagePreview.src = '#';
            });
        });
    </script>
</body>
</html>