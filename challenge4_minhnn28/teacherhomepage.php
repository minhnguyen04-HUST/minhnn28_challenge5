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
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Admin Dashboard</title>

    <link rel="stylesheet" type="text/css" href="admin.css">

    <?php
        include 'teacher_css.php';
      ?>
</head>
<body>

    <?php
        include 'teacher_sidebar.php';
      ?>

    

</body>
</html>
