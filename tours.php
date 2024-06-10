<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$servername = "127.0.0.1:3308";
$username = "root";
$password = "";
$dbname = "tour_database";

// Створення підключення
$conn = new mysqli($servername, $username, $password, $dbname);

// Перевірка підключення
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Виконання SQL запиту
$sql = "SELECT id, name, image_path FROM tours";
$result = $conn->query($sql);

$tours = array();

if ($result->num_rows > 0) {
    // Виведення даних кожного рядка
    while($row = $result->fetch_assoc()) {
        $tours[] = $row;
    }
} else {
    echo json_encode(array("message" => "No tours found."));
}

echo json_encode($tours);

$conn->close();
?>
