<?php

    include('../config/constants.php');


    if(isset($_GET['id']))
    {
        //1. 獲取 ID 與 圖片名稱
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //2. 若可行，移除圖片
        if($image_name != "")
        {
            $path = IMGURL_ADMIN."food/".$image_name;

            $remove = unlink($path);

            if($remove==false)
            {
                $_SESSION['upload'] = "<div class='error'>刪除照片失敗</div>";
                header('location:'.SITEURL.'admin/manage-food.php');

                die();
            }
        }

        //3. 將 食物 從資料庫中移除
        //4. 重新導向
        $sql = "DELETE FROM tbl_food WHERE id=$id";

        $res = mysqli_query($conn, $sql);

        if($res==true)
        {
            $_SESSION['delete'] = "<div class='success'>食物刪除成功</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else
        {
            $_SESSION['delete'] = "<div class='error'>食物刪除失敗</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }


    }
    else
    {
        $_SESSION['unauthorize'] = "<div class='error'>無許可</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }

?>

