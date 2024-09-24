<?php
error_reporting();
session_start();
	include("connect.php");
	if (!isset($_SESSION['username']))
	{
	    header("Location: index.php");
	}
	if($_SESSION["isTeacher"] == 0)
	{
		header("Location: index.php");
	}
	
	$assignment_id = $_GET['assignment_id'];

	$sql = "SELECT * FROM studentSubmit WHERE id ='$assignment_id'";
 	$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>View Assignment</title>

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
        <h1>View Assignment</h1>

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
        		<th class="table_th">Username</th>
        		<th class="table_th">File Name</th>
        		<th class="table_th">File Size</th>
        		<th class="table_th">File Type</th>
        		<th class="table_th">Download</th>
        	</tr>

        	<?php 
        	while ($info=$result->fetch_assoc()) 
        	{
        	 	$file_path="student_uploads/".$info['filename'];
        	?>


        	<tr>
        		<td class="table_td">
        			<?php echo "{$info['username']}" ?>
        		</td>
        		<td class="table_td">
        			<?php echo "{$info['filename']}" ?>
        		</td>
        		<td class="table_td">
        			<?php echo "{$info['filesize']}" ?>
        		</td>
        		<td class="table_td">
        			<?php echo "{$info['filetype']}" ?>
        		</td>
        		<td class="table_td"><a href="<?php echo $file_path; ?>" class="btn btn-primary" download>Download</a></td>
        		
        	</tr>
        	<?php 
        	}
        	 ?>
        </table>
        </center>

    </div>

</body>
</html>