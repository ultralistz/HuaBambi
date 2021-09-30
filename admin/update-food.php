<?php 
    $title = '更新食物';
    include('partials/header.php');
    include('partials/menu.php');
?>


<!-- 主要區塊 -->

<?php

    if(isset($_GET['id']))
    {
        $id = $_GET['id'];

        $sql2 = "SELECT * FROM tbl_food WHERE id=$id";

        $res2 = mysqli_query($conn, $sql2);

        $count2 = mysqli_num_rows($res2);

        if($count2==1)
        {
            $row2 = mysqli_fetch_assoc($res2);

            $title = $row2['title'];
            $description = $row2['description'];
            $price = $row2['price'];
            $current_image = $row2['image_name'];
            $current_category = $row2['category_id'];
            $featured = $row2['featured'];
            $active = $row2['active'];
        }
        else
        {
            $_SESSION['no-food-found'] = "<div class='error'>食物無效</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
    }
    else
    {
        header('location:'.SITEURL.'admin/manage-food.php');
    }

?>


<div class="main-content">

    <div class="wrapper">

        <h1>更新食物</h1>

        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">

                <tr>
                    <td>標題：</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>描述：</td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo $description ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>價格：</td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>

                <tr>
                    <td>目前圖片：</td>
                    <td>
                        <?php
                            if($current_image == "")
                            {
                                echo "<div class='error'>無圖片</div>";
                            }
                            else
                            {
                                ?>

                                <img src="<?php echo SITEURL.IMGURL_USER; ?>food/<?php echo $current_image; ?>" width="200px">

                                <?php
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>更新圖片</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>類別：</td>
                    <td>
                        <select name="category">

                            <?php
                            
                                $sql = "SELECT * FROM tbl_category WHERE active='是'";
                            
                                $res = mysqli_query($conn, $sql);

                                $count = mysqli_num_rows($res);

                                if($count>0)
                                {
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        $category_title = $row['title'];
                                        $category_id = $row['id'];

                                        ?>

                                        <option <?php if($current_category==$category_id) {echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>

                                        <?php
                                    }
                                }
                                else
                                {
                                    echo "<option value='0'>無類別</option>";
                                }

                            ?>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td>精選：</td>
                    <td>
                        <input <?php if($featured=="是") {echo "checked";} ?> type="radio" name="featured" value="是"> 是
                        <input <?php if($featured=="否") {echo "checked";} ?> type="radio" name="featured" value="否"> 否
                    </td>
                </tr>

                <tr>
                    <td>啟動：</td>
                    <td>
                        <input <?php if($active=="是") {echo "checked";} ?> type="radio" name="active" value="是"> 是
                        <input <?php if($active=="否") {echo "checked";} ?> type="radio" name="active" value="否"> 否
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">

                        <input type="submit" name="submit" value="更新食物" class="btn-secondary">
                    </td>
                </tr>

            </table>
    
        </form>


        <?php

            if(isset($_POST['submit']))
            {
                $id = $_POST['id'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $current_image = $_POST['current_image'];
                $category = $_POST['category'];

                $featured = $_POST['featured'];
                $active = $_POST['active'];


                //若有選取照片則上傳

                //檢查上傳按鈕是否點選
                if(isset($_FILES['image']['name']))
                {
                    $image_name = $_FILES['image']['name'];

                    //檢查檔案是否可用
                    if($image_name !="")
                    {
                        $tmp = explode('.', $image_name);
                        $ext = end($tmp);

                        $image_name = "Food-Name-".rand(0000, 9999).'.'.$ext;

                        $src_path = $_FILES['image']['tmp_name'];
                        $dest_path = IMGURL_ADMIN."food/".$image_name;

                        $upload = move_uploaded_file($src_path, $dest_path);

                        if($upload==false)
                        {
                            $_SESSION['upload'] = "<div class='error'>圖片上傳失敗</div>";
                            header('location:'.SITEURL.'admin/manage-food.php');

                            die();
                        }

                        if($current_image!="")
                        {
                            $remove_path = IMGURL_ADMIN."food/".$current_image;
                            $remove = unlink($remove_path);

                            if($remove==false)
                            {
                                $_SESSION['remove-failed'] = "<div class='error'>刪除圖片失敗</div>";
                                header('location:'.SITEURL.'admin/manage-food.php');

                                die();
                            }
                        }
                    }
                    else
                    {
                        $image_name = $current_image;
                    }
                }
                else
                {
                    $image_name = $current_image;
                }


                //更新至資料庫
                $sql3 = "UPDATE tbl_food SET
                    title = '$title',
                    description = '$description',
                    price = '$price',
                    image_name = '$image_name',
                    category_id = '$category',
                    featured = '$featured',
                    active = '$active'
                    WHERE id=$id
                ";

                $res3 = mysqli_query($conn, $sql3);

                if($res3==true)
                {
                    $_SESSION['update'] = "<div class='success'>食物更新成功</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else
                {
                    $_SESSION['update'] = "<div class='error'>食物更新失敗</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
            }


        ?>


    </div>

</div>


<?php include('partials/footer.php'); ?>