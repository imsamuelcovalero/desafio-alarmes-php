<?php
require_once '../includes/db.php';

$erro = '';

// Buscar equipamentos para o select
$equipamentos = $pdo->query("SELECT id, nome FROM equipamentos ORDER BY nome")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $descricao = $_POST['descricao'] ?? '';
    $classificacao = $_POST['classificacao'] ?? '';
    $equipamento_id = $_POST['equipamento_id'] ?? '';

    if ($descricao && $classificacao && $equipamento_id) {
        $stmt = $pdo->prepare("INSERT INTO alarmes (descricao, classificacao, equipamento_id) VALUES (?, ?, ?)");
        $stmt->execute([$descricao, $classificacao, $equipamento_id]);
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
  <title>Cadastrar Alarme</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
  <h1>Cadastrar Alarme</h1>
  <a href="index.php" class="btn btn-secondary mb-3">← Voltar</a>

  <?php if ($erro): ?>
    <div class="alert alert-danger"><?= $erro ?></div>
  <?php endif ?>

  <form method="POST">
    <div class="mb-3">
      <label for="descricao" class="form-label">Descrição</label>
      <input type="text" class="form-control" name="descricao" id="descricao" required>
    </div>

    <div class="mb-3">
      <label for="classificacao" class="form-label">Classificação</label>
      <select name="classificacao" id="classificacao" class="form-select" required>
        <option value="">Selecione</option>
        <option value="Urgente">Urgente</option>
        <option value="Emergente">Emergente</option>
        <option value="Ordinário">Ordinário</option>
      </select>
    </div>

    <div class="mb-3">
      <label for="equipamento_id" class="form-label">Equipamento</label>
      <select name="equipamento_id" id="equipamento_id" class="form-select" required>
        <option value="">Selecione</option>
        <?php foreach ($equipamentos as $e): ?>
          <option value="<?= $e['id'] ?>"><?= htmlspecialchars($e['nome']) ?></option>
        <?php endforeach ?>
      </select>
    </div>

    <button type="submit" class="btn btn-primary">Salvar</button>
  </form>
</body>
</html>
