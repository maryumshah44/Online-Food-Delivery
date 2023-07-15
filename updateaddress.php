<?php

include 'connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:home.php');
};

if(isset($_POST['submit'])){

   $address = $_POST['flat'] .', '.$_POST['building'].', '.$_POST['area'].', '.$_POST['town'] .', '. $_POST['city'] .', '. $_POST['state'] .', '. $_POST['country'] .' - '. $_POST['pin_code'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);

   $update_address = $conn->prepare("UPDATE `users` set address = ? WHERE id = ?");
   $update_address->execute([$address, $user_id]);

   $message[] = 'address saved!';

}

?>




<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
   <title>Update Address</title>

  

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="style.css">
   <script src="scripts.js"></script>

</head>
<body>
   
   
   
   
  


<?php include 'user_header.php' ?>

<section class="form-container">

   <form action="" method="post">
      <h3>your address</h3>
      <input type="text" class="box" placeholder="flat no." required maxlength="50" name="flat">
      <input type="text" class="box" placeholder="building no." required maxlength="50" name="building">
      <input type="text" class="box" placeholder="area name" required maxlength="50" name="area">
      <input type="text" class="box" placeholder="town name" required maxlength="50" name="town">
      <input type="text" class="box" placeholder="city name" required maxlength="50" name="city">
      <input type="text" class="box" placeholder="state name" required maxlength="50" name="state">
      <input type="text" class="box" placeholder="country name" required maxlength="50" name="country">
      <input type="number" class="box" placeholder="pin code" required max="999999" min="0" maxlength="6" name="pin_code">
      <input type="submit" value="save address" name="submit" class="btn">
   </form>

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

   <div class="credit"><br>&copy; copyright @ 2022 by <span>19cp55 and 19cp103</span></div>

</footer>




</body>
</html>