<?php 
    $title = '更新類別';
    include('partials/header.php');
    include('partials/menu.php');
?>


<!-- 主要區塊 -->

<div class="main-content">
    <div class="wrapper">

        <h1>更新類別</h1>

        <br><br>


        <?php
        
            //檢查 ID 是否導入成功
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];

                $sql = "SELECT * FROM tbl_category WHERE id=$id";

                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    //獲取資料
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }
                else
                {
                    $_SESSION['no-category-found'] = "<div class='error'>類別無效</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            }
            else
            {
                header('location:'.SITEURL.'admin/manage-category.php');
            }

        ?>


        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">

                <tr>
                    <td>標題：</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>目前圖片：</td>
                    <td>
                        <?php
                        
                            if($current_image != "")
                            {
                                ?>

                                <img src="<?php echo SITEURL.IMGURL_USER; ?>category/<?php echo $current_image; ?>" width="200">

                                <?php
                            }
                            else
                            {
                                echo "<div class='error'>無圖片</div>";
                            }

                        ?>
                    </td>
                </tr>

                <tr>
                    <td>更新圖片：</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>精選：</td>
                    <td>
                        <input <?php if($featured=="是"){echo "checked";} ?> type="radio" name="featured" value="是"> 是

                        <input <?php if($featured=="否"){echo "checked";} ?> type="radio" name="featured" value="否"> 否
                    </td>
                </tr>

                <tr>
                    <td>啟動：</td>
                    <td>
                        <input <?php if($active=="是"){echo "checked";} ?> type="radio" name="active" value="是"> 是

                        <input <?php if($active=="否"){echo "checked";} ?> type="radio" name="active" value="否"> 否
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="更新類別" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        <?php

            if(isset($_POST['submit']))
            {
                //1. 獲取所有表格中資料
                $id = $_POST['id'];
                $title = $_POST['title'];
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                //2. 若有選取，更新圖片
                if(isset($_FILES['image']['name']))
                {
                    //獲取圖片資料
                    $image_name = $_FILES['image']['name'];

                    //檢查圖片是否可用
                    if($image_name !="")
                    {
                        //自動重新命名圖片
                        //取得檔案格式
                        $ext = end(explode('.', $image_name));

                        //重新命名
                        $image_name = "Food_Category_".rand(000, 999).'.'.$ext;

                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = IMGURL_ADMIN."category/".$image_name;

                        //最終上傳圖片
                        $upload = move_uploaded_file($source_path, $destination_path);

                        //檢查是否上傳失敗
                        if($upload==false)
                        {
                            $_SESSION['upload'] = "<div class='error'>上傳圖片失敗</div>";
                            header('location:'.SITEURL.'admin/manage-category.php');
                            //若上傳失敗則取消流程(不上傳圖片置資料庫)
                            die();
                        }

                        //刪除當前圖片
                        if($current_image!="")
                        {
                            $remove_path = IMGURL_ADMIN."category/".$current_image;
                            $remove = unlink($remove_path);
    
                            //檢查圖片是否刪除成功
                            //若刪除失敗則提示字並停止程序
                            if($remove==false)
                            {
                                $_SESSION['failed-remove'] = "<div class='error'>刪除圖片失敗</div>";
                                header('location:'.SITEURL.'admin/manage-category.php');

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


                //3. 更新至資料庫
                $sql2 = "UPDATE tbl_category SET
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active' 
                    WHERE id=$id
                ";

                $res2 = mysqli_query($conn, $sql2);

                //4. 重新導向
                if($res2==true)
                {
                    $_SESSION['update'] = "<div class='success'>類別更新成功</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    $_SESSION['update'] = "<div class='error'>類別更新失敗</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            }

        ?>

    </div>

</div>


<?php include('partials/footer.php') ?>