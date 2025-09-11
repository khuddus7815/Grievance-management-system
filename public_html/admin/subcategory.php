
<?php
session_start();
include('include/config.php');
if(strlen($_SESSION['aid'])==0){   
    header('location:index.php');
}
else{
    date_default_timezone_set('Asia/Kolkata');
    $currentTime = date( 'd-m-Y h:i:s A', time ());
    if(isset($_POST['submit'])){
        $category=$_POST['category'];
        $subcat=$_POST['subcategory'];
        $sql=mysqli_query($con,"insert into subcategory(categoryid,subcategory) values('$category','$subcat')");
        $_SESSION['msg']="SubCategory Created !!";
    }
    if(isset($_GET['del'])){
        mysqli_query($con,"delete from subcategory where id = '".$_GET['id']."'");
        $_SESSION['delmsg']="SubCategory deleted !!";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Subcategory</title>
    <link rel="stylesheet" href="assets/css/style.css">
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
                            <h5 class="m-b-10">Subcategory</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="subcategory.php">Subcategory</a></li> 
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Subcategory</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-10">
                            	<?php if(isset($_POST['submit'])){?>
                                    <div class="alert alert-success">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>Well done!</strong> <?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
                                    </div>
                                    <?php } ?>
                                    <?php if(isset($_GET['del'])){?>
                                    <div class="alert alert-danger" role="alert">
                                    <strong>Oh snap!</strong>   <?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?>
                                    </div><?php } ?>
                                    <br />
                                <form method="post" name="Category">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Category</label>
                                        <select name="category" class="form-control" required>
                                        <option value="">Select Category</option> 
                                        <?php $query=mysqli_query($con,"select * from category");
                                        while($row=mysqli_fetch_array($query)){?>

                                <option value="<?php echo $row['id'];?>"><?php echo $row['categoryName'];?></option>
                                <?php } ?>
                        </select> 
                                    </div>
                                      <div class="form-group">
                                        <label for="exampleInputEmail1">SubCategory Name</label>
                                        <input type="text" placeholder="Enter SubCategory Name" id="fname" name="subcategory" class="form-control" required> 
                                    </div>
                                    <button type="submit" class="btn  btn-primary" name="submit">Add</button>
                                </form>
                            </div>
                           
                        </div>
                     <hr>
                      <div class="row">
                            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Manage Sub Categories</h5>
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                            <th>#</th>
                                            <th>Category</th>
                                            <th>Sub Category</th>
                                            <th>Description</th>
                                            <th>Creation date</th>
                                            <th>Last Updated</th>
                                            <th>Action</th>
                                        </tr>
                                </thead>
                                <tbody>
                                    <?php $query=mysqli_query($con,"select subcategory.id,category.categoryName,category.categoryDescription,subcategory.subcategory,subcategory.creationDate,subcategory.updationDate from subcategory join category on category.id=subcategory.categoryid");
                                    $cnt=1;
                                    while($row=mysqli_fetch_array($query)){
                                        ?>
                                        <tr>
                                            <td><?php echo htmlentities($cnt);?></td>
                                            <td><?php echo htmlentities($row['categoryName']);?></td>
                                            <td><?php echo htmlentities($row['subcategory']);?></td>
                                            <td><?php echo htmlentities($row['categoryDescription']);?></td>
                                            <td> <?php echo htmlentities($row['creationDate']);?></td>
                                            <td><?php echo htmlentities($row['updationDate']);?></td>
                                            <td>
                                            <a href="edit-subcategory.php?id=<?php echo $row['id']?>" class="btn  btn-icon btn-primary"><i class="feather icon-edit"></i></a>
                                            <a href="subcategory.php?id=<?php echo $row['id']?>&del=delete" class="btn  btn-icon btn-danger" onClick="return confirm('Are you sure you want to delete?')"><i class="feather icon-delete"></i></a></td>

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
                </div>
            </div>
        </div>
    </div>
</section>
    <script src="assets/js/vendor-all.min.js"></script>
    <script src="assets/js/plugins/bootstrap.min.js"></script>
    <script src="assets/js/pcoded.min.js"></script>

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
</body>
</html>
<?php } ?>