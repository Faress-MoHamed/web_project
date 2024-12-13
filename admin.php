<?php 
// Include the auth.php to use the logout() function
require_once __DIR__ . "/db/auth.php"; // Adjust the path as needed

// Start session
session_start();

// Check if logout button is clicked
if (isset($_POST['logout'])) {
    logout(); // Call the logout function from auth.php
}
if (stripos($_SERVER['REQUEST_URI'], "/admin.php") !== false &&
    (strtolower($_SESSION["role"]) !== "admin")) {
    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="icon" href="img/icon.jpg" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="admin.css?v=1.0" />
  </head>
  <body>


<nav>
    <div class="nav-container">
        <a href="#" class="logo">
            <button class="logo-btn">F</button>
            <span>3arbity</span>
        </a>
        <ul class="menu">
            <li><a href="#">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Pricing</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
        <div class="hamburger">&#9776;</div>
        <!-- <div class="user-menu">
          <span>Bonnie Green</span>
            <img src="/img/car5.jpg" alt="User Photo">
            <div class="dropdown">
                <div>
                    <span>Bonnie Green</span><br>
                    <small>name@flowbite.com</small>
                </div>
                <ul>
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="#">Settings</a></li>
                    <li><a href="#">Earnings</a></li>
                    <li><a href="#">Sign Out</a></li>
                </ul>
            </div>
        </div> -->
<?php
// Include the auth.php file to access the logout() function
require_once __DIR__ . "/db/auth.php"; // Adjust the path to auth.php as needed


// Check if the user is logged in
if (isset($_SESSION["username"])) {
    ?>
    <div class="user-menu">
        <span><?php echo $_SESSION["username"]; ?></span>
        <img src="./img/user.png" alt="User Photo">
        <div class="dropdown">
            <div>
                <span><?php echo $_SESSION["username"]; ?></span><br>
                <small><?php echo $_SESSION["email"]; ?></small>
            </div>
            <ul>
              <?php 
              if(strtolower($_SESSION["role"])=== "admin" || strtolower($_SESSION["role"])==="superadmin"){
?>
                <li><a href="admin.php">Dashboard</a></li>
<?php }?>
                <li><a href="#">Settings</a></li>
                <li><a href="#">Earnings</a></li>
                <li>
                    <!-- The form that calls the logout() function in auth.php -->
                    <form action="" method="POST" style="display:inline;">
                        <button class="signout" type="submit" name="logout">Sign Out</button>
                    </form>
                </li> 
            </ul>
        </div>
    </div>
    <?php
} else {
    ?>
    <div class="auth-buttons">
        <a href="login.php">Sign In</a>
        <a href="signup.php">Sign Up</a>
    </div>
    <?php
}
?>


    </div>
</nav>

    <!-- Dashboard content -->
     <div class="layout">

       <div class="container">
         <a href="add_cars.php">
           <div class="box admin">
             <h2>Add Cars</h2>
            </div>
          </a>
          <a href="addadmins.php">
            <div class="box admin">
          <h2>Add Admins</h2>
        </div>
      </a>
       </div>
    </div>
  </body>
      <script src="main.js"></script>

</html>
