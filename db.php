<?php
$db = new SQLite3('tarefas.db');

$db->exec("
CREATE TABLE IF NOT EXISTS tarefas (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  nome TEXT UNIQUE NOT NULL,
  custo REAL NOT NULL,
  data_limite TEXT NOT NULL,
  ordem INTEGER NOT NULL
)
");