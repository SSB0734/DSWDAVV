<?php
	if(isset($_POST['submit'])){
		$description=$_POST['description'];
		$file = $_FILES['file'];
		print_r($file);

		$FileName = $file['name'];
		$FileTempName = $file['tmp_name'];
		$FileError = $file['error'];
		$FileType = $file['type'];
		$FileSize = $file['size'];
		

		if($FileError === 0){
			$FileDestination = "../documents/schemes/".$FileName;
			include_once "dbh.inc.php";
			$sql="SELECT * FROM schemes;";
			$stmt = mysqli_stmt_init($conn);
			if(!mysqli_stmt_prepare($stmt,$sql)){
				echo "sql statement failed!";
			}
			else{
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);
				$RowCount = mysqli_num_rows($result);
				$SetPdfOrder = $RowCount+ 1;

				$sql="INSERT INTO schemes(name,description,fileorder) VALUES(?,?,?);";
				if(!mysqli_stmt_prepare($stmt,$sql)){
				echo "sql statement failed!";
				exit();
				}
				else{
					mysqli_stmt_bind_param($stmt,"sss",$FileName,$description,$SetPdfOrder);
					mysqli_stmt_execute($stmt);
					move_uploaded_file($FileTempName, $FileDestination);
					header("location:../schemes.php?upload=success");
			}
		}
	}
		else{
			echo "error while uploading.";
		}
	}
	else{
		echo "do choose some file";
		header("location:../schemes.php");
	}