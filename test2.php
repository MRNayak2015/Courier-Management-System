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
$error= "";
		if(isset($_POST['submit']))
		{
		$email=$_SESSION['email'];
		$new_pass=$_POST['new_password'];
		$cnf_pass=$_POST['confirm_password'];
		require 'db_connect.php';
		$conn = Connect();
		if($new_pass==$cnf_pass){
			$encrypt_pass = md5($new_pass);
		$sql="UPDATE users SET password ='$encrypt_pass' WHERE email='$email'";
		if ($conn->query($sql)===TRUE) {
			echo "<script>alert('Password successfully updated.');</script>";
			echo "<script>window.location.href ='login.php'</script>";
			}
			
		}
		else{
            echo "<script>alert('New Password and Confirm Password should be Same');</script>";
			echo "<script>window.location.href ='reset_password2.php'</script>";
		}
	}
	
?>