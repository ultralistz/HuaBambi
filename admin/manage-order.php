<?php
$title = '管理訂單';
include('partials/header.php');
include('partials/menu.php');
?>


<!-- 主要區塊 -->

<div class="main-content">
    <div class="wrapper">
        
        <h1>管理訂單</h1>   

        <br><br>


        <table class="tbl-full">
            <tr>
                <th>編號</th>
                <th>全名</th>
                <th>使用者名稱</th>
                <th>動作</th>
            </tr>

            <tr>
                <td>1. </td>
                <td>古子暘</td>
                <td>ulta</td>
                <td>
                    <a href="#" class="btn-secondary">更新管理員</a>
                    <a href="#" class="btn-danger">刪除管理員</a>
                </td>
            </tr>

            <tr>
                <td>2. </td>
                <td>羅雅馨</td>
                <td>hsin</td>
                <td>
                <a href="#" class="btn-secondary">更新管理員</a>
                <a href="#" class="btn-danger">刪除管理員</a>
                </td>
            </tr>

            <tr>
                <td>3. </td>
                <td>羅雪華</td>
                <td>hua</td>
                <td>
                <a href="#" class="btn-secondary">更新管理員</a>
                <a href="#" class="btn-danger">刪除管理員</a>
                </td>
            </tr>
        </table>

    </div>
</div>


<?php include('partials/footer.php') ?>