<?php

    include('../config/constants.php');

    //1.摧毀SESSION
    session_destroy(); //unset $_SESSION=['user']

    //2.重新導向至登入頁面
    header('location:'.SITEURL.'admin/login.php');

?>