<?php
error_reporting();
session_start();
	include("connect.php");
	if (!isset($_SESSION['username']))
	{
	    header("Location: index.php");
	}
	

	$from_user=$_SESSION['username'];
	$id = $_GET['student_id'];

	$sql = "SELECT * FROM users WHERE id = '$id'";

	$result = mysqli_query($conn, $sql);

	$info = $result->fetch_assoc();

	$to_user = $info['username'];

	if(isset($_POST['leave_message']))
	{
		$message = $_POST['message'];
		$stmt = $conn->prepare("INSERT INTO leaveMessage(fromUser, toUser, content) VALUES (?, ?, ?)");
		$stmt->bind_param("sss", $from_user, $to_user, $message); // Assuming all three are strings

		if($stmt->execute()){
			if($_SESSION['isTeacher'] == 0)
			{
				echo "<script>alert('Leaving message successfully')</script>";
				header("Location: student_view_for_student.php");
			}
			else
			{
				echo "<script>alert('Leaving message successfully')</script>";
				header("Location: view_student.php");
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
    <title>Sent Message</title>

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
        			<input type="text" name="from_user" value="<?php echo "{$from_user}" ?>" disabled>
        		</div>
        		<div>
        			<label>To</label>
        			<input type="text" name="to_user" value="<?php echo "{$info['username']}" ?>" disabled>
        		</div>
        		<div>
        			<label>Message</label>
        			<textarea type="text" name="message"></textarea>
        		</div>
        		<div>
        			<input class ="btn btn-success" type="submit" name="leave_message" value="Leave Message">
        		</div>
        	</form>
        </div>
        </center>

    </div>
</body>
</html>