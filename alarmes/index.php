<?php
require_once '../includes/db.php';

// Buscar alarmes com nome do equipamento associado
$query = "
    SELECT a.*, e.nome AS equipamento_nome 
    FROM alarmes a
    JOIN equipamentos e ON a.equipamento_id = e.id
    ORDER BY a.id DESC
";

$stmt = $pdo->query($query);
$alarmes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Alarmes</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
  <h1>Alarmes</h1>
  <a href="create.php" class="btn btn-primary mb-3">Cadastrar Alarme</a>
  <a href="../index.php" class="btn btn-secondary mb-3">Voltar ao Início</a>

  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Descrição</th>
        <th>Classificação</th>
        <th>Equipamento</th>
        <th>Status</th>
        <th>Data de Cadastro</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($alarmes as $alarme): ?>
        <tr>
          <td><?= $alarme['id'] ?></td>
          <td><?= htmlspecialchars($alarme['descricao']) ?></td>
          <td><?= $alarme['classificacao'] ?></td>
          <td><?= $alarme['equipamento_nome'] ?></td>
          <td><?= $alarme['status'] === 'on' ? 'Ativo' : 'Inativo' ?></td>
          <td><?= $alarme['data_cadastro'] ?></td>
          <td>
            <?php if ($alarme['status'] === 'off'): ?>
              <a href="toggle.php?id=<?= $alarme['id'] ?>&action=on" class="btn btn-sm btn-success">Ativar</a>
            <?php else: ?>
              <a href="toggle.php?id=<?= $alarme['id'] ?>&action=off" class="btn btn-sm btn-secondary">Desativar</a>
            <?php endif; ?>

            <a href="edit.php?id=<?= $alarme['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
            <a href="delete.php?id=<?= $alarme['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?')">Excluir</a>
          </td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</body>
</html>
