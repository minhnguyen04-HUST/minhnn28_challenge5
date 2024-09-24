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

    $error_message="";


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $target_dir = "quiz/";
    $file_name = pathinfo($_FILES["challenge_file"]["name"], PATHINFO_FILENAME); // Tên file không có phần mở rộng
    $file_name = strtolower(str_replace('', '', iconv('UTF-8', 'ASCII//TRANSLIT', $file_name))); // Bỏ dấu
    $target_file = $target_dir . $file_name . ".txt";
    $hint = $_POST['hint'];

    // Kiểm tra và upload file
    if (move_uploaded_file($_FILES["challenge_file"]["tmp_name"], $target_file)) {
        $checkUsername="SELECT * FROM quiz ";
                 $result=$conn->query($checkUsername);
                 if($result->num_rows>0){
                    $sql1="DELETE FROM quiz where id <> 0";
                    $result=mysqli_query($conn, $sql1);
                 }
        $sql = "INSERT INTO quiz (hint, filename) VALUES ('$hint', '$target_file')";
        if ($conn->query($sql) === TRUE) {
                    $error_message =  "Upload quiz successfully";
                    #header("Location: add_assignment.php");
                } else {
                    $error_message = "Sorry, there was an error uploading your file and storing information in the database: " . $conn->error;
                    #header("Location: add_assignment.php");
                }

       
    } else {
        $error_message =  "Sorry, there was an error uploading your file.";
    }
}
    
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Create Quiz</title>

    <link rel="stylesheet" type="text/css" href="admin.css">

    <?php 
        include 'teacher_css.php';
     ?>

    <style type="text/css">
        
    label 
          {
            display: inline-block;
            
            width: 190px;
            padding-top: 10px;
            padding-bottom: 10px;
          }

          .div_deg
          {
            background-color: skyblue;
            width: 500px;
            padding-top: 40px;
            padding-bottom: 40px;
          }
          #hint{
            text-align: left;
          }
        
    </style>
</head>
<body>
    <?php 
        include 'teacher_sidebar.php';
     ?>
    
    <div class="content">    
        <center>
            <h1>Create Quiz</h1>
            <div class="div_deg">
                <form action="#" method="POST" enctype="multipart/form-data">
                    <div class = "mb-3">
                        <label for="hint">Hint</label>
                        <textarea type="text" name="hint" id = "hint" required></textarea><br>

                        <label for="challenge_file">Upload challenge file (.txt):</label><br>
                        <input type="file" id="challenge_file" name="challenge_file" accept=".txt" required><br><br>
                        <?php if ($error_message): ?>
                        <h2 style="color:green;"><?php echo $error_message; ?></h2>
                        <?php endif; ?>
                    </div>
                    <button type="submit" class="btn btn-primary">Upload File</button>
                </form>
            </div>
        </center>

    </div>
    
</body>
</html>