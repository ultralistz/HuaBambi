<?php

$page_title = "商品";
include('../config/constants.php');

include('partials/header.php');
include('partials/user_login_check_menu.php');

?>

<!-- =============== 主區塊 =============== -->
<main class="main main__BG">
    <!--=============== 全部商品 ===============-->
    <?php

    $sql = "SELECT * FROM tbl_food WHERE active='是'";
    $res = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($res);

    ?>


    <section class="product section container" id="product">
        <div class="product__container grid">

            <h2 class="section__title-center">全部商品</h2>

        </div>
        

        <div class="product__container grid">
            <div class="product__buttons">

                <a href="<?php echo SITEURL ?>user/product.php?id=0" class="button__category">全部商品</a>
                <a href="<?php echo SITEURL ?>user/product.php?id=1" class="button__category">瑪德蓮</a>
                <a href="<?php echo SITEURL ?>user/product.php?id=2" class="button__category">雪Q餅</a>

                <br>

            </div>
        </div>


        <?php
        $category_id = $_GET['id'];
        ?>


        <div class="product__container grid">
            <?php
            if($count>0)
            {
                while($row=mysqli_fetch_assoc($res))
                {
                    $product_id = $row['id'];
                    $product_title = $row['title'];
                    $product_image_name = $row['image_name'];
                    $product_price = $row['price'];
                    $product_description = $row['description'];
                    $product_category = $row['category_id'];


                    switch($category_id)
                    {
                        //===============全部商品===============
                        case 0:
                            ?>

                            <div class="product__sub__container grid">
                                <div class="card__img">
                                    <div class="img__box">

                                        <img src="<?php echo IMGURL_USER; ?>food/<?php echo $product_image_name; ?>" class="services__img">     
                                        
                                    </div>
                                </div>   

                                <div class="card__text">
                                    <div class="content__box">
                                        <d3><?php echo $product_title ?></d3>
                                        <br>
                                        <h5><?php echo "每盒：".$product_price." NTD"; ?></h5>
                                        <br>
                                        <a href="<?php echo SITEURL; ?>user/login.php" class="button__cart__add">加入購物車</a>

                                    </div>
                                </div>
                            </div>
                            <?php
                            break;


                        //===============瑪德蓮===============
                        case 1:
                            ?>

                            <div class="product__sub__container grid">
                                <?php
                                if($product_category==1)
                                {
                                ?>

                                    <div class="card__img">
                                        <div class="img__box">

                                            <img src="<?php echo IMGURL_USER; ?>food/<?php echo $product_image_name; ?>" class="services__img">     
                                            
                                        </div>
                                    </div>   

                                    <div class="card__text">
                                        <div class="content__box">
                                            <d3><?php echo $product_title ?></d3>
                                            <br>
                                            <h5><?php echo "每盒：".$product_price." NTD"; ?></h5>
                                            <br>
                                            <a href="<?php echo SITEURL; ?>user/login.php" class="button__cart__add">加入購物車</a>
                                            
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                            <?php
                            break;


                        //===============雪Q餅===============
                        case 2:
                            ?>

                            <div class="product__sub__container grid">
                                <?php
                                if($product_category==2)
                                {
                                ?>

                                    <div class="card__img">
                                        <div class="img__box">

                                            <img src="<?php echo IMGURL_USER; ?>food/<?php echo $product_image_name; ?>" class="services__img">     
                                            
                                        </div>
                                    </div>   

                                    <div class="card__text">
                                        <div class="content__box">
                                            <d3><?php echo $product_title ?></d3>
                                            <br>
                                            <h5><?php echo "每盒：".$product_price." NTD"; ?></h5>
                                            <br>
                                            <a href="<?php echo SITEURL; ?>user/login.php" class="button__cart__add">加入購物車</a>
                                            
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                            <?php
                            break;
                    }
                }
            }
            ?>
        </div>
    </section>
</main>


<?php include('../user/partials/footer.php'); ?>