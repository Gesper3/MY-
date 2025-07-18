<?php
session_start();

// Database Connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "trip_planner";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

header('Content-Type: application/json');

// Register User
if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    // Insert user into database
    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
    if ($conn->query($sql)) {
        echo json_encode(['status' => 'success', 'message' => 'Registration successful!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => $conn->error]);
    }
    exit();
}

// Login User
if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    
    // Retrieve user from database
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            echo json_encode(['status' => 'success', 'message' => 'Login successful!', 'user_id' => $user['id']]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid password.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'User not found.']);
    }
    exit();
}

// Create Trip
if (isset($_POST['create_trip'])) {
    $trip_name = mysqli_real_escape_string($conn, $_POST['trip_name']);
    $destination = mysqli_real_escape_string($conn, $_POST['destination']);
    $travel_dates = $_POST['travel_dates'];
    $budget = $_POST['budget'];
    $user_id = $_SESSION['user_id'];
    
    // Insert trip into database
    $sql = "INSERT INTO trips (user_id, trip_name, destination, travel_dates, budget) VALUES ('$user_id', '$trip_name', '$destination', '$travel_dates', '$budget')";
    if ($conn->query($sql)) {
        echo json_encode(['status' => 'success', 'message' => 'Trip created successfully!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => $conn->error]);
    }
    exit();
}

// Fetch User Trips
if (isset($_GET['fetch_trips'])) {
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM trips WHERE user_id='$user_id'";
    $result = $conn->query($sql);
    $trips = [];
    
    // Fetch trips and store in array
    while ($row = $result->fetch_assoc()) {
        $trips[] = $row;
    }
    echo json_encode(['status' => 'success', 'trips' => $trips]);
    exit();
}

// Close database connection
$conn->close();
?>
