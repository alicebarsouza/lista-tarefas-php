<?php
require 'db.php';

$erro = '';

if (!isset($_GET['id'])) {
  header("Location: index.php");
  exit;
}

$id = $_GET['id'];

$stmt = $db->prepare("SELECT * FROM tarefas WHERE id = :id");
$stmt->bindValue(':id', $id, SQLITE3_INTEGER);
$result = $stmt->execute();
$tarefa = $result->fetchArray(SQLITE3_ASSOC);


// Se não existir, volta
if (!$tarefa) {
  header("Location: index.php");
  exit;
}

// Salvar edição
if ($_POST) {
  $nome = trim($_POST['nome']);
  $custo = $_POST['custo'];
  $data = $_POST['data'];

  if ($nome === '' || $custo === '' || $data === '') {
    $erro = "Todos os campos são obrigatórios.";
  } else {
    // Verificar nome duplicado
    $stmt = $db->prepare("
      SELECT COUNT(*) FROM tarefas
      WHERE nome = :nome AND id != :id
    ");
    $stmt->bindValue(':nome', $nome);
    $stmt->bindValue(':id', $id);
    $existe = $stmt->execute()->fetchArray()[0];

    if ($existe > 0) {
      $erro = "Já existe uma tarefa com esse nome.";
    } else {
      $stmt = $db->prepare("
        UPDATE tarefas
        SET nome = :nome,
            custo = :custo,
            data_limite = :data
        WHERE id = :id
      ");

      $stmt->bindValue(':nome', $nome);
      $stmt->bindValue(':custo', $custo);
      $stmt->bindValue(':data', $data);
      $stmt->bindValue(':id', $id);

      if ($stmt->execute()) {
        header("Location: index.php");
        exit;
      }
    }
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Editar Tarefa</title>
</head>
<body>

<h2>Editar Tarefa</h2>

<?php if ($erro): ?>
  <p style="color:red"><?= $erro ?></p>
<?php endif; ?>

<form method="post">
  Nome da tarefa:<br>
  <input type="text" name="nome" value="<?= htmlspecialchars($tarefa['nome']) ?>" required><br><br>

  Custo (R$):<br>
  <input type="number" name="custo" step="0.01" min="0"
         value="<?= $tarefa['custo'] ?>" required><br><br>

  Data limite:<br>
  <input type="date" name="data"
         value="<?= $tarefa['data_limite'] ?>" required><br><br>

  <button type="submit">Salvar</button>
</form>

<br>
<a href="index.php">Voltar</a>

</body>
</html>
