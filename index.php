<?php

$page_title = "首頁";
include('config/constants.php');

include('user/partials/header.php');
include('user/partials/user_login_check_menu.php');

?>


<!--=============== 提示字 ===============-->
<?php

//登入提示字
if(isset($_SESSION['login__success__msg']))
{
    ?>
    <script>
        Swal.fire
        (
            '登入成功',
            '歡迎回來!',
            'success'
        )
    </script>
    <?php
    unset($_SESSION['login__success__msg']);
}

if(isset($_SESSION['order__success__msg']))
{
    ?>
    <script>
        Swal.fire
        (
            '訂購成功',
            '謝謝您的支持!',
            'success'
        )
    </script>
    <?php
    unset($_SESSION['order__success__msg']);
}

?>


<!--=============== 主區塊 ===============-->
<main class="main main__BG">
<div class="home__banner">
            <img src="<?php echo IMGURL_USER ?>huabambi_banner.png"; width="100%">
        <div>
    <!--=============== 首頁 ===============-->
    <section class="home section" id="home">
        <div class="home__container container grid">


            <!-- 首頁左側標題 -->
            <div class="home__data">
                <h1 class="home__title">給您<br></h1>
                <h1 class="home__title__sub">用料單純，天然飽足的健康小點心</h3>
                    
                <br>

                <p class="home__description">
                    <img src="<?php echo IMGURL_USER; ?>check.png" width="12px">&nbsp法國 AOP 認證奶油 <br> 
                    <img src="<?php echo IMGURL_USER; ?>check.png" width="12px">&nbsp上白糖 <br>
                    <img src="<?php echo IMGURL_USER; ?>check.png" width="12px">&nbsp海藻糖 <br>
                    <img src="<?php echo IMGURL_USER; ?>check.png" width="12px">&nbsp日本麵粉 <br>
                    <img src="<?php echo IMGURL_USER; ?>check.png" width="12px">&nbsp履歷雞蛋
                </p>

                <a href="<?php echo SITEURL ?>user/product.php?id=0" class="button__start"><p>開始訂購</p></a>
            </div>   

            <img src="<?php echo IMGURL_USER; ?>home_pre_01.png" class="home__img">
        </div>
    </section>


    <!--=============== 我們的承諾 ===============-->
    <section class="services section container" id="services">

        <img src="<?php echo IMGURL_USER ?>title_gap_01.png">

        <br><br><br>

        <h2 class="section__title">我們的承諾</h2>

        <div class="services__container grid">
            <div class="services__data">
                <h3 class="services__subtitle">滿額免運</h3>

                <img src="<?php echo IMGURL_USER; ?>service_pre_01.png" class="services__img">

                <p class="services__description">
                    台灣地區滿1000免運
                </p>
            </div>

            <div class="services__data">
                <h3 class="services__subtitle">三日出貨</h3>

                <img src="<?php echo IMGURL_USER; ?>service_pre_02.png" class="services__img">

                <p class="services__description">
                    訂單完成後72小時內出貨
                </p>
            </div>

            <div class="services__data">
                <h3 class="services__subtitle">會員福利</h3>

                <img src="<?php echo IMGURL_USER; ?>/service_pre_03.png" class="services__img">

                <p class="services__description">
                    加入會員享有會員價
                </p>
            </div>

        </div>
    </section>


    <!--=============== 精選商品 ===============-->
    <?php

    $sql = "SELECT * FROM tbl_food WHERE active='是' AND featured='是'";
    $res = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($res);

    ?>


    <section class="services section container" id="featured">

        <img src="<?php echo IMGURL_USER ?>title_gap_01.png">

        <br><br><br>

        <h2 class="section__title">精選商品</h2>
        <div class="featured__container grid">

            <?php
            if($count>0)
            {
                while($row=mysqli_fetch_assoc($res))
                {
                    $featured_id = $row['id'];
                    $featured_title = $row['title'];
                    $featured_image_name = $row['image_name'];
                    $featured_price = $row['price'];
                    $featured_description = $row['description'];

                    ?>
        
                
                    <div class="card">
                        <div class="img__box">

                            <?php

                            if($featured_image_name=="")
                            {
                                echo "精選無圖片";
                            }
                            else
                            {
                                ?>
                                <img src="<?php echo IMGURL_USER; ?>food/<?php echo $featured_image_name; ?>" class="services__img">
                                <?php
                            }

                            ?>
                        </div>

                        <div class="content__box">

                            <div class="featured__content">
                                <h3><?php echo $featured_title ; ?></h3>
                                <br>
                                <h5><?php echo "每盒為：".$featured_price." NTD"; ?></h5>
                                <br>
                                <p><?php echo $featured_description; ?></p>
                            </div>

                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </section>
    

    <!--=============== 聯絡我們 ===============-->
    <section class="contact section container">
        <div class="contact__container grid">

            <div class="contact__content">
                <h2 class="section__title-center">聯絡我們 <br> 我們會盡快為您服務</h2>
                <p class="contact__description">若您有任何疑問或建議，歡迎留下您寶貴的意見；我們將盡速與您回覆，謝謝。</p>
            </div>

            <ul class="contact__content grid">
                <li class="contact__address">電話：<span class="contact__information">aaa - aaa - aaa</span></li>
                <li class="contact__address">信箱：<span class="contact__information">huabambi@gmail.com</span></li>
                <li class="contact__address">地址：<span class="contact__information">新竹縣 竹東鎮</span></li>
            </ul>

            <div class="contact__content">
                <a href="#" class="button">線上表單</a>
            </div>

        </div>
    </section>
</main>


<!-- =============== Footer =============== -->
<?php include('user/partials/footer.php'); ?>