<?php
	session_start();
	include ("connect.php");

	if($_GET['student_id'])
	{
		$user_id=$_GET['student_id'];

		$sql="DELETE FROM users WHERE id ='$user_id' ";

		$result=mysqli_query($conn, $sql);

		if($result)
		{
			$_SESSION['message']='Delete student is successful';
			header("Location: view_student.php");
		}
	}

  ?>