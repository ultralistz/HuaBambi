<?php 
    $title = '更新密碼';
    include('partials/header.php');
    include('partials/menu.php');
?>


<!-- 主要區塊 -->

<div class="main-content">
    <div class="wrapper">

    <h1>更新密碼</h1>

    <br><br>

    
    <?php
        if(isset($_GET['id']))
        {
            $id=$_GET['id'];
        }
    ?>

    <form action="" method="POST">

        <table calss="tbl-30">
            <tr>
                <td>目前密碼：</td>
                <td>
                    <input type="password" name="current_password" placeholder="目前密碼">
                </td>
            </tr>

            <tr>
                <td>新密碼：</td>
                <td>
                    <input type="password" name="new_password" placeholder="新密碼">
                </td>
            </tr>

            <tr>
                <td>確認新密碼</td>
                <td>
                    <input type="password" name="confirm_password" placeholder="確認新密碼">
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" name="submit" value="更改密碼" class="btn-secondary">
                </td>
            </tr>
        </table>

    </form>

    </div>
</div>


<?php

    //確認提交按鈕是否點選
    if(isset($_POST['submit']))
    {
        //1. 獲取表格中資料
        $id=$_POST['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);

        //2. 確認當前管理員ID與密碼是否存在
        $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

        //執行要求
        $res = mysqli_query($conn, $sql);

        if($res==true)
        {
            $count=mysqli_num_rows($res);
            
            if($count==1)
            {
                if($new_password==$confirm_password)
                {
                    $sql2 = "UPDATE tbl_admin SET
                    password='$new_password'
                    WHERE id=$id
                    ";

                    $res2 = mysqli_query($conn, $sql2); 

                    if($res2==true)
                    {
                        $_SESSION['change-pwd'] = "<div class='success'>新密碼更新成功.</div>";

                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                    else
                    {
                        $_SESSION['change-pwd'] = "<div class='error'>密碼更新失敗.</div>";

                        header('location'.SITEURL.'admin/manage-admin.php');
                    }
                }
                else
                {
                    $_SESSION['pwd-not-match'] = "<div class='error'>新密碼與確認密碼並不相符</div>";
                    
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
            else
            {
                $_SESSION['admin-not-found'] = "<div class='error'>管理員不存在或密碼錯誤.</div>";

                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }

        //3. 確認新密碼與確認密碼是否相同
        
        //4. 執行更改密碼若以上都確認正確
    }

?>


<!-- Main Content Section Ends -->


<?php include('partials/footer.php'); ?>