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

        <div class="container">

  <div class="col-md-12 bg-info" style="margin-bottom: 50px; padding-bottom: 20px;">
        
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
            
                <?php
                global $con;
                $ip = getIp();
                if(isset($_POST['update_cart'])){
                    /*Way 1 to do */
                    //foreach (array_combine($_POST['product_id'], $_POST['qty']) as $pro_id => $qty) {
                    /*Way 2 to do */
                    for($i =0; $i< sizeof($_POST['product_id']); $i++){
                        $pro_id = $_POST['product_id'][$i];
                        $qty = $_POST['qty'][$i];
                        if($qty > 0) {
                            $update_qty = "update cart set qty='$qty' where p_id='$pro_id' AND ip_add='$ip'";
                            $run_qty = mysqli_query($con, $update_qty);
                        }
                    }
                    if(isset($_POST['remove'])) {
                        foreach ($_POST['remove'] as $remove_id) {
                            $del_pro = "delete from cart where p_id='$remove_id' AND ip_add='$ip'";
                            $run_del = mysqli_query($con, $del_pro);
                        }
                    }
                    header('location: '.$_SERVER['PHP_SELF']);
                }
                if(isset($_POST['continue'])){
                   header("location: index.php");
                }
                ?>
                <div class="shopping_cart">
                    <?php cart(); ?>
                    <span style="float: right;
                    font-size: 18px; padding: 5px;line-height: 40px;">
                        <?php
                        if(!isset($_SESSION['customer_email']))
                            echo "Welcome guest!";
                        else
                            echo "Welcome ".$_SESSION['customer_email'];
                        ?>
                        
                        
                        <a style="color: yellow" href="index.php">Back to Shop</a>
                        <?php
                        if(!isset($_SESSION['customer_email'])){
                            echo "<a style='color: orange;' href='checkout.php'>Login</a>";
                        }
                        else{
                            echo "<a style='color: orange;' href='logout.php'>Logout</a>";
                        }
                        ?>
                    </span>

                </div>
                <div class="products_box">
                    <br>
                    <form action="" method="post" enctype="multipart/form-data">
                        <table align="center" width="700px" bgcolor="#87ceeb" style="margin-right: auto; margin-left:152px;margin-bottom:15px;">
                            <tr align="center">
                                <th> Remove </th>
                                <th> Product(s) </th>
                                <th> Quantity </th>
                                <th> Unit Price </th>
                                <th> Items Total </th>
                            </tr>
                            <?php
                                $ip = getIp();
                                $total = 0;
                                $sel_price = "select * from cart where ip_add = '$ip'";
                                $run_price = mysqli_query($con,$sel_price);
                                while($cart_row = mysqli_fetch_array($run_price)){
                                    $pro_id = $cart_row['p_id'];
                                    $pro_qty = $cart_row['qty'];
                                    $pro_price = "select * from products where pro_id = '$pro_id'";
                                    $run_pro_price = mysqli_query($con, $pro_price);
                                    while ($pro_row = mysqli_fetch_array($run_pro_price)){
                                        $pro_title = $pro_row['pro_title'];
                                        $pro_image = $pro_row['pro_image'];
                                        $pro_price = $pro_row['pro_price'];
                                        $pro_price_all_items = $pro_price * $pro_qty;
                                        $total += $pro_price_all_items;
                                        ?>
                                        <tr align="center">
                                            <td><input type="checkbox" name="remove[]"
                                                       value="<?php echo $pro_id; ?>"></td>
                                            <td><?php echo $pro_title; ?> <br>
                                                <img src="admin/product_images/<?php echo $pro_image; ?>"
                                                     width="60" height="60">
                                            </td>
                                            <td><input size="2" name="qty[]" value="<?php echo $pro_qty;?>">
                                                <input name="product_id[]" type="hidden" value="<?php echo $pro_id;?>">
                                            </td>
                                            <td><?php echo "Rs " . $pro_price . "/-"; ?></td>
                                            <td><?php echo "Rs " . $pro_price_all_items . "/-"; ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                            ?>

                            <tr align="right">
                                <td colspan="4"><b>Sub Total:</b></td>
                                <td><?php echo "Rs ".$total."/-"; ?></td>
                            </tr>
                            <tr align="center">
                                <td colspan="2"><input type="submit" name="update_cart" value="Update Cart"></td>
                                <td><input type="submit" name="continue" value="Continue Shopping"></td>
                                <td><button>
                                        <a style="text-decoration: none;
                                            color: black;" href="checkout.php">
                                            Checkout</a>
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </form>
                

            </div>
        </div>
        
    </div>
</body>
</html>