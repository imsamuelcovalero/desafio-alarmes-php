<?php
require_once '../includes/db.php';

$id = $_GET['id'] ?? null;
$action = $_GET['action'] ?? null;

if (!$id || !in_array($action, ['on', 'off'])) {
    header('Location: index.php');
    exit;
}

// Buscar o alarme
$stmt = $pdo->prepare("SELECT * FROM alarmes WHERE id = ?");
$stmt->execute([$id]);
$alarme = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$alarme) {
    header('Location: index.php');
    exit;
}

try {
    if ($action === 'on' && $alarme['status'] === 'off') {
        // Ativar alarme
        $pdo->prepare("UPDATE alarmes SET status = 'on' WHERE id = ?")->execute([$id]);
        $pdo->prepare("INSERT INTO atuacoes (alarme_id) VALUES (?)")->execute([$id]);

        // Simula envio de e-mail para alarmes Urgentes
        if ($alarme['classificacao'] === 'Urgente') {
            if (!file_exists('../logs')) {
                mkdir('../logs', 0777, true);
            }
            file_put_contents('../logs/emails.log', "[URGENTE] Alarme ativado: {$alarme['descricao']}\n", FILE_APPEND);
        }

    } elseif ($action === 'off' && $alarme['status'] === 'on') {
        // Desativar alarme
        $pdo->prepare("UPDATE alarmes SET status = 'off' WHERE id = ?")->execute([$id]);
        $pdo->prepare("UPDATE atuacoes SET data_saida = NOW() WHERE alarme_id = ? AND data_saida IS NULL")->execute([$id]);
    }

    // Redireciona de volta
    header('Location: index.php');
    exit;

} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
