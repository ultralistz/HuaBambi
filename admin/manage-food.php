<?php
$title = '編輯食物';
include('partials/header.php');
include('partials/menu.php');
?>


<!-- 主要區塊 -->

<div class="main-content">
    <div class="wrapper">

        <h1>編輯食物</h1>   

        <br><br>


        <?php

            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

            if(isset($_SESSION['unauthorize']))
            {
                echo $_SESSION['unauthorize'];
                unset($_SESSION['unauthorize']);
            }

            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }

            if(isset($_SESSION['no-food-found']))
            {
                echo $_SESSION['no-food-found'];
                unset($_SESSION['no-food-found']);
            }
        ?>

        <br><br><br>


        <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">新增食物</a>

        <br><br><br>


        <table class="tbl-full">
            <tr>
                <th>編號</th>
                <th>標題</th>
                <th>價格</th>
                <th>圖片</th>
                <th>精選</th>
                <th>啟動</th>
                <th>動作</th>
            </tr>


            <?php
                $sql = "SELECT * FROM tbl_food";

                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                $sn=1;

                if($count>0)
                {
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];

                        ?>

                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $title; ?></td>
                                <td><?php echo $price; ?> NTD</td>

                                <td>
                                    <?php

                                        if($image_name=="")
                                        {
                                            echo "<div class='error'>無圖片</div>";
                                        }
                                        else
                                        {
                                            ?>

                                                <img src="<?php echo SITEURL.IMGURL_USER; ?>food/<?php echo $image_name; ?>" width="200px" >

                                            <?php
                                        }

                                    ?>
                                </td>

                                <td><?php echo $featured; ?></td>
                                <td><?php echo $active; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">更新食物</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">刪除食物</a>
                                </td>
                            </tr>

                        <?php
                    }
                }
                else
                {
                    echo "<tr> <td colspan='7' class='error'>無食物</td> </tr>";
                }
            ?>


        </table>

    </div>
</div>


<?php include('partials/footer.php'); ?>