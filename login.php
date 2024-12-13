<?php
require_once __DIR__ . "/db/auth.php";
session_start();

if (strpos($_SERVER['REQUEST_URI'], "/login.php") && isset($_SESSION["username"])) {
    header("Location: index.php");
    exit();
}


  if(isset($_POST["login_btn"])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    echo $email, $password;
    loginUser($email ,$password );
    echo "user inserted";
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Page</title>
    <link rel="stylesheet" href="login.css" />
  </head>
  <body>
    <div class="container">
      <div class="left-bar">
        <div class="login-form">
          <h1>Login</h1>
          <form action="login.php" method="post">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required /><br /><br />

            <label for="password">Password:</label>
            <input
              type="password"
              id="password"
              name="password"

              required
            /><br /><br />

            <button type="submit" class="login-btn" name="login_btn">Login</button><br /><br />

            <a href="forgetpass.php" class="forgot-password">Forgot Password?</a><br /><br />

            <span
              >Don't have an account?
              <a href="signup.php" class="create-account"
                >Create Account</a
              ></span
            >
          </form>
        </div>
      </div>

      <div class="right-bar">
        <img src="img/front-car-lights-night-road.jpg" alt="Car Photo" />
      </div>
    </div>
  </body>
</html>
