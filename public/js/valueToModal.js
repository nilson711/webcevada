
// FUNÇÃO ValueToModal 
  // busca na tabela os values dos campos e coloca no modal editarProduto
  // Seleciona o modal e o input onde o nome será exibido
  const modal = document.getElementById('editProduto');
  const inputNome = modal.querySelector('#newProduto');
  const inputCod = modal.querySelector('#newcod');
  const inputIdProd = modal.querySelector('#idProd');
  
  // Adiciona um evento de clique para os botões que abrem o modal
  document.querySelectorAll('[data-target="#editProduto"]').forEach(btn => {
    btn.addEventListener('click', () => {
      // Obtém o valor do atributo data-nome do botão que foi clicado
      const idDoBotao = btn.dataset.idp;
      const nomeDoBotao = btn.dataset.nome;
      const codDoBotao = btn.dataset.cod;
      
  // Atribui os dados do botão aos values dos inputs dentro do modal
      inputIdProd.value = idDoBotao;
      inputNome.value = nomeDoBotao;
      inputCod.value = codDoBotao;
    });
  });

  


  
 

  
 