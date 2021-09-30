<?php 
    $title = '新增管理員';
    include('partials/header.php');
    include('partials/menu.php');
?>


<!-- 主要區塊 -->

<div class="main-content">

    <div class="wrapper">

        <h1>新增管理員</h1>

        <br><br>


        <?php

            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

        ?>
    
    
        <form action="" method="POST">

            <table>
                <tr>
                    <td>本名：</td>
                    <td><input type="text" name="full_name" placeholder="請輸入你的本名"></td>
                </tr>

                <tr>
                    <td>使用者名稱：</td>
                    <td><input type="text" name="username" placeholder="請輸入你的使用者名稱"></td>
                </tr>

                <tr>
                    <td>密碼：</td>
                    <td>
                        <input type="password" name="password" placeholder="請輸入你的密碼">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="新增管理員" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>


<?php

//檢查是否按下新增管理員

if(isset($_POST['submit']))
{
    //1. 從填入格獲取資料
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);  //密碼加密透過MD5


    //2. SQL 要求資料存入資料庫(左資料庫右form)
    $sql = "INSERT INTO tbl_admin SET
        full_name='$full_name',
        username='$username',
        password='$password'
    ";

    
    //3. 執行詢問並將資料存入資料庫
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));


    //4. 確定資料是否成功輸入資料庫並顯示提示訊息
    if($res==TRUE)
    {
        //echo "新增成功";
        //Create a Session Variable to Display Message
        $_SESSION['add'] = "<div class='success'>新建管理員成功</div>";

        //重新導向至 Manage Admin
        header("location:".SITEURL.'admin/manage-admin.php');
    }
    else
    {
        //echo "新增成功";
        //Create a Session Variable to Display Message
        $_SESSION['add'] = "<div class='error'>新建管理員失敗</div>";

        //重新導向至 Add Admin
        header("location:".SITEURL.'admin/add-admin.php');
    }
}


?>