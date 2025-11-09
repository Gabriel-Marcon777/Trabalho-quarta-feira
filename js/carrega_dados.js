document.addEventListener("DOMContentLoaded", function() {
  const tabela = document.querySelector(".tabela-produtos tbody");

  fetch("dados.json")
    .then(response => response.json())
    .then(produtos => {
      tabela.innerHTML = "";
      produtos.forEach(p => {
        const linha = `
          <tr>
            <td><img src="${p.imagem}" width="100" alt="${p.nome}"></td>
            <td>${p.nome}</td>
            <td>${p.categoria}</td>
            <td>${p.preco}</td>
            <td>${p.peso}</td>
          </tr>
        `;
        tabela.innerHTML += linha;
      });
    })
    .catch(() => {
      tabela.innerHTML = "<tr><td colspan='5'>Erro ao carregar produtos.</td></tr>";
    });
});
