<?php
    session_start();
    $id = $_GET['id'];
    $qty = $_POST['qty'];
    // echo $qty;
    if(!in_array($id,$_SESSION['cart'])){
        array_push($_SESSION['cart'],$id);
        if($qty < 1){
            array_push($_SESSION['qty1'],1);
        }
        else{
            array_push($_SESSION['qty1'],$qty);
        }
    }
    else{
        $key = array_search($id,$_SESSION['cart']);
        if($qty != 0){
            $_SESSION['qty1'][$key] = $qty;
        }
        else{
            $q = $_SESSION['qty1'][$key];
            $_SESSION['qty1'][$key] = ++$q;
        }
    }
    // for ($i=0; $i < count($_SESSION['cart']) ; $i++) { 
    //     echo $_SESSION['cart'][$i]. ":" .$_SESSION['qty1'][$i]."<br>";
    // }
    // echo print_r($_SESSION['qty1']);
    header("location:product.php");
?>