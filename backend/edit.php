<?php
require 'db.php';
$id = $_GET['id'];

if ($_POST) {
    $sql = $pdo->prepare("UPDATE itens SET nome=?, preco=?, produto=?, categoria=?, peso=? WHERE id=?");
    $ok = $sql->execute([
        $_POST['nome'], 
        $_POST['preco'], 
        $_POST['produto'],
        $_POST['categoria'],
        $_POST['peso'],
        $id
    ]);

    echo "<script>alert('".($ok ? "Alterado com sucesso!" : "Erro ao alterar")."');
           location='list.php';</script>";
    exit;
}

$item = $pdo->query("SELECT * FROM itens WHERE id=$id")->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Editar Item</title></head>
<body>

<h1>Editar Item</h1>

<form method="POST">
    Nome: <input name="nome" value="<?= htmlspecialchars($item['nome']) ?>" required><br><br>
    Preço: <input name="preco" type="number" step="0.01" value="<?= htmlspecialchars($item['preco']) ?>" required><br><br>
    
    <p style="font-weight: bold; color: #00796b;">
        IMG: Digite apenas o nome do arquivo da imagem (ex: `arroz.jpg`).
        Certifique-se de que o arquivo esteja na pasta `img`.
    </p>
    Produto: <input name="produto" value="<?= htmlspecialchars($item['produto']) ?>" required><br><br>
    
    Categoria: <input name="categoria" value="<?= htmlspecialchars($item['categoria']) ?>" required><br><br>
    Peso: <input name="peso" value="<?= htmlspecialchars($item['peso']) ?>" required><br><br>

    <button>Salvar</button>
</form>

</body>
</html>