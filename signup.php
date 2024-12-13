<?php
require_once __DIR__. "/db/auth.php";
if(isset($_POST["signUp_btn"])){
    $name = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $pin_code = $_POST['pincode'];
    $role = 'user';
    
    SignNewUser($name, $email ,$phone,$password ,$pin_code , $role);
    echo "user inserted";
}
?>
<?php 

// function signup(){
//     if(isset($_POST['btn'])){
//         $name = $_POST['username'];
//         $email = $_POST['email'];
//         $phone = $_POST['phone'];
//         $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password
//         $pin_code = $_POST['pincode'];
//         $role = 'user'; // Assign a variable for 'user'

//         // Establish database connection
//         $con = mysqli_connect("localhost", "root", "", "webbbbbb", 4306);
//         if(!$con) {
//             die("Connection failed: " . mysqli_connect_error());
//         }

//         // Check if email exists
//         $stmt = mysqli_prepare($con, "SELECT Email FROM users WHERE Email=?");
//         mysqli_stmt_bind_param($stmt, "s", $email);
//         mysqli_stmt_execute($stmt);
//         $result = mysqli_stmt_get_result($stmt);
//         if(mysqli_num_rows($result) > 0) {
//             echo "Email already exists"; 
//             header('location:login.php');
//             exit();
//         }

//         // Insert data using prepared statement
//         $stmt = mysqli_prepare($con, "INSERT INTO users (Username, Email, pass, Phone, Role, pin_code) VALUES (?, ?, ?, ?, ?, ?)");
//         mysqli_stmt_bind_param($stmt, "ssssss", $name, $email, $password, $phone, $role, $pin_code);
//         mysqli_stmt_execute($stmt);
//          $user  =mysqli_stmt_get_result($stmt);
//         if (!mysqli_stmt_execute($stmt)) {
//             die("Error: " . mysqli_error($con));
//         }
//         echo $user;
//         $_SESSION["user"]=$user;
//         // Redirect to index
//         header('location:index.php');
//         exit();
//     }
// }


// signup(); // Call the signup function to handle form submissions
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Page</title>
    <link rel="stylesheet" href="signup.css">
</head>
<body>
    <div class="container">
        <div class="left-bar">
            <div class="signup-form">
                <h1>Sign Up</h1>
                <form action="signup.php" method="post">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required><br><br>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required><br><br>
                    <label for="phone">Phone:</label>
                    <input type="tel" id="phone" name="phone" minlength="11" pattern="[0-9]{11,}" title="Please enter a valid phone number (only digits allowed)" required><br><br>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" minlength="8" required><br><br>
                    <label for="pincode">PinCode:</label>
                    <input type="text" id="pincode" name="pincode" required><br><br>
                    <button type="submit" class="signup-btn" name="signUp_btn">Sign Up</button><br><br>
                    <span>Already have an account? <a href="login.php" class="login-link">Login</a></span>
                </form>
            </div>
        </div>
        <div class="right-bar">
            <img src="img/front-car-lights-night-road.jpg" alt="Car Photo">
        </div>
    </div>
</body>
</html>
