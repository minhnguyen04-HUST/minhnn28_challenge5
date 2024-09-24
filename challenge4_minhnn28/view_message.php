<?php
error_reporting();
session_start();
	include("connect.php");
	if (!isset($_SESSION['username']))
	{
	    header("Location: index.php");
	}
	
	$to_user=$_SESSION['username'];

	$sql = "SELECT * FROM leaveMessage WHERE toUser = '$to_user' ";
		$result = mysqli_query($conn, $sql);
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>View Message</title>

    <link rel="stylesheet" type="text/css" href="admin.css">

    <?php
        include 'teacher_css.php';
      ?>
	<style type="text/css">
		.table_th{
			padding: 20px;
			font-size: 20px;
		}
		.table_td{
			padding: 20px;
			background-color: skyblue;
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
        <h1>Message</h1>

        <?php
        /*
        	if($_SESSION['message'])
        	{
        		echo $_SESSION['message'];
        	} 
        	unset($_SESSION['message']);
        */
         ?>
        <br><br>
        <table border="1px">
        	<tr>
        		<th class="table_th">From User</th>
        		<th class="table_th">To User</th>
        		<th class="table_th">Message</th>
        		

        	</tr>

        	<?php 
        	while ($info=$result->fetch_assoc()) 
        	{
        	 	
        	?>


        	<tr>
        		<td class="table_td">
        			<?php echo "{$info['fromUser']}" ?>
        		</td>
        		<td class="table_td">
        			<?php echo "{$info['toUser']}" ?>
        		</td>
        		<td class="table_td">
        			<?php echo "{$info['content']}" ?>
        		</td>
        		
        	</tr>
        	<?php 
        	}
        	 ?>
        </table>
        </center>

    </div>

</body>
</html>
