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
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Student Dashboard</title>

    <link rel="stylesheet" type="text/css" href="admin.css">

    <?php
    include 'student_css.php';
      ?>
</head>
<body>

    <?php
    include 'student_sidebar.php';
      ?>

    


</body>
</html>
