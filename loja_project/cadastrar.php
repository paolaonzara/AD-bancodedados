<?php
require 'conexao.php';

$sql = "SELECT id, nome FROM categorias ORDER BY nome";
$categorias = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>
<?php include 'header.php'; ?>

<div class="container mt-4">
    <h1 class="mb-4">Cadastrar Produto</h1>

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
            <input type="number" name="estoque" class="form-control" required>
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
    </form>
</div>

<?php include 'footer.php'; ?>
