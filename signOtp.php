<?php
require_once __DIR__ . "/db/connection.php";
session_start();
$conn = dataBase_connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userOtp = $_POST['otp'] ?? '';
    $newPassword = $_POST['new_password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    if (!empty($userOtp) && empty($newPassword)) {
        // Validate the OTP
        $stmt = mysqli_prepare($conn, "SELECT otp FROM users WHERE Email = ?");
        mysqli_stmt_bind_param($stmt, "s", $_SESSION["email"]);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        echo  $rows[0]["otp"], $userOtp;
        if ($rows && $rows[0]["otp"] == $userOtp) {
            // OTP is valid, allow password reset
            $_SESSION["otp_verified"] = true;
        } else {
            echo "Invalid OTP. Please try again.";
        }
    } elseif (!empty($newPassword) && !empty($confirmPassword)) {
        // Handle password reset
        if ($newPassword === $confirmPassword) {
            if ($_SESSION["otp_verified"] ?? false) {
                // Update the password in the database
                $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
                $stmt = mysqli_prepare($conn, "UPDATE users SET pass = ? WHERE Email = ?");
                mysqli_stmt_bind_param($stmt, "ss", $hashedPassword, $_SESSION["email"]);
                mysqli_stmt_execute($stmt);

                echo "Password reset successful. Please log in.";
                $_SESSION["email"] = "";
                $_SESSION["otp_verified"] = false;
                header("Location: login.php");
                exit();
            } else {
                echo "OTP verification is required before resetting the password.";
            }
        } else {
            echo "Passwords do not match. Please try again.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>
<body>
    <h1>Reset Your Password</h1>
    <?php if (!($_SESSION["otp_verified"] ?? false)): ?>
        <form action="signOtp.php" method="POST">
            <label for="otp">Enter OTP:</label>
            <input type="text" id="otp" name="otp" required>
            <button type="submit">Verify OTP</button>
        </form>
    <?php else: ?>
        <form action="signOtp.php" method="POST">
            <label for="new_password">New Password:</label>
            <input type="password" id="new_password" name="new_password" required>
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
            <button type="submit">Reset Password</button>
        </form>
    <?php endif; ?>
</body>
</html>
