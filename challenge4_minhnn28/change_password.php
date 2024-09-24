<?php
session_start();
    include("connect.php");
    if (!isset($_SESSION['username']))
    {
        header("Location: index.php");
    }
    elseif($_SESSION['isTeacher']== 1)
    {
        header("Location: index.php");
    }

    $name=$_SESSION['username'];


    $sql="SELECT * FROM users WHERE username ='$name'";

    $result=mysqli_query($conn, $sql);

    $info=mysqli_fetch_assoc($result);


    if(isset($_POST['change_password']))
    {
        $old_password = $_POST['password'];
        $old_password = md5($old_password);
        if($old_password === $info['password'])
        {
            $newpass=$_POST['newpass'];
            $retype=$_POST['confirmpass'];
            if ($newpass === $retype)
            {
                $newpass=md5($newpass);
                $sql2 = "UPDATE users SET password ='$newpass' WHERE username='$name'";
                $result2 = mysqli_query($conn, $sql2);
                if ($result2)
                {
                    echo "<script> alert('Update password successfully')</script>";
                    
                }
            }
            else
            {
                echo "<script> alert('Retype password did not match the new password')</script>";
                
            }
        }
        else
        {
            echo "<script>alert('Incorrect password')</script>";
            
        }
    }
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Change Password</title>

    <link rel="stylesheet" type="text/css" href="admin.css">

    <?php
    include 'student_css.php';
      ?>
      <style type="text/css">
          
          label 
          {
            display: inline-block;
            text-align: left;
            width: 200px;
            padding-top: 10px;
            padding-bottom: 10px;
          }

          .div_deg
          {
            background-color: skyblue;
            width: 500px;
            padding-top: 30px;
            padding-bottom: 30px;
          }
      </style>
</head>
<body>

    <?php
    include 'student_sidebar.php';
      ?>

    <div class ="content">
        <center>
            <h1>Change Password</h1>
            <br><br>
            <form action="#" method="POST">
                <div class ="div_deg">
                    <div>
                        <label>Old Password</label>
                        <input type="password" name="password" >
                    </div>
                    <div>
                        <label>New Password</label>
                        <input type="password" name="newpass" >
                    </div>
                    <div>
                        <label>Retype New Password</label>
                        <input type="password" name="confirmpass">
                    </div>
                    
                    <div>
                        <input type="submit" class = "btn btn-primary" name="change_password" value = "Change Password">
                    </div>
                </div>
            </form>
        </center>
    </div>


</body>
</html>