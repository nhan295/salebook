
<?php
    
   
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
       
    
    </style>
</head>
<body>
    <div id="content_login">
        <div class="title">
            <h1>BOOKSHOP <img src="images\book.jpg" alt="ảnh cuốn sách" style="width:70px; border: 3px; display: inline;"></h1>
        </div>

        <div id="loginform">
            <form action="test.php"method="post">
               
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

    
            // Đọc dữ liệu từ cơ sở dữ liệu
            if (!empty($uname) && !empty($passwd)) {
                // Lấy mật khẩu đã được mã hóa trong cơ sở dữ liệu và lưu vào biến StoredHashPassword
                $GetPass = "select ND_MatKhau from NGUOI_DUNG where ND_HoTen = '$uname' limit 1";
                $check_passwd = mysqli_query($conn, $GetPass);
                if($check_passwd && mysqli_num_rows($check_passwd) > 0) {
                    $HashPass = mysqli_fetch_assoc($check_passwd);
                    $StoredHashPassword =  rtrim($HashPass['ND_MatKhau']);
                }
                var_dump($StoredHashPassword);
                var_dump( $passwd);
    
                $query = "select * from NGUOI_DUNG where ND_HoTen = '$uname' limit 1";
                $result = mysqli_query($conn, $query);
                
    
                if($result && mysqli_num_rows($result) > 0) {
                    $user_data = mysqli_fetch_assoc($result);
                    // Kiểm tra xem mật khẩu nhập vào có giống với mật khẩu đã được mã hóa không
                    if(!password_verify($passwd, $StoredHashPassword)) {
                        echo 'Invalid password.';
                        
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

    // Trả về phản hồi dưới dạng JSON
    // echo json_encode($response);
?>