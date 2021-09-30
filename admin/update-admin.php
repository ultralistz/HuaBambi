<?php 
    $title = '更新管理員';
    include('partials/header.php');
    include('partials/menu.php');
?>


<!-- 主要區塊 -->

<div class="main-content">
    <div class="wrapper">

        <h1>更新管理員</h1>

        <br><br>
        

        <?php
            //獲取選取之管理員的ID
            $id=$_GET['id'];

            //創造SQL要求來獲取細節
            $sql="SELECT * FROM tbl_admin WHERE id=$id";

            //執行要求
            $res=mysqli_query($conn, $sql);

            //確定要求是否已被執行
            if($res==true)
            {
                //確認資料是否可被使用
                $count = mysqli_num_rows($res);
                //確定是否擁有管理員資料
                if($count==1)
                {
                    //獲取資料
                    //echo "管理員可用";
                    $row = mysqli_fetch_assoc($res);

                    $full_name = $row['full_name'];
                    $username = $row['username'];
                }
                else
                {
                    //重新導向至編輯管理員葉面
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">

                <tr>
                    <td>全名</td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>


                <tr>
                    <td>使用者名稱</td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="更新管理員" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
    </div>
    
</div>


<?php

    //確認提交按鈕是否被點選
    if(isset($_POST['submit']))
    {
        //echo "已更新";
        //獲取表格中填寫之資料以更新
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        //創建SQL要求以更新資料庫(左邊為資料庫資料，右邊為表單中數值)
        $sql = "UPDATE tbl_admin SET
        full_name = '$full_name',
        username = '$username' 
        WHERE id='$id'
        ";

        //執行要求
        $res = mysqli_query($conn, $sql);

        //檢查要求是否被執行
        if($res==true)
        {
            //要求被執行且管理員已更新
            $_SESSION['update'] = "<div clas='success'>管理員已更新.</div>";
            //重新導向至編輯管理員
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
        else
        {
            //要求執行失敗
            $_SESSION['update'] = "<div clas='success'>管理員更新失敗.</div>";
            //重新導向至編輯管理員
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }

?>


<!-- Main Content Section Ends -->


<?php include('partials/footer.php'); ?>
