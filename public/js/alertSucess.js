function exibirAlerta(mensagem, tipo, tempo) {
    // Criar um elemento de alerta Bootstrap
    var alerta = document.createElement('div');
    alerta.classList.add('alert', 'alert-' + tipo, 'alert-dismissible', 'fade', 'show');
    alerta.setAttribute('role', 'alert');
    alerta.innerHTML = mensagem +
      '<button type="button" class="close" data-dismiss="alert" aria-label="Fechar">' +
      '<span aria-hidden="true">&times;</span>' +
      '</button>';
  
    // Adicionar o alerta à página
    var container = document.querySelector('.alertaqui');
    container.appendChild(alerta);
  
    // Remover o alerta após alguns segundos
    setTimeout(function() {
      container.removeChild(alerta);
    }, tempo);
  }
  
  // Exemplo de uso: exibir um alerta de sucesso que desaparece após 5 segundos
  exibirAlerta('Registro salvo com sucesso!', 'success', 5000);