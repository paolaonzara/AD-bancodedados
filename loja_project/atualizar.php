<?php
require 'conexao.php';

$id = intval($_POST['id'] ?? 0);
$nome = $_POST['nome'] ?? '';
$descricao = $_POST['descricao'] ?? null;
$preco = $_POST['preco'] ?? 0;
$estoque = $_POST['estoque'] ?? 0;
$categoria_id = $_POST['categoria_id'] ?: null;

if (!$id || !$nome) {
    header('Location: index.php?msg=' . urlencode('Dados inválidos'));
    exit;
}

$sql = "UPDATE produtos 
        SET nome = :nome, descricao = :descricao, preco = :preco, estoque = :estoque, categoria_id = :categoria_id 
        WHERE id = :id";
$stmt = $pdo->prepare($sql);
try {
    $stmt->execute([
        ':nome' => $nome,
        ':descricao' => $descricao,
        ':preco' => $preco,
        ':estoque' => $estoque,
        ':categoria_id' => $categoria_id,
        ':id' => $id
    ]);
    header('Location: index.php?msg=' . urlencode('Registro atualizado!'));
} catch (Exception $e) {
    header('Location: editar.php?id=' . $id . '&msg=' . urlencode('Erro ao atualizar: ' . $e->getMessage()));
}
exit;
