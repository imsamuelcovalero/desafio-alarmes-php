<?php
require_once '../includes/db.php';

// Filtro por descrição
$filtroDescricao = $_GET['descricao'] ?? '';

// Ordenação
$colunasOrdenaveis = ['descricao', 'classificacao', 'nome', 'data_entrada', 'data_saida'];
$ordenarPor = in_array($_GET['ordenar'] ?? '', $colunasOrdenaveis) ? $_GET['ordenar'] : 'data_entrada';
$direcao = ($_GET['direcao'] ?? 'DESC') === 'ASC' ? 'ASC' : 'DESC';

// Buscar atuações
$query = "
    SELECT a.id, a.data_entrada, a.data_saida, al.descricao, al.classificacao, e.nome,
           al.status
    FROM atuacoes a
    JOIN alarmes al ON a.alarme_id = al.id
    JOIN equipamentos e ON al.equipamento_id = e.id
    WHERE al.descricao LIKE :descricao
    ORDER BY $ordenarPor $direcao
";

$stmt = $pdo->prepare($query);
$stmt->execute(['descricao' => "%$filtroDescricao%"]);
$atuacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Top 3 alarmes mais atuados
$top3 = $pdo->query("
    SELECT al.descricao, COUNT(*) as total
    FROM atuacoes a
    JOIN alarmes al ON a.alarme_id = al.id
    GROUP BY al.descricao
    ORDER BY total DESC
    LIMIT 3
")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Alarmes Atuados</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .table th a { text-decoration: none; color: inherit; }
  </style>
</head>
<body class="container py-4">
  <h1>Alarmes Atuados</h1>
  <a href="../index.php" class="btn btn-secondary mb-3">← Voltar ao Início</a>

  <form method="GET" class="mb-4">
    <div class="input-group">
      <input type="text" name="descricao" value="<?= htmlspecialchars($filtroDescricao) ?>" class="form-control" placeholder="Filtrar por descrição do alarme">
      <button type="submit" class="btn btn-primary">Filtrar</button>
    </div>
  </form>

  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th><a href="?ordenar=descricao&direcao=<?= $direcao === 'ASC' ? 'DESC' : 'ASC' ?>">Descrição</a></th>
        <th><a href="?ordenar=classificacao&direcao=<?= $direcao === 'ASC' ? 'DESC' : 'ASC' ?>">Classificação</a></th>
        <th><a href="?ordenar=nome&direcao=<?= $direcao === 'ASC' ? 'DESC' : 'ASC' ?>">Equipamento</a></th>
        <th><a href="?ordenar=data_entrada&direcao=<?= $direcao === 'ASC' ? 'DESC' : 'ASC' ?>">Entrada</a></th>
        <th><a href="?ordenar=data_saida&direcao=<?= $direcao === 'ASC' ? 'DESC' : 'ASC' ?>">Saída</a></th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($atuacoes as $a): ?>
        <tr>
          <td><?= htmlspecialchars($a['descricao']) ?></td>
          <td><?= $a['classificacao'] ?></td>
          <td><?= $a['nome'] ?></td>
          <td><?= $a['data_entrada'] ?></td>
          <td><?= $a['data_saida'] ?? '<em>—</em>' ?></td>
          <td><?= $a['status'] === 'on' ? 'Ativo' : 'Inativo' ?></td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>

  <h3 class="mt-5">Top 3 Alarmes Mais Atuados</h3>
  <ol>
    <?php foreach ($top3 as $t): ?>
      <li><?= htmlspecialchars($t['descricao']) ?> — <?= $t['total'] ?> atuações</li>
    <?php endforeach ?>
  </ol>
</body>
</html>
