<?php
require 'db.php';

$id  = (int) $_GET['id'];
$dir = $_GET['dir'];

$atual = $db->querySingle(
  "SELECT id, ordem FROM tarefas WHERE id = $id",
  true
);

if (!$atual) {
  header("Location: index.php");
  exit;
}

if ($dir === 'up') {
  $outra = $db->querySingle(
    "SELECT id, ordem FROM tarefas WHERE ordem < {$atual['ordem']} ORDER BY ordem DESC LIMIT 1",
    true
  );
} else {
  $outra = $db->querySingle(
    "SELECT id, ordem FROM tarefas WHERE ordem > {$atual['ordem']} ORDER BY ordem ASC LIMIT 1",
    true
  );
}

if ($outra) {
  $db->exec("UPDATE tarefas SET ordem = {$outra['ordem']} WHERE id = {$atual['id']}");
  $db->exec("UPDATE tarefas SET ordem = {$atual['ordem']} WHERE id = {$outra['id']}");
}

header("Location: index.php");
exit;
