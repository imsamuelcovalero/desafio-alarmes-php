<?php
require_once '../includes/db.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $pdo->prepare("DELETE FROM equipamentos WHERE id = ?");
    $stmt->execute([$id]);
}

header('Location: index.php');
exit;
