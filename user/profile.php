<?php

$page_title = "我的帳戶";
include('../config/constants.php');

include('../user/partials/header.php');
include('../user/partials/user_login_check.php');
include('../user/partials/user_login_check_menu.php');


$user_login_id = $_SESSION['user_login_id'];
$user_login_email = $_SESSION['user_login_email'];

$sql_profile = "SELECT * FROM tbl_user WHERE user_id='$user_login_id'";
$res_profile = mysqli_query($conn, $sql_profile);

$rows_profile = mysqli_fetch_assoc($res_profile);

$current_user_full_name = $rows_profile['user_full_name'];
$current_user_email = $rows_profile['user_email'];
$current_user_password = $rows_profile['user_password'];

?>


<main class="main main__BG">
    <section class="service section container">
        <h2 class="section__title">我的帳戶</h2>

        <br>

        <div class="profile__container">
            <ul class="menu__sub">

                <a href="#" class="profile__menu">
                    個人資訊 <br><br>
                    <div class="profile__menu__icon"></div>
                </a>

                <a href="#" class="profile__menu">
                    訂單資訊 <br><br>
                    <div class="profile__menu__icon"></div>
                </a>
            </ul>

            <div class="profile__content">

                <div class="profile__content__inner__title">
                    <?php echo $current_user_full_name ?>
                </div>

                <br>

                <input class="profile__content__inner" type="text" name="change_user_full_name" placeholder="<?php echo $current_user_full_name ?>">

                <input class="profile__content__inner" type="text" name="change_user_email" placeholder="<?php echo $current_user_email ?>">

                <a class="profile__content__inner" href="#">更改密碼</a>

                <br>

                <input class="profile__content__inner__submit" type="submit" name="change_user_submit" value="儲存變更">

            </div>
        </div>




    </section>
</main>





<?php include('../user/partials/footer.php'); ?>