<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $course = $_POST['course'];

    $query = "UPDATE students SET name='$name', email='$email', course='$course' WHERE id='$id'";
    if ($conn->query($query) === TRUE) {
        echo "Student updated successfully";
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}
?>
