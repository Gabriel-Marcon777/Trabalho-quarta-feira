<?php
require 'db.php';

if ($_POST) {
    $sql = $pdo->prepare("INSERT INTO itens (nome, preco, produto, categoria, peso) VALUES (?, ?, ?, ?, ?)");
    $ok = $sql->execute([
        $_POST['nome'], 
        $_POST['preco'], 
        $_POST['produto'],
        $_POST['categoria'],
        $_POST['peso']
    ]);

    echo "<script>alert('".($ok ? "Cadastro feito!" : "Erro ao cadastrar")."');
           location='list.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Novo Item</title></head>
<body>

<h1>Novo Item</h1>

<form method="POST">
    Nome: <input name="nome" required><br><br>
    Preço: <input name="preco" type="number" step="0.01" required><br><br>
    
    <p style="font-weight: bold; color: #00796b;">
        IMG/: Digite apenas o nome do arquivo da imagem (ex: `arroz.jpg`).
        Certifique-se de que o arquivo esteja na pasta `img`.
    </p>
    Produto: <input name="produto" required><br><br>
    
    Categoria: <input name="categoria" required><br><br>
    Peso: <input name="peso" required><br><br>

    <button>Enviar</button>
</form>

</body>
</html>