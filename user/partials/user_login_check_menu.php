<?php

//網頁許可控制
//檢查使用者是否登入

//測試
if($_SERVER['HTTP_HOST']=="localhost")
{
    if(!isset($_SESSION['user_login_id']))
    {
        //未登入
        include($_SERVER['DOCUMENT_ROOT'].'/huabambi/user/partials/menu.php');
    }
    else
    {
        //已登入
        include($_SERVER['DOCUMENT_ROOT'].'/huabambi/user/partials/menu_login.php');
    }
}
else
{
    if(!isset($_SESSION['user_login_id']))
    {
        //未登入
        include($_SERVER['DOCUMENT_ROOT'].'/user/partials/menu.php');
    }
    else
    {
        //已登入
        include($_SERVER['DOCUMENT_ROOT'].'/user/partials/menu_login.php');
    }
}

?>