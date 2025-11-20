<?php
require 'db.php';
$id = $_GET['id'];

$ok = $pdo->exec("DELETE FROM itens WHERE id=$id");

echo "<script>alert('".($ok ? "Deletado com sucesso!" : "Erro ao deletar")."');
       location='list.php';</script>";
// Não se esqueça de fechar a tag PHP se este for um arquivo standalone
?>