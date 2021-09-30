<?php

    include('../config/constants.php');

    //檢查 ID 與 image_name 是否導入成功
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //取得資料並刪除
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //若有照片的話刪除照片
        if($image_name != "")
        {
            //若照片非空值, 刪除照片
            $path = IMGURL_ADMIN."category/".$image_name;
            $remove = unlink($path);

            //若移除失敗, 顯示錯誤訊息並停止程序
            if($remove==false)
            {
                $_SESSION['remove'] = "<div class='error'>刪除照片失敗</div>";
                header('location:'.SITEURL.'admin/manage-category.php');

                die();
            }
        }

        //從資料庫中刪除資料
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        $res = mysqli_query($conn, $sql);

        if($res==true)
        {
            $_SESSION['delete'] = "<div class='success'>類別刪除成功</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            $_SESSION['delete'] = "<div class='error'>類別刪除失敗</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }

        //重新導向
    }
    else
    {
        //重新導向至編輯類別
        header('location:'.SITEURL.'admin/manage-category.php');
    }

?>