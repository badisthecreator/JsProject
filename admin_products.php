<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
   exit;
}

/* ---------------- ADD PRODUCT ---------------- */
if(isset($_POST['add_product'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $price = $_POST['price'];

   $image = $_FILES['image']['name'];
   $image_tmp = $_FILES['image']['tmp_name'];
   $image_size = $_FILES['image']['size'];

   $upload_path = 'media/uploaded/' . $image;

   $check = mysqli_query($conn, "SELECT id FROM products WHERE name = '$name'");

   if(mysqli_num_rows($check) > 0){
      $message[] = 'Product already exists';
   }else{

      if($image_size > 2000000){
         $message[] = 'Image size too large (max 2MB)';
      }else{

         move_uploaded_file($image_tmp, $upload_path);

         mysqli_query(
            $conn,
            "INSERT INTO products (name, price, image)
             VALUES ('$name', '$price', '$image')"
         );

         $message[] = 'Product added successfully';
      }
   }
}

/* ---------------- DELETE PRODUCT ---------------- */
if(isset($_GET['delete'])){

   $id = $_GET['delete'];

   $img_q = mysqli_query($conn, "SELECT image FROM products WHERE id = '$id'");
   $img = mysqli_fetch_assoc($img_q);

   if($img){
      unlink('media/uploaded/' . $img['image']);
   }

   mysqli_query($conn, "DELETE FROM products WHERE id = '$id'");

   header('location:admin_products.php');
   exit;
}

/* ---------------- UPDATE PRODUCT ---------------- */
if(isset($_POST['update_product'])){

   $id = $_POST['update_p_id'];
   $name = $_POST['update_name'];
   $price = $_POST['update_price'];

   mysqli_query(
      $conn,
      "UPDATE products SET name = '$name', price = '$price' WHERE id = '$id'"
   );

   $new_image = $_FILES['update_image']['name'];
   $tmp = $_FILES['update_image']['tmp_name'];
   $size = $_FILES['update_image']['size'];
   $old_image = $_POST['update_old_image'];

   if(!empty($new_image)){

      if($size <= 2000000){

         $path = 'media/uploaded/' . $new_image;

         move_uploaded_file($tmp, $path);

         mysqli_query(
            $conn,
            "UPDATE products SET image = '$new_image' WHERE id = '$id'"
         );

         unlink('media/uploaded/' . $old_image);

      }else{
         $message[] = 'Image too large (max 2MB)';
      }
   }

   header('location:admin_products.php');
   exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Products - BookFair</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/admin_style.css">
</head>
<body>

<?php include 'admin_header.php'; ?>

<section class="add-products">

   <h1 class="title">Products</h1>

   <form action="" method="post" enctype="multipart/form-data">
      <h3>Add Product</h3>

      <input type="text" name="name" class="box" placeholder="Product name" required>
      <input type="number" name="price" class="box" min="0" placeholder="Price in USD" required>
      <input type="file" name="image" class="box" accept="image/jpg,image/jpeg,image/png" required>

      <input type="submit" name="add_product" value="Add Product" class="btn">
   </form>

</section>

<section class="show-products">

   <div class="box-container">

      <?php
      $result = mysqli_query($conn, "SELECT * FROM products");

      if(mysqli_num_rows($result) > 0){
         while($row = mysqli_fetch_assoc($result)){
      ?>

      <div class="box">
         <img src="media/uploaded/<?php echo $row['image']; ?>" alt="">
         <div class="name"><?php echo $row['name']; ?></div>
         <div class="price">$<?php echo $row['price']; ?></div>

         <a href="admin_products.php?update=<?php echo $row['id']; ?>" class="option-btn">Update</a>
         <a href="admin_products.php?delete=<?php echo $row['id']; ?>" class="delete-btn"
            onclick="return confirm('Delete this product?');">Delete</a>
      </div>

      <?php
         }
      }else{
         echo '<p class="empty">No products found</p>';
      }
      ?>

   </div>

</section>

<section class="edit-product-form">

<?php
if(isset($_GET['update'])){

   $id = $_GET['update'];
   $q = mysqli_query($conn, "SELECT * FROM products WHERE id = '$id'");
   $p = mysqli_fetch_assoc($q);

   if($p){
?>

<form action="" method="post" enctype="multipart/form-data">

   <input type="hidden" name="update_p_id" value="<?php echo $p['id']; ?>">
   <input type="hidden" name="update_old_image" value="<?php echo $p['image']; ?>">

   <img src="media/uploaded/<?php echo $p['image']; ?>" alt="">

   <input type="text" name="update_name" value="<?php echo $p['name']; ?>" class="box" required>
   <input type="number" name="update_price" value="<?php echo $p['price']; ?>" class="box" min="0" required>

   <input type="file" name="update_image" class="box" accept="image/jpg,image/jpeg,image/png">

   <input type="submit" name="update_product" value="Update" class="btn">
   <input type="reset" value="Cancel" class="option-btn">

</form>

<?php
   }
}else{
   echo '<script>document.querySelector(".edit-product-form").style.display="none";</script>';
}
?>

</section>

<script src="js/admin_script.js"></script>

</body>
</html>