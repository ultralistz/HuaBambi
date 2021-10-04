<?php

$page_title = "首頁";
include('config/constants.php');

include('user/partials/header.php');
include('user/partials/user_login_check_menu.php');

?>


<!-- =============== 主區塊 =============== -->
<main class="main main__BG">
    <!-- =============== 商品(獨立) =============== -->
    <section class="service section container">
        <h2 class="section__title"></h2>

        <br>

        <div class="cart__page__container">
            <ul class="menu__sub">

                <h2 class="un__page__menu">
                    <?php echo "施工中，請稍後再試" ?> 
                    <br><br><br><br><br><br>
                    <div class="un__page__menu__icon"></div>
                    <br><br><br><br>
                </h2>

            </ul>
        </div>
    </section>
</main>


<?php include('user/partials/footer.php'); ?>