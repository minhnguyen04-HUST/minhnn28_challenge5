<?php
error_reporting();
session_start();
	include("connect.php");
	if (!isset($_SESSION['username']))
	{
	    header("Location: index.php");
	}
	

	$message_id = $_GET['message_id'];

	$sql = "SELECT * FROM leaveMessage WHERE id = '$message_id'";

	$result = mysqli_query($conn, $sql);
	$info = mysqli_fetch_assoc($result);

	if(isset($_POST['change_message']))
	{
			
			$message = $_POST['message'];
			$stmt = "UPDATE leaveMessage SET content='$message' WHERE id='$message_id'";

		
		$result2 = mysqli_query($conn, $stmt);

		if($result2){
			if($_SESSION['isTeacher'] == 0)
			{
				echo "<script>alert('Changing message successfully')</script>";
				header("Location: message_sent.php");
			}
			else
			{
				echo "<script>alert('Changing message successfully')</script>";
				header("Location: message_sent.php");
			}
		    
		} else {
		    echo "Error: " . $stmt->error;
		}
	}

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Change Message</title>

    <link rel="stylesheet" type="text/css" href="admin.css">

    <?php 
        include 'student_css.php'; 
    ?>
	<style type="text/css">
		label
		{
			display: inline-block;
			width: 100px;
			text-align: left;
			padding-top: 10px;
			padding-bottom: 10px;
		}
		.div_deg
		{
			background-color: skyblue;
			width: 700px;
			padding-bottom: 70px;
			padding-top: 70px;
		}
	</style>

</head>
<body>

    <?php
    	if ($_SESSION['isTeacher']== 1)
        include 'teacher_sidebar.php';
    	elseif ($_SESSION['isTeacher']== 0)
    		include 'student_sidebar.php';
      ?>

    <div class="content">
        <center>
        <h1>Leave Message</h1>

        <div class="div_deg">
        	<form action="#" method="POST">
        		<div>
        			<label>From</label>
        			<input type="text" name="from_user" value="<?php echo "{$info['fromUser']}" ?>" disabled>
        		</div>
        		<div>
        			<label>To</label>
        			<input type="text" name="to_user" value="<?php echo "{$info['toUser']}" ?>" disabled>
        		</div>
        		<div>
        			<label>Message</label>
        			<textarea type="text" name="message" ><?php echo "{$info['content']}"?></textarea>
        		</div>
        		<div>
        			<input class ="btn btn-success" type="submit" name="change_message" value="Change Message">
        		</div>
        	</form>
        </div>
        </center>

    </div>
</body>
</html>