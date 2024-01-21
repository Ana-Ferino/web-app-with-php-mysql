
// Script para mostrar ou ocultar senha
function mostrarOcultarSenhaLogin() {
  var senha  = document.getElementById("Senha");

  if (senha.type == "password"){
    senha.type  = "text";
  } else {
    senha.type  = "password";
  }
}

// Script para mostrar ou ocultar senha
function mostrarOcultarSenhaCadastro() {
  var senha1 = document.getElementById("Senha1");
  var senha2 = document.getElementById("Senha2");

  if (senha1.type == "password"){
    senha1.type = "text";
    senha2.type = "text";
  } else {
    senha1.type = "password";
    senha2.type = "password";
  }
}

function mensagem(m) {
  alert(m);
}

function habilitarEdicao() {
  // Habilita a edição dos campos
  document.querySelectorAll('.profile-field input, #descricao').forEach(input => {
      input.removeAttribute('readonly');
  });

  // Altera o texto do botão para "Salvar"
  document.getElementById('edit-button').innerText = 'Salvar';
  document.getElementById('edit-button').onclick = function() {
      if (validarIdade()) {
          salvarEdicao();
      } else {
          alert('Por favor, insira uma idade válida (entre 16 e 100).');
      }
  };
}

function validarIdade() {
  var idadeInput = document.getElementById('idade');
  var idade = parseInt(idadeInput.value);

  // Verifica se a idade está no intervalo desejado
  return !isNaN(idade) && idade >= 16 && idade <= 100;
}

function limitarTamanhoCampo(elemento, tamanhoMaximo) {
  if (elemento.value.length > tamanhoMaximo) {
      elemento.value = elemento.value.slice(0, tamanhoMaximo);
  }
}

function salvarEdicao() {
  // Lógica para salvar as alterações (pode ser implementada com AJAX para o servidor)

  // Desabilita a edição dos campos
  document.querySelectorAll('.profile-field input, #descricao').forEach(input => {
      input.setAttribute('readonly', true);
  });

  // Altera o texto do botão de volta para "Editar"
  document.getElementById('edit-button').innerText = 'Editar';
  document.getElementById('edit-button').onclick = habilitarEdicao;
}

function redirecionarParaLogin() {
  // Redireciona para a página de login
  window.location.href = "/app-web-frontend/login.php";
}