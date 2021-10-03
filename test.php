<?php

session_start();

if($_SESSION['total']=="")
{
    $_SESSION['total'] = 0;
}

?>

<a href="?add=car" class="button__cart__add">add car</a>
<a href="?add=box" class="button__cart__add">add box</a>
<a href="?add=none" class="button__cart__add">add box</a>

<?php





if($_SESSION['total']!="")
{
    if($_GET['add'] == 'car')
    {
        $_SESSION['total'] = $_SESSION['total'] + 2;
    }
    
    if($_GET['add'] == 'box')
    {
        $_SESSION['total'] = $_SESSION['total'] + 3;
    }
}


echo $_SESSION['total'];
?>