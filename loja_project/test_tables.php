<?php
require 'conexao.php';

try {
    echo "<h3>Conectado ao banco: loja</h3>";
    $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
    echo "<h4>Tabelas detectadas:</h4><pre>" . htmlspecialchars(print_r($tables, true)) . "</pre>";

    $ok = $pdo->query("SHOW TABLES LIKE 'produtos'")->fetchAll();
    echo "<h4>Existe tabela 'produtos'?</h4><pre>" . htmlspecialchars(print_r($ok, true)) . "</pre>";

    if ($ok) {
        $cnt = $pdo->query("SELECT COUNT(*) FROM produtos")->fetchColumn();
        echo "<h4>Total de produtos: $cnt</h4>";
    }
} catch (Exception $e) {
    echo "<h4>Erro:</h4><pre>" . htmlspecialchars($e->getMessage()) . "</pre>";
}
