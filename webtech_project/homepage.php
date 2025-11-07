<?php
session_start();
include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Homepage(john)</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
   
    <p>You are successfully logged in.
        <?php
        if(isset($_SESSION['Email'])) {
           $email = $_SESSION['Email'];
           $query=mysqli_query($conn,"SELECT users.* FROM `users` WHERE users.Email='$email'");
        while($row=mysqli_fetch_array($query)){
            echo "Welcome, " . $row['FirstName'] . " " . $row['LastName'] . "!";
        } 
    }
    ?>
    
    </p>
</body>
</html>