<?php

// Include the auth.php to use the logout() function
require_once __DIR__ . "/db/auth.php"; // Adjust the path as needed

// Start session
session_start();
echo stripos($_SERVER['REQUEST_URI'], "/index.php");
if ($_SERVER['REQUEST_URI'] == "/web_project/index.php" && !isset($_SESSION["username"])) {
    // Redirect to login if the user is already logged in
    header("Location: login.php");
    exit();
}
// Check if logout button is clicked
if (isset($_POST['logout'])) {
    logout(); // Call the logout function from auth.php
}

// Continue with the rest of the page
?>

<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home-page</title>
    <link rel="icon" href="img/icon.jpg">

    <link rel="stylesheet" href="style.css" />

    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
  <style>
    .dropdown li form{
      	border-bottom: 1px solid #ccc;
      }
      /* Styling for the Sign Out button */
      .signout {
          background-color: white;
          width: 100%;
          outline: none;
          border: none;
          padding: 0.5rem 1rem;
      }

      /* Hover effect for the button */
      .signout:hover {
          background-color: #f0f0f0;
      }
    </style>
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




    <!--Home-->
    <section class="home" id="home">
      <div class="home-text">
        <h1>
          We Have Everything <br />
          Your <span>Car</span> Need
        </h1>
        <p>
         <span style="font-size:30px;">Welcome to Car Point!</span> 
         <br>

          Find the perfect car for you. At Car Point, we offer a wide range of cars, from new to used,<br> all in one place. Whether you're buying or selling, we make the process quick and easy.<br> Start browsing today and discover great deals!
        </p>
        <!--home button-->
        <a href="#cars" class="btn">Discover Now</a>
      </div>
    </section>

    <!--cars-->
    <section class="cars" id="cars">
      <div class="heading">
        <span>All Cars</span>
        <h2>We have all types of cars</h2>
        <p>
          Select your preferred color and explore different versions from this brand.


        </p>
      </div>
      <!-- cars containters -->
      <div class="cars-container container">
        <!-- box1 -->
        <div class="box">
          <img src="img/car1.jpg" alt="" />
          <h2>porche car</h2>
        </div>
        <!-- box2 -->
        <div class="box">
          <img src="img/car2.jpg" alt="" />
          <h2>audi car</h2>
        </div>
        <!-- box3 -->
        <div class="box">
          <img src="img/car3.jpg" alt="" />
          <h2>audi car</h2>
        </div>
        <!-- box4 -->
        <div class="box">
          <img src="img/car4.jpg" alt="" />
          <h2>audi car</h2>
        </div>
        <!-- box5 -->
        <div class="box">
          <img src="img/car5.jpg" alt="" />
          <h2>audi car</h2>
        </div>
        <!-- box6 -->
        <div class="box">
          <img src="img/car6.jpg" alt="" />
          <h2>dodge car</h2>
        </div>
      </div>
    </section>

    <!-- about -->
    <section class="about container" id="about">
      <div class="about-img">
        <img src="img/about.png" alt="" />
      </div>
      <div class="about-text">
        <span>About Us</span>
        <h2>
          Cheap prices with <br />
          Quality Cars
        </h2>
        <p>
          At Car Point, we believe in offering the best cars without breaking your budget. Our team carefully selects each vehicle to ensure both affordability and top-notch quality. You don’t have to compromise—drive the car of your dreams at a price you'll love.

          <!-- about buttons -->
        </p>
        <a href="aboutusbutton.html" class="btn">Learn More</a>

      </div>
    </section>

    <!-- parts -->
    <section class="parts" id="parts">
      <div class="heading">
        <span>What we offer</span>
        <h2>Our car Is always Excellent</h2>
        <p>
          Lorem ipsum, dolor sit amet consectetur adipisicing elit.
          Necessitatibus, delectus.
        </p>
      </div>

      <!-- parts container -->
      <div class="part-container container">
        <!-- part1 -->
        <div class="box">
          <img src="img/part1.png" alt="" />
          <h3>Auto Spare Part</h3>
          <span>$120.99</span>
          <i class="bx bxs-star">(6 Reviews)</i>
          <a href="#" class="btn">Buy now</a>
          <a href="#" class="Details">view Details</a>
        </div>
        <!-- part1 -->
        <div class="box">
          <img src="img/part2.png" alt="" />
          <h3>Auto Spare Part</h3>
          <span>$120.99</span>
          <i class="bx bxs-star">(6 Reviews)</i>
          <a href="#" class="btn">Buy now</a>
          <a href="#" class="Details">view Details</a>
        </div>
        <!-- part1 -->
        <div class="box">
          <img src="img/part3.png" alt="" />
          <h3>Auto Spare Part</h3>
          <span>$120.99</span>
          <i class="bx bxs-star">(6 Reviews)</i>
          <a href="#" class="btn">Buy now</a>
          <a href="#" class="Details">view Details</a>
        </div>
        <!-- part1 -->
        <div class="box">
          <img src="img/part4.png" alt="" />
          <h3>Auto Spare Part</h3>
          <span>$120.99</span>
          <i class="bx bxs-star">(6 Reviews)</i>
          <a href="#" class="btn">Buy now</a>
          <a href="#" class="Details">view Details</a>
        </div>
        <!-- part1 -->
        <div class="box">
          <img src="img/part5.png" alt="" />
          <h3>Auto Spare Part</h3>
          <span>$120.99</span>
          <i class="bx bxs-star">(6 Reviews)</i>
          <a href="#" class="btn">Buy now</a>
          <a href="#" class="Details">view Details</a>
        </div>
        <!-- part1 -->
        <div class="box">
          <img src="img/part6.png" alt="" />
          <h3>Auto Spare Part</h3>
          <span>$120.99</span>
          <i class="bx bxs-star">(6 Reviews)</i>
          <a href="#" class="btn">Buy now</a>
          <a href="#" class="Details">view Details</a>
        </div>
      </div>
    </section>

    <section>
      <!--Blog Container-->
      <section class="blog" id="blog"></section>
      <div class="heading">
        <span>Our Blog</span>
        <h2>Blog & News</h2>
        <p>
          Lorem ipsum, dolor sit amet consectetur adipisicing elit.
          Necessitatibus, delectus.
        </p>
      </div>
      <!--Blog Container-->
      <div class="blog-container container">
        <!--Box 1-->
        <div class="box">
          <img src="img/car1.jpg" />
          <span>Feb 14 2021</span>
          <h3>How To Get Prefect Car At Low Price</h3>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Necessitatibus, praesentium.
          </p>
          <a href="#" class="blog-btn"
            >Read More<i class="bx bx-right-arrow-alt"></i
          ></a>
        </div>
        <!--Box 2-->
        <div class="box">
          <img src="img/car4.jpg" />
          <span>Feb 14 2021</span>
          <h3>How To Get Prefect Car At Low Price</h3>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Necessitatibus, praesentium.
          </p>
          <a href="#" class="blog-but"
            >Read More <i class="bx bx-rigth-arrow-alt"></i
          ></a>
        </div>
        <!--Box 3-->
        <div class="box">
          <img src="img/car3.jpg" />
          <span>Feb 14 2021</span>
          <h3>How To Get Prefect Car At Low Price</h3>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Necessitatibus, praesentium.
          </p>
          <a href="#" class="blog-but"
            >Read More <i class="bx bx-rigth-arrow-alt"></i
          ></a>
        </div>
      </div>
    </section>

    <!-- footer -->
    <section class="footer">
      <div class="footer-container container">
        <div class="footer-box">
          <a href="#" class="logo">Car<span>Point</span></a>
          <div class="social">
            <a href="#"><i class="bx bxl-facebook"></i></a>
            <a href="#"><i class="bx bxl-twitter"></i></a>
            <a href="#"><i class="bx bxl-instagram"></i></a>
            <a href="#"><i class="bx bxl-youtube"></i></a>
          </div>
        </div>
        <div class="footer-box">
          <h3>Pages</h3>
          <a href="#">Home</a>
          <a href="#">Cars</a>
          <a href="#">Parts</a>
          <a href="#">Sales</a>
        </div>
        <div class="footer-box">
          <h3>Legal</h3>
          <a href="#">Privacy</a>
          <a href="#">Refund Policy</a>
          <a href="#">Cookie Policy</a>
        </div>
        <div class="footer-box">
          <h3>Contact</h3>
          <p>United States</p>
          <p>Japan</p>
          <p>Germany</p>
        </div>
      </div>
    </section>
    <!--Copyrigth-->
    <div class="copyright">
      <p>&#169; CarpoolVenom All Right Reserved</p>
    </div>
   
    <!-- part1 -->
  
 
</section>

    <!--link to js -->
    <script src="main.js"></script>
  </body>
</html>
