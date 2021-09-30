<?php 
$title = '編輯管理員';
include('partials/header.php');
include('partials/menu.php');
?>


<!-- 主要區塊 -->

<div class="main-content">
    <div class="wrapper">

        <h1>編輯管理員</h1>
        
        <br><br>


        <?php
        
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add']; //顯示 SESSION 訊息
                unset($_SESSION['add']); //移除 SESSION 訊息
            }

            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }

            if(isset($_SESSION['admin-not-found']))
            {
                echo $_SESSION['admin-not-found'];
                unset($_SESSION['admin-not-found']);
            }

            if(isset($_SESSION['pwd-not-match']))
            {
                echo $_SESSION['pwd-not-match'];
                unset($_SESSION['pwd-not-match']);
            }

            if(isset($_SESSION['change-pwd']))
            {
                echo $_SESSION['change-pwd'];
                unset($_SESSION['change-pwd']);
            }
        ?>

        <br><br><br>


        <!-- Button to Add Admin -->
        <a href="add-admin.php" class="btn-primary">新增管理員</a>

        <br><br><br>


        <table class="tbl-full">
            <tr>
                <th>編號</th>
                <th>全名</th>
                <th>使用者名稱</th>
                <th>動作</th>
            </tr>

            
            <?php
                //要求管理員資料
                $sql = "SELECT * FROM tbl_admin";
                //執行要求
                $res = mysqli_query($conn, $sql);

                //確認要求是否被執行
                if($res==TRUE)
                {
                    //計算 Rows 來確認資料庫中是否有資料
                    $count = mysqli_num_rows($res);

                    $sn = 1;//記數用

                    //確定有幾 Rows
                    if($count>0)
                    {
                        //資料庫中有資料
                        while($rows=mysqli_fetch_assoc($res))
                        {
                            //透過 while 取出資料庫中所有資料
                            $id=$rows['id'];
                            $full_name=$rows['full_name'];
                            $username=$rows['username']; 

                            //顯示資料
                            ?>


                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $full_name; ?></td>
                                <td><?php echo $username; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">更改密碼</a>
                                    <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">更新管理員</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">刪除管理員</a>
                                </td>
                            </tr>


                            <?php
                        }
                    }
                    else
                    {
                        //資料庫中無資料
                    }
                }
            ?>


        </table>


    </div>
</div>


<!-- Main Content Section Ends -->


<?php include('partials/footer.php'); ?>
