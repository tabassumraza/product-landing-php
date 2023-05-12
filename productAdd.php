<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <form method="post" class="w-50 bg-light text-dark rounded mx-auto mt-5 p-3" enctype="multipart/form-data">
        <h1>Add a Product.</h1>
        <input type="text" name="name" class="form-control" placeholder="Enter product name"><br>
        <input type="text" name="desc" class="form-control" placeholder="Enter Description"><br>
        <input type="text" name="cat" class="form-control" placeholder="Enter Category"><br>
        <input type="text" name="avail" class="form-control" placeholder="Enter availability"><br>
        <input type="number" name="qty" class="form-control" placeholder="Enter quantity"><br>
        <input type="number" name="price" class="form-control" placeholder="Enter Price"><br>
        <input type="file" name="files[]" multiple="multiple" class="form-control" placeholder="Enter Image"><br>


        <button type="submit" name="submit" class="btn btn-info w-50 mx-auto">submit</button>
    </form>
    <?php
        include "config.php";
        if(isset($_POST["submit"])){
            $name = $_POST['name'];
            $desc = $conn -> real_escape_string($_POST['desc']);
            echo "$desc";
            $cat = $_POST['cat'];
            $avail = $_POST['avail'];
            $qty = $_POST['qty'];
            $price = $_POST['price'];
            
            $uploaddir = "images/";
            $filecount = count($_FILES['files']['tmp_name']);
            // echo $filecount;
            for ($i=0; $i < $filecount ; $i++) { 
                $uploadfile = $uploaddir.basename($_FILES['files']['name'][$i]);
                $images[] = basename($_FILES['files']['name'][$i]);
                $filetype = strtolower(pathinfo($uploadfile,PATHINFO_EXTENSION));
                echo $filetype;
                if($filetype == 'jpg' || $filetype == 'jpeg' || $filetype == 'jfif' || $filetype == 'gif' || $filetype == 'png'){
                    if(move_uploaded_file($_FILES['files']['tmp_name'][$i],$uploadfile)){
                        echo 'uploaded';
                    }
                    else{
                        echo "not uploaded";
                    }
                }    
            }
            $pro_image = implode(",",$images);
            $mysql = "INSERT into product(pro_name,pro_description,
            pro_cat,pro_availability,pro_price,pro_qty,pro_image)
             values ('$name','$desc','$cat','$avail','$price','$qty','$pro_image')";
            mysqli_query($conn,$mysql);
        }

?>
</body>
</html>