<?php
include 'connect.php';
// kiem tra neu tham so page duoc truyen thi chuyen thanh so nguyen khong thi tra ve 1
    $page = isset($_GET(['page'])) ? int($_GET(['page'])) : 1;
    $limit  = 5;

    $start = ($limit * $page) - $limit;
    $sql = "select * from SACH limit $start, ".($limit+1);
    $query = mysqli_query($conn,$sql);

    $result =array();

    while ($row = mysqli_query($conn,$query)){
        array_push($result, $row);
    }
    $total = count($result);

    //kiem tra xem co yeu cau cua ajax hay khong

    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
        die(json_encode($result));
    }
    else{
        for($i=0;$i<$limit; $i++){
            echo '<div class="book">
            <div class="image">
                <div class="item">
                    <center><img src='".$result[$i]["SACH_Anh"]."'alt=""></center>
                </div>

                <div class="image_content"> 
                    
                <div>
                    <h2 class="product-name-no-ellipsis">
                        <a href="" title="">'".$result[$i]["SACH_Ten"]."'</a>
                    </h2>
                    <div class="price-label">
                        <p class="special-price">
                            <span class="price m-price-font fhs_center_left"> '".$result[$i]["SACH_GiaBan"]."'</span>
                        </p>
                    
                    </div>
                   
                </div>
            </div>
        </div>'
        }
    }

