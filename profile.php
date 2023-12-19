<!-- connect file -->
<?php
include('../includes/connect.php');
include('../functions/common_function.php');
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome <?php echo $_SESSION['username'] ?></title>
    <!-- ICON BROWSER TAB -->
    <link rel="shortcut icon" type="x-icon" href="../images/LUGO.png">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../style.css">
    <style>
    body{
        overflow-x:hidden;
    }
    .profile_img{
    width: 90%;
    margin: auto;
    display: block;
    /* height: 100%; */
    object-fit: contain;
    }
    .edit_image{
        width:100px;
        height:100px;
        object-fit: contain;
    }

</style>
</head>
<body style="background-color: pink">
    <div class="container-fluid p-0">
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: pink";>
  <div class="container-fluid">
    <img src="../images/LOGOOO.png" alt="" class="logo">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../display_all.php">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="profile.php">My Account</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link" href="../cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item(); ?></sup></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Total Price: <?php total_cart_price()?>/-</a>
        </li>
      </ul>
      <form class="d-flex" role="search" action="../search_product.php" method="get">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data" autocomplete="off">
        <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product">
      </form>
    </div>
  </div>
</nav>

<!-- CALLING CART FUNCTION -->
<?php
cart();
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <ul class="navbar-nav me-auto">
        <?php
        if(!isset($_SESSION['username'])){
          echo "<li class='nav-item'>
          <a class='nav-link' href='#'>Welcome Guest</a>
        </li>";
        }else{
          echo "<li class='nav-item'>
          <a class='nav-link' href='#'>Welcome ".$_SESSION['username']." !</a>
        </li>";
        }

?>
    </ul>
</nav>

<div class="text-dark" style="background-color: pink">
<hr>

<div class="row mb-3">
    <div class="col-md-2">
        <ul class="navbar-nav bg-dark text-center" style="height:100vh">
        <li class="nav-item text-light bg-danger">
          <hr>
          <a class="nav-link" href="#"><h2>My Profile</h2></a>
          <hr>
        </li>

        <?php
$username=$_SESSION['username'];
$user_image="Select * from `user_table` where username='$username'";
$result_image=mysqli_query($con,$user_image);
$row_image=mysqli_fetch_array($result_image);
$user_image=$row_image['user_image'];
echo "<li class='nav-item text-light bg-dark'>
<img src='./user_images/$user_image' class='profile_img my-3 mb-1' alt=''>
</li>";

?>
        <hr class="text-light">
        <li class="nav-item text-light bg-dark">
          <a class="nav-link" href="profile.php?my_orders">My Orders</a>
        </li>
        <hr class="text-light">
        <li class="nav-item text-light bg-dark">
          <a class="nav-link" href="profile.php">Pending Orders</a>
        </li>
        <hr class="text-light">
        <li class="nav-item text-light bg-dark">
          <a class="nav-link" href="profile.php?edit_account">Edit Account</a>
        </li>
        <hr class="text-light">
        <li class="nav-item text-light bg-dark">
          <a class="nav-link" href="profile.php?delete_account">Delete Account</a>
        </li>
        <hr class="text-light">
        <li class="nav-item text-light bg-dark">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>
        <hr class="text-light">
        </ul>
        
    </div>
    <div class="col-md-10 text-center">
        <?php
get_user_order_details();
        if(isset($_GET['edit_account'])){
            include('edit_account.php');
        }
        if(isset($_GET['my_orders'])){
          include('user_orders.php');
        }
        if(isset($_GET['delete_account'])){
          include('delete_account.php');
        }
        ?>
    </div>
</div>


    <!-- INCLUDE FOOTER -->
    <?php
      include("../includes/footer.php") ?>
        </div>

    <script src="js/bootstrap.js"></script>
</body>
</html>