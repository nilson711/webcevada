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
  

function mostrarValor() {
  var select = document.getElementById("product");
  var checkAtacado = document.getElementById("checkAtacado");
  var option = select.options[select.selectedIndex];
  var valorSelecionado = option.value;
  var valor2 = option.getAttribute("data-value2");
  var valor3 = option.getAttribute("data-value3");

    
  if (checkAtacado.checked) {
    // Atribui o valor do produto ao preço de Atacado
    document.getElementById('price').value = valor3;
    
  } else {
    // Atribui o valor do produto ao preço de Varejo
    document.getElementById('price').value = valor2;
  }
 

  // Move o foco para o campo quantidade
  document.getElementById('quantity').focus();

  // alert(`O id é: ${valorSelecionado}\nValor2: ${valor2}\nValor3: ${valor3}`);
}

function calcularTotal() {
  var salesTable = document.getElementById('salesTable');
  var rows = salesTable.getElementsByTagName('tr');
  var rowCount = salesTable.getElementsByTagName('tr').length - 1; // Subtrai 1 para desconsiderar o cabeçalho

  var total = 0;

  // Percorre todas as linhas da tabela, começando pela segunda linha (índice 1)
  for (var i = 1; i < rows.length; i++) {
    var row = rows[i];
    var subtotal = parseFloat(row.querySelector('td:nth-child(5)').textContent);

    // Soma o subtotal ao total
    total += subtotal;
  }

  return total;
}

function contarLinhas() {
  var salesTable = document.getElementById('salesTable');
  var rowCount = salesTable.getElementsByTagName('tr').length - 1; // Subtrai 1 para desconsiderar o cabeçalho

  var rowCountElement = document.getElementById('rowCount');
  rowCountElement.textContent = 'Linhas: ' + rowCount;
}

function somarQuantidade() {
  var salesTable = document.getElementById('salesTable');
  var rowCount = salesTable.rows.length;
  var totalQuantity = 0;

  // Inicia o loop a partir do índice 1 para ignorar o cabeçalho da tabela
  for (var i = 1; i < rowCount; i++) {
    var row = salesTable.rows[i];
    var quantityCell = row.cells[2];
    var quantity = parseInt(quantityCell.textContent);

    // Verifica se o valor é um número válido e adiciona à quantidade total
    if (!isNaN(quantity)) {
      totalQuantity += quantity;
    }
  }

  // Exibe o valor da quantidade total
  var totalQuantityElement = document.getElementById('totalQuantity');
  totalQuantityElement.textContent = 'itens: ' + totalQuantity;
}


