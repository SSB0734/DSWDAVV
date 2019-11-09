<?php
if(isset($_POST['submit'])){
	require 'dbh.inc.php';
	$uname=$_POST['username'];
	$pwd=$_POST['password'];

	$sql = "SELECT * FROM users where username=?;";
	$stmt=mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt,$sql)){
		echo "sql query failed";
	}
	else{
		mysqli_stmt_bind_param($stmt,"s",$uname);
		mysqli_stmt_execute($stmt);
		$result=mysqli_stmt_get_result($stmt);#mysqli_stmt_store_result($stmt);
		if($row=mysqli_fetch_assoc($result))
		{
			$pwdcheck=password_verify($pwd, $row['password']);
			if($pwdcheck==true){
			session_start();
			$_SESSION['username']=$row['username'];
			header("location:../index.html?signin=success");
		}
		else{
			header("location:../adminsignup.php?signin=error");
		}
		}#$check=mysqli_stmt_num_rows($stmt);
				else{
			header("location:../adminsignup.php?error=user_not_found");
		}
	}
}
?>