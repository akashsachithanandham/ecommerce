<?php

if(isset($_POST['login']))
{
    global $con;
    $ip = getIp();
    $c_email = $_POST['email'];
    $c_pass = $_POST['pass'];
    $sel_c = "select * from customers where cust_pass = '$c_pass' AND cust_email = '$c_email'";
    $run_c = mysqli_query($con,$sel_c);
    $check_c = mysqli_num_rows($run_c);
    if($check_c==0){
        header('location:'.$_SERVER['PHP_SELF']);
        exit();
    }
    $sel_cart = "select * from cart where ip_add='$ip'";
    $run_cart = mysqli_query($con,$sel_cart);
    $check_cart = mysqli_num_rows($run_cart);
     $_SESSION['customer_email'] = $c_email;
    if($check_c > 0 && $check_cart ==0){
        //$_SESSION['customer_email'] = $c_email;
        header('location: my_account.php');
    }else{
        
       
        header('Location: index.php');
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>


<div>
    <form method="post"action="">
        <h2>Login or Register to Buy!</h2>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" name="pass" placeholder="Password">
  </div>
  <div class="form-group ">
    
    <a href="checkout.php?forgot_pass" class="text-white">Forgot Password?</label>
  </div>
  <input type="submit" name="login" class="btn btn-secondary" value="Login"><br>
  <h5 style="padding: 5px;float: left;" class="text-white"> 
            <a style="text-decoration: none;" href="customer_register.php" class="text-white">Register!</a>
        </h5>
</form>
    
</div>
</body>
</html>