<?php
ob_start();

$page_title = "登入";
include('../config/constants.php');

include('partials/header.php');
include('partials/menu_login_page.php');

?>


<?php
    if(isset($_SESSUON['signup_seccess']))
    {
        echo $_SESSION['signup_seccess'];
        unset($_SESSION['signup_seccess']);

    }
?>




<main class="main">
    <section class="login__section">
        <div class="login__container">

            <div class="login__user login__signinBx">

                <div class="login__imgBx">
                    <img src="<?php echo IMGURL_USER; ?>login_01.jpg">
                </div>

                <div class="login__formBx">
                    <form action="" method="POST">

                        <h2>登入</h2>

                        <input type="text" name="user_login_email" placeholder="電子信箱">
                        <input type="password" name="user_login_password" placeholder="會員密碼">

                        <br><br>

                        <input type="submit" name="submit_login" value="登入" class="button__login">

                        <p class="login__signup">還沒有會員？<a href="#" onclick="toggleForm();">註冊</a></p>
                    </form>
                </div>

            </div>


            <div class="login__user login__signupBx">

                <div class="login__formBx">
                    <form action="" method="POST">

                        <h2>註冊</h2>

                        <input type="text" name="user_signup_full_name" placeholder="真實姓名">
                        <input type="text" name="user_signup_email" placeholder="電子信箱">
                        <input type="password" name="user_signup_password" placeholder="會員密碼">
                        <input type="password" name="user_signup_confirm_password" placeholder="確認密碼">

                        <br><br>
                        
                        <input type="submit" name="submit_signup" value="註冊" class="button">

                        <p class="login__signup">已經有會員？<a href=# onclick="toggleForm();">登入</a></p>

                    </form>
                </div>

                <div class="login__imgBx">
                    <img src="<?php echo IMGURL_USER; ?>login_02.jpg">
                </div>

            </div>

        </div>
    </section>
</main>


<!---->
<?php

if(isset($_POST['submit_login']))
{  
    $user_login_email = $_POST['user_login_email'];
    $user_login_password = md5($_POST['user_login_password']);


    if($user_login_email!="" AND $user_login_password!="")
    {
        $sql_login = "SELECT * FROM tbl_user WHERE user_email='$user_login_email' AND user_password='$user_login_password'";
        $res_login = mysqli_query($conn, $sql_login);

        $rows = mysqli_fetch_assoc($res_login);

        $count_login = mysqli_num_rows($res_login);

        if($count_login==1)
        {
            $user_login_id = $rows['user_id']; 

            $_SESSION['user_login_id'] = $user_login_id;
            $_SESSION['user_login_email'] = $user_login_email;
            header('location:'.SITEURL);
            //登入成功提示字
        }
        else
        {
            header('location:'.SITEURL.'user/login.php');
            //登入失敗提示字
        }
    }
    else
    {
        echo "使用者名稱或密碼錯誤" ;
    }
}


if(isset($_POST['submit_signup']))
{
    $user_signup_full_name = $_POST['user_signup_full_name'];
    $user_signup_email = $_POST['user_signup_email'];
    $user_signup_password = md5($_POST['user_signup_password']);
    $user_signup_confirm_password = md5($_POST['user_signup_confirm_password']);


    //註冊表格皆不為空值時
    if($user_signup_full_name!="" AND $user_signup_email!="" AND $user_signup_password!="" AND $user_signup_confirm_password!="")
    {
        if($user_signup_password==$user_signup_confirm_password)
        {
            $sql_signup = "INSERT INTO tbl_user SET
            user_full_name = '$user_signup_full_name',
            user_email = '$user_signup_email',
            user_password ='$user_signup_password'
            ";

            $res_signup = mysqli_query($conn, $sql_signup) or die(mysqli_error($conn));

            if($res_signup==TRUE)
            {
                $_SESSION['signup_seccess'] = "新增會員成功" ;
                header("location:".SITEURL.'user/login.php');
            }
        }

    }
}


if(isset($_SESSION['user_login']))
{
    //未登入
    //重新導向至登入頁面
    header('location:'.SITEURL);
}


ob_end_flush();


?>


<?php include('partials/footer.php') ?>