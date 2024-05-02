<?php
   include 'connect.php';


    // Khởi động session
    session_start(); // dữ liệu sẽ được lưu trữ trong phiên
?>

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
        #content_login{
            border: 2px solid black;
            width: 40%;
            margin: 0 auto;
        }

        a{
            margin-left: 10px;
        }
       
    
    </style>
</head>
<body>
    <div id="content_login">
        <div class="title">
            <h1>BOOKSHOP <img src="images\book.jpg" alt="ảnh cuốn sách" style="width:70px; border: 3px; display: inline;"></h1>
        </div>

        <div id="loginform">
            <form action="login.php"method="post">
               
               <input type="text" name="full_name" placeholder="Nhập tên người dùng" required><br>
               
               <input type="password" name="password" id="password" placeholder="Nhập mật khẩu" required>

               <span id="alert"></span><br>
               <input type="checkbox"  onclick="ShowPasswd()">Show password <br><br>
               <span>Haven't an account?</span><a href="signup.php">Signup</a><br><br>
               <button>Log In</button>
            </form>
    </div>

    </div>
    <?php
    
    include 'connect.php';

    // Nếu có dữ liệu được gửi lên bằng phương thức POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if(isset($_POST['full_name']) && isset($_POST['password'])) {
            $uname = $_POST['full_name'];
            $passwd = $_POST['password'];

    
            // Đọc dữ liệu từ cơ sở dữ liệu
            if (!empty($uname) && !empty($passwd)) {
                // Lấy mật khẩu đã được mã hóa trong cơ sở dữ liệu và lưu vào biến StoredHashPassword
                $GetPass = "select ND_MatKhau from NGUOI_DUNG where ND_HoTen = '$uname' limit 1";
                $check_passwd = mysqli_query($conn, $GetPass);
                if($check_passwd && mysqli_num_rows($check_passwd) > 0) {
                    $HashPass = mysqli_fetch_assoc($check_passwd);
                    $StoredHashPassword =  rtrim($HashPass['ND_MatKhau']);
                }
               
    
                $query = "select * from NGUOI_DUNG where ND_HoTen = '$uname' limit 1";
                $result = mysqli_query($conn, $query);
                
    
                if($result && mysqli_num_rows($result) > 0) {
                    $user_data = mysqli_fetch_assoc($result);
                    // Kiểm tra xem mật khẩu nhập vào có giống với mật khẩu đã được mã hóa không
                    if(!password_verify($passwd, $StoredHashPassword)) {
                        echo 'Wrong password.';
                        
                    } else {
                        // Thiết lập phản hồi lỗi
                        $_SESSION['ND_ID'] = $user_data['ND_ID'];
                        header('Location: subhome.php');
                    }
                } else {
                    // Thiết lập phản hồi lỗi
                    echo "<script>document.getElementById('alert').innerHTML = 'Wrong username or password.<br><br>'</script>";
                }          
            } else {
                // Thiết lập phản hồi lỗi
                echo "<script>document.getElementById('alert').innerHTML = 'Please enter valid information.<br><br>'</script>";
            }
        }
    }

   
?>



    <script>
        function ShowPasswd(){
            var x = document.getElementById('password')

            if(x.type === 'password'){
                x.type = 'text'
            }else{
                x.type = 'password'
            }
        }
    </script>

</body>
</html>