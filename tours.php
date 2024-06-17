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
            t.id, 
            t.name, 
            t.duration, 
            t.price, 
            t.start_location, 
            t.end_location,
            i.src AS img_src, 
            i.alt AS img_alt
        FROM tours t
        JOIN img i ON t.id = i.tour_id
        WHERE i.alt = 'tour-cover'
    ");
    $stmt->execute();
    $tours = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Замінюємо зворотні слеші на прямі
    foreach ($tours as &$tour) {
        $tour['img_src'] = str_replace('\\', '/', $tour['img_src']);
    }

    echo json_encode($tours);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>