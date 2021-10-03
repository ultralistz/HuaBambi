<?php

$page_title = "購物車";
include('../config/constants.php');

include('partials/header.php');
include('partials/user_login_check_menu.php');
include('../config/component.php');


$select_product_id=$_GET['id'];

$sql_select = "SELECT * FROM tbl_food WHERE id='$select_product_id'";
$res_select = mysqli_query($conn, $sql_select);

$rows_select = mysqli_fetch_assoc($res_select);

$select_product_title = $rows_select['title'];
$select_product_description = $rows_select['description'];
$select_product_price = $rows_select['price'];
$select_product_image_name = $rows_select['image_name'];

?>


<!-- =============== 主區塊 =============== -->
<main class="main main__BG">
    <!-- =============== 商品(獨立) =============== -->
    <section class="service section container">
        <h2 class="section__title"></h2>

        <br>

        <div class="cart__page__container">
            <ul class="menu__sub">

                <h2 class="cart__page__menu">
                    <?php echo $select_product_title ?> 
                    <br><br>
                    <div class="cart__page__menu__icon"></div>
                </h2>

            </ul>

            <div class="account__content">

                <form action="" method="POST" class="cart__page__content">
                    <div class="each__page__content__inner">
                        <div class="each__page__content__inner__img">
                            <img src="<?php echo IMGURL_USER; ?>food/<?php echo $select_product_image_name ?>" class="cart__page__content__inner__img__center">
                        </div>

                        <div class="each__page__content__inner__mid">
                            <br>
                            <h1 class="cart__title__sub"><?php echo $select_product_title ?></h1>
                            <br>
                            <h3 class="cart__title__sub__opacity"><?php echo $select_product_description ?></h3>
                            <br>
                            <h5 class="cart__price__sub"><?php echo $select_product_price ?> NTD</h5>
                            <br>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </section>
</main>


<?php include('../user/partials/footer.php') ?>