<?php include('../config/constants.php'); ?>


<!-- 主要區塊 -->

<html>
    <head>
        <title>登入 - HuaBambi</title>
        <link rel="stylesheet" href="../asset/css/admin.css">
    </head>

    <body>

        <div class="login">

            <h1 class="text-center">登入</h1>
            <br><br>


            <?php

                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>


            <br><br>


            <!-- 登入表單開始 -->
            <form action="" method="POST">
                使用者名稱：<br>
                <input type="text" name="username" placeholder="請輸入使用者名稱"><br><br>

                密碼：<br>
                <input type="password" name="password" placeholder="請輸入密碼"><br><br>

                <input type="submit" name="submit" value="登入" class="btn-primary"><br><br>
            </form>
            <!-- 登入表單結束 -->


            <P class="text-center">2021 All rights reserved, Hau Bambi, Developed By - ulta</P>

        </div>

    </body>
</html>


<?php

    //檢查提交按鈕是否點選
    if(isset($_POST['submit']))
    {
        //執行登入動作
        //1. 從資料庫中拿取資料
        $username = $_POST['username'];
        $password =  md5($_POST['password']);


        //2.檢查使用者名稱與密碼是否存在
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";


        //3.執行要求
        $res = mysqli_query($conn, $sql);


        //4.計算 ROWS 以檢查管理員是否存在
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            //管理員登入成功
            $_SESSION['login'] = "<div class='success'>登入成功.</div>";
            $_SESSION['user'] = $username; //檢查是否為登入狀態

            //重新導向至管理員首頁
            header('location:'.SITEURL.'admin/');
        }
        else
        {
            //管理員登入失敗
            $_SESSION['login'] = "<div class='error text-center'>使用者名稱或密碼錯誤.</div>";
            
            //重新導向至登入畫面
            header('location:'.SITEURL.'admin/login.php');
        }


    }

?>