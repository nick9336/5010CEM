<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

   <section class="flex">

      <a href="dashboard.php" class="logo">Admin<span>Panel</span></a>

      <nav class="navbar">
         <a href="dashboard.php">Home</a>
         <a href="users_accounts.php">Users</a>
         <a href="placed_orders.php">Orders</a>
         <a href="placed_reservations.php">Reservations</a>
         <a href="admin_accounts.php">Accounts</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `admin` WHERE id = ?");
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         
         <a href="../components/admin_logout.php" onclick="return confirm('Logout from this website?');" class="delete-btn">logout</a>
      </div>

   </section>

</header>