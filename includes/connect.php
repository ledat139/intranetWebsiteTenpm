<!-- Kết nối với database -->
<?php
require_once "config.php";

try {
    if (class_exists('PDO')) {
        $dsn = 'mysql:dbname=' . _DB . ';host=' . _HOST;
        $options = [
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', //set utd8
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION //tạo thông báo ra ngoại lệ khi gặp lỗi
        ];
        $conn = new PDO($dsn, _USER, _PASS, $options);
    }
} catch (Exception $exception) {
    echo $exception->getMessage() . '<br>';
    die();
}
