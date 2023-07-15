<?php

include 'connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:home.php');
};

?>




<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
   <title>Profile</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="style.css">

</head>
<body>
   
<?php include'user_header.php' 
?>


<div class="heading">
   <h3>Profile</h3>
 
</div>

<section class="user-details">

   <div class="user">
     <img src="images/user-icon.png" alt="">
      <p><i class="fas fa-user"></i><span><span><?= $fetch_profile['name']; ?></span></span></p>
      <p><i class="fas fa-phone"></i><span><?= $fetch_profile['number']; ?></span></p>
      <p><i class="fas fa-envelope"></i><span><?= $fetch_profile['email']; ?></span></p>
      <a href="updateprofile.php" class="btn">update info</a>
      <p class="address"><i class="fas fa-map-marker-alt"></i><span><?php if($fetch_profile['address'] == ''){echo 'please enter your address';}else{echo $fetch_profile['address'];} ?></span></p>
      <a href="updateaddress.php" class="btn">update address</a>
   </div>
     

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
