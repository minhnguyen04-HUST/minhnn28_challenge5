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
    $sql = "SELECT * FROM users WHERE username = '$name'";

    $result = mysqli_query($conn, $sql);

    $info=mysqli_fetch_assoc($result);

    
    if (isset($_POST['update_profile']))
    {
        
        
        $email=$_POST['email'];
        $phone=$_POST['phone'];

        if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK)
        {
            $file = $_FILES['image']['name'];
            
            $dst = "./image/".$file;

            $dst_db= "image/".$file;
            

            move_uploaded_file($_FILES['image']['tmp_name'], $dst);
        }
        if(isset($_POST['avatar_url']) && !empty($_POST['avatar_url']))
        {
            $url = $_POST['avatar_url'];
            #echo $url;
            $file_type = strtolower(pathinfo($url, PATHINFO_EXTENSION));

            // Kiểm tra định dạng file hợp lệ (chỉ chấp nhận jpg, png, gif)
            $valid_extensions = ['jpg', 'jpeg', 'png', 'gif'];
            if (in_array($file_type, $valid_extensions)) {
                // Tải hình ảnh từ URL
                $new_file_name = uniqid('avatar_') . '.' . $file_type;
                #$target_file = $target_dir . $new_file_name;
                $dst = "./image/".$new_file_name;
                $dst_db = "image/".$new_file_name;

                // Tải hình ảnh về từ URL và lưu vào thư mục
                if (file_put_contents($dst, file_get_contents($url))) {
                    
                    echo "Avatar đã tải từ URL thành công!";
                } else {
                    $error_message = "Lỗi khi tải avatar từ URL.";
                }
            } else {
                $error_message = "Chỉ chấp nhận URL có định dạng JPG, PNG, GIF.";
            }
        }

        $sql2= "UPDATE users SET email='$email', phone='$phone', image='$dst_db' WHERE username='$name'";
        $result2 = mysqli_query($conn, $sql2);
        
        if($result2)
        {
            header("Location: student_profile.php");
        }

        
    }
    
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>My Profile</title>

    <link rel="stylesheet" type="text/css" href="admin.css">



    <?php
    include 'student_css.php';
      ?>

      <style type="text/css">
          
          label 
          {
            display: inline-block;
            text-align: right;
            width: 100px;
            padding-top: 10px;
            padding-bottom: 10px;
          }

          .div_deg
          {
            background-color: skyblue;
            width: 500px;
            padding-top: 70px;
            padding-bottom: 70px;
          }
          .avatar-container {
            display: flex;
            align-items: right;
            gap: 10px; /* Khoảng cách giữa "Avatar" và nút "Browse" */
            margin-left: 110px;
        }
        
      </style>
</head>
<body>

    <?php
    include 'student_sidebar.php';
      ?>

    <div class ="content">
        <center>
            <h1>My Profile</h1>
            <br><br>
            <form action="#" method="POST" enctype="multipart/form-data">
                <div class ="div_deg">
                    <div>
                        <label>First Name</label>
                        <input type="text" name="fName" value="<?php echo "{$info['firstName']}" ?>" disabled>
                    </div>
                    <div>
                        <label>Last Name</label>
                        <input type="text" name="lName" value="<?php echo "{$info['lastName']}" ?>" disabled>
                    </div>
                    <div>
                        <label>Username</label>
                        <input type="text" name="username" value="<?php echo "{$info['username']}" ?>" disabled>
                    </div>
                    <div>
                        <label>Email</label>
                        <input type="email" name="email" value="<?php echo "{$info['email']}" ?>">
                    </div>
                    <div>
                        <label>Phone</label>
                        <input type="tel" name="phone" value="<?php echo "{$info['phone']}" ?>">
                    </div>
                    <div class = "avatar-container">
                        <label>Avatar</label>
                        <input type="file" name="image">
                    </div>
                    <div>
                        <label for="avatar_url"> Avatar URL</label>
                        <input type="text" name="avatar_url" id="avatar_url" placeholder="http://example.com/avatar.jpg"><br><br>
                    </div>
                    <div>
                        <?php if (!empty($info['image'])): ?>
                            <img class="teacher" src="<?php echo htmlspecialchars($info['image']); ?>" alt = "Student Avatar">
                        <?php endif; ?>
                        <br><br>
                    </div>
                    <div>
                        <input type="submit" class = "btn btn-primary" name="update_profile" value = "Update">
                    </div>
                </div>
            </form>
        </center>
    </div>


</body>
</html>
