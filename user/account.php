<?php

$page_title = "我的帳戶";
include('../config/constants.php');

include('partials/header.php');
include('partials/user_login_check.php');
include('partials/user_login_check_menu.php');


if(isset($_SESSION['account_update_success']))
{
    ?>
    <script>
        Swal.fire
        (
            '修改成功',
            '會員資料已更新！',
            'success'
        )
    </script>
    <?php
    unset($_SESSION['account_update_success']);
}

if(isset($_SESSION['account_update_error']))
{
    ?>
    <script>
        Swal.fire
        ({
            icon: 'error',
            title: '修改失敗',
            text: '會員資料修改失敗，請稍後再試！',
        })
    </script>
    <?php
    unset($_SESSION['account_update_error']);
}


$user_login_id = $_SESSION['user_login_id'];
$user_login_email = $_SESSION['user_login_email'];

$sql_account = "SELECT * FROM tbl_user WHERE user_id='$user_login_id'";
$res_account = mysqli_query($conn, $sql_account);

$rows_account = mysqli_fetch_assoc($res_account);

$current_user_full_name = $rows_account['user_full_name'];
$current_user_email = $rows_account['user_email'];

?>


<!-- =============== 主區塊 =============== -->
<main class="main main__BG">
    <!-- =============== 我的帳戶 =============== -->
    <section class="service section container">
        <h2 class="section__title">我的帳戶</h2>

        <br>

        <div class="account__container">
            <ul class="menu__sub">

                <a href="<?php SITEURL; ?>account.php#account" class="account__menu">
                    個人資訊 <br><br>
                    <div class="account__menu__icon"></div>
                </a>

                <a href="<?php echo SITEURL ?>un.php" class="account__menu">
                    訂單資訊 <br><br>
                    <div class="account__menu__icon"></div>
                </a>
            </ul>

            <form action="" method="POST" class="account__content">

                <div class="account__content__inner__title">
                    <?php echo $current_user_full_name ?>
                </div>

                <br>

                <input type="text" class="account__content__inner" name="change_user_full_name" value="<?php echo $current_user_full_name ?>">

                <input type="text" class="account__content__inner" name="change_user_email" value="<?php echo $current_user_email ?>">

                <a class="account__content__inner" href="<?php echo SITEURL ?>un.php">更改密碼</a>

                <br>

                <input type="submit" class="account__content__inner__submit" name="submit_user" value="儲存變更">

            </form>
        </div>
    </section>
</main>




<?php
if(isset($_POST['submit_user']))
{
    $update_user_full_name = $_POST['change_user_full_name'];
    $update_user_email = $_POST['change_user_email'];

    $sql_update = "UPDATE tbl_user SET
        user_full_name = '$update_user_full_name',
        user_email = '$update_user_email',
        WHERE user_id = '$user_login_id'
    ";

    $res_update = mysqli_query($conn, $sql_update);

    if($res_update==true)
    {
        header('location:'.SITEURL.'user/account.php');
        $_SESSION['account_update_success'] = "";
    }
    else
    {
        header('location:'.SITEURL.'user/account.php');
        $_SESSION['account_update_error'] = "";
    }
}
?>


<?php include('../user/partials/footer.php'); ?>