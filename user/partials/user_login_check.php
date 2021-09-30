<?php

    //網頁許可控制
    //檢查使用者是否登入
    if(!isset($_SESSION['user_login_id']))
    {
        //未登入
        //重新導向至登入頁面
        header('location:'.SITEURL.'user/login.php');
    }
    

?>