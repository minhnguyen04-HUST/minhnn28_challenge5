<?php
	session_start();
	include ("connect.php");

	if($_GET['message_id'])
	{
		$message_id=$_GET['message_id'];

		$sql="DELETE FROM leaveMessage WHERE id ='$message_id' ";

		$result=mysqli_query($conn, $sql);

		if($result)
		{
			header("Location: message_sent.php");
		}
	}

  ?>