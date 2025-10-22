<?php 
session_start(); 
include "database.php";

if(isset($_POST['cancel'])){
      
    header("location:index.php");
 
 }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="icon" type="image/png" href="tot_logo1.png">
    <title>Login Page</title>
    <link rel="stylesheet" href="styles.css">
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
      <li><a href="login.php" class="active">Log In</a></li>
    </ul>
  </nav>

    <div class="login-container">
        <div class="login-box">
            <h2>Login</h2>
            <form action="" method="post">
            <?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>
                <div class="textbox">
                    <input type="text" id="user" placeholder="Username" name="user" required>
                </div>
                <div class="textbox">
                    <input type="password" id= pass placeholder="Password" name="pass" required>
                </div>
                <input type="submit" value="Log in" name="login" class="btn">
            </form>
        </div>
    </div>
</body>
<?php
 if(isset($_POST['login'])){
       
 
            if (isset($_POST['user']) && isset($_POST['pass'])) {
            
                function validate($data){
                   $data = trim($data);
                   $data = stripslashes($data);
                   $data = htmlspecialchars($data);
                   return $data;
                }
            
                $user = mysqli_real_escape_string($conn, $_POST['user']);
                $pass = mysqli_real_escape_string($conn, $_POST['pass']);
            
                if (empty($user)) {
                    ?>
                    
                        <?php
                    exit();
                }else if(empty($pass)){
                    ?>
                    
                        <?php
                    exit();
            
                }else{
                    $pass = md5($pass);
            
                    $sql = "SELECT * FROM login WHERE user='$user' AND pass='$pass'";
            
                    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                    
                    
                    $success = false;
                    if (mysqli_num_rows($result) === 1) {
                        $success = true;
                        echo $success;
                    }
                    else if(mysqli_num_rows($result) === 0){
                        ?>
                        
                            <?php 
                            $success = false;
                            echo $success;
                            
                        }else{
                            ?>
                        
                            <?php
                            exit();
                        }
                    }
                }else{
                    ?>
                        
                            <?php
                            
                    exit();
            }
            if($success){
                echo "<center><font color='green'><b>You have login successfully</b></font></center>";
                $row = mysqli_fetch_assoc($result);
                
                        $id = $row['id'];
                        

                $_SESSION['user'] = $row['user'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['pass'] = $row['pass'];
                $_SESSION['status'] = $row['status'];
                $_SESSION['address'] = $row['address'];
                $_SESSION['allstatus']="Success!";
                $_SESSION['alldescription']="You have logged in!";
                $_SESSION['allstatuscode']="success";
                if($row["status"] == 2)
                {
                    header("Location: admin.php");
                }elseif($row["status"] == 1)
                {
                    header("Location: staff.php");
                }
                else{
                    header("Location: dashboard.php");
                }
            }else{
                echo "<center><font color='green'><b>You have login successfully</b></font></center>";
                header("Location: login.php?error=Incorect Email or password");
                exit();
            }
            }
            
            ?>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Pakcik TOT. All rights reserved.</p>
    </footer>
</html>