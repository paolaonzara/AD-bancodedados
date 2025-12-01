<?php
require 'conexao.php';
include 'header.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if (!$id) {
    header('Location: index.php?msg=' . urlencode('ID inválido'));
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = :id");
$stmt->execute([':id' => $id]);
$produto = $stmt->fetch();

if (!$produto) {
    header('Location: index.php?msg=' . urlencode('Produto não encontrado'));
    exit;
}

$catStmt = $pdo->query("SELECT id, nome FROM categorias ORDER BY nome");
$cats = $catStmt->fetchAll();
?>
<div class="container mt-4">
    <h1 class="mb-4">Editar Produto</h1>

    <form action="atualizar.php" method="post">
      <input type="hidden" name="id" value="<?php echo $produto['id']; ?>">
      <div class="mb-3">
        <label class="form-label">Nome</label>
        <input class="form-control" name="nome" value="<?php echo htmlspecialchars($produto['nome']); ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Descrição</label>
        <textarea class="form-control" name="descricao"><?php echo htmlspecialchars($produto['descricao']); ?></textarea>
      </div>
      <div class="mb-3">
        <label class="form-label">Preço</label>
        <input class="form-control" name="preco" type="number" step="0.01" value="<?php echo $produto['preco']; ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Estoque</label>
        <input class="form-control" name="estoque" type="number" value="<?php echo $produto['estoque']; ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Categoria</label>
        <select class="form-control" name="categoria_id">
          <option value="">-- Selecionar --</option>
          <?php foreach($cats as $c): ?>
            <option value="<?php echo $c['id']; ?>" <?php if($c['id']==$produto['categoria_id']) echo 'selected'; ?>><?php echo htmlspecialchars($c['nome']); ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <button class="btn btn-primary" type="submit">Atualizar</button>
      <a class="btn btn-secondary" href="index.php">Cancelar</a>
    </form>
</div>

<?php include 'footer.php'; ?>
