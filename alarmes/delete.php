<?php
require_once '../includes/db.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $pdo->prepare("DELETE FROM alarmes WHERE id = ?");
    $stmt->execute([$id]);
}

header('Location: index.php');
exit;
