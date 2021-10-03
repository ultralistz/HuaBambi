<?php
$page_title = "商品";
include('../config/constants.php');

include('partials/header.php');
include('partials/user_login_check_menu.php');
include('../config/component.php')
?>


<?php
if(isset($_POST['button__cart__add']))
{
    ?><meta http-equiv='refresh' content='0.2'><?php

    if(isset($_SESSION['cart'])){

        $item_array_id = array_column($_SESSION['cart'], "product_id");

        if(in_array($_POST['product_id'], $item_array_id)){
            echo "<script>alert('Product is already added in the cart..!')</script>";
            echo "<script>window.location = 'product.php'</script>";
        }
        else
        {

            $cc_count = count($_SESSION['cart']);
            $item_array = array(
                'product_id' => $_POST['product_id']
            );

            $_SESSION['cart'][$cc_count] = $item_array;
        }

    }
    else
    {
        $item_array = array(
                'product_id' => $_POST['product_id']
        );

        // Create new session variable
        $_SESSION['cart'][0] = $item_array;
        print_r($_SESSION['cart']);
    }
}
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

                    component($product_title, $product_price, $product_image_name, $product_id);
                    
                }
            }
            ?>
        </div>
    </section>
</main>


<?php include('../user/partials/footer.php'); ?>