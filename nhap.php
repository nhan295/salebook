<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>


    <style>
        #box {
            margin: auto;
            width: 350px;
            padding: 30px 40px;
            text-align: center;
        }

        #alert {
            color: lightcoral;
        }

        table{
            color: rgb(2, 8, 2);
            margin: 0 auto;
            
        }
        .first{
            text-align: right;
            font-size: 20px;
            
        }
        .second{
            padding-left: 10px;
        }
        .title{
            text-align: center;
        }

        body{
            border: 2px solid;
            width: 400px;
            margin: auto;
        }

        form{
            margin-right: 50px;
        }
    </style>
</head>
<body>
    <!--Form dang ki-->
    <div class="title">
        <h1>Sign Up</h1>
    </div>
    <div id="box">
        <form action="nhap.php" method="post">   <!--dữ liệu sẽ được gửi đến trang bằng phương thức post-->
            <table>
            <tr>
                <td class="first">Ho ten*:</td>
                <td colspan="2"><input type="text" name="full_name"></td>
            </tr>
            
            <tr>
                <td class="first">Mat khau*:</td>
                <td colspan="2"><input type="password" id="password"  name="passwd"></td>
            </tr>

            <tr>
                <td class="first">Nhap lai mat khau*:</td>
                <td colspan="2"><input type="password" id="re_password" name="re-password"></td>
                <span id="alert"></span>
            </tr>
           
            <tr>
                <td class="first">Sex*: </td>
                <td class="second"><input type="radio" id="male" name="gender" checked>Nam</td>
                <td class="second"><input type="radio" id="female" name="gender">Nữ</td>
            </tr>

            <tr>
                <td colspan="2"><input type="hidden" id="dt" name="date"></td>
            </tr>
            

            <tr>
                <td class="first">email:</td>
                <td colspan="2"><input type="email" name="mail"></td>
            </tr>
            
            <tr>
                <td class="first">so dien thoai:</td>
                <td colspan="2"><input type="tel" name="phone_number"></td>
            </tr>
    
           <tr>
                <td class="first">Dia chi:</td>
                <td colspan="2"><input type="text" name="address"></td>
           </tr>
         </table>

            <button>Signup</button><br><br>
            <span>Alredy have an account? </span><a href="test.php">Login</a>
            </table>
        </form>
    </div>

    <?php
    session_start();

    include 'connect.php';
    include 'func.php';

    //something was posted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') { //kiểm tra xem trang hiện tại đã được yêu cầu bằng phương thức POST hay không.
        $uname = $_POST['full_name'];
        $passwd = $_POST['passwd'];
        $re_passwd = $_POST['re-password'];
        $sex = $_POST['gender'];
        $date = $_POST['date'];
        $email = $_POST['mail'];
        $phone = $_POST['phone_number'];
        $address = $_POST['address'];
        $query1 = "select * from NGUOI_DUNG where ND_HoTen = '$uname'";
        $result = mysqli_query($conn, $query1);

         $HashPassword = password_hash($passwd, PASSWORD_DEFAULT);
        
        //save to database
        if ($result && mysqli_num_rows($result) <= 0) {
            if ($passwd == $re_passwd && !empty($uname) && !empty($passwd) && !empty($re_passwd)) {
                $query2 = "insert into NGUOI_DUNG(ND_Hoten, ND_MatKhau,ND_GioiTinh,ND_NgayTao,ND_Email,ND_SoDienThoai, ND_DiaChi) values('$uname', '$HashPassword ','$sex','$date','$email','$phone','$address')";
                mysqli_query($conn, $query2);
    
                header('Location: test.php');
                die;
            } else {
                echo "<script>document.getElementById('alert').innerHTML = 'Please enter valid information.<br><br>'</script>";
            }
        } else {
            echo "<script>document.getElementById('alert').innerHTML = 'Username already exists.<br><br>'</script>";
        }
        
    }
?>

<script>
    var today = new Date();
    var date = today.getFullYear()+"-"+(today.getMonth()+1)+"-"+today.getDate();
    document.getElementById('dt').value = date;
    
</script>
</body>
</html>