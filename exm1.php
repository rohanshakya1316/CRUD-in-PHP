<?php
$errors = []; // Initialize an empty array

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate Name
    if (empty($_POST["name"])) {
        $errors['name'] = "Name is required";
    } else {
        $name = htmlspecialchars($_POST["name"]);
    }

    // Validate Email
    if (empty($_POST["email"])) {
        $errors['email'] = "Email is required";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format";
    } else {
        $email = htmlspecialchars($_POST["email"]);
    }

     // Prevent form submission if there are errors
     if (empty($errors)) {
        // Process the form (e.g., save to database, send an email, etc.)
        echo "<p style='color: green;'>Form submitted successfully!</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Validation with PHP</title>
    <style>
    .error {
        color: red;
    }
    </style>
</head>

<body>

    <form method="POST" action="">
        Name: <input type="text" name="name">
        <span class="error"><?php echo $errors['name'] ?? ''; ?></span><br><br>

        Email: <input type="text" name="email">
        <span class="error"><?php echo $errors['email'] ?? ''; ?></span><br><br>

        <input type="submit" name="submit" value="Submit">
    </form>

</body>

</html>