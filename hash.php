
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        html{
            background-image: url();
        }
        .title{
           
            text-align:center;
            font-family: Arial;
            width: 350px;
            margin: auto;
            
        }
        h1{
            margin: 0;
            vertical-align: top;
        }
        #loginform{
            
            margin-top: 20px;
            margin: 20px auto;
            text-align: center;
            width: 400px;
            padding-bottom: 5px;

        }
       
        .form{
          width: 50px;
        }

        input{
            margin-top: 10px;
        }

        #content{
            border-radius: 2px;
            border: solid;
            margin: 300px;
            width: 350px;
        }
       
    
    </style>
</head>
<body>
    <div id="content_login">
        <div class="title">
            <h1>BOOKSHOP <img src="images\book.jpg" alt="ảnh cuốn sách" style="width:70px; border: 3px; display: inline;"></h1>
        </div>

        <div id="loginform">
            <form action="hash.php"method="post">
               
               <input type="text" name="full_name" placeholder="Enter your username" required><br>
               
               <input type="password" name="password" id="password" placeholder="Enter yor password" required>

               <span id="alert"></span><br>
               <input type="checkbox"  onclick="ShowPasswd()">Show password <br><br>
               <span>Haven't an account</span><a href="nhap.php">Signup</a><br><br>
               <button>Log In</button>
            </form>
    </div>

    </div>
<?php

include 'connect.php';

// Khởi động session
session_start();

// Tạo một mảng để lưu trữ phản hồi


// Nếu có dữ liệu được gửi lên bằng phương thức POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if(isset($_POST['full_name']) && isset($_POST['password'])) {
        $uname = $_POST['full_name'];
        $passwd = $_POST['password'];

// See the password_hash() example to see where this came from.
    $hash = '$2y$10$UgAc621xfkXzIS5K7OlKUOpRu7b7ZEKVrkPaopsvVIdHa41ZHxE7O ';
    if (!empty($uname) && !empty($passwd)) {
        // Lấy mật khẩu đã được mã hóa trong cơ sở dữ liệu và lưu vào biến StoredHashPassword
        $GetPass = "select ND_MatKhau from NGUOI_DUNG where ND_HoTen = '$uname' limit 1";
        $check_passwd = mysqli_query($conn, $GetPass);
        if($check_passwd && mysqli_num_rows($check_passwd) > 0) {
            $HashPass = mysqli_fetch_assoc($check_passwd);
            $StoredHashPassword =  rtrim($HashPass['ND_MatKhau']);
            var_dump($StoredHashPassword);
           

        }



            if (password_verify($passwd,$StoredHashPassword )) {
                header('Location: subhome.php');
                die;
            } else {
                echo 'Invalid password.';
            }
            }
        }
}
            
?>