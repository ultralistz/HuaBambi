<?php

    include('../../config/constants.php');

    //1.摧毀SESSION
    unset($_SESSION['user_login_id']);
    unset($_SESSION['user_login_email']);

    //2.重新導向至登入頁面
    header('location:'.SITEURL.'user/login.php');

?>