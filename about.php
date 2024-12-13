<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About LuxeDrive Gallery</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f3f4f6;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        main {
            padding: 2rem 0;
        }
        h1, h2, h3 {
            margin-bottom: 1rem;
        }
        h1 {
            font-size: 2rem;
        }
        h2 {
            font-size: 1.8rem;
        }
        h3 {
            font-size: 1.5rem;
        }
        p {
            margin-bottom: 1rem;
        }
        .grid {
            display: grid;
            gap: 2rem;
        }
        .two-columns {
            grid-template-columns: 1fr 1fr;
        }
        .three-columns {
            grid-template-columns: repeat(3, 1fr);
        }
        img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }
        .feature-card, .exhibit-card {
            background-color: #fff;
            border-radius: 8px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .feature-card i {
            font-size: 2.5rem;
            color: #2563eb;
            margin-bottom: 1rem;
        }
        .cta {
            background-color: #2563eb;
            color: #fff;
            text-align: center;
            padding: 3rem 1rem;
            border-radius: 8px;
            margin-top: 2rem;
        }
        .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        .btn-primary {
            background-color: #fff;
            color: #2563eb;
        }
        .btn-secondary {
            background-color: transparent;
            color: #fff;
            border: 2px solid #fff;
        }
        .btn-primary:hover {
            background-color: #f3f4f6;
        }
        .btn-secondary:hover {
            background-color: #fff;
            color: #2563eb;
        }
        footer {
            background-color: #1f2937;
            color: #fff;
            padding: 3rem 0;
        }
        .footer-content {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
        }
        .footer-section h3 {
            margin-bottom: 1rem;
        }
        .footer-section p {
            color: #9ca3af;
        }
        .social-links a {
            color: #9ca3af;
            margin-right: 1rem;
            text-decoration: none;
        }
        .social-links a:hover {
            color: #fff;
        }
        .copyright {
            text-align: center;
            margin-top: 2rem;
            color: #9ca3af;
        }
        @media (max-width: 768px) {
            .two-columns, .three-columns {
                grid-template-columns: 1fr;
            }
            .footer-content {
                grid-template-columns: 1fr;
            }
        }
    </style>


    <link rel="stylesheet" href="style.css?v0.1">

</head>
<body>

<nav>
    <div class="nav-container">
        <a href="#" class="logo">
            <button class="logo-btn">F</button>
            <span>3arbity</span>
        </a>
        <ul class="menu">
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="#">Cars</a></li>
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

    <main class="container">
        <section>
            <h2>About Our Car Gallery</h2>
            <p>Welcome to LuxeDrive Gallery, where automotive dreams come to life. We are passionate about curating the finest collection of classic, luxury, and performance vehicles from around the world.</p>
            <div class="grid two-columns">
                <img src="https://via.placeholder.com/600x400" alt="LuxeDrive Gallery Showroom">
                <div>
                    <h3>Our Mission</h3>
                    <p>At LuxeDrive Gallery, we strive to preserve automotive history while showcasing the pinnacle of engineering and design. Our mission is to provide car enthusiasts with an immersive experience that celebrates the artistry and innovation of the automotive industry.</p>
                    <p>Whether you're a seasoned collector or a curious newcomer, our gallery offers a unique opportunity to witness automotive excellence up close and personal.</p>
                </div>
            </div>
        </section>

        <section>
            <h2>What Sets Us Apart</h2>
            <div class="grid three-columns">
                <div class="feature-card">
                    <i class="fas fa-car"></i>
                    <h3>Extensive Collection</h3>
                    <p>Over 200 meticulously maintained vehicles spanning a century of automotive history.</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-tools"></i>
                    <h3>Expert Restoration</h3>
                    <p>Our team of skilled craftsmen breathe new life into classic cars, preserving their heritage for future generations.</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-calendar"></i>
                    <h3>Regular Events</h3>
                    <p>Monthly showcases, test drives, and automotive enthusiast meetups that bring our community together.</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-users"></i>
                    <h3>Knowledgeable Staff</h3>
                    <p>Our passionate team of experts is always ready to share insights and stories behind each vehicle.</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-award"></i>
                    <h3>Award-Winning Curation</h3>
                    <p>Recognized for our outstanding selection and presentation of rare and significant automobiles.</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-map-marker-alt"></i>
                    <h3>Prime Location</h3>
                    <p>Conveniently located in the heart of the city, easily accessible for locals and tourists alike.</p>
                </div>
            </div>
        </section>

        <section>
            <h2>Featured Exhibits</h2>
            <div class="grid three-columns">
                <div class="exhibit-card">
                    <img src="https://via.placeholder.com/400x200?text=Classic+Elegance" alt="Classic Elegance">
                    <h3>Classic Elegance</h3>
                    <p>Step back in time with our collection of pristine vintage automobiles from the 1920s to 1960s.</p>
                </div>
                <div class="exhibit-card">
                    <img src="https://via.placeholder.com/400x200?text=Supercar+Showcase" alt="Supercar Showcase">
                    <h3>Supercar Showcase</h3>
                    <p>Experience the pinnacle of automotive performance with our rotating display of modern supercars.</p>
                </div>
                <div class="exhibit-card">
                    <img src="https://via.placeholder.com/400x200?text=Concept+Car+Corner" alt="Concept Car Corner">
                    <h3>Concept Car Corner</h3>
                    <p>Glimpse into the future of automotive design with our exhibit of groundbreaking concept vehicles.</p>
                </div>
            </div>
        </section>

        <section class="cta">
            <h2>Ready to Experience Automotive Excellence?</h2>
            <p>Visit LuxeDrive Gallery today and immerse yourself in the world of extraordinary vehicles.</p>
            <a href="#" class="btn btn-primary">Plan Your Visit</a>
            <a href="#" class="btn btn-secondary">Contact Us</a>
        </section>
    </main>
    <script src="main.js"></script>
</body>

</html>