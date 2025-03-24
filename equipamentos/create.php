<?php
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $numero_serie = $_POST['numero_serie'] ?? '';
    $tipo = $_POST['tipo'] ?? '';

    if ($nome && $numero_serie && $tipo) {
        $stmt = $pdo->prepare("INSERT INTO equipamentos (nome, numero_serie, tipo) VALUES (?, ?, ?)");
        $stmt->execute([$nome, $numero_serie, $tipo]);
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
  <title>Cadastrar Equipamento</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
  <h1>Cadastrar Equipamento</h1>

  <a href="index.php" class="btn btn-secondary mb-3">← Voltar</a>

  <?php if (!empty($erro)): ?>
    <div class="alert alert-danger"><?= $erro ?></div>
  <?php endif ?>

  <form method="POST">
    <div class="mb-3">
      <label for="nome" class="form-label">Nome</label>
      <input type="text" class="form-control" name="nome" id="nome" required>
    </div>

    <div class="mb-3">
      <label for="numero_serie" class="form-label">Número de Série</label>
      <input type="text" class="form-control" name="numero_serie" id="numero_serie" required>
    </div>

    <div class="mb-3">
      <label for="tipo" class="form-label">Tipo</label>
      <select name="tipo" id="tipo" class="form-select" required>
        <option value="">Selecione</option>
        <option value="Tensão">Tensão</option>
        <option value="Corrente">Corrente</option>
        <option value="Óleo">Óleo</option>
      </select>
    </div>

    <button type="submit" class="btn btn-primary">Salvar</button>
  </form>
</body>
</html>
