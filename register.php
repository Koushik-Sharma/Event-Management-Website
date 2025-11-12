<?php
include "connect_db.php";

if (isset($_POST['sign_up']) && isset($_POST['Password'])) {
    $firstname = $_POST['FirstName'];
    $lastname = $_POST['LastName'];
    $email = $_POST['Email'];
    $password = $_POST['Password'];
    $password=md5($password);
    $check_email = "SELECT * FROM users WHERE Email='$email'";
    $result = $conn->query($check_email);

    if ($result->num_rows > 0) 
    {
        echo "Email already exists";
    } 
    else 
    {
        
        $insert_query = "INSERT INTO users (FirstName, LastName, Email, Password) VALUES ('$firstname', '$lastname', '$email', '$password')";
      if ($conn->query($insert_query) === TRUE) 
     {
       header("Location: login.php");
     }
    else
    {
        echo "Error:".$conn->error;
    }

  }
}
if(isset($_POST['login']))
{
    $email = $_POST['Email'];
    $password = $_POST['Password'];
    $password=md5($password);
    $sql = "SELECT * FROM users WHERE Email='$email' AND Password='$password'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) 
    {
        session_start();
        $row=$result->fetch_assoc();
        $_SESSION['user_id'] = $row['id']; 
        $_SESSION['first_name'] = $row['FirstName'];  
        $_SESSION['Email']=$row['Email'];
        header("Location: home.php");
        exit();
    } 
    else 
    {
        echo "Invalid email or password";
    }
}
?>