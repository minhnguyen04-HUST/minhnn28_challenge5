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


    $sql ="SELECT * FROM quiz";
    $result = mysqli_query($conn, $sql);

    $info=mysqli_fetch_assoc($result);
    $error_message="";
    $content="";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $answer = strtolower(str_replace(' ', '', $_POST['answer']));
        $answer = iconv('UTF-8', 'ASCII//TRANSLIT', $answer); // Bỏ dấu, chuyển thành ASCII
        $file_path = "uploads/" . $answer . ".txt";

        // Kiểm tra nếu đáp án đúng
        if (file_exists($file_path)) {
            $content = file_get_contents($file_path); // Đọc nội dung của file
            #echo "<h2>Congratulations! Here is the content of the file:</h2>";
            #echo "<pre>" . htmlspecialchars($content) . "</pre>";
        } else {
            $error_message = "Wrong answer, please try again!";
        }
    }
?>

<!-- HTML Form cho sinh viên nhập đáp án -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Submit Answer</title>
    <link rel="stylesheet" type="text/css" href="admin.css">
    <?php
    include 'student_css.php';
      ?>
    <style type="text/css">
        
        label 
          {
            display: inline-block;
            text-align: center;
            width: 300px;
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
    include 'student_sidebar.php';
      ?>
    <div class="content">
        <center>
            <h1>Submit your answer</h1>
            <p>Hint: <?php echo "{$info['hint']}" ?></p>
            <div class="div_deg">
                <form action="#" method="post">
                    <label for="answer">Enter your answer (file name):</label><br>
                    <input type="text" id="answer" name="answer" required><br><br>

                    <input type="submit" value="Submit Answer">
                </form>
                <?php if ($error_message): ?>
                    <h2 style="color:red;"><?php echo $error_message; ?></h2>
                <?php endif; ?>

            <!-- Hiển thị nội dung bài thơ nếu đáp án đúng -->
                <?php if ($content): ?>
                    <h2>Congratulation, you got it!!!!</h2>
                    <pre><?php echo htmlspecialchars($content); ?></pre>
                <?php endif; ?> 
            </div>
        </center>

    </div>
</body>
</html>
