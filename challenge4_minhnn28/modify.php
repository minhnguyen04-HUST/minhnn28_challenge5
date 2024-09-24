<?php
session_start();
	include("connect.php");
	if (!isset($_SESSION['username']))
	{
	    header("Location: index.php");
	}
	elseif($_SESSION['isTeacher']== 0)
	{
	    header("Location: index.php");
	}

	$id = $_GET['student_id'];

	$sql = "SELECT * FROM users WHERE id = '$id'";

	$result = mysqli_query($conn, $sql);

	$info = $result->fetch_assoc();


	if (isset($_POST['update']))
	{
		$fName=$_POST['fName'];
		$lName=$_POST['lName'];
		$username=$_POST['username'];
		$email=$_POST['email'];
		$phone=$_POST['phone'];


		$password=$_POST['password'];
		if(!empty($password))
		{
			$password = md5($password);
			$query="UPDATE users SET firstName='$fName', lastName='$lName', username='$username', password='$password', email='$email', phone='$phone' WHERE id = '$id'";
		}
		else
		{
			$query="UPDATE users SET firstName='$fName', lastName='$lName', username='$username', email='$email', phone='$phone' WHERE id = '$id'";
		}

		$result2 = mysqli_query($conn, $query);

		if($result2)
		{
			header("Location: view_student.php");
		}
	}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Change Student Information</title>

    <link rel="stylesheet" type="text/css" href="admin.css">

    <?php 
    	include 'teacher_css.php' 
    ?>
    
	<style type="text/css">
		label
		{
			display: inline-block;
			width: 100px;
			text-align: right;
			padding-top: 10px;
			padding-bottom: 10px;
		}
		.div_deg
		{
			background-color: skyblue;
			width: 400px;
			padding-bottom: 70px;
			padding-top: 70px;
		}
	</style>

</head>
<body>

    <?php
    	include 'teacher_sidebar.php';
      ?>


    <div class="content">
        <center>
        <h1>Change Information</h1>

        <div class="div_deg">
        	<form action="#" method="POST">
        		<div>
        			<label>First Name</label>
        			<input type="text" name="fName" value="<?php echo "{$info['firstName']}" ?>">
        		</div>
        		<div>
        			<label>Last Name</label>
        			<input type="text" name="lName" value="<?php echo "{$info['lastName']}" ?>">
        		</div>
        		<div>
        			<label>Username</label>
        			<input type="text" name="username" value="<?php echo "{$info['username']}" ?>">
        		</div>
        		<div>
        			<label>Password</label>
        			<input type="password" name="password">
        		</div>
        		<div>
        			<label>Email</label>
        			<input type="email" name="email" value="<?php echo "{$info['email']}" ?>">
        		</div>
        		<div>
        			<label>Phone Number</label>
        			<input type="tel" name="phone" value="<?php echo "{$info['phone']}" ?>">
        		</div>
        		<div>
        			
        			<input class ="btn btn-success" type="submit" name="update" value="Modify">
        		</div>
        	</form>
        </div>
        </center>

    </div>

</body>
</html>
