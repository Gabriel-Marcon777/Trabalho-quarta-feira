<?php
require 'db.php';
// A consulta SELECT * FROM itens já retorna todos os campos, incluindo os novos.
$rows = $pdo->query("SELECT * FROM itens")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Lista de Itens</title>
</head>
<body>

<h1>Itens Cadastrados</h1>
<a href="create.php">➕ Novo Item</a>

<table border="1" cellspacing="0" cellpadding="8">
<tr>
    <th>ID</th>
    <th>Nome</th>
    <th>Preço</th>
    <th>Produto</th>
    <th>Categoria</th>
    <th>Peso</th>
    <th>Ações</th>
</tr>

<?php foreach ($rows as $r): ?>
<tr>
    <td><?= htmlspecialchars($r['id']) ?></td>
    <td><?= htmlspecialchars($r['nome']) ?></td>
    <td>R$ <?= number_format($r['preco'], 2, ',', '.') ?></td>
    <td><img 
        src="imagens/produtos/<?= htmlspecialchars($r['produto']) ?>" 
        alt="<?= htmlspecialchars($r['nome']) ?>"
        style="width: 50px; height: 50px; object-fit: cover;"
    >
</td>
    <td><?= htmlspecialchars($r['categoria']) ?></td>
    <td><?= htmlspecialchars($r['peso']) ?></td>
    <td>
        <a href="edit.php?id=<?= $r['id'] ?>">✏️ Editar</a> |
        <a href="delete.php?id=<?= $r['id'] ?>" onclick="return confirm('Tem certeza que deseja deletar?')">
            🗑️ Deletar
        </a>
    </td>
</tr>
<?php endforeach; ?>

</table>

</body>
</html>