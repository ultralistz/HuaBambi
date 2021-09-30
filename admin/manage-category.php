<?php
$title = '編輯類別';
include('partials/header.php');
include('partials/menu.php');
?>


<!-- 主要區塊 -->

<div class="main-content">
    <div class="wrapper">
        
        <h1>編輯類別</h1>   

        <br><br>


        <?php

            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['remove']))
            {
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }

            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if(isset($_SESSION['no-category-found']))
            {
                echo $_SESSION['no-category-found'];
                unset($_SESSION['no-category-found']);
            }

            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

            if(isset($_SESSION['failed-remove']))
            {
                echo $_SESSION['failed-remove'];
                unset($_SESSION['failed-remove']);
            }

        ?>

        <br><br><br>


        <!-- 新增類別 -->
        <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">新增類別</a>

        <br><br><br>


        <table class="tbl-full">
            <tr>
                <th>編號</th>
                <th>標題</th>
                <th>圖片</th>
                <th>精選</th>
                <th>啟動</th>
                <th>動作</th>
            </tr>


            <?php 
            
                $sql = "SELECT * FROM tbl_category";

                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                $sn=1;

                if($count>0)
                {
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];

                        ?>


                            <tr>
                                <td><?php echo $sn++; ?> </td>
                                <td><?php echo $title; ?></td>

                                <td>

                                    <?php

                                        //檢查圖片是否可用
                                        if($image_name!="")
                                        {
                                            ?>

                                                <img src="<?php echo SITEURL.IMGURL_USER; ?>category/<?php echo $image_name; ?>" width="200px">

                                            <?php
                                        }
                                        else
                                        {
                                            echo "<div class='error'>無圖片.</div>";
                                        }

                                    ?>

                                </td>

                                <td><?php echo $featured ?></td>
                                <td><?php echo $active ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">更改類別</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">刪除類別</a>
                                </td>
                            </tr>


                        <?php
                    }
                }
                else
                {
                    ?>

                    <tr>
                        <td colspan="6"><div class="error">目前尚無類別.</div></td>
                    </tr>

                    <?php
                }

            ?>


        </table>

    </div>
</div>


<?php include('partials/footer.php') ?>