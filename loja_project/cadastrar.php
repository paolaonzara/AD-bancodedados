<?php
require 'conexao.php';
include 'header.php';

$catStmt = $pdo->query("SELECT id, nome FROM categorias ORDER BY nome");
$categorias = $catStmt->fetchAll();
?>
<div class="container mt-4">
    <h1 class="mb-4">Cadastrar Produto</h1>

    <?php if (isset($_GET['msg'])): ?>
        <div class="alert alert-info"><?= htmlspecialchars($_GET['msg']) ?></div>
    <?php endif; ?>

    <form action="salvar.php" method="post">
        <div class="mb-3">
            <label class="form-label">Nome:</label>
            <input type="text" name="nome" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Descrição:</label>
            <textarea name="descricao" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Preço:</label>
            <input type="number" step="0.01" name="preco" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Estoque:</label>
            <input type="number" name="estoque" class="form-control" value="0" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Categoria:</label>
            <select name="categoria_id" class="form-control">
                <option value="">Sem categoria</option>
                <?php foreach ($categorias as $c): ?>
                    <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['nome']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <button class="btn btn-success">Salvar</button>
        <a class="btn btn-secondary" href="index.php">Cancelar</a>
    </form>
</div>

<?php include 'footer.php'; ?>
