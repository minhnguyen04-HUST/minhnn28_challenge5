<?php

session_start();
    include 'connect.php';
    if (!isset($_SESSION['username']))
    {

        header("Location: index.php");
    }
    elseif($_SESSION['isTeacher']== 1)
    {

        header("Location: index.php");
    }

    $assignment_id = $_GET['assignment_id'];
    $username = $_SESSION['username'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if a file was uploaded without errors
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        $target_dir = "student_uploads/"; // Change this to the desired directory for uploaded files
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if the file is allowed (you can modify this to allow specific file types)
        $allowed_types = array("jpg", "jpeg", "png", "gif", "pdf");
        if (!in_array($file_type, $allowed_types)) {
            echo "Sorry, only JPG, JPEG, PNG, GIF, and PDF files are allowed.";
        } else {
            // Move the uploaded file to the specified directory
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                // File upload success, now store information in the database
                $filename = $_FILES["file"]["name"];
                $filesize = $_FILES["file"]["size"];
                $filetype = $_FILES["file"]["type"];

                // Database connection
                /*
                $db_host = "localhost";
                $db_user = "root";
                $db_pass = "";
                $db_name = "login";

                $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                */
                $checkUsername="SELECT * FROM studentSubmit WHERE username='$username' AND id ='$assignment_id'";
                 $result=$conn->query($checkUsername);
                 if($result->num_rows>0){
                    $sql1="DELETE FROM studentSubmit where username = '$username' AND id ='$assignment_id'";
                    $result=mysqli_query($conn, $sql1);
                 }
                // Insert the file information into the database
                $sql = "INSERT INTO studentSubmit(id, username, filename, filesize, filetype) VALUES ('$assignment_id', '$username','$filename', $filesize, '$filetype')";

                if ($conn->query($sql) === TRUE) {
                    echo "The file " . basename($_FILES["file"]["name"]) . " has been uploaded and the information has been stored in the database.";
                    #header("Location: add_assignment.php");
                } else {
                    echo "Sorry, there was an error uploading your file and storing information in the database: " . $conn->error;
                    #header("Location: add_assignment.php");
                }

                $conn->close();
            } else {
                echo "Sorry, there was an error uploading your file.";
                #header("Location: add_assignment.php");
            }
        }
    } else {
        echo "No file was uploaded.";
        #header("Location: add_assignment.php");
    }
}



    
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Submit Assignment</title>

    <link rel="stylesheet" type="text/css" href="admin.css">

    <?php 
        include 'student_css.php';
     ?>

    <style type="text/css">
        
        

        
    </style>
</head>
<body>
    <?php 
        include 'student_sidebar.php';
     ?>
    
    <div class="content">    
        <center>
            <h1>Submit Assignment</h1>
        </center>
            <div class="div_deg">
                <form action="#" method="POST" enctype="multipart/form-data">
                    <div class = "mb-3">
                        <label for="file" class="form-label">Select file</label>
                        <input type="file" class="form-control" name="file" id="file">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
    </div>
    
</body>
</html>