<?php
session_start();
echo "Welcome!, " . $_SESSION['user_name'] . '<br>';
include "dbconfig.php";
?>
<!DOCTYPE html>
<html>

<head>
    <title>Student Database</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <style>
    .logout {
        width: inherit;
        display: flex;
    }

    #btn-create {
        background-color: #00ff00;
        color: white;
        border: none;
        padding: 10px 20px;
        margin-right: 10px;
        text-align: center;
        font-size: 16px;
        cursor: pointer;
        border-radius: 5px;
        translate: 600px 20px;
    }

    #btn-out {
        background-color: #f44336;
        color: white;
        border: none;
        padding: 10px 20px;
        margin: 0;
        text-align: center;
        font-size: 16px;
        cursor: pointer;
        border-radius: 5px;
        translate: 620px 20px;
    }

    #btn-out:hover {
        background-color: #d32f2f;
    }
    </style>
</head>

<body>

    <div class="container">
        <div class="logout container">
            <h2>Student Details</h2>
            <a href="create-student.php">
                <button type="text" name="createStudent" id="btn-create">Add</button>
            </a>
            <a href="logout.php">
                <button type="submit" name="logout" id="btn-out">Logout</button>
            </a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>S.N.</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $userLoggedIn = $_SESSION['user_name'];
                if ($userLoggedIn == true) {
                    $sql = "SELECT * FROM tblstudents";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $sn = 1;
                        while ($row = $result->fetch_assoc()) {
                            ?>
                <tr>
                    <td><?php echo $sn; ?></td>
                    <td><?php echo $row['fname']; ?></td>
                    <td><?php echo $row['lname']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><a class="btn btn-info" href="update-student.php?id=<?php echo $row['id']; ?>">Edit</a>
                        &nbsp;
                        <a class="btn btn-danger" href="delete-student.php?id=<?php echo $row['id']; ?>">Delete</a>
                    </td>
                </tr>
                <?php
                $sn++;
                        }
                    }
                } else {
                    header('location:login.php');
                }
                ?>
            </tbody>
        </table>
    </div>
    <script>
    document.getElementById('btn-out').addEventListener('click', function(event) {
        const confirmLogout = confirm('Are you sure you want to logout?');
        if (!confirmLogout) {
            event.preventDefault(); // Prevents the logout if the user cancels
        }
    });
    </script>
</body>

</html>