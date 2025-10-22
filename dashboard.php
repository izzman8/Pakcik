<?php 
session_start();
require('database.php');
$id = $_SESSION['id'];
$user = $_SESSION['user'];
$email = $_SESSION['email'];
$pass = $_SESSION['pass'];

$select = mysqli_query($conn, "SELECT * FROM `login` WHERE email = '$email'") or die('query failed');
      if(mysqli_num_rows($select) > 0){
         $fetch = mysqli_fetch_assoc($select);
      }

     


if (isset($_SESSION['email']) && isset($_SESSION['pass'])) {
  
  $sql = "SELECT * FROM login WHERE email='$email' AND pass='$pass'";
  $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
  $row = mysqli_fetch_assoc($result);

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard</title>
  <link rel="icon" type="image/png" href="tot_logo1.png">
  <link rel="stylesheet" href="style2.css" />
  <link href="styleG.css" rel="stylesheet">
</head>
<body>

  <nav>
    <div class="logo">
      <img src="tot_logo1.png" alt="Logo" />
    </div>
    <div class="menu-btn">
      <div class="menu-icon">&#9776;</div>
    </div>
    <ul class="nav-links">
        
    <ul>
      <li><a href="#">Ticket <i class="fas fa-caret-down"></i></a>
            <div class="dropdown-menu">
                <ul>
                <li><a href="addticket.php">New Ticket</a></li>
                <li><a href="ticketstu.php">Pending Ticket</a></li>
               <li><a href="ticketstu2.php">Completed Ticket</a></li>
                  </ul>
                    </div>
                  </li>
                  <li><a href="#">Counseling <i class="fas fa-caret-down"></i></a>
            <div class="dropdown-menu">
                <ul>
                <li><a href="addapp.php">New Appointment</a></li>
                <li><a href="appstu.php">Scheduled Appointment</a></li>
               <li><a href="apphistory.php">Appointment History</a></li>
                  </ul>
                    </div>
                  </li>
                  <li><a href="#">Help <i class="fas fa-caret-down"></i></a>
            <div class="dropdown-menu">
                <ul>
                <li><a href="faq.php">FAQ</a></li>
                <li><a href="allarticlestu.php">Article</a></li>
                  </ul>
                    </div>
                  </li>
                  <?php
         if($fetch['image'] == ''){
            echo '<img src="pakcik.jpg" class="user-pic" onclick="toggleMenu()">';
         }else{
            echo '<img src="img src="pakcik1.jpg" class="user-pic" onclick="toggleMenu()">';
         }
      ?>
      </ul>
      <div class="sub-menu-wrap" id="subMenu">
        <div class="sub-menu">
            <div class="user-info">

            <?php
         if($fetch['image'] == ''){
            echo '<img src="pakcik.jpg">';
         }else{
            echo '<img src="pakcik1.jpg">';
         }
      ?>
                <h3><?php echo $_SESSION['user'];?></h3>
            </div>
            <hr>
            <a href="editprofilestu.php?lectureid=<?php echo $row['id'] ?>" class="sub-menu-link">
                <img src="user.png">
                <p>Edit Profile</p>
                <span>></span>
            </a>
           
            <a href="logout.php" class="sub-menu-link">
                <img src="logout.png">
                <p>Log Out</p>
                <span>></span>
            </a>
        </div>
      </div>


      <li><a href="login.php" class="active">Log In</a></li>
    </ul>
    
  </nav>

        <script>
        let subMenu = document.getElementById("subMenu");
        function toggleMenu(){
            subMenu.classList.toggle("open-menu");
        }


      </script>


<div class="container">
    <h1>Welcome, <?php echo $_SESSION['user']; ?>!</h1>
    <p>This is your dashboard where you can manage your tickets and counseling appointments.</p>
</div>


  


 

  <footer>
    <p>&copy; <?php echo date("Y"); ?> Pakcik TOT. All rights reserved.</p>

  </footer>

  <script>
    const menuBtn = document.querySelector('.menu-btn');
    const navLinks = document.querySelector('.nav-links');

    menuBtn.addEventListener('click', () => {
      navLinks.classList.toggle('show');
    });
  </script>

</body>
</html>
<?php 
}
else{
     header("Location: index.php");
     exit();
}
 ?>
