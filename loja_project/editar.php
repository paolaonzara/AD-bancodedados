<?php
require 'conexao.php';
include 'header.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if (!$id) {
    header('Location: index.php?msg=' . urlencode('ID inválido'));
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id");
$stmt->execute([':id' => $id]);
$product = $stmt->fetch();

if (!$product) {
    header('Location: index.php?msg=' . urlencode('Produto não encontrado'));
    exit;
}

$catStmt = $pdo->query("SELECT id, name FROM categories ORDER BY name");
$cats = $catStmt->fetchAll();
?>
<h2>Editar Produto</h2>

<form action="atualizar.php" method="post">
  <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
  <div class="mb-3">
    <label class="form-label">Nome</label>
    <input class="form-control" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Descrição</label>
    <textarea class="form-control" name="description"><?php echo htmlspecialchars($product['description']); ?></textarea>
  </div>
  <div class="mb-3">
    <label class="form-label">Preço</label>
    <input class="form-control" name="price" type="number" step="0.01" value="<?php echo $product['price']; ?>" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Estoque</label>
    <input class="form-control" name="stock" type="number" value="<?php echo $product['stock']; ?>" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Categoria</label>
    <select class="form-control" name="category_id">
      <option value="">-- Selecionar --</option>
      <?php foreach($cats as $c): ?>
        <option value="<?php echo $c['id']; ?>" <?php if($c['id']==$product['category_id']) echo 'selected'; ?>><?php echo htmlspecialchars($c['name']); ?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <button class="btn btn-primary" type="submit">Atualizar</button>
  <a class="btn btn-secondary" href="index.php">Cancelar</a>
</form>

<?php include 'footer.php'; ?>
