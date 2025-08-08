<?php
include 'db.php';

$query = "SELECT * FROM students";
$result = $conn->query($query);

$students = array();
while ($row = $result->fetch_assoc()) {
    $students[] = $row;
}

echo json_encode($students);
?>
