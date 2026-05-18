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
   <title>About Us</title>

   <!-- font awesome cdn link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'header.php'; ?>

<div class="heading">
   <h3>about us</h3>
   <p><a href="home.php">home</a> / about</p>
</div>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="media/bookshelves.jpg" alt="">
      </div>

      <div class="content">
         <h3>Why Choose Us?</h3>

         <p>
            At BookFair, we provide a diverse collection of books for every reader.
            From classic literature to modern fiction, our platform is designed to
            make discovering and purchasing books simple and enjoyable.
         </p>

         <p>
            We focus on quality service, fast delivery, and building a strong reading
            community for book lovers everywhere.
         </p>

         <p>
            Choose BookFair for a reliable and personalized online book shopping experience.
         </p>

         <a href="contact.php" class="btn">contact us</a>
      </div>

   </div>

</section>

<section class="reviews">

   <h1 class="title">client reviews</h1>

   <div class="box-container">

      <div class="box">
         <img src="media/avatar_female_4.png" alt="">
         <p>
            Amazing collection of books and a very smooth shopping experience.
            The website is easy to use and delivery was fast.
         </p>

         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>

         <h3>Person A</h3>
      </div>

      <div class="box">
         <img src="media/avatar_female_2.png" alt="">
         <p>
            Great prices, excellent recommendations, and a huge variety of books.
            I always find something interesting to read.
         </p>

         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>

         <h3>Person B</h3>
      </div>

      <div class="box">
         <img src="media/avatar_man_3.png" alt="">
         <p>
            The ordering process was simple and the packaging was excellent.
            Highly recommended for book lovers.
         </p>

         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>

         <h3>Person C</h3>
      </div>

   </div>

</section>

<section class="authors">

   <h1 class="title">our team</h1>

   <div class="box-container">

      <div class="box">
         <img src="media/avatar_man_1.png" alt="">

         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>

         <h3>Badis</h3>
      </div>

      <div class="box">
         <img src="media/avatar_man_2.png" alt="">

         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>

         <h3>Youssef</h3>
      </div>

      <div class="box">
         <img src="media/avatar_female_3.png" alt="">

         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>

         <h3>Insaf</h3>
      </div>

   </div>

</section>

<?php include 'footer.php'; ?>

<!-- custom js file link -->
<script src="js/script.js"></script>

</body>
</html>