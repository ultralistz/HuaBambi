<?php 
    $title = '新增類別';
    include('partials/header.php');
    include('partials/menu.php');
?>


<!-- 主要區塊 -->

<div class="main-content">

    <div class="wrapper">

        <h1>新增類別</h1>

        <br><br>


        <?php

            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

        ?>


        <br><br>


        <!-- 新增類別表格開始 -->

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>標題：</td>
                    <td>
                        <input type="text" name="title" placeholder="類別標題">
                    </td>
                </tr>

                <tr>
                    <td>上傳圖片：</td>
                    <td>
                        <input type="file" name="image">
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
                    <td colsapn="2">
                        <input type="submit" name="submit" value="新增類別" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>


        <!-- 新增類別表格結束 -->


        <?php 

            //檢查提交按鈕是否點選
            if(isset($_POST['submit']))
            {
                //1.獲取表格中資料
                $title = $_POST['title'];

                //單選題是否已點選
                if(isset($_POST['featured']))
                {
                    //獲取表格資料
                    $featured = $_POST['featured'];
                }
                else
                {
                    $featured = "No";
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No";
                }


                //檢查圖片是否選取
                //print_r($_FILES['image']);

                //die();
                if(isset($_FILES['image']['name']))
                {
                    //上傳圖片
                    //上傳圖片需要 image name, 來源位址, 目的地位址
                    $image_name = $_FILES['image']['name'];

                    //當圖片被選取時才上傳圖片
                    if($image_name != "")
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
                            $_SESSION['upload'] = "<div class='error'>上傳圖片失敗.</div>";
                            header('location:'.SITEURL.'admin/add-category.php');
                            //若上傳失敗則取消流程(不上傳圖片置資料庫)
                            die();
                        }

                    }

                }
                else
                {
                    //不上傳圖片且將 image_name 設為 blank
                    $image_name="";
                }


                //2.創建 SQL 要求以將類別存入資料庫
                $sql = "INSERT INTO tbl_category SET
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                ";

                
                //3.執行要求並存入資料庫
                $res = mysqli_query($conn, $sql);


                //4.檢查要求與存入資料庫是否已執行
                if($res==true)
                {
                    //執行成功
                    $_SESSION['add'] = "<div class='success'>新增類別成功.</div>";
                    //重新導向
                    header("location:".SITEURL.'admin/manage-category.php');
                }
                else
                {
                    $_SESSION['add'] = "<div class='error'>新增類別失敗.</div>";
                    header("location:".SITEURL.'admin/add-category.php');
                }
            }

        ?>


    </div>
</div>


<?php include('partials/footer.php'); ?>