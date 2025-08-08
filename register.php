<?php
// Initialize error array and success message
$errors = [];
$successMessage = '';

// Server-side validation and processing
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate inputs
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    // Validate username
    if (strlen($username) < 5) {
        $errors[] = "Username must be at least 5 characters.";
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }

    // Validate password
    if (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters long.";
    }

    // Validate confirm password
    if ($password !== $cpassword) {
        $errors[] = "Password and Confirm Password do not match.";
    }

    // If there are no errors, proceed with storing data in the database
    if (empty($errors)) {
        // Hash the password before storing it in the database
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Database connection (replace with your own credentials)
        $conn = new mysqli('localhost', 'root', '', 'my_database');

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepared statement to insert the user into the database
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $hashedPassword);
        
        if ($stmt->execute()) {
            $successMessage = "Registration successful! Please login.";
        } else {
            $errors[] = "Error: " . $stmt->error;
        }

        // Close the database connection
        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <!-- <script>
    // Client-side validation function
    function validateForm() {
        let returnval = true;
        clearErrors();

        // Validate Username
        let username = document.forms['registerForm']["username"].value;
        if (username.length < 5) {
            setError("username", "*Username must be at least 5 characters.");
            returnval = false;
        }

        // Validate Email
        let email = document.forms['registerForm']["email"].value;
        const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (!emailRegex.test(email)) {
            setError("email", "*Please enter a valid email.");
            returnval = false;
        }

        // Validate Password
        let password = document.forms['registerForm']["password"].value;
        if (password.length < 6) {
            setError("password", "*Password should be at least 6 characters long.");
            returnval = false;
        }

        // Validate Confirm Password
        let cpassword = document.forms['registerForm']["cpassword"].value;
        if (cpassword !== password) {
            setError("cpassword", "*Password and Confirm Password do not match.");
            returnval = false;
        }

        return returnval; // Return false if validation fails to prevent form submission
    }

    // Helper functions to set and clear errors
    function clearErrors() {
        let errors = document.getElementsByClassName('error');
        for (let item of errors) {
            item.innerHTML = "";
        }
    }

    function setError(id, error) {
        let element = document.getElementById(id);
        element.getElementsByClassName("error")[0].innerHTML = error;
    }
    </script> -->
</head>

<body>

    <!-- Registration Form -->
    <h2>Registration Form</h2>

    <?php
// Display server-side validation errors
if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "<p style='color: red;'>$error</p>";
    }
}

// Display success message if registration is successful
if ($successMessage) {
    echo "<p style='color: green;'>$successMessage</p>";
}
?>

    <form name="registerForm" action="register.php" method="POST" onsubmit="return validateForm()" autocomplete="off">
        <div class="input-box" id="username">
            <input type="text" name="username">
            <label>Username</label>
            <span class="error"></span>
        </div>
        <div class="input-box">
            <input type="email" name="email">
            <label>Email</label>
            <span class="error"></span>
        </div>
        <div class="input-box">
            <input type="password" name="password">
            <label>Password</label>
            <span class="error"></span>
        </div>
        <div class="input-box">
            <input type="password" name="cpassword">
            <label>Confirm Password</label>
            <span class="error"></span>
        </div>
        <div class="remember-forgot">
            <label>
                <input type="checkbox" name="terms"> I agree to the terms and conditions
            </label>
        </div>
        <button type="submit">Register</button>
    </form>

</body>

</html>