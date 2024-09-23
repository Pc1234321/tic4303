<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = new mysqli("localhost", "root", "root", "tic4303");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // No escaping to demonstrate XSS vulnerability
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $country = $_POST['country'];
    $gender = $_POST['gender'];
    $qualification = $conn->real_escape_string($_POST['qualification']);

    $sql = "INSERT INTO form (name, email, phone, country, gender, qualification) 
            VALUES ('$name', '$email', '$phone', '$country', '$gender', '$qualification')";

    if ($conn->query($sql) === TRUE) {
        // echo for XSS attack test
        echo "Name: " . $name . "<br>";
        echo "Email: " . $email . "<br>";
        echo "Phone: " . $phone . "<br>";
        echo "Country: " . $country . "<br>";
        echo "Gender: " . $gender . "<br>";
        echo "Qualification: " . $qualification . "<br>";
        echo "<script>
            setTimeout(function(){
                window.location.href = 'logout.php';
            }, 0);
        </script>";

        exit();
    } else {
        echo "Error submitting form!";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Main</title>
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
        .form-container {
            text-align: center;
            padding: 30px;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            width: 400px; 
        }
        input, select {
            margin: 10px 0;
            padding: 10px;
            width: calc(100% - 22px);
            border-radius: 5px;
            border: 1px solid #ccc;
            background-color: #e9e9f0;
            box-sizing: border-box;
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
        .submit-button {
            background-color: #28a745;
            color: white;
        }
        .submit-button:hover {
            background-color: #218838;
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
    <div class="form-container">
        <h2>Main Page</h2>
        <form method="POST" action="main.php">
            Name: <input type="text" name="name" required><br>
            Email: <input type="email" name="email" required><br>
            Phone: <input type="text" name="phone" required><br>
            Country: <input type="text" name="country" required><br>
            Gender: 
            <select name="gender" required>
                <option value="" disabled selected>Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select><br>
            Qualification: 
            <select name="qualification" required>
                <option value="" disabled selected>Select Qualification</option>
                <option value="PSLE">PSLE</option>
                <option value="O-Level">O-Level</option>
                <option value="A-Level">A-Level</option>
                <option value="Diploma">Diploma</option>
                <option value="N-Level">N-Level</option>
                <option value="S-Level">S-Level</option>
                <option value="NITEC">NITEC</option>
                <option value="Higher NITEC">Higher NITEC</option>
                <option value="Bachelor's Degree">Bachelor's Degree</option>
                <option value="Master's Degree">Master's Degree</option>
                <option value="PhD">PhD</option>
            </select><br>
            <input type="submit" value="Submit" class="button submit-button">
        </form>
        <button class="button logout-button" onclick="window.location.href='login.php';">Logout</button>
    </div>
</body>
</html>