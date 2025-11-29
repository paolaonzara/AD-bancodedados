<?php
require 'conexao.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if (!$id) {
    header('Location: index.php?msg=' . urlencode('ID inválido'));
    exit;
}

$sql = "DELETE FROM produtos WHERE id = :id";
$stmt = $pdo->prepare($sql);
try {
    $stmt->execute([':id' => $id]);
    header('Location: index.php?msg=' . urlencode('Registro excluído!'));
} catch (Exception $e) {
    header('Location: index.php?msg=' . urlencode('Erro ao excluir: ' . $e->getMessage()));
}
exit;
