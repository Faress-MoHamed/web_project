<?php
require_once __DIR__ . '/db/auth.php';

$message = '';
$messageType = '';
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['email'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        try {
            $message = forgetPassword($email);
            $_SESSION["email"]=$email;
            $messageType = 'success';
            header("Location: signOtp.php");
            exit();
        } catch (Exception $e) {
            $message = "An error occurred: " . $e->getMessage();
            $messageType = 'error';
        }
    } else {
        $message = "Invalid email format";
        $messageType = 'error';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <h1 class="text-2xl font-bold mb-6 text-center">Forgot Password</h1>
        
        <?php if ($message): ?>
            <div class="mb-4 p-4 rounded <?php echo $messageType === 'success' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="forgetPassword.php" class="space-y-4">
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Enter your email to reset password:</label>
                <input type="email" id="email" name="email" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Send OTP
            </button>
        </form>
    </div>
</body>
</html>

