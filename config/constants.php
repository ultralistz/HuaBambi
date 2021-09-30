<?php

//Start Session
session_start();


//定義區塊
if($_SERVER['HTTP_HOST']=="localhost")
{
    define('SITEURL', 'http://localhost/huabambi/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'huabambi_db');
}
else
{
    define('SITEURL', 'https://huabambi.com/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'ultralistz');
    define('DB_PASSWORD', 'ult014077');
    define('DB_NAME', 'huabambi_db');
}


$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn)); //連結資料庫
$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn)); //選擇資料庫
mysqli_set_charset($conn, "utf8mb4");


//定義區塊

define('IMGURL_USER', SITEURL.'asset/img/');
define('IMGURL_ADMIN', '../asset/img/');

?>