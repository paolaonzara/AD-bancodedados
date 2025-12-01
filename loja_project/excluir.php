<?php
require 'conexao.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if (!$id) {
    header('Location: index.php?msg=' . urlencode('ID inválido'));
    exit;
}

$stmt = $pdo->prepare("UPDATE produtos SET ativo = 0 WHERE id = :id");
try {
    $stmt->execute([':id' => $id]);
    header('Location: index.php?msg=' . urlencode('Registro desativado!'));
} catch (Exception $e) {
    header('Location: index.php?msg=' . urlencode('Erro ao desativar: ' . $e->getMessage()));
}
exit;
