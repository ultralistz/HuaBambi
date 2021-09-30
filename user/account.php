<?php

$page_title = "我的帳戶";
include('../config/constants.php');

include('../user/partials/header.php');
include('../user/partials/user_login_check.php');
include('../user/partials/user_login_check_menu.php');


$user_login_id = $_SESSION['user_login_id'];
$user_login_email = $_SESSION['user_login_email'];

$sql_account = "SELECT * FROM tbl_user WHERE user_id='$user_login_id'";
$res_account = mysqli_query($conn, $sql_account);

$rows_account = mysqli_fetch_assoc($res_account);

$current_user_full_name = $rows_account['user_full_name'];
$current_user_email = $rows_account['user_email'];
$current_user_password = $rows_account['user_password'];

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

                <a href="<?php SITEURL; ?>account.php#order" class="account__menu">
                    訂單資訊 <br><br>
                    <div class="account__menu__icon"></div>
                </a>
            </ul>

            <form action="" method="POST" class="account__content">

                <div class="account__content__inner__title">
                    <?php echo $current_user_full_name ?>
                </div>

                <br>

                <input class="account__content__inner" type="text" name="change_user_full_name" placeholder="<?php echo $current_user_full_name ?>">

                <input class="account__content__inner" type="text" name="change_user_email" placeholder="<?php echo $current_user_email ?>">

                <a class="account__content__inner" href="#">更改密碼</a>

                <br>

                <input class="account__content__inner__submit" type="submit" name="change_user_submit" value="儲存變更">

            </form>
        </div>
    </section>
</main>


<?php
if(isset($_POST))
?>


<?php include('../user/partials/footer.php'); ?>