<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="login.css">
    <script>
    function message() {
        alert("Remember your password brother!");
    }


    function clearErrors() {
        errors = document.getElementsByClassName('error');
        for (let item of errors) {
            item.innerHTML = "";
        }
    }

    function setError(id, error) {
        document.getElementById(id).innerHTML = error;
    }

    // Form Validation

    function validateForm() {
        let returnval = true;
        clearErrors();

        let username = document.forms['registerForm']["username"].value;
        if (username.length < 5) {
            setError("user_error", "*Length of name is too short");
            returnval = false;
        }

        if (username.length == 0) {
            setError("user_error", "*Length of name cannot be zero!");
            returnval = false;
        }

        var email = document.forms['registerForm']["email"].value;
        if (email.length > 15) {
            setError("email_error", "*Email length is too long");
            returnval = false;
        }

        var password = document.forms['registerForm']["password"].value;
        if (password.length < 6) {
            setError("pass_error", "*Password should be atleast 6 characters long!");
            returnval = false;
        }

        var cpassword = document.forms['registerForm']["cpassword"].value;
        if (cpassword != password) {
            setError("cpass_error", "*Password and Confirm password should match!");
            returnval = false;
        }

        return returnval;
    }
    </script>
</head>

<body>
    <!-- Registration Form Start -->
    <div class="form-box register">
        <h2>Registration</h2>
        <form name="registerForm" action="#" onsubmit="return validateForm()" method="POST" autocomplete="off">
            <div class="input-box" id="username">
                <span class="icon"><i class="fa-solid fa-user"></i></span>
                <input type="text" class="username" name="username">
                <label>Username</label>
                <span id="user_error" class="error"></span>
            </div>
            <div class="input-box">
                <span class="icon"><i class="fa-solid fa-envelope"></i></span>
                <input type="email" id="email" name="email">
                <label>Email</label>
                <span id="email_error" class="error"></span>
            </div>
            <div class=" input-box">
                <span class="icon"><i class="fa-solid fa-lock"></i></span>
                <input type="password" id="password" name="password">
                <label>Password</label>
                <span id="pass_error" class="error"></span>
            </div>
            <div class=" input-box">
                <span class="icon"><i class="fa-solid fa-lock"></i></i></span>
                <input type="password" id="cpassword" name="cpassword">
                <label>Confirm Password</label>
                <span id="cpass_error" class="error"></span>
            </div>
            <div class="remember-forgot">
                <label>
                    <input type="checkbox"> I agree to the terms and conditions
                </label>
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


</body>

</html>