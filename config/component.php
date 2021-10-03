<?php


function component($productname, $productprice, $productimg, $productid){
    $imgurl = IMGURL_USER."food/";
    $element = "
    
    <div class=\"product__sub__container grid\">
        <form action=\"product.php\" method=\"post\">
            <div class=\"card__img\">
                <div class=\"img__box\">

                    <img src=\"$imgurl$productimg\" alt=\"Image1\" class=\"img-fluid card-img-top\">
                
                </div>

                <button type=\"submit\" name=\"button__cart__add\" class=\"button__cart__add\">加入購物車</button>
                <input type='hidden' name='product_id' value='$productid'>

            </div>

            <div class=\"card__text\">
                <div class=\"content__box\"> 

                    <d3>$productname</d3>

                    <h5>$productprice</h5>
                        
                </div>
            </div>
        </form>
    </div>
    ";
    echo $element;
}

?>