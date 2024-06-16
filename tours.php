<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

$host = '127.0.0.1:3308';
$dbname = 'tour_database';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("
        SELECT 
            tt.id, 
            tt.name, 
            tt.duration, 
            tt.price, 
            tt.start_location, 
            tt.end_location,
            REPLACE(ti.src, '\\\\', '/') AS img_src, 
            ti.alt AS img_alt
        FROM travel_tours tt
        JOIN tours_img ti ON tt.id = ti.tour_id
        WHERE ti.alt = 'tour-cover'
    ");
    $stmt->execute();
    $tours = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($tours);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
