<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
    <?php
        include "config.php";
        $mysql = "SELECT * from category";
        $result = mysqli_query($conn,$mysql);

    ?>
    <form method="post" class="w-50 bg-dark p-3 mx-auto" enctype="multipart/form-data">
        <h1 class="text-light text-center mb-5">ADD A PRODUCT.</h1>
        <input type="text" placeholder="Enter product name" name="pname" class="form-control"><br>
        <input type="text" placeholder="Enter product Description" name="pdesc" class="form-control"><br>
        <input type="text" placeholder="Enter product price" name="price" class="form-control"><br>
        <input type="text" placeholder="Enter product Quantity" name="Quantity" class="form-control"><br>
        <input type="text" placeholder="Enter product Availability" name="Avail" class="form-control"><br>
        <select name="category" id="" class="form-select">
            <option value="0">Choose a category</option>
            <?php
                while($row = mysqli_fetch_assoc($result)){
            ?>
                <option value="<?php echo $row['id']?>"><?php echo $row['cat_name']?></option>
            <?php
                }  
            ?>
        </select><br>
        <input type="file" placeholder="Enter product name" name="files[]" multiple="multiple" class="form-control"><br>
        <br>
        <div class="text-center"><button name="submit" class="btn btn-warning w-50" >Submit</button></div>
    </form>
    <?php
        if(isset($_POST['submit'])){
            $uploaddir = "uploads/";
            for ($i=0; $i < count($_FILES['files']['tmp_name']) ; $i++) { 
                $fileupload = $uploaddir.basename($_FILES['files']['name'][$i]);
                $images[] = basename($_FILES['files']['name'][$i]);
                $filetype = strtolower(pathinfo($fileupload,PATHINFO_EXTENSION));
                if($filetype == 'jpg' || $filetype == "jpeg" || $filetype == "png" || $filetype == "jfif"){
                    if(move_uploaded_file($_FILES['files']['tmp_name'][$i],$fileupload)){
                    }
                }
            }
            $pro_images = implode(",",$images);
            print_r($pro_images);
            // echo $_POST['pname'];
            // $insert = "INSERT INTO `product`(`pro_name`, `pro_description`, `pro_cat`, `pro_availability`, `pro_qty`, `pro_price`, `pro_image`) VALUES ('$_POST['pname']','$_POST['pdesc']','$_POST['category']','$_POST['Avail']','$_POST['Quantity']','$_POST['price']','$pro_images')";
            // mysqli_query($conn,$insert);
            $pname = $_POST['pname'];
            $cat = $_POST['category'];
            $avail = $_POST['Avail'];
            $qty = $_POST['Quantity'];
            $price = $_POST['price'];
            $desc = $_POST['pdesc'];
            // echo $_POST['pname'];
            $insert = "INSERT INTO `product`(`pro_name`, `pro_description`, `pro_cat`, `pro_availability`, `pro_qty`, `pro_price`, `pro_image`) VALUES ('$pname','$desc','$cat','$avail','$qty','$price','$pro_images')";
            mysqli_query($conn,$insert);
            header("location:product.php");
        }

    ?>
</body>
</html>