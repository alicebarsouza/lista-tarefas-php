<?php
require 'db.php';

if (!isset($_GET['id'])) {
  header("Location: index.php");
  exit;
}

$id = $_GET['id'];

$stmt = $db->prepare("DELETE FROM tarefas WHERE id = :id");
$stmt->bindValue(':id', $id, SQLITE3_INTEGER);
$stmt->execute();

header("Location: index.php");
exit;
