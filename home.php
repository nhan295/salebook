<!DOCTYPE html>
<?php
session_start();
    include 'connect.php';
    include 'func.php';
    

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>
<div>
        <div id="header">
            <h1 style='font-size: xxx-large;'>BOOKSHOP.COM</h1>
        </div>

        <div id="content">
            
            <div class="danh_muc">
                
                <ul class="list">
                    <li><a href="">Danh mục sản phẩm</a></li>
                    <li><ul class="sublist">
                    <li><a href="kinhte.php">Kinh Tế</a></li>
                        <li><a href="Ki_nang_song.php">Kĩ năng sống</a></li>
                        <li><a href="khoahoc.php">Khoa học</a></li>
                        <li><a href="truyen.php">Truyện</a></li>
                    </ul></li>
                    
                </ul>
            </div>

            <div class="find">
                <form action="home.php" method="post">
                <input type="text" placeholder="Enter name's book" name="search_kw">
                <!-- <input type="submit" value="Search"> -->
                <button>Search</button>
                </form>
                
            </div>

            <div class="log">
                <a href="login.php">Log In</a>
                <a href="signup.php">Sign Up</a>
                <!--<a href="user_inf.php"><ion-icon name="person-outline"></ion-icon></a>-->
            </div>

            </div>

            
                    <!-- SEARCH -->
            <div class="search">

                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') { //kiểm tra xem trang hiện tại đã được yêu cầu bằng phương thức POST hay không.
                    $search = $_POST['search_kw'];

                    $sql = "SELECT * from SACH where SACH_Ten like '%$search%' ";
                        $result = mysqli_query($conn, $sql);
                        if ($result->num_rows > 0) { //nếu có kết quả trả về sẽ in ra 
                            echo '<div class="image">';
                                while ($sach_data = $result->fetch_assoc()) {
                                
                                    
                                    echo '<div class="item">
                                            
                                            <img src="'.$sach_data['SACH_Anh'].'"  alt="">
                                            
                                            <!-- lay SACH_ID tu csdl -->
                                            <div onclick="show()">
                                                <a name="sachid" title="" >'.$sach_data['SACH_Ten'].'</a>   
                                            </div>
                                            
                                            <div class="price-label">
                                                <p class="special-price">
                                                    <span class="book_pri">'.$sach_data['SACH_GiaBan'].'</span>
                                                </p>
                                            
                                            </div>

                                            <div class="price-sale">
                                                <p class="special-saleprice">
                                                    <span class="book_pri">'.$sach_data['SACH_GiaKhuyenMai'].'</span>
                                                </p> <span class="book_pri"><del>'.$sach_data['SACH_GiaBan'].'</del></span>
                                            </div>

                                        
                                        
                                         
                                    
                                    </div> ';
                            }

                            echo '</div>';
                        } else {
                            echo "0 result";
                        }
                    }
                        
                
                    ?>

            
            </div>
            <div class="bd">
                <div class="img_title"><h2>NEW RELEASE!!!</h2></div>
      
            <div class="book">
                <?php

                    $sql = "SELECT * from SACH order by SACH_ID DESC limit 8";
                    $result = mysqli_query($conn, $sql);
                    if ($result->num_rows > 0) {
                        echo '<div class="image">';
                            while ($sach_data = $result->fetch_assoc()) {
                            
                                
                                echo '<div class="item">
                                        
                                        <img src="'.$sach_data['SACH_Anh'].'"  alt="">
                                        
                                        <!-- lay SACH_ID tu csdl -->
                                        <div class="sach_name" onclick="show()">
                                            <a name="sachid" title="" >'.$sach_data['SACH_Ten'].'</a>   
                                        </div>
                                        
                                        <div class="price-label">
                                            <p class="special-price">
                                                <span class="book_pri">'.$sach_data['SACH_GiaKhuyenMai'].'</span>
                                            </p> <span class="book_pri"><del>'.$sach_data['SACH_GiaBan'].'</del></span>
                                            
                                        
                                        </div>

                                       
                                    
                                
                                   
                                </div> 
        
                            
                                
                            
        
                        ';
                        }

                        echo '</div>';
                    } else {
                        echo "0 result";
                    }
                    
            
                ?>
                   

                
            </div>
        </div>
</div>
                
        <div id="footer">

        </div>
    </div>

<!--install icon-->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>




<div id="js-model" style="display: none" class="model">
    <div class="modal-container">
        <div class="model-header">
            <h2>You Need To Login <span onclick="hide()" ><button>X</button></span></h2> 
        </div>
        <center>
            <div class="model-btn">
                <button><a href="login.php">Login</a></button>
            </div>
        </center>
    </div>
</div>

<script>
    function show() {
        document.getElementById('js-model').style.display='block' //ruy cập đến một phần tử trên trang web bằng ID của nó. 
    }
    function hide() {
        document.getElementById('js-model').style.display='none'
    }
</script>
</body>
</html>