<?php 

include 'connect.php';

if(isset($_POST['signUp'])){
    $firstName=$_POST['fName'];
    $lastName=$_POST['lName'];
    $username=$_POST['username'];
    
    $password=$_POST['password'];
    $password=md5($password);
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $isTeacher = 1;
     $checkUsername="SELECT * From users where username='$username'";
     $result=$conn->query($checkUsername);
     if($result->num_rows>0){
        echo "Username Address Already Exists !";
     }
     else{
        $insertQuery="INSERT INTO users(firstName,lastName,username,password,email,phone,isTeacher)
                       VALUES ('$firstName','$lastName','$username','$password','$email','$phone','$isTeacher')";
            if($conn->query($insertQuery)==TRUE){
                header("location: index.php");
            }
            else{
                echo "Error:".$conn->error;
            }
     }
   

}

if(isset($_POST['signIn'])){
   $username=$_POST['username'];
   $password=$_POST['password'];
   $password=md5($password) ;
   
   $sql="SELECT * FROM users WHERE username='$username' and password='$password'";
   $result=$conn->query($sql);
   if($result->num_rows>0){
    session_start();
    $row=$result->fetch_assoc();
    if($row['isTeacher'] == 1)
    {
       $_SESSION['username']=$row['username'];
       $_SESSION['isTeacher']=1;
       header("Location: teacherhomepage.php");
       exit();
      }
      elseif($row['isTeacher'] == 0)
    {
       $_SESSION['username']=$row['username'];
       $_SESSION['isTeacher'] = 0;
       header("Location: studenthomepage.php");
       exit();
      }
   }
   else{
    echo "Not Found, Incorrect Username or Password";
   }

}
?>