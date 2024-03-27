<?php

function Connect()
{
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$dbname = "cms_db";

	//Create Connection
	$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname) or die($conn->connect_error);

	return $conn;
}
?>

<?php
session_start();
$error='';
if (isset($_POST['submit'])) {
    if (empty($_POST['firstname'])|| empty($_POST['lastname'])|| empty($_POST['email'])) {
    $error = "Invalid details. Please try with valid details.....";
    }
    else
    {
    // Define $username and $password
    $firstname=$_POST['firstname'];
    $lastname=$_POST['lastname'];
    $email=$_POST['email'];
    // Establishing Connection with Server by passing server_name, user_id and password as a parameter
    require 'db_connect.php';
    $conn = Connect();
    // SQL query to fetch information of registerd users and finds user match.
    $query = "SELECT firstname,lastname,email FROM users WHERE firstname=?  AND lastname=? AND email=? LIMIT 1";

    // To protect MySQL injection for Security purpose
    $stmt = $conn->prepare($query);
    $stmt -> bind_param("sss",$firstname,$lastname,$email);
    $stmt -> execute();
    $stmt -> bind_result($firstname,$lastname,$email);
    $stmt -> store_result();
    
    if ($stmt->fetch())  //fetching the contents of the row
    {
        $_SESSION['email']=$email;
        header("location: reset_password2.php"); // Redirecting To Other Page
    } else {
    $error = "Invalid details. Please try with valid details";
    }
    mysqli_close($conn); // Closing Connection
    }
    }
    ?>