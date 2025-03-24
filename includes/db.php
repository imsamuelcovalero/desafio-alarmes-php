<?php
$host = 'db';
$dbname = 'desafio_php';
$username = 'user';
$password = 'secret';

try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Erro: " . $e->getMessage());
}