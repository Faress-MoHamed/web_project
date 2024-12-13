<?php
// Include the database connection
require_once __DIR__ . "/db/connection.php"; // Adjust the path as needed
require_once __DIR__ . "/db/auth.php"; // Adjust the path as needed
require_once __DIR__ . "/components/navBar.php"; // Adjust the path as needed

// Start session
session_start();
$conn = dataBase_connect();



// Check if logout button is clicked
if (isset($_POST['logout'])) {
    logout(); // Call the logout function from auth.php
}


// Redirect if the user is not an admin
if (stripos($_SERVER['REQUEST_URI'], "/add_cars.php") !== false &&
    (strtolower($_SESSION["role"]) !== "admin")) {
    header("Location: index.php");
    exit();
}

// Handle form submission for add/update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $carId = isset($_POST['car-id']) ? intval($_POST['car-id']) : null;
    $carName = $_POST['car-name'];
    $carColor = $_POST['car-color'];
    $modelYear = intval($_POST['model-year']);
    $price = floatval($_POST['price']);
    $stocks = intval($_POST['no-of-stocks']);

    if ($carId) {
        // Update existing car
        $query = "UPDATE cars SET car_name = ?, color = ?, model_year = ?, price = ?, stock = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssddii", $carName, $carColor, $modelYear, $price, $stocks, $carId);
        $stmt->execute();
    } else {
        // Add new car
        $query = "INSERT INTO cars (car_name, color, model_year, price, stock) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssddi", $carName, $carColor, $modelYear, $price, $stocks);
        $stmt->execute();
    }
    header("Location: add_cars.php"); // Refresh the page
    exit();
}

// Handle delete request
if (isset($_GET['delete'])) {
    $carId = intval($_GET['delete']);
    $query = "DELETE FROM cars WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $carId);
    $stmt->execute();
    header("Location: add_cars.php"); // Refresh the page
    exit();
}

// Fetch all cars
$query = "SELECT * FROM cars";
$result = $conn->query($query);
$cars = $result->fetch_all(MYSQLI_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Manage Cars</title>
    <link rel="stylesheet" href="style.css" />

    <style>
      body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f9f9f9;
}


.layout {
    padding: 20px;
    display: flex;
    gap: 30px;
}

.car-cards {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    width: 60%;
}

.car-card {
    border: 1px solid #ddd;
    padding: 10px;
    width: 200px;
    text-align: center;
    border-radius: 5px;
    background-color: white;
}

.car-card button,
.car-card a {
    display: block;
    margin-top: 10px;
    text-decoration: none;
    color: white;
    background-color: blue;
    padding: 5px;
    border-radius: 5px;
    text-align: center;
}

.right-container {
    flex-grow: 1;
}

form label {
    display: block;
    margin: 10px 0 5px;
}

form input,
form button {
    display: block;
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

form button {
    background-color: green;
    color: white;
    border: none;
}

    </style>
  </head>
<body>
  <?php
   renderNavbar($_SESSION);
?>

    <div class="layout">
      <!-- Car Cards -->
      <div class="car-cards">
        <?php foreach ($cars as $car): ?>
          <div class="car-card">
            <img src="'<?php $car['car_photo']?>'" >
            <h3><?= htmlspecialchars($car['car_name']) ?></h3>
            <p>Model Year: <?= htmlspecialchars($car['model_year']) ?></p>
            <p>Color: <span style="background-color:<?= htmlspecialchars($car['color']) ?>;">&nbsp;&nbsp;&nbsp;</span></p>
            <p>Price: $<?= htmlspecialchars($car['price']) ?></p>
            <p>Stocks: <?= htmlspecialchars($car['stock']) ?></p>
            <button onclick="editCar(<?= htmlspecialchars(json_encode($car)) ?>)">Edit</button>
            <a href="?delete=<?= $car['id'] ?>" onclick="return confirm('Are you sure you want to delete this car?');">Delete</a>
          </div>
        <?php endforeach; ?>
      </div>

      <!-- Right Side: Form -->
      <div class="right-container">
        <h1 id="form-title">Add Car Details</h1>
        <form id="car-form" action="" method="POST">
          <input type="hidden" id="car-id" name="car-id" />
          <label for="car-name">Car Name:</label>
          <input type="text" id="car-name" name="car-name" required />

          <label for="car-color">Color:</label>
          <input type="color" id="car-color" name="car-color" required />

          <label for="model-year">Model Year:</label>
          <input type="number" id="model-year" name="model-year" required />

          <label for="price">Price:</label>
          <input type="number" id="price" name="price" step="0.01" required />

          <label for="no-of-stocks">Number of Stocks:</label>
          <input type="number" id="no-of-stocks" name="no-of-stocks" required />

          <button type="submit">Save</button>
        </form>
      </div>
    </div>

    <script>
      // JavaScript for Editing a Car
      function editCar(car) {
        document.getElementById("form-title").innerText = "Edit Car Details";
        document.getElementById("car-id").value = car.id;
        document.getElementById("car-name").value = car.car_name;
        document.getElementById("car-color").value = car.color;
        document.getElementById("model-year").value = car.model_year;
        document.getElementById("price").value = car.price;
        document.getElementById("no-of-stocks").value = car.stock;
        document.getElementById("car-form").scrollIntoView({ behavior: "smooth" });
      }
    </script>
    <script src="main.js"></script>
  </body>
</html>
