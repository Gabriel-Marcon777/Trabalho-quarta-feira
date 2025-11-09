document.addEventListener("DOMContentLoaded", function() {
  const form = document.getElementById("formSAC");

  form.addEventListener("submit", function(event) {
    const email = document.getElementById("id_email").value.trim();
    const cpf = document.getElementById("id_cpf").value.trim();

    const emailRegex = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/i;
    const cpfRegex = /^\d{3}\.\d{3}\.\d{3}-\d{2}$/;

    if (!emailRegex.test(email)) {
      alert("Por favor, insira um e-mail válido (ex: joao.silva@net.com).");
      event.preventDefault();
      return;
    }

    if (!cpfRegex.test(cpf)) {
      alert("Por favor, insira o CPF no formato 999.999.999-99.");
      event.preventDefault();
      return;
    }

    alert("Mensagem enviada com sucesso!");
  });
});
