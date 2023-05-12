<?php
    $i[] = "ali";
    $i[] = "adeen";
    $i[] = "arbaz";
    $i[] = "zaid";
    print_r($i);
    echo "<br>";
    $a = implode(",",$i);

    echo $a;

    $e = explode(",",$a);
    echo "<br>";
    print_r($e);




?>