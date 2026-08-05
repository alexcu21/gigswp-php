<?php

header('Content-Type: application/json');

$config = require __DIR__ . '/../config/db.php';

try {
    $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']}";
    $pdo = new PDO($dsn, $config['username'], $config['password'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    $listingCount = (int) $pdo->query('SELECT COUNT(*) FROM listings')->fetchColumn();

    echo json_encode([
        'status' => 'ok',
        'database' => $config['dbname'],
        'listings' => $listingCount,
    ]);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage(),
    ]);
}
