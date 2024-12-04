<?php
// Database connection variables
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "portfolio_db"; // Replace with your database name

// Establish a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = ""; // Initialize message variable

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $messageText = htmlspecialchars($_POST["message"]);

    // Insert data into the database
    $sql = "INSERT INTO contacts (name, email, message) VALUES ('$name', '$email', '$messageText')";

    if ($conn->query($sql) === TRUE) {
        $message = "Message sent successfully!";
    } else {
        $message = "Error: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Status</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMAREfK7cX0jLX1Y+t9K9fF5Q6f0k8tFXwAa" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f3f3;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: linear-gradient(135deg, #4caf50, #81c784);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            text-align: center;
            color: #fff;
            animation: popup-fadein 0.5s ease-out;
            z-index: 1000;
        }
        .popup h2 {
            font-size: 24px;
            margin: 10px 0;
        }
        .popup .icon {
            font-size: 50px;
            margin-bottom: 15px;
            color: #fff;
        }
        .popup button {
            margin-top: 15px;
            padding: 10px 20px;
            background: #ffffff;
            color: #4caf50;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s ease, color 0.3s ease;
        }
        .popup button:hover {
            background: #4caf50;
            color: #fff;
        }
        #overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: 999;
        }
        @keyframes popup-fadein {
            from {
                opacity: 0;
                transform: translate(-50%, -60%);
            }
            to {
                opacity: 1;
                transform: translate(-50%, -50%);
            }
        }
    </style>
</head>
<body>
    <div id="overlay"></div>
    <div class="popup" id="popup">
        <i class="fas fa-check-circle icon"></i>
        <h2><?php echo $message; ?></h2>
        <button onclick="closePopup()">Close</button>
    </div>

    <script>
        const popup = document.getElementById("popup");
        const overlay = document.getElementById("overlay");

        // Show popup if there's a message
        <?php if (!empty($message)): ?>
            popup.style.display = "block";
            overlay.style.display = "block";
        <?php endif; ?>

        // Close popup function
        function closePopup() {
            popup.style.animation = "popup-fadeout 0.3s ease-out";
            overlay.style.display = "none";
            setTimeout(() => {
                popup.style.display = "none";
                window.location.href = "index.html"; // Redirect to main page
            }, 300);
        }
    </script>
</body>
</html>
