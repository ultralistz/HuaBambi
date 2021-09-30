<?php

    include('../config/constants.php');


    //1. 獲取即將被刪除之管理員ID
    $id = $_GET['id'];


    //2. 提出 SQL 刪除管理員之要求
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    //執行要求
    $res = mysqli_query($conn, $sql);

    //檢查要求是否被成功執行
    if($res==true)
    {
        //echo "刪除成功";
        $_SESSION['delete'] = "<div class='success'>刪除管理員成功</div>";
        //重新導向至編輯管理員
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
        //echo "刪除失敗";
        $_SESSION['delete'] = "<div class='error'>刪除管理員失敗，請稍後再試</div>";
        //重新導向至編輯管理員
        header('location:'.SITEURL.'admin/manage-admin.php');
    }


    //3. 重新導向網頁與提示字

?>