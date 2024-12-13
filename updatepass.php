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
          <form action="<?php echo updatepass();?>"method="post">
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" required /><br /><br />

            <label for="password">New password:</label>
            <input type="password" id="password" name="password" required /><br /><br />

      
            <button type="submit" class="login-btn" name="btn">change</button
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
