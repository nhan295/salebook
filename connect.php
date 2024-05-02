<?php

//create connection

$conn = mysqli_connect("localhost", "root", "", "BOOKS");

//check connect

if ($conn->connect_error) {
    die("Kết nối đến MySQL thất bại: ". $conn-> connect_error);
} 


?>