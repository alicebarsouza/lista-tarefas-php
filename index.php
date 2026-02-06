<?php
require 'db.php';

$result = $db->query("SELECT * FROM tarefas ORDER BY ordem ASC");
$total = 0;
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Lista de Tarefas</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Lista de Tarefas</h1>

<table>
<tr>
  <th>Nome</th>
  <th>Custo</th>
  <th>Data Limite</th>
  <th>Ações</th>
</tr>

<?php $total = 0; ?>
<?php while ($t = $result->fetchArray(SQLITE3_ASSOC)): ?>
  <?php $total += $t['custo']; ?>

  <tr style="<?= $t['custo'] >= 1000 ? 'background-color: #ffe680;' : '' ?>">
    <td><?= htmlspecialchars($t['nome']) ?></td>
    <td>R$ <?= number_format($t['custo'], 2, ',', '.') ?></td>
    <td><?= date('d/m/Y', strtotime($t['data_limite'])) ?></td>
    <td>
      <a href="mover.php?id=<?= $t['id'] ?>&dir=up">⬆</a>
      <a href="mover.php?id=<?= $t['id'] ?>&dir=down">⬇</a> |
      <a href="editar.php?id=<?= $t['id'] ?>">Editar</a>
      <a href="excluir.php?id=<?= $t['id'] ?>"
         onclick="return confirm('Confirma exclusão?')">Excluir</a>
    </td>
  </tr>

<?php endwhile; ?>
</table>

<p><b>Total:</b> R$ <?= number_format($total, 2, ',', '.') ?></p>

<a href="incluir.php">➕ Incluir tarefa</a>

</body>
</html>
