
// FUNÇÃO ValueToModal Estoque
  // busca na tabela os values dos campos e coloca no modal addEstoque
  // Seleciona o modal e o input onde o nome será exibido
  const modal = document.getElementById('addEstoque');
  const inputCod = modal.querySelector('#cod');
  const inputIdProd = modal.querySelector('#produtos_id');
  
  // Adiciona um evento de clique para os botões que abrem o modal
  document.querySelectorAll('[data-target="#addEstoque"]').forEach(btn => {
    btn.addEventListener('click', () => {
      // Obtém o valor do atributo data-nome do botão que foi clicado
      const idDoBotao = btn.dataset.idp;
      const codDoBotao = btn.dataset.cod;

  // Atribui os dados do botão aos values dos inputs dentro do modal
      inputIdProd.value = idDoBotao;
      inputCod.value = codDoBotao;
    });
  });

  


  
 

  
 