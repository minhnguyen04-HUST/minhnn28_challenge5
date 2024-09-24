<?php
error_reporting();
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

		$sql = "SELECT * FROM users ";
		$result = mysqli_query($conn, $sql);
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>View Student</title>

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
        include 'teacher_sidebar.php';
      ?>


    <div class="content">
        <center>
        <h1>Student Data</h1>

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
        <table border="1px" style="margin-left: 0px;">
        	<tr>
        		<th class="table_th">First Name</th>
        		<th class="table_th">Last Name</th>
        		<th class="table_th">Email</th>
        		<th class="table_th">Phone Number</th>
        		<th class="table_th">Teacher</th>
                <th class="table_th">Leave Message</th>
        		<th class="table_th">Modify</th>
        		<th class="table_th">Delete</th>

        	</tr>

        	<?php 
        	while ($info=$result->fetch_assoc()) 
        	{
        	 	
        	?>


        	<tr>
        		<td class="table_td">
        			<?php echo "{$info['firstName']}" ?>
        		</td>
        		<td class="table_td">
        			<?php echo "{$info['lastName']}" ?>
        		</td>
        		<td class="table_td">
        			<?php echo "{$info['email']}" ?>
        		</td>
        		<td class="table_td">
        			<?php echo "{$info['phone']}" ?>
        		</td>
        		<td class="table_td">
        			<?php if ($info['isTeacher'] == 1)
        					echo "Yes";
        					else
        						echo "No";

        			 ?>
        				
        		</td>
                <td class="table_td">
                    <?php echo "<a class = 'btn btn-primary' href='message.php?student_id={$info['id']}'>Message</a>" ?>
                </td>
        		<td class="table_td">
        			<?php echo "<a class = 'btn btn-primary' href='modify.php?student_id={$info['id']}'>Modify</a>" ?>
        		</td>
        		<td class="table_td">
        			<?php echo "<a onClick=\"javascript:return confirm('Are you sure to delete this'); \" class = 'btn btn-danger' href='delete.php?student_id={$info['id']}'>Delete</a>" ?>
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
