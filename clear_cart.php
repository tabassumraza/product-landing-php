<?php
    echo "<a href='product.php'>Products</a>";
    session_start();
    unset($_SESSION['cart']);
    unset($_SESSION['qty1']);

?>