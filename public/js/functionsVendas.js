function exibirTresLinhas() {
    var tabela = document.getElementById('tableEmEstoque');
    var linhas = tabela.getElementsByTagName('tr');
    
    for (var i = 0; i < linhas.length; i++) {
      if (i < 3) {
        linhas[i].style.display = 'table-row';
      } else {
        linhas[i].style.display = 'none';
      }
    }
  }

  

  function prodSelect(){

    // FUNÇÃO prodSelect 

      const item = document.getElementById('item');
      const qtd = document.getElementById('qtd');
      const vlUnit = document.getElementById('vlUnit');
      const subtotal = document.getElementById('subtotal');
      
      // Adiciona um evento de clique para os botões que abrem o modal
      document.querySelectorAll('[data-target="#editProduto"]').forEach(btn => {
        btn.addEventListener('click', () => {
          // Obtém o valor do atributo data-nome do botão que foi clicado
          const idDoBotao = btn.dataset.idp;
          const nomeDoBotao = btn.dataset.nome;
          const codDoBotao = btn.dataset.cod;
          const precoVenda = btn.dataset.venda;
          const precoAtacado = btn.dataset.atacad;

          console.log(nomeDoBotao +"-"+ precoVenda +"-"+ precoAtacado);
          
          // Atribui os dados do botão aos values dos inputs 
          item.value = nomeDoBotao;
          vlUnit.value = precoVenda;
          calcSubtotal();
          
        });

        document.getElementById('qtd').focus();

      });
  }

  function calcSubtotal(){
    var varsubtotal = document.getElementById('subtotal');
    varsubtotal.value = document.getElementById('qtd').value * document.getElementById('vlUnit').value;
  }
  