<?php
    include "../config/conn.php";
    include "../components/admin_head.php";
    session_start();

    if(isset($_POST['submit'])){

        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $pass = sha1($_POST['pass']);
        $pass = filter_var($pass, FILTER_SANITIZE_STRING);
     
        $select_admin = $conn->prepare("SELECT * FROM `admins` WHERE name = ? AND password = ?");
        $select_admin->execute([$name, $pass]);
        $row = $select_admin->fetch(PDO::FETCH_ASSOC);
     
        if($select_admin->rowCount() > 0){
           $_SESSION['admin_id'] = $row['id'];
           header('location:dashboard.php');
        }else{
           $message[] = 'Incorrect username or password!';
        }
     
     }
?>
<body>
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
    <section class="form-container">

    <form action="" method="post">
    <h3>Login now</h3>
    <input type="text" name="name" required placeholder="Enter your username" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
    <input type="password" name="pass" required placeholder="Enter your password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
    <input type="submit" value="Login now" class="btn" name="submit">
    </form>

    </section>

</body>