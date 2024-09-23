<?php
session_start();
if (isset($_SESSION['username'])) {
    session_unset();
    session_destroy();
} else {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Logout</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f9;
        }
        .logout-container {
            text-align: center;
            padding: 30px;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        .button {
            border: none;
            border-radius: 25px;
            padding: 10px 20px;
            cursor: pointer;
            margin: 10px 0;
            width: 100%;
            font-size: 16px;
        }
        .logout-button {
            background-color: #dc3545;
            color: white;
        }
        .logout-button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="logout-container">
        <h2>Thank You</h2>
        <p>Your form has been submitted successfully.</p>
        <button class="button logout-button" onclick="window.location.href='login.php';">Logout</button>
    </div>
</body>
</html>