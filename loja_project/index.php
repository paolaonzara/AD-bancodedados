<?php
//?????????

require 'conexao.php';

$msg = $_GET['msg'] ?? '';

$sql = "SELECT p.*, c.nome AS categoria 
        FROM produtos p 
        LEFT JOIN categorias c ON p.categoria_id = c.id
        ORDER BY p.id DESC";

$produtos = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>
<?php include 'header.php'; ?>

<div class="container mt-4">
    <h1 class="mb-4">Lista de Produtos</h1>

    <?php if ($msg): ?>
        <div class="alert alert-info"><?= htmlspecialchars($msg) ?></div>
    <?php endif; ?>

    <a href="cadastrar.php" class="btn btn-success mb-3">Cadastrar Produto</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Categoria</th>
                <th>Preço</th>
                <th>Estoque</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produtos as $p): ?>
            <tr>
                <td><?= $p['id'] ?></td>
                <td><?= htmlspecialchars($p['nome']) ?></td>
                <td><?= $p['categoria'] ?: 'Sem categoria' ?></td>
                <td>R$ <?= number_format($p['preco'], 2, ',', '.') ?></td>
                <td><?= $p['estoque'] ?></td>
                <td>
                    <a href="editar.php?id=<?= $p['id'] ?>" class="btn btn-primary btn-sm">Editar</a>
                    <a href="excluir.php?id=<?= $p['id'] ?>" class="btn btn-danger btn-sm"
                       onclick="return confirm('Tem certeza que deseja excluir este produto?')">
                       Excluir
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>
