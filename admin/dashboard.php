<?php
    include "../config/conn.php";
    include "../components/admin_head.php";
    include "../components/admin_header.php";

    session_start();

    $admin_id = $_SESSION['admin_id'];

    if(!isset($admin_id)){
        header('location:admin_login.php');
    }
?>
<section class="dashboard">

<h1 class="heading">Dashboard</h1>

<div class="box-container">

   

   <div class="box">
      <?php
         $total_pendings = 0;
         $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
         $select_pendings->execute(['pending']);
         if($select_pendings->rowCount() > 0){
            while($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)){
               $total_pendings += $fetch_pendings['total_price'];
            }
         }
      ?>
      <h3><span>$</span><?= $total_pendings; ?><span>/-</span></h3>
      <p>total pendings</p>
      <a href="placed_orders.php" class="btn">See orders</a>
   </div>

   <div class="box">
      <?php
         $total_completes = 0;
         $select_completes = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
         $select_completes->execute(['completed']);
         if($select_completes->rowCount() > 0){
            while($fetch_completes = $select_completes->fetch(PDO::FETCH_ASSOC)){
               $total_completes += $fetch_completes['total_price'];
            }
         }
      ?>
      <h3><span>$</span><?= $total_completes; ?><span>/-</span></h3>
      <p>completed orders</p>
      <a href="placed_orders.php" class="btn">See orders</a>
   </div>

   <div class="box">
      <?php
         $select_orders = $conn->prepare("SELECT * FROM `orders`");
         $select_orders->execute();
         $number_of_orders = $select_orders->rowCount()
      ?>
      <h3><?= $number_of_orders; ?></h3>
      <p>orders placed</p>
      <a href="placed_orders.php" class="btn">See orders</a>
   </div>

   <div class="box">
      <?php
         $select_products = $conn->prepare("SELECT * FROM `products`");
         $select_products->execute();
         $number_of_products = $select_products->rowCount()
      ?>
      <h3><?= $number_of_products; ?></h3>
      <p>products added</p>
      <a href="products.php" class="btn">See products</a>
   </div>

   <div class="box">
      <?php
         $select_users = $conn->prepare("SELECT * FROM `users`");
         $select_users->execute();
         $number_of_users = $select_users->rowCount()
      ?>
      <h3><?= $number_of_users; ?></h3>
      <p>Users</p>
      <a href="users_accounts.php" class="btn">See users</a>
   </div>

   

   <div class="box">
      <?php
         $select_messages = $conn->prepare("SELECT * FROM `messages`");
         $select_messages->execute();
         $number_of_messages = $select_messages->rowCount()
      ?>
      <h3><?= $number_of_messages; ?></h3>
      <p>New messages</p>
      <a href="messagess.php" class="btn">See messages</a>
   </div>

</div>

</section>

<script src="../js/admin_script.js"></script>

</body>