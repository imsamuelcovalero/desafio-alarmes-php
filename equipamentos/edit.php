<?php
require_once '../includes/db.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM equipamentos WHERE id = ?");
$stmt->execute([$id]);
$equipamento = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$equipamento) {
    echo "Equipamento não encontrado.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $numero_serie = $_POST['numero_serie'] ?? '';
    $tipo = $_POST['tipo'] ?? '';

    if ($nome && $numero_serie && $tipo) {
        $update = $pdo->prepare("UPDATE equipamentos SET nome = ?, numero_serie = ?, tipo = ? WHERE id = ?");
        $update->execute([$nome, $numero_serie, $tipo, $id]);
        header('Location: index.php');
        exit;
    } else {
        $erro = "Preencha todos os campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Editar Equipamento</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
  <h1>Editar Equipamento</h1>

  <a href="index.php" class="btn btn-secondary mb-3">← Voltar</a>

  <?php if (!empty($erro)): ?>
    <div class="alert alert-danger"><?= $erro ?></div>
  <?php endif ?>

  <form method="POST">
    <div class="mb-3">
      <label for="nome" class="form-label">Nome</label>
      <input type="text" class="form-control" name="nome" id="nome" required value="<?= htmlspecialchars($equipamento['nome']) ?>">
    </div>

    <div class="mb-3">
      <label for="numero_serie" class="form-label">Número de Série</label>
      <input type="text" class="form-control" name="numero_serie" id="numero_serie" required value="<?= htmlspecialchars($equipamento['numero_serie']) ?>">
    </div>

    <div class="mb-3">
      <label for="tipo" class="form-label">Tipo</label>
      <select name="tipo" id="tipo" class="form-select" required>
        <option value="">Selecione</option>
        <option value="Tensão" <?= $equipamento['tipo'] === 'Tensão' ? 'selected' : '' ?>>Tensão</option>
        <option value="Corrente" <?= $equipamento['tipo'] === 'Corrente' ? 'selected' : '' ?>>Corrente</option>
        <option value="Óleo" <?= $equipamento['tipo'] === 'Óleo' ? 'selected' : '' ?>>Óleo</option>
      </select>
    </div>

    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
  </form>
</body>
</html>
