<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $nome  = trim($_POST['nome']);
  $custo = (float) str_replace(',', '.', $_POST['custo']);
  $data  = $_POST['data_limite'];

  // próxima ordem
  $ordem = $db->querySingle("SELECT COALESCE(MAX(ordem), 0) + 1 FROM tarefas");

  $stmt = $db->prepare("
    INSERT INTO tarefas (nome, custo, data_limite, ordem)
    VALUES (:nome, :custo, :data, :ordem)
  ");

  $stmt->bindValue(':nome', $nome);
  $stmt->bindValue(':custo', $custo);
  $stmt->bindValue(':data', $data);
  $stmt->bindValue(':ordem', $ordem);
  $stmt->execute();

  header("Location: index.php");
  exit;
}
?>

<h2>Incluir tarefa</h2>

<form method="post">
  Nome: <input name="nome" required><br><br>
  Custo: <input name="custo" required><br><br>
  Data limite: <input type="date" name="data_limite" required><br><br>
  <button>Salvar</button>
</form>
