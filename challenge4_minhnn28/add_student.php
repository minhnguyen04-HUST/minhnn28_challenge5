
<?php

session_start();
    include 'connect.php';
    if (!isset($_SESSION['username']))
    {

        header("Location: index.php");
    }
    elseif($_SESSION['isTeacher']== 0)
    {

        header("Location: index.php");
    }


    

    if(isset($_POST['add_student']))
    {
        $firstName=$_POST['fName'];
        $lastName=$_POST['lName'];
        $username=$_POST['username'];
        
        $password=$_POST['password'];
        $password=md5($password);
        $email=$_POST['email'];
        $phone=$_POST['phone'];
        $isTeacher = 0;
         $checkUsername="SELECT * From users where username='$username'";
         $result=$conn->query($checkUsername);
         if($result->num_rows>0){
            echo "Username Already Exists !";
         }
         else{
            $insertQuery="INSERT INTO users(firstName,lastName,username,password,email,phone,isTeacher)
                           VALUES ('$firstName','$lastName','$username','$password','$email','$phone','$isTeacher')";
                if($conn->query($insertQuery)==TRUE){
                    #header("location: teacherhomepage.php");
                    echo "<script type='text/javascript'>
                            alert('Add Student Successfully');
                    </script>";
                }
                else{
                    echo "Error:".$conn->error;
                }
         }
    }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Add Student</title>

    <link rel="stylesheet" type="text/css" href="admin.css">

    <?php 
        include 'teacher_css.php';
     ?>

    <style type="text/css">
        
        label
        {
            display: inline-block;
            text-align: right;
            width: 118px;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .div_deg
        {
            background-color: skyblue;
            width: 450px;
            padding-top: 70px;
            padding-bottom: 70px;
        }
    </style>
</head>
<body>
    <?php 
        include 'teacher_sidebar.php';
     ?>
    <center>
        <div class="content">    
            <h1>Add Student</h1>
                <div class="div_deg">
                    <form action="#" method="POST">
                        <div>
                            <label for="fName">First Name</label>
                            <input type="text" name="fName" id="fName" placeholder="First Name" required>
                            
                        </div>
                        <div>
                            <label for="lName">Last Name</label>
                            <input type="text" name="lName" id="lName" placeholder="Last Name" required>
                            
                        </div>
                        <div>
                            <label for="userame">Username</label>
                            <input type="text" name="username" id="username" placeholder="Username" required>
                            
                        </div>
                        <div>
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" placeholder="Password" required>
                            
                        </div>
                        <div>
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" placeholder="Email" required>
                            
                        </div>
                        <div>
                            <label for="phone">Phone Number</label>
                            <input type="tel" name="phone" id="phone" placeholder="Phone Number" required>
                            
                        </div>
                        <div>
                            
                            <input type="submit" class="btn btn-primary" name="add_student" value="Add Student">
                        </div>
                    </form>
                </div>
        </div>
    </center>
</body>
</html>