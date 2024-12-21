<?php 
require_once __DIR__ . "/connection.php";

function SignNewUser($name, $email, $phone, $password, $role, $pin_code) {
    // Connect to the database
    $conn = dataBase_connect();

    // Check if email already exists
    $stmt = mysqli_prepare($conn, "SELECT Email FROM users WHERE Email=?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) > 0) {
        return "Email already exists. Please use a different email or login.";
    }

    // Insert new user
    $stmt = mysqli_prepare($conn, "INSERT INTO users (Username, Email, pass, Phone, Role, pin_code) VALUES (?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssssss", $name, $email, $password, $phone, $role, $pin_code);

    if (mysqli_stmt_execute($stmt)) {
        // Start a session and assign values
        session_start();
        $_SESSION['username'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['role'] = $role;

        return true;
    } else {
        // Handle query error
        return "Error: " . mysqli_error($conn);
    }
}
function generateToast($message, $type = 'info') {
    $types = [
        'success' => '#4CAF50',
        'error' => '#F44336',
        'warning' => '#FF9800',
        'info' => '#2196F3'
    ];
    $color = $types[$type] ?? '#2196F3';
    
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            showToast('" . htmlspecialchars($message, ENT_QUOTES) . "', '$color');
        });
    </script>";
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

    // Check if a user is found
    if (count($rows) > 0) {
        $user = $rows[0]; // Use the first row as the user

        // Verify the hashed password
        if (password_verify($password, $user['pass'])) {
            // Start the session and store user data
            $_SESSION['username'] = $user['Username'];
            $_SESSION['email'] = $user['Email'];
            $_SESSION['role'] = $user['Role'];

            // Redirect to a dashboard or home page
            // header("Location: index.php");
            // exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "User not found.";
    }

    // Close the statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

        return true;

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


function forgetPassword($email) {
    // Connect to the database
    $conn = dataBase_connect();

    // Check if the email exists in the database
    $stmt = mysqli_prepare($conn, "SELECT Email FROM users WHERE Email = ?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        // Generate a 6-digit OTP
        $otp = rand(100000, 999999);

        // Update the OTP in the database
        $stmt = mysqli_prepare($conn, "UPDATE users SET otp = ? WHERE Email = ?");
        mysqli_stmt_bind_param($stmt, "is", $otp, $email);
        if (mysqli_stmt_execute($stmt)) {
            // Send OTP to email
            if (sendOtpEmail($email, $otp)) {
                return "OTP has been sent to your email.";
            } else {
                return "Failed to send OTP. Please try again.";
            }
        } else {
            return "Error updating OTP: " . mysqli_error($conn);
        }
    } else {
        return "Email not found. Please check and try again.";
    }
}

function sendOtpEmail($email, $otp) {
    // Use PHP's mail function or an external library like PHPMailer
    $subject = "Password Reset OTP";
    $message = "Your OTP for password reset is: " . $otp;
    $headers = "From: fareess.mohameedd@gmail.com\r\n" .
               "Reply-To: noreply@yourdomain.com\r\n" .
               "X-Mailer: PHP/" . phpversion();

    return mail($email, $subject, $message, $headers);
}





