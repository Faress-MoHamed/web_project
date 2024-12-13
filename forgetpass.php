<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Page</title>
    <link rel="stylesheet" href="css/login.css" />
  </head>
  <body>
    <div class="container">
      <div class="left-bar">
        <div class="login-form">
          <?php
                require 'dbconnect.php';
          ?>
          <form action="<?php echo checkemailforforgetpassword();?>"method="post">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required /><br /><br />

            <label for="email">pincode:</label>
            <br><br>
            <input type="text" id="text" name="pincode" required /><br /><br />
            <button type="submit" class="login-btn" name="btn">Forget</button
            ><br /><br />
          </form>
        </div>
      </div>

      <div class="right-bar">
        <img src="img/front-car-lights-night-road.jpg" alt="Car Photo" />
      </div>
    </div>
  </body>
</html>
