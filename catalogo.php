<?php
// Inclui a conexão PDO segura (db.php) que usa o banco 'vendinha'
// O caminho ajustado para buscar o db.php dentro da pasta backend
require 'backend/db.php'; 

// ATUALIZAÇÃO 1: Busca os itens da tabela 'itens' (incluindo as novas colunas)
$sql = $pdo->prepare("SELECT id, nome, preco, produto, categoria, peso FROM itens");
$sql->execute();
$rows = $sql->fetchAll(PDO::FETCH_ASSOC);

$pageTitle = "Catálogo de Produtos";
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?> - Mercado do seu Zé</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<header> 
    <button id="toggleTema">Tema Escuro</button>
    <script src="js/tema.js"></script>

    <h1>Mercado do seu Zé: Onde se tem os melhores preços para o seu bolso</h1>
</header>

<nav class="navbar">
    <a href="index.html">Home</a> | 
    <b>Catálogo de produtos</b> | 
    <a href="sac.html">SAC</a> |
    <a href="equipe.html">Equipe</a> 
</nav>

<main>
<h2>Desfrute da nossa variedade de produtos</h2>
<a href="http://localhost/Trabalho-quarta-feira/backend/list.php" class="botao-editar">
     Editar Catálogo (Admin)
</a>

<table class="tabela-produtos">
  <thead>
    <tr>
      <th>Produto</th>       <th>Nome do produto</th>
      <th>Categoria</th>       <th>Preço</th>
      <th>Peso</th>     </tr>
  </thead>

  <tbody>
    <?php if (count($rows) > 0): ?>
        <?php foreach ($rows as $item): ?>
            <tr>
                              <td>
                    
    <img 
        src="img/<?= htmlspecialchars($item['produto']) ?>" 
        alt="Imagem de <?= htmlspecialchars($item['nome']) ?>"
        style="width: 100px; height: 100px; object-fit: cover; border-radius: 5px;"
    >
</td>
                </td>
                                <td><?= htmlspecialchars($item['nome']) ?></td>
                                <td><?= htmlspecialchars($item['categoria']) ?></td>
                                <td>R$ <?= number_format($item['preco'], 2, ',', '.') ?></td>
                                <td><?= htmlspecialchars($item['peso']) ?></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="5">Nenhum produto encontrado no banco de dados. Use o painel de administração em `/backend/list.php` para cadastrar.</td></tr>
    <?php endif; ?>
  </tbody>
</table>

</main>

<footer id="rodape">
    <p>© 2025 Mercado do seu Zé. Todos os direitos reservados.</p>
    <p>Este projeto é uma ferramenta educacional e não comercial. As informações e imagens são utilizadas para fins de demonstração, aprendizado e ilustração de conceitos de desenvolvimento web.</p>
</footer>
</body>
</html>