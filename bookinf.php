<?php
    session_start();
    include 'connect.php';
    include 'func.php';
    $user_data=check_login($conn);
?>

<!DOCTYPE html>
<html lang="en">
    <link rel="stylesheet" href="bookinf.css">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

<body>
    <div class="page">
    
        <?php  
           
            $id = $_GET['id']; //Tham số truyền bằng pt get từ url

       
             $sql = "SELECT * from SACH where SACH_ID= '$id'";
             $result = mysqli_query($conn, $sql);
             if ($result->num_rows > 0) {
                 $sach_data = $result->fetch_assoc();
           echo' <div class="content">
           
            <!-- truy van sql -->
            <div class="top_content">
            <div class="image">
                <img src="'.$sach_data['SACH_Anh'].'" alt="domxamnho">
            </div>

            
            <div class="order">
                <form action="bookinf.php" method="post">
                    <table>
                       <tr>
                            <td colspan="2" class="book_title" >'.$sach_data['SACH_Ten'].'</td>
                            <td><input type="hidden" name="book_title" value="'.$sach_data['SACH_Ten'].'"></td>
                       </tr>

                       <tr>
                            
                            <td><input type="hidden" name="book_id" value="'.$sach_data['SACH_ID'].'"></td>
                       </tr>

                       <tr>
                            <td><input type="hidden" name="nd_id" value="'.$user_data['ND_ID'].'"></td>
                         
                       </tr>

                       <tr>
                            <td colspan="2"><input type="hidden" id="dt" name="date"></td>
                       </tr>

                       <tr>
                            <td colspan="2" class="book_title" <input name="price">'.$sach_data['SACH_GiaKhuyenMai'].'</td>
                            <td><input type="hidden" name="book_price" value="'.$sach_data['SACH_GiaKhuyenMai'].'"></td>
                       </tr>

                       <tr>
                            <td colspan="2" class="origin_price"><del>'.$sach_data['SACH_GiaBan'].'</del></td>
                       </tr>

                       <tr>
                            <td>Số lượng</td>
                            <td id="second1">
                                <button type="button" class="minus-btn" onclick="handleMinus()"><ion-icon name="remove-outline"></ion-icon></button>
                                <input type="text" name="amount" id="amount" value="1">
                                <button type="button" class="plus-btn" onclick="handlePlus()"><ion-icon name="add-outline"></ion-icon></button>
                            </td>
                        </tr>

                       <tr>                          
                            <td><button type="onclick">Mua ngay</button></td>
                        </tr>
                    </table>
                </form>    
              
            </div>
            </div>

            <hr>

            <div class="detail">
                <h2>Thông tin sản phẩm</h2>
                <div class="detail_content">
                    <table>
                        <tr>
                            <td class="first">Tác giả</td>
                            <td class="second">'.$sach_data['SACH_TacGia'].'</td>
                            
                        </tr>

                        <tr>
                            <td class="first">Ngôn ngữ</td>
                            <td class="second">'.$sach_data['SACH_NgonNgu'].'</td>
                        </tr>

                        <tr>
                            <td class="first">Số trang</td>
                            <td class="second">'.$sach_data['SACH_Sotrang'].'</td>
                        </tr>

                        <tr>
                            <td class="first">Nhà xuất bản</td>
                            <td class="second">'.$sach_data['SACH_NhaXuatBan'].'</td>
                        </tr>

                       
                    </table>
                </div>
              
            </div>
            <hr>

            <div class="decribe_product">
                <h2>Mô tả sản phẩm</h2>
                <p>'.$sach_data['SACH_MoTa'].'</p>
            </div>
        </div>
        
    </div>';
            }
                
        ?>

   
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

<script>
    let amountElement = document.getElementById('amount'); //gán phần tử có id là amount cho biến amountElement
    let amount= amountElement.value; // lấy giá trị biến có id amount 
    

    let render = (amount) =>{  //hàm render nhận tham số amount
        amountElement.value = amount
    }
    //xu li handleplus
    let handlePlus = () =>{
        amount++
        render(amount);
        
    }
    //xu li handle minus
    handleMinus = () => {
        if(amount >1)
             amount--;
        render(amount);//load lai du lieu ô input
    }

    amountElement.addEventListener('input',() => {
        amount = amountElement.value; //cập nhật giá trị ô input
        amount =parseInt(amount); //chuyen amount ve dang so nguyen
        amout =  (isNaN(amount) || amount==0)?1:amount; // neu input la text hoac 0
        render(amount);
        console.log(amount);
    })
</script>

<?php
include 'connect.php';


     if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $b_title = $_POST['book_title'];
        $b_price = $_POST['book_price'];
        $b_id = $_POST['book_id'];
        $nd_id = $_POST['nd_id'];
        $amount = $_POST['amount'];
        $date = $_POST['date'];
       
        $b_total = $b_price * $amount;
        $query = "select * from CHI_TIET_DON_HANG inner join SACH on CHI_TIET_DON_HANG.SACH_ID=SACH.SACH_ID where SACH_Ten = '$b_title'";
        $result = mysqli_query($conn, $query);
        if ($result && mysqli_num_rows($result) <= 0) {
            if (!empty($b_title) && !empty($b_price) && !empty($amount)) {
                $query2 = "insert into CHI_TIET_DON_HANG(ND_ID,SACH_ID,CTDH_SoLuong,CTDH_DonGia,CTDH_ThanhTien,CTDH_NgayLap) values('$nd_id','$b_id','$amount','$b_price',' $b_total','$date')";
                mysqli_query($conn, $query2);
                echo "<script>alert('Mua hàng thành công')</script>";
        }
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