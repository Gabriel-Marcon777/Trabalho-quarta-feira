document.addEventListener("DOMContentLoaded", function() {
  const botaoTema = document.getElementById("toggleTema");
  const temaAtual = localStorage.getItem("tema") || "claro";

  document.body.classList.add(temaAtual);

  botaoTema.textContent = temaAtual === "escuro" ? "Tema Claro" : "Tema Escuro";

  botaoTema.addEventListener("click", function() {
    document.body.classList.toggle("escuro");
    const novoTema = document.body.classList.contains("escuro") ? "escuro" : "claro";
    localStorage.setItem("tema", novoTema);
    botaoTema.textContent = novoTema === "escuro" ? "Tema Claro" : "Tema Escuro";
  });
});
