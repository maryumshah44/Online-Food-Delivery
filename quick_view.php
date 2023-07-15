0<?php

include 'connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'add_cart.php';

?>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>quick view</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">


   <link rel="stylesheet" href="style.css">

</head>
</body>
   
<?php 
include 'user_header.php';
?>

<section class="quick-view">

   <h1 class="title">quick view</h1>

   <?php
      $pid = $_GET['pid'];
      $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
      $select_products->execute([$pid]);
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="box">
      <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
      <img src="images/<?= $fetch_products['image']; ?>" alt="">
      <a href="category.php?category=<?= $fetch_products['category']; ?>" class="cat"><?= $fetch_products['category']; ?></a>
      <div class="name"><?= $fetch_products['name']; ?></div>
      <div class="flex">
         <div class="price"><span>$</span><?= $fetch_products['price']; ?></div>
         <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
      </div>
      <button type="submit" name="add_to_cart" class="cart-btn">add to cart</button>
   </form>
   <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
   ?>

</section>








<footer class="footer">

   <section class="box-container">

      <div class="box">
         <img src="images/email-icon.png" alt="">
         <h3>Email</h3>
         <a href="">maryum22@gmail.com</a>
         <a href="">nayyab12@gmail.com</a>
      </div>

      <div class="box">
         <img src="images/clock-icon.png" alt="">
         <h3>Timings</h3>
         <p>00:10am to 00:10pm </p>
      </div>
   <div class="box">
         <img src="images/phone-icon.png" alt="">
         <h3>Contact No.</h3>
         <a href="">+92-4526-7890</a>
         <a href="">+92-2222-3333</a>
      </div>
	  
      <div class="box">
         <img src="images/map-icon.png" alt="">
         <h3>Address</h3>
         <a href="https://www.google.com/maps">Bahria Town Phase 8</a>
      </div>


   </section>

   <div class="credit"><br>&copy; copyright @ 2022 by <span>19cp55 and 19cp101</span></div>

</footer>

<div class="loader">
   <img src="images/loader.gif" alt="">
</div>

<script src="script.js"></script>

</body>
</html>









