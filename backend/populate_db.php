<?php
// Inclui a conexão PDO segura (db.php)
require 'db.php'; 

// O JSON que você forneceu
$jsonData = '[
  {
    "produto": "banana.jpeg",
    "nome": "Banana",
    "categoria": "Fruta",
    "preco": "R$ 12,90",
    "peso": "1KG"
  },
  {
    "produto": "maca.jpeg",
    "nome": "Maçã",
    "categoria": "Fruta",
    "preco": "R$ 17,00",
    "peso": "1KG"
  },
  {
    "produto": "morango.jpeg",
    "nome": "Morango",
    "categoria": "Fruta",
    "preco": "R$ 20,50",
    "peso": "1KG"
  },
  {
    "produto": "melancia.jpeg",
    "nome": "Melancia",
    "categoria": "Fruta",
    "preco": "R$ 28,90",
    "peso": "5KG"
  },
  {
    "produto": "alface.jpeg",
    "nome": "Alface crespo",
    "categoria": "Verdura",
    "preco": "R$ 14,90",
    "peso": "200g"
  },
  {
    "produto": "rucula.jpeg",
    "nome": "Rúcula",
    "categoria": "Verdura",
    "preco": "R$ 18,90",
    "peso": "250g"
  },
  {
    "produto": "couve.jpeg",
    "nome": "Couve",
    "categoria": "Verdura",
    "preco": "R$ 18,90",
    "peso": "300g"
  },
  {
    "produto": "fraldinha.jpeg",
    "nome": "Fraldinha",
    "categoria": "Carne",
    "preco": "R$ 46,90",
    "peso": "1KG"
  },
  {
    "produto": "maminha.jpeg",
    "nome": "Maminha",
    "categoria": "Carne",
    "preco": "R$ 52,90",
    "peso": "1KG"
  },
  {
    "produto": "calabresa.jpeg",
    "nome": "Calabresa",
    "categoria": "Carne",
    "preco": "R$ 19,99",
    "peso": "200g"
  }
]';

$produtos = json_decode($jsonData, true);
$count = 0;

try {
    $pdo->beginTransaction();
    $sql = $pdo->prepare("INSERT INTO itens (nome, preco, produto, categoria, peso) VALUES (?, ?, ?, ?, ?)");
    
    foreach ($produtos as $p) {
        // Limpa a string de preço (remove "R$ " e troca ',' por '.')
        $preco_limpo = str_replace(['R$ ', ','], ['', '.'], $p['preco']);
        
        $sql->execute([
            $p['nome'], 
            $preco_limpo, 
            $p['produto'], 
            $p['categoria'], 
            $p['peso']
        ]);
        $count++;
    }

    $pdo->commit();
    echo "<h1>Sucesso!</h1>";
    echo "<p>Foram inseridos **$count produtos** na tabela `itens` com sucesso.</p>";
    echo "<p>Agora você pode ver o catálogo com os dados completos e as imagens:</p>";
    echo "<p><a href=\"../catalogo.php\">Ir para o Catálogo de Produtos</a></p>";

} catch (PDOException $e) {
    $pdo->rollBack();
    echo "<h1>Erro ao Popular o Banco de Dados!</h1>";
    // Erro comum se tentar rodar mais de uma vez com produtos duplicados.
    echo "<p>Erro: " . $e->getMessage() . "</p>";
    echo "<p>Você já rodou este script antes? Se sim, vá para o catálogo.</p>";
    echo "<p><a href=\"../catalogo.php\">Ir para o Catálogo de Produtos</a></p>";
}
?>