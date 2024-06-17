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
            e.id, 
            e.name, 
            e.location, 
            e.duration, 
            e.price, 
            i.src AS img_src, 
            i.alt AS img_alt
        FROM excursions e
        JOIN img i ON e.id = i.excursion_id
        WHERE i.alt = 'excursion-cover'
    ");
    $stmt->execute();
    $excursions = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Замінюємо зворотні слеші на прямі
    foreach ($excursions as &$excursion) {
        $excursion['img_src'] = str_replace('\\', '/', $excursion['img_src']);
    }

    echo json_encode($excursions);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
