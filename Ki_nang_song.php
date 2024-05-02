<!DOCTYPE html>
<?php
session_start();
    include 'connect.php';
    include 'func.php';
    // $user_data = check_login($conn);

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
            <div class="book">
                <?php

                    $sql = "select * from SACH join LOAI_SACH on sach.ls_id=loai_sach.ls_id where Ls_ten = 'Kĩ năng sống'";
                        $result = mysqli_query($conn, $sql);
                        if ($result->num_rows > 0) {
                            echo '<div class="image">';
                                while ($sach_data = $result->fetch_assoc()) {
                                
                                    
                                echo '<div class="item">
                                            
                                            <img src="'.$sach_data['SACH_Anh'].'"  alt="">
                                            
                                            <!-- lay SACH_ID tu csdl -->
                                            <div onclick="show()" class="theloai">
                                                <a href="bookinf.php?id='.$sach_data['SACH_ID'].'" name="sachid" title="" style="text-decoration: none;">'.$sach_data['SACH_Ten'].'</a>     
                                            </div>
                                            
                                            <div class="price-label">
                                                <p class="special-price">
                                                    <span class="book_pri">'.$sach_data['SACH_GiaBan'].'</span>
                                                </p> <span class="book_pri"><del>'.$sach_data['SACH_GiaKhuyenMai'].'</del></span>
                                            
                                            </div>
                                     
                                    </div> ';
                            }

                            echo '</div>';
                        } else {
                            echo "0 results";
                        }
                    
                        
                
                    ?>

            
        </div>
    </div>

</body>
</html>


