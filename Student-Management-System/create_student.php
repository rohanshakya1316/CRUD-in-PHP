<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $course = $_POST['course'];

    $query = "INSERT INTO students (name, email, course) VALUES ('$name', '$email', '$course')";
    if ($conn->query($query) === TRUE) {
        echo "Student added successfully";
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}
?>
