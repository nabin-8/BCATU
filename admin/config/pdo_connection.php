<?php

$serverName = "localhost";
$userName = "root";
$password = "";

try {
  $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ);
  $pdo = new PDO("mysql:host=$serverName;dbname=bcatu_db", $userName, $password, $options);

  return $pdo;
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
