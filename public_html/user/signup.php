<?php
session_start();
include("include/config.php");

// Check if the form was submitted
if(isset($_POST['submit'])) {
    $fullName = $_POST['fullname'];
    $email = $_POST['emailid'];
    $contactNo = $_POST['contactno'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmpassword'];

    // --- Validation ---
    
    // 1. Check if passwords match
    if($password != $confirmPassword) {
        echo "<script>alert('Passwords do not match.');</script>";
    } else {
        // 2. Check if email already exists
        $checkEmailStmt = mysqli_prepare($con, "SELECT userEmail FROM users WHERE userEmail=?");
        mysqli_stmt_bind_param($checkEmailStmt, "s", $email);
        mysqli_stmt_execute($checkEmailStmt);
        mysqli_stmt_store_result($checkEmailStmt);
        
        if(mysqli_stmt_num_rows($checkEmailStmt) > 0) {
            echo "<script>alert('An account with this email already exists.');</script>";
        } else {
            // --- If all checks pass, proceed with insertion ---

            // Hash the password with MD5 (as per your current setup)
            // IMPORTANT: For a real-world application, please switch to password_hash()
            $hashedPassword = md5($password);

            // Prepare the INSERT statement to prevent SQL Injection
            $insertStmt = mysqli_prepare($con, "INSERT INTO users(fullName, userEmail, contactNo, password) VALUES(?, ?, ?, ?)");
            mysqli_stmt_bind_param($insertStmt, "ssss", $fullName, $email, $contactNo, $hashedPassword);
            
            // Execute the statement and check for success
            if(mysqli_stmt_execute($insertStmt)) {
                echo "<script>alert('Registration successful! You can now log in.');</script>";
                echo "<script type='text/javascript'> document.location ='index.php'; </script>";
            } else {
                echo "<script>alert('Something went wrong. Please try again.');</script>";
            }
        }
        mysqli_stmt_close($checkEmailStmt);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Signup</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        html, body { height: 100%; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; background-color: #d2b48c; color: #e0e0e0; position: relative; overflow-x: hidden; }
        body::before { content: ""; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('../images/bg.png') no-repeat center center / cover; z-index: -1; }
        .login-container { display: flex; justify-content: center; align-items: center; min-height: 100vh; padding: 20px; position: relative; z-index: 1; }
        .login-box { background: rgba(20, 20, 20, 0.8); padding: 40px; border-radius: 8px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5); width: 100%; border: 1px solid #ffffff; max-width: 400px; text-align: center; position: relative; }
        .login-header h1 { color: #ffffff; font-size: 28px; margin-bottom: 5px; font-weight: 600; }
        .login-header p { color: #bbbbbb; margin-bottom: 30px; font-size: 16px; }
        .input-group { margin-bottom: 20px; text-align: left; }
        .input-group label { display: block; margin-bottom: 8px; color: #e0e0e0; font-weight: 500; }
        .input-group input { width: 100%; padding: 12px 15px; border: 1px solid #fff; background: #1e1e1e; color: #ffffff; border-radius: 5px; font-size: 16px; transition: border-color 0.3s ease; }
        .input-group input:focus { outline: none; border-color: #007bff; }
        .btn-submit { width: 100%; padding: 12px; background-color: #28a745; /* Green for signup */ color: #ffffff; border: none; border-radius: 5px; font-size: 16px; font-weight: 600; cursor: pointer; transition: background-color 0.3s ease; }
        .btn-submit:hover { background-color: #218838; }
        .links-container { text-align: center; margin-top: 25px; }
        .links-container a { color: #66b3ff; text-decoration: none; font-size: 14px; }
        .links-container a:hover { text-decoration: underline; }
        
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <div class="login-header">
                <h1>TRANETRA</h1>
                <p>Create a New Account</p>
            </div>
            
            <form method="post">
                <div class="input-group">
                    <label for="fullname">Full Name</label>
                    <input type="text" name="fullname" id="fullname" required placeholder="Enter your full name">
                </div>
                <div class="input-group">
                    <label for="emailid">Email Address</label>
                    <input type="email" name="emailid" id="emailid" required placeholder="you@example.com">
                </div>
                <div class="input-group">
                    <label for="contactno">Mobile Number</label>
                    <input type="tel" name="contactno" id="contactno" required placeholder="Enter your mobile number">
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required placeholder="Enter a new password">
                </div>
                <div class="input-group">
                    <label for="confirmpassword">Confirm Password</label>
                    <input type="password" name="confirmpassword" id="confirmpassword" required placeholder="Confirm your password">
                </div>
                <button class="btn-submit" type="submit" name="submit">Sign Up</button>
            </form>
            
            <div class="links-container">
                <a href="index.php">Already have an account? Log In</a>
            </div>
        </div>
    </div>
</body>
</html>