<?php


include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:home.php');
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Make Reservation</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<div class="heading">
   <h3>Make Reservation</h3>
   <p><a href="html.php">home</a> <span> / Make Reservation</span></p>
</div>

<section class="reservation">

   <h1 class="title">Make Reservation</h1>

   <div class="box-container">

   <?php
        if ($user_id == '') {
            echo '<p class="empty">please login to make a reservation</p>';
        } else 
            if (isset($_POST['submit'])) {
                $name = isset($_POST['name']) ? $_POST['name'] : '';
                $email = isset($_POST['email']) ? $_POST['email'] : '';
                $place_on = isset($_POST['place_on']) ? $_POST['place_on'] : '';
                $time_place = isset($_POST['time_place']) ? $_POST['time_place'] : '';
                $pax = isset($_POST['pax']) ? $_POST['pax'] : '';
                $table_no = isset($_POST['table_no']) ? $_POST['table_no'] : '';
                $contact = isset($_POST['contact_no']) ? $_POST['contact_no'] : '';
        
                if (!empty($name) && !empty($email) && !empty($place_on) && !empty($time_place) && !empty($pax) && !empty($table_no) && !empty($contact)) {
                    
                    $insert_res = $conn->prepare("INSERT INTO reservations (user_id, name, place_on, reservation_status, time_place, pax, table_no, contact_no, email)
                        VALUES (?, ?, ?, 'pending', ?, ?, ?, ?, ?)");
                    $insert_res->execute([$user_id, $name, $place_on, $time_place, $pax, $table_no, $contact, $email]);

                } else {
                    echo '<p class="empty">Please fill in all the required fields.</p>';
                }
          
            
            ?>

            <div class="box">
                <h2>Reservation Form</h2>
                <form action="reservation.php" method="POST">
                    <div class="form-group">
                        <p>Reservation Placed On : 
                        <input type="date" id="place_on" name="place_on" required></p>
                    </div>

                    <div class="form-group">
                        <p>Time of Reservation :
                        <input type="time" id="time_place" name="time_place" required></p>
                        </div>

                    <div class="form-group">
                        <p>Name :
                        <input type="text" id="name" name="name" required></p>
                        </div>
                        
                    <div class="form-group">
                        <p>Email :
                        <input type="email" id="email" name="email" required></p>
                    </div>

                    <div class="form-group">
                        <p>Contact No :
                        <input type="text" id="contact_no" name="contact_no" required></p>
                    </div>

                    <div class="form-group">
                        <p>Number of Pax : 
                        <input type="text" id="pax" name="pax" required></p>
                    </div>
                    
                    <div class="form-group">
                        <p>Table No :
                        <input type="text" id="table_no" name="table_no" required></p>
                    </div>
                    <center>
                        <input type="submit" value="Submit Reservation"id="submit"name="submit" style="background:orange; color:white; padding:20px 50px 20px 50px" >
                    </center>
      
                </form>
            </div>
        <?php
      }
   ?>

   </div>

</section>










<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->






<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>