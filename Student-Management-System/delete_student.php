<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    $query = "DELETE FROM students WHERE id='$id'";
    if ($conn->query($query) === TRUE) {
        echo "Student deleted successfully";
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}
?>
