<?php
require 'conexao.php';

$nome = $_POST['nome'] ?? '';
$descricao = $_POST['descricao'] ?? null;
$preco = $_POST['preco'] ?? 0;
$estoque = $_POST['estoque'] ?? 0;
$categoria_id = $_POST['categoria_id'] ?: null;

if (!$nome) {
    header('Location: cadastrar.php?msg=' . urlencode('Nome é obrigatório'));
    exit;
}

$sql = "INSERT INTO produtos (nome, descricao, preco, estoque, categoria_id, ativo) 
        VALUES (:nome, :descricao, :preco, :estoque, :categoria_id, 1)";
$stmt = $pdo->prepare($sql);
try {
    $stmt->execute([
        ':nome' => $nome,
        ':descricao' => $descricao,
        ':preco' => $preco,
        ':estoque' => $estoque,
        ':categoria_id' => $categoria_id
    ]);
    header('Location: index.php?msg=' . urlencode('Registro salvo!'));
} catch (Exception $e) {
    header('Location: cadastrar.php?msg=' . urlencode('Erro ao salvar: ' . $e->getMessage()));
}
exit;
