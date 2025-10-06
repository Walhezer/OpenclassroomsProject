<?php
function connexion(
  string $host='localhost',
  string $db='artbox',
  string $user='root',
  string $pass=''
): PDO {
  $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
  $options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
  ];
  try {
    return new PDO($dsn, $user, $pass, $options);
  } catch (PDOException $e) {
    // En prod: log + relancer une exception générique
    throw new RuntimeException('Impossible de se connecter à la base.', 0, $e);
  }
}