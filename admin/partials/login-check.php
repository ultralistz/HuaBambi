<?php

    //網頁許可控制
    //檢查使用者是否登入
    if(!isset($_SESSION['user']))
    {
        //未登入
        //重新導向至登入頁面
        $_SESSION['no-login-message'] = "<div class='error text-center'>請登入管理員後操作管理員系統.</div>";
        header('location:'.SITEURL.'admin/login.php');
    }
    

?>