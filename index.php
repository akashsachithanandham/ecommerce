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


        <div class="form-row">
<div class="col-md-2" style="margin-left: 25px; margin-right: 25px;">
<div class="bs-example">
    <div class="accordion" id="accordionExample">
        <div class="card">
            <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                    <button type="button" id = "profile1" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"><em class="fa fa-plus"></em> Categories</button>                  
                </h2>
            </div>
            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                   <?php getCats(); ?>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingTwo">
                <h2 class="mb-0">
                    <button type="button"  id="resume1" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo"><em class="fa fa-plus"></em> Brands</button>
                </h2>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                     <?php getBrands(); ?>

                </div>
            </div>
        </div>
        
        
         
    
</div></div></div>

  <div class="col-md-8 col-sm-12 bg-info" style="margin-bottom: 50px;">
        
        <div>
            
            <div>
                <div class="bg-danger" style="height: 50px; width: 100%;">
                    <?php cart(); ?>
                    <span style="float: right;
                    font-size: 18px; padding: 5px;line-height: 40px;">
                        <?php
                        if(!isset($_SESSION['customer_email']))
                            echo "Welcome guest!   ";
                        else
                            echo "Welcome ".$_SESSION['customer_email'];
                         ?>
                        

                        <?php
                            if(!isset($_SESSION['customer_email'])){

                                echo "<a style='color: orange;margin-left:15px;' href='checkout.php'>Login</a>";
                            }
                            else{
                                echo "<a style='color: orange;margin-left:15px;' href='logout.php'>Logout</a>";
                            }
                        ?>
                    </span>
                </div>
                <div class="products_box">
                    <?php getPro(); ?>
                </div>

            </div>
        </div>
        
        </div>
    </div></div></div></div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>