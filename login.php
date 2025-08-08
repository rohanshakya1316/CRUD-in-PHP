<?php
session_start();
include "dbconfig.php";
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `login` WHERE username = '$username' && password = '$password'";

    $result = mysqli_query($conn, $sql);
    $total = mysqli_num_rows($result);
    if ($total == 1) {
        $_SESSION['user_name'] = $username;
        header('location:view-student.php');
    } else {
        echo '<script type="text/javascript">';
        echo 'alert("Login Failed. Invalid Username or password.");';
        echo '</script>';
    }
}
ob_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $terms = $_POST['terms'];

    $errors = [];

    if (strlen($username) < 5) {
        $errors['username'] = "*Length of name is too short";
    }

    if (empty($username)) {
        $errors['username'] = "*Length of name cannot be zero!";
    }

    if (strlen($email) > 15) {
        $errors['email'] = "*Email length is too long";
    }

    if (strlen($password) < 6) {
        $errors['password'] = "*Password should be at least 6 characters long!";
    }

    if ($cpassword !== $password) {
        $errors['cpassword'] = "*Password and Confirm password should match!";
    }

    if (!$terms) {
        $errors['terms'] = "*You must agree to the terms and conditions.";
    }

    // If no errors, proceed with form submission (e.g., saving to database)
    if (empty($errors)) {
        // Check if both passwords match
        // if ($password !== $cpassword) {
        //     echo "<script>alert('Passwords do not match. Please try again.');</script>";
        //     echo '<meta http-equiv = "refresh" content = "3; url = login.php"/>';}
        //else {
        $sql = "INSERT INTO `login`(`username`, `email`, `password`, `cpassword`) VALUES ('$username','$email','$password','$cpassword')";
        $result = $conn->query($sql);
        if ($result == true) {
            echo "<script>confirm('Registration successful! Now, Login Here.')</script>";
            echo '<meta http-equiv = "refresh" content = "0; url = login.php"/>';
            exit();
        } else {
            echo "<script>alert('Error!, Registration failed. Try again!');</script>";
        }
    }
}
ob_end_flush();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Registration</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link
        href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;700&family=Poppins:wght@200;300;400;600&family=Quicksand:wght@300;400;500;600;700&family=Urbanist:wght@300;400;600;700;800;900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="login.css">
    <script src="login.js" defer></script>
</head>

<body class="mainContainer">
    <div class="wrapper container">
        <span class="icon-close">
            <i class="fa-solid fa-xmark"></i>
        </span>

        <!-- Login Form Start -->
        <div class="form-box login">
            <h2>Login</h2>
            <form name="loginForm" action="login.php" method="POST" autocomplete="off">
                <div class="input-box">
                    <span class="icon"><i class="fa-solid fa-user"></i></span>
                    <input type="text" class="username" name="username" required>
                    <label>Username</label>
                    <span id=class="error"></span>
                </div>
                <div class="input-box">
                    <span class="icon"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" class="password" name="password" required>
                    <label>Password</label>
                    <span id=class="error"></span>
                </div>
                <div class="remember-forgot">
                    <label>
                        <input type="checkbox"> Remember me
                    </label>
                    <a href="#" onclick="message()">Forget Password?</a>
                </div>
                <button type="submit" class="btn" name="login">Login</button>
                <div class="login-register">
                    <p>Don't have an account?
                        <a href="#" class="register-link">Register</a>
                    </p>
                </div>
            </form>
        </div>
        <!-- Login Form End -->

        <!-- Registration Form Start -->
        <div class="form-box register">
            <h2>Registration</h2>
            <form name="registerForm" action="#" onsubmit="return validateForm()" method="POST" autocomplete="off">
                <div class="input-box">
                    <span class="icon"><i class="fa-solid fa-user"></i></span>
                    <input type="text" id="username" class="username" name="username" required>
                    <label>Username</label>
                    <span id="user_error" class="error"></span>
                </div>
                <div class="input-box">
                    <span class="icon"><i class="fa-solid fa-envelope"></i></span>
                    <input type="email" id="email" name="email" required>
                    <label>Email</label>
                    <span id="email_error" class="error"></span>
                </div>
                <div class="input-box">
                    <span class="icon"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" id="password" name="password" required>
                    <label>Password</label>
                    <span id="pass_error" class="error"></span>
                </div>
                <div class="input-box">
                    <span class="icon"><i class="fa-solid fa-lock"></i></i></span>
                    <input type="password" id="cpassword" name="cpassword" required>
                    <label>Confirm Password</label>
                    <span id="cpass_error" class="error"></span>
                </div>
                <div class=" terms remember-forgot">
                    <label>
                        <input type="checkbox" name="terms"> I agree to the terms and conditions
                    </label>
                    <span id="check_error" class="error" style="color:red;"></span>
                </div>
                <button type="submit" class="btn" name="register">Register</button>
                <div class="login-register">
                    <p>Already have an account?
                        <a href="#" class="login-link">Login</a>
                    </p>
                </div>
            </form>
        </div>
        <!-- Registration Form End -->
    </div>
</body>

</html>