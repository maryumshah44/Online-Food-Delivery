<?php

include 'connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:home.php');
};

if(isset($_POST['delete'])){
   $cart_id = $_POST['cart_id'];
   $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
   $delete_cart_item->execute([$cart_id]);
   $message[] = 'cart item deleted!';
}

if(isset($_POST['delete_all'])){
   $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
   $delete_cart_item->execute([$user_id]);
   // header('location:cart.php');
   $message[] = 'deleted all from cart!';
}

if(isset($_POST['update_qty'])){
   $cart_id = $_POST['cart_id'];
   $qty = $_POST['qty'];
   $qty = filter_var($qty, FILTER_SANITIZE_STRING);
   $update_qty = $conn->prepare("UPDATE `cart` SET quantity = ? WHERE id = ?");
   $update_qty->execute([$qty, $cart_id]);
   $message[] = 'cart quantity updated';
}

$grand_total = 0;

?>




<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
   <title>Cart</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="style.css">

</head>

<body>
   
  
<header class="header">
<section class="flex">
<a href="home.php" class="logo"><img src ="download.png" width="120px"></a>

      <nav class="navbar">
         <a href="home.php">home</a>
         <a href="about.php">about</a>
         <a href="menu.php">menu</a>
         <a href="orders.php">orders</a>
         <a href="contact.php">contact</a>
      </nav>

    <div class="icons">
         <?php
            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_items = $count_cart_items->rowCount();
         ?>
         <a href="search.php"><i class="fas fa-search"></i></a>
         <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?= $total_cart_items; ?>)</span></a>
         <div id="user-btn" class="fas fa-user"></div>
         <div id="menu-btn" class="fas fa-bars"></div>
      </div>

<div class="profile">
<p class="name">MARYUM</p>
<div class="flex">
<a href="profile.php" class="btn">profile</a>
<a href="#" class="delete-btn">logout</a>
</div>
<p class="account"><a href="login.php">login</a> or <a href="register.php">register</a></p>
</div>
</section>

</header>


<div class="heading">
   <h3>shopping cart</h3>
   <p><a href="home.php">home</a> <span> / cart</span></p>
</div>

<!-- shopping cart section starts  -->

<section class="products">

   <h1 class="title">your cart</h1>

   <div class="box-container">

      <?php
         $grand_total = 0;
         $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
         $select_cart->execute([$user_id]);
         if($select_cart->rowCount() > 0){
            while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
      ?>
      <form action="" method="post" class="box">
         <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
         <a href="quick_view.php?pid=<?= $fetch_cart['pid']; ?>" class="fas fa-eye"></a>
         <button type="submit" class="fas fa-times" name="delete" onclick="return confirm('delete this item?');"></button>
         <img src="images/<?= $fetch_cart['image']; ?>" alt="">
         <div class="name"><?= $fetch_cart['name']; ?></div>
         <div class="flex">
            <div class="price"><span>$</span><?= $fetch_cart['price']; ?></div>
            <input type="number" name="qty" class="qty" min="1" max="99" value="<?= $fetch_cart['quantity']; ?>" maxlength="2">
            <button type="submit" class="fas fa-edit" name="update_qty"></button>
         </div>
         <div class="sub-total"> sub total : <span>$<?= $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>/-</span> </div>
      </form>
      <?php
               $grand_total += $sub_total;
            }
         }else{
            echo '<p class="empty">your cart is empty</p>';
         }
      ?>

   </div>

   <div class="cart-total">
      <p>cart total : <span>$<?= $grand_total; ?></span></p>
      <a href="checkout.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">proceed to checkout</a>
   </div>

   <div class="more-btn">
      <form action="" method="post">
         <button type="submit" class="delete-btn <?= ($grand_total > 1)?'':'disabled'; ?>" name="delete_all" onclick="return confirm('delete all from cart?');">delete all</button>
      </form>
      <a href="menu.php" class="btn">continue shopping</a>
   </div>

</section>

<!-- shopping cart section ends -->




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
