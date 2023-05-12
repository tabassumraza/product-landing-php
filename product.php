<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
</head>
<body>
<?php
    include "config.php";
    session_start();
    $mysql = "SELECT * from product";
    $result = mysqli_query($conn,$mysql);
    if(!isset($_SESSION['cart'])){
        $_SESSION['cart'] = array();
    }
    if(!isset($_SESSION['qty1'])){
        $_SESSION['qty1'] = array();
    }
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Features</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href='clear_cart.php'>Clear Cart</a>
        </li>
        <li class="nav-item float-end">
          <a class="nav-link " href="view_cart.php" tabindex="-1" aria-disabled="true"><i class="bi bi-bag-dash fs-4"></i><?php echo count($_SESSION['cart'])?></a>
        </li>
      </ul>
    </div>
  </div>
</nav>
    <div class="container">
        <div class="row">
        <?php
            while($row = mysqli_fetch_assoc($result)){
                $arr = explode(",",$row['pro_image']);
        ?>
            <div class="col-lg-4 mt-4">
            <div class="card" style="width: 18rem;">
            <a href="detail.php?id=<?php echo $row['id']?>">
            <img src="uploads/<?php echo $arr[0]?>" class="card-img-top" alt="...">
          </a>
            <div class="card-body">
                <h5 class="card-title"><?php echo $row["pro_name"] ?></h5>
                <p class="card-text"><?php echo $row["pro_description"] ?></p>
                <p class="card-text"><?php echo $row["pro_availability"] ?></p>
                <p class="card-text">PKR <?php echo $row["pro_price"] ?></p>
                
                <a href="detail.php?id=<?php echo $row['id']?>" class="btn btn-primary">Quick view</a>
                <a href="add_cart.php?id=<?php echo $row['id']?>" class="btn btn-primary">Add to Cart</a>
            </div>
            </div>
            </div>
        <?php
            }
        ?>
        </div>
    </div>
</body>
</html>