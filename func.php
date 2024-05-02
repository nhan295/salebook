<?php
    function check_login($conn) {
        if(isset($_SESSION['ND_ID'])) {  //kiểm tra người dùng có đăng nhập hay chưa
            $id = $_SESSION['ND_ID']; // $id sẽ chứa giá trị được lưu trữ trong biến phiên 'ND_ID'.
            $query = "select * from NGUOI_DUNG where ND_ID = $id limit 1";
            $result = mysqli_query($conn, $query);
            
            if($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result); //duyet tung hang
                return $user_data; //tra ve ket qua la mang
            }
        } else {
           
            //redirect to login page
            header('Location: home.php');
            die;
        }
    }


  ?>

    


