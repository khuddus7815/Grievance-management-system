<?php
session_start();
include("include/config.php");

// --- SECURITY NOTE ---
// md5 is considered insecure for password hashing. Use password_hash() & password_verify().
// SQL Injection risk: Use prepared statements instead of direct query.
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $ret = mysqli_query($con, "SELECT * FROM admin WHERE username='$username' AND password='$password'");
    $num = mysqli_fetch_array($ret);

    if ($num > 0) {
        $_SESSION['alogin'] = $_POST['username'];
        $_SESSION['aid'] = $num['id'];
        header("location:dashboard.php");
        exit();
    } else {
        echo "<script>alert('Invalid username or password');</script>";
        echo "<script>window.location.href='admin-login.php'</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body, html {
            height: 100%;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: #d2b48c; /* Dark fallback */
            color: #e0e0e0; /* Light gray text for dark theme */
            position: relative;
        }

        /* Dark background image with overlay */
        body::before {
            content: '';
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
        }

        .login-box {
            background: rgba(20, 20, 20, 0.8); /* Dark semi-transparent box */
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 400px;
            text-align: center;
						 border: 1px solid #ffffff;
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
            background-color: #dc3545;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #c82333;
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
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <div class="login-header">
                <h1>TRANETRA</h1>
                <p>Admin Login</p>
            </div>
            
            <form method="post">
                <div class="input-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" required placeholder="Enter admin username">
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required placeholder="Enter password">
                </div>
                <button class="btn-submit" type="submit" name="submit">Login</button>
            </form>

            <div class="links-container">
                <a href="../user/index.php">User Login</a>
                <a href="../index.php">Back to Home</a>
            </div>
        </div>
    </div>
</body>
</html>
