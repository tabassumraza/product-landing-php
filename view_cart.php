<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
</head>
<body>
<?php
    include "config.php";
    session_start();
    
?>
<?php
    if(!empty($_SESSION['cart'])){
        $mysql = "SELECT * FROM product where id IN (".implode(",",$_SESSION['cart']).")";
        $result = mysqli_query($conn,$mysql);
        $price = 0;
        $i = 0;
?>
    <section class="h-100" style="background-color: #eee;">
  <div class="container h-100 py-5">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-10">

        <div class="d-flex justify-content-between align-items-center mb-4">
          <h3 class="fw-normal mb-0 text-black">Shopping Cart</h3>
          <div>
            <p class="mb-0"><span class="text-muted">Sort by:</span> <a href="#!" class="text-body">price <i
                  class="fas fa-angle-down mt-1"></i></a></p>
          </div>
        </div>
<?php
    while($row = mysqli_fetch_assoc($result)){
        $images = explode(",",$row['pro_image']);
        $price += $row['pro_price'] * $_SESSION['qty1'][$i];
        echo print_r($_SESSION['qty1']);
?>
        <div class="card rounded-3 mb-4">
          <div class="card-body p-4">
            <div class="row d-flex justify-content-between align-items-center">
              <div class="col-md-2 col-lg-2 col-xl-2">
                <img
                  src="uploads/<?php echo $images[0]?>"
                  class="img-fluid rounded-3" alt="Cotton T-shirt">
              </div>
              <div class="col-md-3 col-lg-3 col-xl-3">
                <p class="lead fw-normal mb-2"><?php echo $row['pro_name']?></p>
                <p><span class="text-muted">Size: </span>M <span class="text-muted">Color: </span>Grey</p>
              </div>
              <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                <button class="btn btn-link px-2"
                  onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                  <i class="bi bi-dash fs-4"></i>
                </button>

                <input id="form1" min="0" name="quantity" value="<?php echo $_SESSION['qty1'][$i]?>" type="number"
                  class="form-control form-control-sm" />

                <button class="btn btn-link px-2"
                  onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                  <i class="bi bi-plus fs-4"></i>
                </button>
              </div>
              <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                <h5 class="mb-0">PKR <?php echo $row['pro_price'] * $_SESSION['qty1'][$i]?></h5>
              </div>
              <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                <a href="delete_item.php?id=<?php echo $row['id']?>" class="text-danger"><i class="bi bi-trash fs-4"></i></a>
              </div>
            </div>
          </div>
        </div>
<?php
    $i++;
    }

?>

        <div class="card">
          <div class="card-body">
            <button type="button" class="btn btn-light btn-block btn-lg float-end">PKR <?php echo $price?></button>
          </div>
        </div>

        <div class="card mb-4">
          <div class="card-body p-4 d-flex flex-row">
            <div class="form-outline flex-fill">
              <input type="text" id="form1" class="form-control form-control-lg" />
              <label class="form-label" for="form1">Discound code</label>
            </div>
            <button type="button" class="btn btn-outline-warning btn-lg ms-3">Apply</button>
          </div>
        </div>

        <div class="card">
          <div class="card-body">
            <button type="button" class="btn btn-warning btn-block btn-lg">Proceed to Pay</button>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>
<?php
    }
    else{
        ?>
        <div class="w-75 mx-auto mt-5">
        <h1 class="display-2 text-center mt-5">Cart is Empty</h1><br><br>
        <div class="w-100 text-center ">
        <a class="btn btn-outline-dark w-75 text-center" href="product.php">Continue Shopping</a>
        </div>
        </div>
        <?php
    }
?>
</body>
</html>