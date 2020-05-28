<!DOCTYPE html>
<?php
session_start();
require "functions/functions.php";
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Online Shop</title>
    <link rel="stylesheet" type="text/css" href="css/mystyle.css">
    <style>
        .main_wrapper {
            background-color: pink;
        }
        .cats a {
            color: orange;
            font-size: 16px;
        }
        .cats a:hover {
            color: white;
        }
    </style>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <style type="text/css">
        .hi{
            background-image: url("https://www.softwarecreatives.com/assets/images/ibg/in-img-5.jpg");
            background-repeat: no-repeat;
            height: 250px;
             background-size: auto;
             object-fit: fill;
             background-size: cover;                      /* <------ */
   
    background-position: center center; 

        }
    </style>
</head>
<body class="bg-dark">
    <div class="hi">
        <br><br><br><br>
    </div>
    
    <nav class="navbar navbar-expand-md navbar-light bg-warning">
  <!-- Brand -->
  <a class="navbar-brand" href="#">Online Shopping</a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>


  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="nav navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="cart.php">Cart</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="all_products.php">All Products</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="my_account.php">My Account</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="customer_register.php">Sign Up</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contact.php">Contact Us</a>
      </li>

    </ul>
    <div class="search-container">
    <form action="results.php">
      <input type="text" placeholder="Search.." name="search">
      <button type="submit"><i class="fa fa-search"></i></button>
    </form>
  </div>


</nav>
<br />
<br />
<br />

<div class="main_wrapper" style="margin-bottom: 50px;">
  
    
    <div class="row">
        <div id="sidebar" class="col-md-4">
            <div class="sidebar_title">My Account </div>
            <ul class="cats">
                <?php
                    $user = $_SESSION['customer_email'];
                    $get_img = "select * from customers where cust_email='$user'";
                    $run_img = mysqli_query($con, $get_img);
                    $row_img = mysqli_fetch_array($run_img);
                    $c_image = $row_img['cust_image'];
                    $c_name = $row_img['cust_name'];
                    echo "<img src='customer/customer_images/$c_image' width='150' height='150' 
                            style='border: 2px solid white;border-radius: 50%;'>"
                ?>
                <li><a href="my_account.php?my_orders">My Orders</a></li>
                <li><a href="my_account.php?edit_account">Edit Account</a></li>
                <li><a href="my_account.php?change_pass">Change Password</a></li>
                <li><a href="my_account.php?del_account">Delete Account</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
        <div class="col-md-8 bg-info">
        <div >
            <div class="shopping_cart">
                <?php cart(); ?>
                <span style="float: right;
                    font-size: 18px; padding: 5px;line-height: 40px;">
                    <?php
                        if(isset($_SESSION['customer_email'])){
                            echo "Welcome ".$_SESSION['customer_email'];
                            echo "<a style='color: orange;' href='logout.php'> Logout</a>";
                        } else {
                            header('location: index.php');
                        }
                    ?>
                    </span>
            </div>
            <div class="products_box ">
                <?php
                    if(!isset($_GET['my_orders'])) {
                        if (!isset($_GET['edit_account'])) {
                            if (!isset($_GET['change_pass'])) {
                                if (!isset($_GET['del_account'])) {
                                    echo "<h2 style='padding: 20px; margin-left:-75px;'> Welcome:  $c_name </h2>";
                                    echo "<b style='margin-left:-75px;'>you can see your orders' progress by clicking this <a href='my_account.php?my_orders'> link </a></b>";
                                }
                            }
                        }
                    }
                ?>
                <?php
                    if(isset($_GET['edit_account'])){
                        include ('edit_account.php');
                    }else
                    if(isset($_GET['change_pass'])){
                        include ('change_pass.php');
                    }else
                    if(isset($_GET['del_account'])){
                        include ('del_account.php');
                    }

                ?>


            </div>

        </div>
    </div>
    </div>
</div></div>
</body>
</html>