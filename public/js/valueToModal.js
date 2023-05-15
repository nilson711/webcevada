
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

  
// FUNÇÃO ValueToModal 

function ValueToModal(m, btn, c1, c2, c3)
{
  // busca na tabela os values dos campos e coloca no modal editarProduto
  // Seleciona o modal e o input onde o nome será exibido
  const modal = document.getElementById(m);
  const c1 = modal.querySelector(c1);
  const c2 = modal.querySelector(c2);
  const c3 = modal.querySelector(c3);
  
  // Adiciona um evento de clique para os botões que abrem o modal
  // document.querySelectorAll('[data-target=modal]').forEach(btn => {
    // btn.addEventListener('click', () => {
      
      // Obtém o valor do atributo data-nome do botão que foi clicado
      const idDoBotao = btn.dataset.idp;
      const codDoBotao = btn.dataset.cod;
      const nomeDoBotao = btn.dataset.nome;
      
    // Atribui os dados do botão aos values dos inputs dentro do modal
        c1.value = nomeDoBotao;
        c2.value = codDoBotao;
        c3.value = idDoBotao;
    };
  // });

  
 

  
 