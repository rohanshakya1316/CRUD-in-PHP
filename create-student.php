<?php
session_start();      
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Database</title>
</head>

<body>
    <?php 
    $userLoggedIn = $_SESSION['user_name'];
    if ($userLoggedIn==true) { ?>
    <h2>Student Form</h2>
    <form action="" method="POST" autocomplete="off">
        <fieldset>
            <legend>Student Information</legend>
            First Name: <br>
            <input type="text" name="fname"> <br>
            Last Name: <br>
            <input type="text" name="lname"> <br>
            Email: <br>
            <input type="email" name="email"> <br>
            <br><br>
            <input type="submit" name="submit"> <br>
        </fieldset>
    </form>
</body>

</html>

<?php
    include "dbconfig.php";
    if (isset($_POST['submit'])) {
        $firstname = $_POST['fname'];
        $lastname = $_POST['lname'];
        $email = $_POST['email'];
        $sql = "INSERT INTO `tblstudents`(`fname`, `lname`, `email`) VALUES ('$firstname','$lastname','$email')";
        $result = $conn->query($sql);
        if ($result == TRUE) {
            echo "<br>New record created successfully!";
            header('Location: view-student.php');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }
    }else{
        header("location:login.php");
    }
?>