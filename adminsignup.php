<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>sign in</title>
<?php
	require 'includes/script.php';
?>
</head>
<body>
<?php
	require "includes/headerandnavbar.php";
?>
<?php
if (isset($_SESSION['username'])) {
echo '<div class="row">
<div class="col-sm-3 d1">
<form method="POST" action="includes/logout.inc.php">
	<button class="d4" type="submit" name="submit">logout</button>
</form>';	
}
else{
echo '<div class="row">
<div class="col-sm-3 d1">
<form method="POST" action="includes/signin.inc.php">
	<input class="d5" type="text" name="username" placeholder="username"><br>
	<input class="d5" type="password" name="password" placeholder="password"><br>
	<button class="d4" type="submit" name="submit">sign in</button>
</form>';
if(isset($_GET['signin'])){
  if($_GET['signin']=='error'){
    echo '<br><div style="color:red;text-align:center;font-size:1vw;">incorrect username or password!</div>';
  }
}
}

?>
</div>
</div>
<?php
	require  "includes/footer.php";
?>
</body>
</html>