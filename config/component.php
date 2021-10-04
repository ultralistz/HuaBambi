<?php


function component($productname, $productprice, $productimg, $productid)
{
    $siteurl = SITEURL;
    $imgurl = IMGURL_USER."food/";
    $element = "
    
    <div class=\"product__sub__container grid\">
        <form action=\"product.php\" method=\"post\">
            <div class=\"card__img\">
                <div class=\"img__box\">

                    <img src=\"$imgurl$productimg\" alt=\"Image1\">
                
                </div>

                <a href=\"$siteurl\\user\\product_each.php?id=$productid\" name=\"button__cart__search\" class=\"button__cart__search\"></a>
                <br>
                <button name=\"button__cart__add\" class=\"button__cart__add\"></button>  

                <input type='hidden' name='product_id' value='$productid'>

            </div>

            <div class=\"card__text\">
                <div class=\"content__box\"> 

                    <d3>• $productname •</d3>

                    <br>

                    <h5>$productprice NTD</h5>
                        
                </div>
            </div>
        </form>
    </div>
    ";
    echo $element;
}


function cartElement($productname, $productprice, $productimg, $productid)
{
    $siteurl = SITEURL;
    $imgurl = IMGURL_USER."food/";

    $element = "
    
    <form action=\"cart.php?action=remove&id=$productid\" method=\"post\" class=\"cart__page__content\">
            <div class=\"cart__page__content__inner\">
                <a href=\"$siteurl\\user\\product_each.php?id=$productid\" class=\"cart__page__content__inner__img\">
                    <img src=\"$imgurl$productimg\" alt=\"Image1\ class=\"cart__page__content__inner__img__center\">
                </a>

                <div class=\"cart__page__content__inner__mid\">
                    <br>
                    <h1 class=\"cart__title__sub\">$productname</h1>
                    <h3 class=\"cart__title__sub__opacity\">目前暫無優惠</h3>
                    <br>
                    <h5 class=\"cart__price__sub\">$productprice NTD</h5>
                    <br>
                    <button type=\"submit\" class=\"button__cart__remove\" name=\"remove\">移除商品</button>
                    <br>
                </div>
                
                <div class=\"cart__page__content__inner__right\">
                    <div class=\"cart__page__content__inner__right__center\">

                        <p class=\"cart__button__minus\"></p>
                        <input type=\"text\" name=\"product_qty\" class=\"cart__amount\" value=\"1\">
                        <input type=\"hidden\" name=\"product_title\" value=\"$productname\">
                        <p class=\"cart__button__add\"></p>
                        
                    </div>
                </div>

            </div>

    </form>
    
    ";

    echo $element;
}

//<button type=\"button\" name=\"product_qty_minus\" class=\"cart__button__minus\"></button>
//<button type=\"button\" name=\"product_qty_add\" class=\"cart__button__add\"></button>

?>