<?php
    session_start();
    include 'connect.php';
    include 'func.php';
    $user_data = check_login($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Information</title>

    <style>
        p {
            margin: 0;
        }
    </style>
</head>
<body>


<!--Form cap nhat thong tin nguoi dung-->
<form action="user_inf.php" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td>Mã tài khoản</td>
            <td><?php echo "<p>".$user_data['ND_ID']."</p>" ?></td>
        </tr>

        <tr>
            <td>Tài khoản</td>
            <td><input type="text" value="<?php echo $user_data['ND_HoTen']; ?>" readonly></td>
        </tr>

        <tr>
            <td>Ngày tham gia</td>
            <td><?php echo "<p>".$user_data['ND_NgayTao']."</p>" ?></td>
        </tr>

        <tr>
            <td>Họ tên</td>
            <td><input type="text" name="fullname" placeholder="Họ và Tên" value="<?php echo $user_data['ND_HoTen'] ?>"></td>
        </tr>

        <tr>
            <td>Giới tính</td>
            <td><select name="sex" id="sex">
                <option value="Nam" <?php if($user_data['ND_GioiTinh'] == 'Nam') {echo "selected";} ?>>Nam</option>
                <option value="Nữ" <?php if($user_data['ND_GioiTinh'] == 'Nữ') {echo "selected";} ?>>Nữ</option>
                <option value="Không xác định" <?php if($user_data['ND_GioiTinh'] == 'Không xác định') {echo "selected";} ?>>Không xác định</option>
            </select></td>
        </tr>

        <tr>
            <td>Số điện thoại (10 chữ số)</td>
            <td><input type="text" pattern="[0-9]{10}" name="phone" value="<?php echo $user_data['ND_SoDienThoai'] ?>"></td>
        </tr>



    </table>
    <button name="submit">Cập nhật</button>
</form>

<?php

  
    if(isset($_POST['submit'])) {
        $name = $_POST['fullname'];
        $sex_option = $_POST['sex'];
        $phone_number = $_POST['phone'];

        
        
        $change = "update NGUOI_DUNG set ND_HoTen = '$name', ND_GioiTinh = '$sex_option', ND_SoDienThoai = '$phone_number' where ND_ID= ".$user_data['ND_ID'];
        $update = mysqli_query($conn, $change);

        echo "<script>alert('Cập nhật thành công')</script>";
        header("refresh: 0");
         
    } 
   
?>  



</body>
</html>