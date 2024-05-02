<?php
 if(isset($_SESSION['ND_ID'])){ // kiểm tra xem biến phiên $_SESSION['ND_ID'] có tồn tại hay không 
    unset($_SESSION['ND_ID']);  //nếu có thì gỡ khỏi phiên làm việc 
}
header('location: home.php');
