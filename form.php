<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>forms</title>
<?php
	require 'includes/script.php';
?>
</head>
<body>
<?php
	require "includes/headerandnavbar.php";
?>
<!-- ...................main starts ................... -->

<div class = "container-fluid">
<div class="row">
<div style="width:100%; height:10%;"><p style="text-align:center;  font-size:290%;margin-top: 10px;  border-radius: 25px; background-image: linear-gradient(to left,#fff68f,#c5eff7);"><B>Forms</B></p></div>
<br>
<?php
if (isset($_SESSION['username'])) {
echo'<div style="margin-left:10%">
  <form action="formincludes/upload.inc.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="file"><br>
    <input type="text" name="description" placeholder="write description"><br>
    <button type="submit" name="submit">upload</button>
  </form>
</div>';
}
?>
<ol start="1">
<?php
include_once "formincludes/dbh.inc.php";
  $sql="SELECT * FROM forms ORDER BY fileorder DESC;";
  $stmt = mysqli_stmt_init($conn);
  if(!mysqli_stmt_prepare($stmt, $sql)){
   echo "sql statements failed!";
}
  else{
  mysqli_stmt_execute($stmt);
  $result=mysqli_stmt_get_result($stmt);
}
  while($row=mysqli_fetch_assoc($result)){
  echo '<li>
<a href="documents/forms/'.$row['name'].'"   target=_new download>
  '.$row['description'].'
</a>
</li>';
if (isset($_SESSION['username'])) {
  echo '<form method="POST" action="formincludes/delete.inc.php"> 
  <button type="submit" name="delete" value="'.$row['fileid'].'">delete</button>
  </form>';
}

}
?>
</ol>
</div>
<!-- ................... main ends ..................... -->
</div>
</div>
<?php
	require  "includes/footer.php";
?>
</body>
</html>