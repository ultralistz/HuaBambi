<?php

$page_title = "購物車";
include('../config/constants.php');

include('partials/header.php');
include('partials/user_login_check_menu.php');
include('../config/component.php');


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
    <!-- =============== 購物車 =============== -->
    <section class="service section container">
        <h2 class="section__title">購物車</h2>

        <br>

        <div class="cart__page__container">
            <ul class="menu__sub">

                <a href="<?php SITEURL; ?>account.php#account" class="cart__page__menu">
                    購物車 <br><br>
                    <div class="account__menu__icon"></div>
                </a>

            </ul>

            <form action="" method="POST" class="account__content">

                <div class="account__content__inner__title">
                    <?php echo $current_user_full_name ?>
                </div>

                <br>

                <div class="cart__header">
                    <h5 class="cart__title">商品</h5>
                    <h5 class="cart__price">價格</h5>
                    <h5 class="cart__qty">數量</h5>
                    <h5 class="cart__total">總額</h5>
                </div>

                <div class="cart__product"></div>

            </form>

        </div>
    </section>
</main>


<?php include('../user/partials/footer.php') ?>