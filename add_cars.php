<?php 
  // Include the auth.php to use the logout() function
require_once __DIR__ . "/db/auth.php"; // Adjust the path as needed

// Start session
session_start();

if (stripos($_SERVER['REQUEST_URI'], "/add_cars.php") !== false &&
    (strtolower($_SESSION["role"]) !== "admin")) {
    header("Location: index.php");
    exit();
}


?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Cars</title>
    <link rel="stylesheet" href="add_cars.css?v=2.0" /> 
    <link rel="stylesheet" href="style.css" />

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
<div class="layout">
    <!-- Main Content -->
    <div class="main-container">
      <!-- Left Side: Photo -->
      <div class="left-container">
        <h2>Car Photo</h2>
        <div class="photo-preview" id="photo-preview">
          <p>No photo selected</p>
        </div>
      </div>

      <!-- Right Side: Form -->
      <div class="right-container">
        <h1>Add Car Details</h1>
        <form id="car-form" action="uploadphoto.php" method="POST" enctype="multipart/form-data">
          
          <!-- Photo input moved inside the form -->
          <label for="car-photo">Car Photo:</label>
          <input
            type="file"
            id="car-photo"
            name="car-photo"
            accept="image/*"
            onchange="previewPhoto()"
            required
          />

          <label for="car-name">Car Name:</label>
          <input type="text" id="car-name" name="car-name" required />

          <label for="car-color">Color:</label>
          <input type="text" id="car-color" name="car-color" required />

          <label for="model-year">Model Year:</label>
          <input type="number" id="model-year" name="model-year" required />

          <label for="price">Price</label>
          <input type="number" id="price" name="price" step="0.01" required />

          <label for="no-of-stocks">Number of Stocks:</label>
          <input type="number" id="no-of-stocks" name="no-of-stocks" required />

          <button type="submit">Add Car</button>
        </form>
      </div>
    </div>
</div>
    <script>
      // Logout functionality
      function logout() {
        window.location.href = "login.php";
      }

      // Preview photo functionality
      function previewPhoto() {
        const fileInput = document.getElementById("car-photo");
        const preview = document.getElementById("photo-preview");
        preview.innerHTML = ""; // Clear previous content

        const file = fileInput.files[0];
        if (file) {
          const img = document.createElement("img");
          img.src = URL.createObjectURL(file);
          img.alt = "Car Photo";
          img.style.width = "100%";
          img.style.height = "auto";
          preview.appendChild(img);
        } else {
          preview.innerHTML = "<p>No photo selected</p>";
        }
      }
    </script>
  </body>
</html>
