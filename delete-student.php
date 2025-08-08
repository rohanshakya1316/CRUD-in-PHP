<?php
session_start();
    include "dbconfig.php";
    if (isset($_GET['id'])) {
        $stu_id = $_GET['id'];
        $sql = "DELETE FROM tblstudents WHERE id ='$stu_id'";
        $result = $conn->query($sql);
        if ($result == TRUE) {
            echo "<script>alert('Record deleted successfully.');</script>";
            echo '<meta http-equiv = "refresh" content = "0; url = view-student.php"/>';
        } else {
            echo "Error:" . $sql . "<br>" . $conn->error;
        }
    }
?>