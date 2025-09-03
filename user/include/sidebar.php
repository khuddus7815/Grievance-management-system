<nav class="pcoded-navbar">
    <div class="navbar-wrapper">
        <div class="navbar-content scroll-div">

            <div class="">
                <div class="main-menu-header">
                    <?php
                    $id = intval($_SESSION["id"]);
                    $query = mysqli_query($con, "SELECT fullName, userEmail, userImage FROM users WHERE id='$id'");
                    while ($row = mysqli_fetch_array($query)) {
                        $userImage = $row['userImage'];
                        $profileImage = (!empty($userImage)) ? "userimages/" . htmlentities($userImage) : "../admin/assets/images/user/user.png";
                    ?>
                        <!-- Display user profile image -->
                        <img class="img-radius" src="<?php echo $profileImage; ?>" alt="User-Profile-Image" style="width:60px;height:60px;object-fit:cover;border-radius:50%;">

                        <div class="user-details">
                            <span><?php echo htmlentities($row['fullName']); ?></span>
                            <div id="more-details">
                                <?php echo htmlentities($row['userEmail']); ?>
                                <i class="fa fa-chevron-down m-l-5"></i>
                            </div>
                        </div>
                    <?php } ?>
                </div>

                <div class="collapse" id="nav-user-link">
                    <ul class="list-unstyled">
                        <li class="list-group-item"><a href="profile.php"><i class="feather icon-user m-r-5"></i>View Profile</a></li>
                        <li class="list-group-item"><a href="setting.php"><i class="feather icon-settings m-r-5"></i>Settings</a></li>
                        <li class="list-group-item"><a href="logout.php"><i class="feather icon-log-out m-r-5"></i>Logout</a></li>
                    </ul>
                </div>
            </div>

            <ul class="nav pcoded-inner-navbar">
                <li class="nav-item pcoded-menu-caption">
                    <label>User Side</label>
                </li>
                <li class="nav-item">
                    <a href="dashboard.php" class="nav-link">
                        <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                        <span class="pcoded-mtext">Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="register-grievance.php" class="nav-link">
                        <span class="pcoded-micon"><i class="feather icon-file-text"></i></span>
                        <span class="pcoded-mtext">Register Grievance</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="grievance-history.php" class="nav-link">
                        <span class="pcoded-micon"><i class="feather icon-align-justify"></i></span>
                        <span class="pcoded-mtext">Grievances History</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
