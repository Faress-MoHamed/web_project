<?php
require_once __DIR__ . "/db/carsFetch.php";
session_start();
$result = getAllCars();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css?v0.1" />

    <title>My Car Collection</title>
    <style>
        .container {
          margin-top: 50px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .car-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px;
        }
        .car-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
        }
        .car-card:hover {
            transform: translateY(-5px);
        }
        .car-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .car-info {
            padding: 15px;
        }
        .car-name {
            font-size: 1.2em;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }
        .color-container{
          display: flex;
          align-items: center;
          gap: 10px;
          color: black;
        }
        .car-color{
          width: 50px;
          height: 20px;
          border-radius: 5px;
        }
        .car-details {
            font-size: 0.9em;
            color: #666;
        }
        .price {
            font-size: 1.1em;
            font-weight: bold;
            color: #4CAF50;
            margin-top: 10px;
        }
        .stock {
            font-size: 0.9em;
            color: #999;
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
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="cars.php">Cars</a></li>
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
  <div class="container">
    <h1>My Car Collection</h1>
    <div class="car-grid">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="car-card">';
                echo '<img src="' . htmlspecialchars($row["car_photo"]) . '" alt="' . htmlspecialchars($row["car_name"]) . '" class="car-image">';
                echo '<div class="car-info">';
                echo '<div class="car-name">' . htmlspecialchars($row["car_name"]) . '</div>';
                echo '<div class="car-details">';
                echo 'Color:<div class="color-container"> <div class="car-color" style="background:'.$row["color"].';"></div>'.htmlspecialchars($row["color"]).'</div> <br>';
                echo 'Year: ' . htmlspecialchars($row["model_year"]);
                echo '</div>';
                echo '<div class="price">$' . number_format($row["price"], 2) . '</div>';
                echo '<div class="stock">In stock: ' . htmlspecialchars($row["stock"]) . '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "No cars found";
        }
        ?>
        </div>
    </div>
    <script src="main.js"></script>
</body>
</html>