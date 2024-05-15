<?php
require_once '../../config/pdo_connection.php';

// Fetch data from database
$sql = "SELECT * FROM community ORDER BY id DESC";
$stmt = $conn->query($sql);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return data as JSON
echo json_encode($data);
