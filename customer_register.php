<!DOCTYPE html>
<?php
session_start();
require "functions/functions.php";
?>

<?php
if(isset($_POST['register'])){
    global $con;
    $ip = getIp();
    $c_name = $_POST['c_name'];
    $c_email = $_POST['c_email'];
    $c_pass = $_POST['c_pass'];
    $c_image = $_FILES['c_image']['name'];
    $c_image_tmp = $_FILES['c_image']['tmp_name'];
    $c_country = $_POST['c_country'];
    $c_city = $_POST['c_city'];
    $c_contact = $_POST['c_contact'];
    $c_address = $_POST['c_address'];

    move_uploaded_file($c_image_tmp,"customer/customer_images/$c_image");

    $insert_c = "insert into customers (cust_ip,cust_name,cust_email,cust_pass,cust_country,cust_city,cust_contact,cust_address,cust_image) 
                  values ('$ip','$c_name','$c_email','$c_pass','$c_country','$c_city','$c_contact','$c_address','$c_image')";
    $run_c = mysqli_query($con,$insert_c);
    $sel_cart = "select * from cart where ip_add='$ip'";
    $run_cart = mysqli_query($con,$sel_cart);
    $check_cart = mysqli_num_rows($run_cart);
    if($check_cart==0){
        $_SESSION['customer_email'] = $c_email;
        header('location: my_account.php');
    }
    else {
        $_SESSION['customer_email'] = $c_email;
        header('location: index.php');
    }
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Online Shop</title>
    <link rel="stylesheet" type="text/css" href="css/mystyle.css">

    
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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

    


  <div class="col-md-6 center bg-info" style="margin-bottom: 50px; margin-right: auto; margin-left: auto;">
        
            

                    <form action="customer_register.php" method="post" enctype="multipart/form-data">
                       
                            <h2>Create an Account </h2>
                            
                                <div class="form-group">
    <label for="exampleInputEmail1">Customer Name: </label>
    <input type="text" class="form-control" name="c_name"  placeholder="Enter Name" required>
    
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email: </label>
    <input type="email" class="form-control" name="c_email" aria-describedby="emailHelp" onkeyup="checkEmail(this.value)" placeholder="Enter email" required>
    
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Password: </label>
    <input type="password" class="form-control" name="c_pass"  placeholder="Enter Password" required>
    
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Image: </label>
    <input type="file" class="form-control" name="c_image" required>
    
  </div>

<div class="form-group">
    <label for="exampleInputEmail1">City </label>
    <input type="text" class="form-control" name="c_city"  placeholder="Enter City" required>
    
  </div>


<div class="form-group">
    <label for="exampleInputEmail1">Contact </label>
    <input type="text" class="form-control" name="c_contact"  placeholder="Enter Contact" required>
    
  </div>

<div class="form-group">
    <label for="exampleInputEmail1">Address </label>
    <input type="text" class="form-control" name="c_address"  placeholder="Enter Address" required>
    
  </div>
   <input type="submit" name="register" class="btn btn-secondary justify-content-center" value="Create Account"><br>

                            
                            

                    </form>


            </div>
        </div>
        
    </div>
    <script>
        function checkEmail(email) {
            if(email==''){
                document.getElementById('hint').innerHTML = "";
            }
            else {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById('hint').innerHTML = this.responseText;
                    }
                };
                xhttp.open("GET", "check_email.php?e="+email);
                xhttp.send();
            }
        }
    </script>
</body>
</html>
