<?php
    session_start();
    $id = $_GET['id'];
    $key = array_search($id,$_SESSION['cart']);
    unset($_SESSION['cart'][$key]);
    unset($_SESSION['qty1'][$key]);
    
    header("location:view_cart.php");

?>