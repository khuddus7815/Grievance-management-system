<?php
session_start();
error_reporting(0);
include("include/config.php");

if (isset($_POST['submit'])) {
    $email = $_POST['emailid'];
    // Hash the plain-text password from the form using MD5
    $password = md5($_POST['inputuserpwd']);

    // 1. Prepare a statement to prevent SQL Injection.
    // The query now checks both email and the hashed password.
    $stmt = mysqli_prepare($con, "SELECT id, fullName FROM users WHERE userEmail=? AND password=?");
    
    if ($stmt) {
        // 2. Bind both the email and the MD5 hashed password to the query
        mysqli_stmt_bind_param($stmt, "ss", $email, $password);
        
        // 3. Execute the query
        mysqli_stmt_execute($stmt);
        
        // 4. Get the result
        $result = mysqli_stmt_get_result($stmt);
        
        // 5. Fetch the user data
        $num = mysqli_fetch_assoc($result);

        // 6. If a user was found, the login is successful
        if ($num) {
            $_SESSION['login'] = $email;
            $_SESSION['id'] = $num['id'];
            $_SESSION['username'] = $num['fullName'];
            echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
            exit();
        } else {
            // Invalid email or password
            echo "<script>alert('Invalid email or password.');</script>";
        }
        
        // Close the statement
        mysqli_stmt_close($stmt);

    } else {
        // Handle case where the statement could not be prepared
        echo "<script>alert('An error occurred. Please try again later.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        html, body {
            height: 100%;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: #d2b48c; /* Dark fallback */
            color: #e0e0e0;
            position: relative;
            overflow-x: hidden;
        }

        /* Dark overlay with background image */
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
            position: relative;
            z-index: 1;
        }

        .login-box {
            background: rgba(20, 20, 20, 0.8); /* Dark semi-transparent box */
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
            width: 100%;
						 border: 1px solid #ffffff;
            max-width: 400px;
            text-align: center;
            position: relative;
        }

        .login-header h1 {
            color: #ffffff;
            font-size: 28px;
            margin-bottom: 5px;
            font-weight: 600;
        }

        .login-header p {
            color: #bbbbbb;
            margin-bottom: 30px;
            font-size: 16px;
        }

        .input-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .input-group label {
            display: block;
            margin-bottom: 8px;
            color: #e0e0e0;
            font-weight: 500;
        }

        .input-group input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #fff;
            background: #1e1e1e;
            color: #ffffff;
            border-radius: 5px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        .input-group input:focus {
            outline: none;
            border-color: #007bff;
        }

        .btn-submit {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #0056b3;
        }

        .links-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 25px;
        }

        .links-container a {
            color: #66b3ff;
            text-decoration: none;
            font-size: 14px;
        }

        .links-container a:hover {
            text-decoration: underline;
        }
        /* Add this new style for the signup button */
        .btn-signup {
            width: 100%;
            padding: 12px;
            background-color: #6c757d; /* A secondary, gray color */
            color: #ffffff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none; /* In case we use an <a> tag */
            display: inline-block; /* To make it behave like a button */
            margin-top: 15px; /* Add some space above it */
        }

        .btn-signup:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <div class="login-header">
                <h1>TRANETRA</h1>
                <p>User Login</p>
            </div>
            
            <form method="post">
                <div class="input-group">
                    <label for="emailid">Email Address</label>
                    <input type="email" name="emailid" id="emailid" class="form-control" required placeholder="you@example.com">
                </div>
                <div class="input-group">
                    <label for="inputuserpwd">Password</label>
                    <input type="password" name="inputuserpwd" id="inputuserpwd" class="form-control" required placeholder="Enter Password">
                </div>
                <button class="btn-submit" type="submit" name="submit">Login</button>
            </form>

            <a href="signup.php" class="btn-signup">Create a new account</a>
            
            <div class="links-container">
                </div>
            
            <div class="links-container">
                <a href="../admin/index.php">Admin Login</a>
                <a href="../index.php">Back to Home</a>
            </div>
        </div>
    </div>
</body>
</html>
