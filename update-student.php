<?php
session_start();
    include "dbconfig.php";
    if (isset($_POST['update'])) {
        $stu_id = $_POST['stu_id'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $sql = "UPDATE `tblstudents` SET `fname`='$fname',`lname`='$lname',`email`='$email' WHERE `id`='$stu_id'";
        $result = $conn->query($sql);
        if ($result == TRUE) {
            echo "Record updated successfully.";
            header('Location: view-student.php');
        } else {
            echo "Error:" . $sql . "<br>" . $conn->error;
        }

    }

    if (isset($_GET['id'])) {
        $stu_id = $_GET['id'];
        $sql = "SELECT * FROM tblStudents WHERE id='$stu_id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id = $row['id'];
                $fname = $row['fname'];
                $lname = $row['lname'];
                $email = $row['email'];
            }
            ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student</title>
</head>

<body>
    <h2>Student details Update Form</h2>
    <form action="" method="post">
        <fieldset>
            <legend>Personal information:</legend>
            First Name:<br>
            <input type="text" name="fname" value="<?php echo $fname; ?>">
            <input type="hidden" name="stu_id" value="<?php echo $id; ?>">
            <br>
            Last Name:<br>
            <input type="text" name="lname" value="<?php echo $lname; ?>">
            <br>
            Email:<br>
            <input type="email" name="email" value="<?php echo $email; ?>">
            <br><br>
            <input type="submit" value="Update" name="update">
        </fieldset>
    </form>
</body>

</html>


<?php
        } else {
            header('Location: view-student.php');
        }
    }
?>