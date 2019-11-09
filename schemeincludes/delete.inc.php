<?php
if(isset($_POST['delete'])){
	include 'dbh.inc.php';
	$id=$_POST['delete'];
	$name='SELECT * FROM schemes WHERE fileid='.$id.';';
  
  $del = mysqli_stmt_init($conn);
  mysqli_stmt_prepare($del,$name);
  mysqli_stmt_execute($del);
  $result=mysqli_stmt_get_result($del);
	$sql='DELETE FROM schemes WHERE fileid='.$id.';';
	$stmt = mysqli_stmt_init($conn);
  if(!mysqli_stmt_prepare($stmt, $sql)){
   echo "sql statements failed!";
}
  else{
    mysqli_stmt_execute($stmt);
  while ($row = mysqli_fetch_assoc($result)) {
   $path="../documents/schemes/".$row['name']; 
   echo $row['name'];
   unlink($path);
   echo "unlink successful";
  }
  
  header("location:../schemes.php?delete=success");
}
}
else{
	header("location:../schemes.php?delete=access_denied");
}