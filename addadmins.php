<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Admins</title>
    <link rel="stylesheet" href="add_admins.css" />
  </head>
  <body>
    <!-- Navigation Bar -->
    <nav class="navbar">
      <div class="nav-content">
        <span class="admin-user">Welcome, Admin</span>
        <button class="logout-btn" onclick="logout()">Log Out</button>
      </div>
    </nav>

    <!-- Main Content -->
    <div class="main-container">
      <!-- Left Side: Visuals -->
      
      <div class="right-container">
        <h1>Add Admin Details</h1>
        <?php
                require 'dbconnect.php';
        ?>
        <form id="admin-form" method="post" action="<?php echo AddAdmins();?>">
          <label for="admin-name">Admin Name:</label>
          <input type="text" id="admin-name" name="admin-name" required />
          <label for="phone">Phone:</label>
        <input 
          type="tel" 
          id="phone" 
          name="phone" 
          minlength="11" 
          pattern="[0-9]{11,}" 
          title="Please enter a valid phone number (only digits allowed)" 
          required >

          <label for="admin-email">Email:</label>
          <input type="email" id="admin-email" name="admin-email" required />

          <label for="admin-password">Password:</label>
          <input
            type="password"
            id="admin-password"
            name="admin-password"
            minlength="8"
            required
          />

          <button type="submit" name="sub_btn">Add Admin</button>
        </form>
      </div>
    </div>

    <script>
      // Logout functionality
      function logout() {
        window.location.href = "login.php";
      }

      // Handle form submission
      // document
      //   .getElementById("admin-form")
      //   .addEventListener("submit", function (event) {
      //     event.preventDefault();
      //     alert("Admin details added successfully!");
      //   });
    </script>
  </body>
</html>
