<?php
require_once '../includes/db.php';

$stmt = $pdo->query("SELECT * FROM equipamentos ORDER BY id DESC");
$equipamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Equipamentos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">

  <h1>Equipamentos</h1>
  <a href="create.php" class="btn btn-primary mb-3 me-2">Cadastrar Equipamento</a>
  <a href="../index.php" class="btn btn-secondary mb-3">Voltar ao Início</a>

  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Número de Série</th>
        <th>Tipo</th>
        <th>Data de Cadastro</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($equipamentos as $eq): ?>
        <tr>
          <td><?= $eq['id'] ?></td>
          <td><?= $eq['nome'] ?></td>
          <td><?= $eq['numero_serie'] ?></td>
          <td><?= $eq['tipo'] ?></td>
          <td><?= $eq['data_cadastro'] ?></td>
          <td>
            <a href="edit.php?id=<?= $eq['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
            <a href="delete.php?id=<?= $eq['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?')">Excluir</a>
          </td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>

</body>
</html>
