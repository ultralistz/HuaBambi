<header class="header" id="header">
    <nav class="nav container">
        <img class="nav__img" src="<?php echo IMGURL_USER; ?>logo.png">

        <div class="nav__menu" id="nav-menu">
            <ul class="nav__list">
                <li class="nav__item">
                    <a href="<?php echo SITEURL ?>#home" class="nav__link">首頁</a>
                </li>

                <li class="nav__item">
                    <a href="<?php echo SITEURL ?>#services" class="nav__link">承諾</a>
                </li>

                <li class="nav__item">
                    <a href="<?php echo SITEURL ?>#featured" class="nav__link">精選</a>
                </li>

                <li class="nav__item">
                    <a href="<?php echo SITEURL ?>user/product.php" class="nav__link">全部商品</a>
                </li>

                <li class="nav__item">
                    <a href="<?php echo SITEURL ?>user/account.php" class="nav__link">我的帳戶</a>
                </li>

                <i class='bx bx-toggle-left change-theme' id="theme-button"></i>

                <a href="<?php echo SITEURL ?>user/cart.php" class="button__cart">
                    購物車 •
                    
                    <?php

                    if (isset($_SESSION['cart'])){
                        $cc_count = count($_SESSION['cart']);
                        echo "<span id=\"cart_count\">$cc_count</span>";
                    }
                    else
                    {
                        echo "<span id=\"cart_count\">0</span>";
                    }

                    ?>
                </a>
                
                <a href="#" onclick="toggleForm();" class="button">登入/註冊</a>
            </ul>
        </div>

        <div class="nav__toggle" id="nav-toggle">
            <i class='bx bx-grid-alt'></i>
        </div>

    </nav>
</header>