<?php 
    $title = '新增類別';
    include('partials/header.php');
    include('partials/menu.php');
?>


<!-- 主要區塊 -->

<div class="main-content">

    <div class="wrapper">

        <h1>新增食物</h1>

        <br><br>


        <?php
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>


        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">

                <tr>
                    <td>標題：</td>
                    <td>
                        <input type="text" name="title" placeholder="食物標題">
                    </td>
                </tr>

                <tr>
                    <td>描述：</td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="食物描述(換行於句尾輸入<br>)"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>價格：</td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>選擇圖片：</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>類別</td>
                    <td>
                        <select name="category">

                            <?php 
                            
                                //將資料庫中"類別"導入
                                //1. 將資料庫中"啟動中"的類別導入
                                $sql = "SELECT * FROM tbl_category WHERE active='是'";

                                $res = mysqli_query($conn, $sql);

                                $count = mysqli_num_rows($res);

                                if($count>0)
                                {

                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        //獲取類別資料
                                        $id = $row['id'];
                                        $title = $row['title'];

                                        ?>

                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                        <?php

                                    }

                                }
                                else
                                {
                                    ?>

                                    <option value="0">無類別</option>

                                    <?php
                                }

                                //2. 將拉顯示於下拉按鈕

                            ?>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td>精選：</td>
                    <td>
                        <input type="radio" name="featured" value="是"> 是
                        <input type="radio" name="featured" value="否"> 否
                    </td>
                </tr>

                <tr>
                    <td>啟動：</td>
                    <td>
                        <input type="radio" name="active" value="是"> 是
                        <input type="radio" name="active" value="否"> 否
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="新增食物" class="btn-secondary"> 
                    </td>
                </tr>

            </table>

        </form>


        <?php

            if(isset($_POST['submit']))
            {
                //1. 從表格獲取資料
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else
                {
                    $featured = "否";
                }
    
                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "否";
                }
    

                //2. 確認選擇圖片按鈕是否點選，若點選則上傳圖片
                if(isset($_FILES['image']['name']))
                {
                    $image_name = $_FILES['image']['name'];
                    
                    //若圖片選取成功(圖片名並非空值)
                    if($image_name!="")
                    {
                        $ext = end(explode('.',$image_name));
    
                        $image_name = "Food-Name-".rand(0000,9999).".".$ext;
    
                        $src = $_FILES['image']['tmp_name'];
    
                        $dst = IMGURL_ADMIN."food/".$image_name;
    
                        $upload = move_uploaded_file($src, $dst);
    
                        if($upload==false)
                        {
                            $_SESSION['upload'] = "<div class='error'>上傳圖片失敗</div>";
                            header('location:'.SITEURL.'admin/add-food.php');
    
                            die();
                        }
    
                    }
                }
                else
                {
                    $image_name = "";
                }
    
    
                //3. 將資料寫入資料庫
                $sql2 = "INSERT INTO tbl_food SET
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'
                ";
    
                $res2 = mysqli_query($conn, $sql2);
    
                if($res2==true)
                {
                    $_SESSION['add'] = "<div class='success'>新增食物成功</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else
                {
                    $_SESSION['add'] = "<div class='error'>新增食物失敗</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
            }
        

        ?>

    </div>

</div>


<?php include('partials/footer.php'); ?>