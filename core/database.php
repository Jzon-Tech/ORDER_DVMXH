<?php
    // XÂY DỰNG WEBSITE KIẾM TIỀN ONLINE MMO | LIÊN HỆ ZALO 0966142061 | JZONTECH.ASIA
    
    // error_reporting(0);
    session_start();

    ob_start();
    header("Content-type: text/html; charset=utf-8");
    date_default_timezone_set('Asia/Ho_Chi_Minh');

    $data_db        = 'dvmxh';
    $username_db    = 'root';
    $password_db    = '';
    $host_db        = 'localhost'; // CÁI NÀY LÀ MẶC ĐỊNH
    
    $conn = new mysqli($host_db, $username_db, $password_db, $data_db);
    mysqli_set_charset($conn, 'UTF8');
    if ($conn->connect_error) {
        die("Lỗi kết nối database. Vui lòng thử lại !");
    }
    
    // XÂY DỰNG WEBSITE KIẾM TIỀN ONLINE MMO | LIÊN HỆ ZALO 0966142061 | JZONTECH.ASIA  
