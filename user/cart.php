<?php
ob_start();

$page_title = "購物車";
include('../config/constants.php');

include('partials/header.php');
include('partials/user_login_check.php');
include('partials/user_login_check_menu.php');
include('../config/component.php');


if (isset($_POST['remove'])){
    if ($_GET['action'] == 'remove'){
        foreach ($_SESSION['cart'] as $key => $value){
            if($value["product_id"] == $_GET['id']){
                unset($_SESSION['cart'][$key]);
                echo "
                <script>
                Swal.fire
                (
                    '商品移除成功',
                    '',
                    'success'
                )
                </script>";
            }
        }
    }
}


if(isset($_SESSION['order__error__msg']))
{
    ?>
    <script>
        Swal.fire
            ({
                icon: 'error',
                title: '訂購失敗',
                text: '目前購物車為空',
            })
    </script>
    <?php
    unset($_SESSION['order__error__msg']);
}


$current_user_id = $_SESSION['user_login_id'];
$sql_current = "SELECT * FROM tbl_user WHERE user_id='$current_user_id'";
$res_current = mysqli_query($conn, $sql_current);

$rows_current = mysqli_fetch_assoc($res_current);

$current_user_full_name = $rows_current['user_full_name'];
$current_user_email = $rows_current['user_email'];


$sql = "SELECT * FROM tbl_food WHERE active='是'";
$res = mysqli_query($conn, $sql);

$count = mysqli_num_rows($res);

?>



<!-- =============== 主區塊 =============== -->
<main class="main main__BG">
    <!-- =============== 購物車 =============== -->
    <section class="service section container">

        <div class="cart__page__container">
            <ul class="menu__sub">

                <h2 class="cart__page__menu">
                    購物車 <br><br>
                    <div class="cart__page__menu__icon"></div>
                </h2>

            </ul>

            <div class="account__content">

                <div class="account__content__inner__title">
                    <?php echo $current_user_full_name ?>
                </div>

                <br> 

                <?php

                $total = 0;
                if (isset($_SESSION['cart'])){
                    $product_id = array_column($_SESSION['cart'], 'product_id');

                    while ($row = mysqli_fetch_assoc($res))
                    {
                        foreach ($product_id as $id)
                        {
                            if ($row['id'] == $id)
                            {
                                cartElement($row['title'],$row['price'], $row['image_name'], $row['id']);
                                $total = $total + (int)$row['price'];
                            }
                        }
                    }
                }
                else
                {
                    echo "<h5>購物車目前為空</h5>";
                }

                ?>

                
                <!-- =============== 價格細項 =============== -->
                <div>
                    <br>

                    <h6>價格細項</h6>

                    <hr>

                    <form action="" method="POST">
                        <div>
                            <?php
                            if (isset($_SESSION['cart']))
                            {
                                $count  = count($_SESSION['cart']);
                                echo "<h6>價格 ( $count 件商品 )</h6>";
                                ?><br><?php
                            }
                            else
                            {
                                echo "<h6>價格 ( 0 件物品 )</h6>";
                            }
                            ?>

                            <br>

                            <h6>商品總額</h6>

                            <hr>

                            <h6><?php echo $total ?> NTD</h6>
                            <br>

                            <h6>運費</h6>

                            <hr>
                            <?php
                            
                            if($total>=1000)
                            {
                                $delivery_fee = 0;
                            }
                            else
                            {
                                $delivery_fee = 60;
                            }

                            if($total==0)
                            {
                                $delivery_fee = 0;
                            }
                            else
                            {
                                $delivery_fee = 60;
                            }
                            
                            ?>
                            <h6><?php echo $delivery_fee ?> NTD</h6>
                            <br>
                        </div>

                        <div>
                            <h6>需付總額</h6>

                            <hr>

                            <h6>
                                <?php
                                $final_total = $total + $delivery_fee;
                                echo $final_total;
                                ?>
                                NTD
                            </h6>

                            <br>

                        </div>

                        <div class="cart__page__content__inner">
                            <div class="cart__page__content">
                                <input class="account__content__inner" type="text" name="user_contact" placeholder="<?php echo "聯絡電話" ?>">
                            </div>

                            <br>

                            <div class="cart__page__content">
                                <input class="account__content__inner" type="text" name="user_address" placeholder="<?php echo "收貨地址" ?>">
                            </div>
                        </div>


                    <input type="submit" class="button__cart__remove" name="submit_cart" value="確認訂單">

                    </form>
                </div>
            </div>
        </div>
    </section>
</main>


<?php

$DateAndTime = date('Y-m-d h:i:s a', time());

if(isset($_POST['submit_cart']))
{
    if($final_total!=0)
    {
        $final_title=$_POST['product_title'];
        $final_contact=$_POST['user_contact'];
        $final_address=$_POST['user_address'];
    
        $sql = "INSERT INTO tbl_order SET
            food='$final_title',
            total='$final_total',
            order_date='$DateAndTime',
            customer_name='$current_user_full_name',
            customer_email='$current_user_email',
            customer_contact='$final_contact',
            customer_address='$final_address'
        ";
        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    
        unset($_SESSION['cart']);
        $_SESSION['order__success__msg'] = "";
    
        header('location:'.SITEURL);
    }
    else
    {
        $_SESSION['order__error__msg'] = "";
        ?><meta http-equiv='refresh' content='0.2'><?php
    }
}


ob_end_flush();


?>


<?php include('../user/partials/footer.php') ?>