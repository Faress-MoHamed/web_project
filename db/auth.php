<?php 
require_once __DIR__ . "/connection.php";

function SignNewUser($name, $email ,$phone,$password ,$pin_code , $role){
        $conn = dataBase_connect();
        $stmt = mysqli_prepare($conn, "SELECT Email FROM users WHERE Email=?");
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if(mysqli_num_rows($result) > 0) {
            echo "Email already exists"; 
            header('location:login.php');
            exit();
        }

  $stmt = mysqli_prepare($conn, "INSERT INTO users (Username, Email, pass, Phone, Role, pin_code) VALUES (?, ?, ?, ?, ?, ?)");

  mysqli_stmt_bind_param($stmt,"ssssss",$name, $email ,$password ,$phone,$pin_code , $role);
  mysqli_stmt_execute($stmt);
}


function loginUser($email, $password) {
    $conn = dataBase_connect();

    // Prepare the SQL statement
    $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE Email = ?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (!$result) {
        echo "Query failed: " . mysqli_error($conn);
        return;
    }

    // Debugging without affecting the result set
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo "Debugging Rows: " . json_encode($rows);

    // Check if a user is found
    if (count($rows) > 0) {
        $user = $rows[0]; // Use the first row as the user

        // Verify the hashed password
        if (password_verify($password, $user['pass'])) {
            // Start the session and store user data
            session_start();
            $_SESSION['username'] = $user['Username'];
            $_SESSION['email'] = $user['Email'];
            $_SESSION['role'] = $user['Role'];

            // Redirect to a dashboard or home page
            header("Location: index.php");
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "User not found.";
    }

    // Redirect back to the login page
    header("Location: login.php");
    exit();

    // Close the statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

function logout (){
session_start();

// Destroy the session
session_unset();
session_destroy();

// Redirect to the login page
header("Location: login.php");
exit();
}
