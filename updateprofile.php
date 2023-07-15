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

   $name = $_POST['name'];
  

   $email = $_POST['email'];
   
   $number = $_POST['number'];
  

   if(!empty($name)){
      $update_name = $conn->prepare("UPDATE `users` SET name = ? WHERE id = ?");
      $update_name->execute([$name, $user_id]);
   }

   if(!empty($email)){
      $select_email = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
      $select_email->execute([$email]);
      if($select_email->rowCount() > 0){
         $message[] = 'email already taken!';
      }else{
         $update_email = $conn->prepare("UPDATE `users` SET email = ? WHERE id = ?");
         $update_email->execute([$email, $user_id]);
      }
   }

   if(!empty($number)){
      $select_number = $conn->prepare("SELECT * FROM `users` WHERE number = ?");
      $select_number->execute([$number]);
      if($select_number->rowCount() > 0){
         $message[] = 'number already taken!';
      }else{
         $update_number = $conn->prepare("UPDATE `users` SET number = ? WHERE id = ?");
         $update_number->execute([$number, $user_id]);
      }
   }
   
   $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
   $select_prev_pass = $conn->prepare("SELECT password FROM `users` WHERE id = ?");
   $select_prev_pass->execute([$user_id]);
   $fetch_prev_pass = $select_prev_pass->fetch(PDO::FETCH_ASSOC);
   $prev_pass = $fetch_prev_pass['password'];
   $old_pass = sha1($_POST['old_pass']);
  
   $new_pass = sha1($_POST['new_pass']);
   
   $confirm_pass = sha1($_POST['confirm_pass']);
   

   if($old_pass != $empty_pass){
      if($old_pass != $prev_pass){
         $message[] = 'old password not matched!';
      }elseif($new_pass != $confirm_pass){
         $message[] = 'confirm password not matched!';
      }else{
         if($new_pass != $empty_pass){
            $update_pass = $conn->prepare("UPDATE `users` SET password = ? WHERE id = ?");
            $update_pass->execute([$confirm_pass, $user_id]);
            $message[] = 'password updated successfully!';
         }else{
            $message[] = 'please enter a new password!';
         }
      }
   }  

}

?>



<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
   <title>Orders</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="style1.css">
   <script src="scripts.js"></script>

</head>
<body>
   

<?php include 'user_header.php'; ?>








<section class="form-container update-form">

   
   <form action="" method="post">
      <h3>update profile</h3>
      <input type="text" name="name" placeholder="<?= $fetch_profile['name']; ?>" class="box" maxlength="50">
      <input type="email" name="email" placeholder="<?= $fetch_profile['email']; ?>" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="number" name="number" placeholder="<?= $fetch_profile['number']; ?>"" class="box" min="0" max="9999999999" maxlength="10">
      <input type="password" name="old_pass" placeholder="enter your old password" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="new_pass" placeholder="enter your new password" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="confirm_pass" placeholder="confirm your new password" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="update now" name="submit" class="btn">
   </form>


</section>














<!-- custom js file link  -->
<script src="script.js"></script>








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