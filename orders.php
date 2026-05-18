<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Orders</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'header.php'; ?>

<div class="heading">
   <h3>your orders</h3>
   <p><a href="home.php">home</a> / orders</p>
</div>

<section class="placed-orders">

   <h1 class="title">placed orders</h1>

   <div class="box-container">

      <?php
         $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('query failed');

         if(mysqli_num_rows($order_query) > 0){
            while($fetch_orders = mysqli_fetch_assoc($order_query)){
      ?>

      <div class="box">

         <p>Placed on: <span><?php echo $fetch_orders['placed_on']; ?></span></p>
         <p>Name: <span><?php echo $fetch_orders['name']; ?></span></p>
         <p>Phone: <span><?php echo $fetch_orders['number']; ?></span></p>
         <p>Email: <span><?php echo $fetch_orders['email']; ?></span></p>
         <p>Address: <span><?php echo $fetch_orders['address']; ?></span></p>
         <p>Payment method: <span><?php echo $fetch_orders['method']; ?></span></p>
         <p>Products: <span><?php echo $fetch_orders['total_products']; ?></span></p>

         <p>
            Total price:
            <span>$<?php echo $fetch_orders['total_price']; ?></span>
         </p>

         <p>
            Payment status:
            <span style="color:<?php echo ($fetch_orders['payment_status'] == 'pending') ? 'red' : 'green'; ?>;">
               <?php echo $fetch_orders['payment_status']; ?>
            </span>
         </p>

         <!-- PayPal Payment -->
         <form method="post" action="https://www.sandbox.paypal.com/cgi-bin/webscr">
            <input type="hidden" name="business" value="sb-cwe0i29548039@business.example.com">
            <input type="hidden" name="item_name" value="Order Payment">
            <input type="hidden" name="item_number" value="<?php echo $fetch_orders['id']; ?>">
            <input type="hidden" name="amount" value="<?php echo $fetch_orders['total_price']; ?>">
            <input type="hidden" name="currency_code" value="USD">
            <input type="hidden" name="no_shipping" value="1">
            <input type="hidden" name="cmd" value="_xclick">
            <input type="hidden" name="return" value="https://yourdomain.com/orders.php">
            <input type="hidden" name="cancel_return" value="https://yourdomain.com/orders.php">

            <button type="submit" class="btn">Pay Now</button>
         </form>

         <a href="print.php?id=<?php echo $fetch_orders['id']; ?>" class="btn">Download Invoice</a>

      </div>

      <?php
            }
         }else{
            echo '<p class="empty">No orders found!</p>';
         }
      ?>

   </div>

</section>

<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>