<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'WebCevada') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    

    <!-- Select2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet"/>
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}

 


</head>
<body>
    <div id="app">

     
 <!-- Modal Pagamentos -->
<div class="modal fade" id="pagamentosModal" tabindex="-1" role="dialog" aria-labelledby="pagamentosModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="pagamentosModalLabel">Pagamentos</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <div class="form-row">
                  <div class="form-group col-md-4">
                      <label for="dataInput">Data</label>
                      <input type="date" class="form-control" id="dataInput">
                  </div>
                  <div class="form-group col-md-3">
                      <label for="formaSelect">Forma</label>
                      <select class="form-control" id="formaSelect">
                          <option value=" " selected>Selecione...</option>
                          <option value="debito">Débito</option>
                          <option value="credito">Crédito</option>
                          <option value="pix">Pix</option>
                          <option value="dinheiro">Dinheiro</option>
                      </select>
                  </div>
                  <div class="form-group col-md-4">
                      <label for="valorInput">Valor</label>
                      <input type="number" class="form-control" id="valorInput" step="0.01">
                  </div>
                  <div class="col-md-1">
                    <button type="submit" class="btn btn-primary" id="adicionarPagamentoBtn" style="margin-top: 30px" disabled>Ok</button>

                  </div>
              </div>
              <hr>
              <table id="pagamentosTable" class="table table-sm">
                  <thead>
                      <tr>
                          <th>Data</th>
                          <th>Forma</th>
                          <th>Valor</th>
                      </tr>
                  </thead>
                  <tbody>
                      <!-- Linhas da tabela de pagamentos serão adicionadas dinamicamente aqui -->
                  </tbody>
                  <tfoot>
                      <tr style="color: blue">
                          <th colspan="2">Total Pago</th>
                          <th id="totalValuePag"></th>
                      </tr>
                      <tr style="color: red">
                          <th colspan="2">Devedor</th>
                          <th id="totalDevedor"></th>
                      </tr>
                      <tr>
                          <th colspan="2">Saldo</th>
                          <th id="saldoDevedor"></th>
                      </tr>
                  </tfoot>
              </table>
          </div>
          <div class="modal-footer">
              
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          </div>
      </div>
  </div>
</div>




        
        <div class="container">
            <div class="row justify-content-center">
              
              
              <div class="col-md-12">
                @if ($errors->any())
                  <div style="position: absolute; top:0px; left:0px; width:100%; color:white; background-color: red; text-align:center">
                    @foreach ($errors->all() as $erro)
                        {{$erro}}<br>
                    @endforeach
                  </div>
                  <hr><br><br>
                 @endif

                 <br>
                <div >
                  
                  <div  >
                    <div class="row">
                      <div class="col-md-3" style="margin: 3px">
                        <h1>Vendas V2</h1>
                      </div>
          
                      <div class="form-group col-md-4">
                        <small>Cliente</small>
                          <select class="form-control form-control-sm">
                           
                            @foreach ($ClientesCad as $Cliente)
                              
                              <option value="{{ $Cliente->id }}"
                                {{ $Cliente->id == $venda->clientes_id ? 'selected' : '' }}>
                                {{ $Cliente->nomeClient }}
                              </option>

                            @endforeach
                          </select>
                      </div>
          
                      <div class="form-group col-md-4" style="text-align: right">
                        
                        Nº: <span id="idVenda">{{ $venda->id }}</span> -  {{ date('d/m/Y', strtotime($venda->data))}}
                        
                      </div>

                  </div>
          
                </div>


                <form id="salesForm">
                    <div class="form-row">
                        <div class="form-group col-md-7">
                            <label for="product">Produto:</label>
                            {{-- <input type="text" class="form-control" id="product" required> --}}

                            <select class="form-control form-control-sm select2" id="product" onchange="mostrarValor()">
                              <option value="0" selected>Selecione um Produto</option>
                              @foreach ($estoquesCad as $Prod)
                                <option value="{{$Prod->id}}" data-value2={{$Prod->precoVenda}} data-value3={{$Prod->precoAtacado}} data-prod={{$Prod->Produto}}>{{$Prod->Produto}}</option>
                              @endforeach
                            </select> 
                        </div>
                        <div class="form-group col-md-1" >
                          <label for="checkAtacado">Atacado</label>
                          <div class="d-flex align-items-center justify-content-center">
                            <input type="checkbox" class="form-check-input " id="checkAtacado" style="width: 50px; height:22px; margin-top:30px" onchange="mostrarValor()">

                          </div>
                        </div>
                        <div class="form-group col-md-1">
                            <label for="quantity">Quantidade:</label>
                            <input type="number" class="form-control form-control-sm" id="quantity" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="price">Preço:</label>
                            <input type="number" class="form-control form-control-sm" id="price" step="0.01" required>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary" style="margin-top: 30px">Ok</button>
                        </div>
                    </div>
                </form>

                <hr>
                <h5>Selecionados</h5>

                <form method="post" action="/newitens">
                  @csrf
                    <table id="salesTable" class="table table-sm">
                        <thead>
                            <tr>
                                <th>IdVenda</th>
                                <th>IdProd</th>
                                <th>Produto</th>
                                <th>Qtd</th>
                                <th>Preço</th>
                                <th>Subtotal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="salesData">
                            <!-- Os registros de vendas serão adicionados dinamicamente aqui -->
                            <td></td>
                        </tbody>
                    </table>
                    <input type="text" name="allsalesData"> <!-- Campo oculto para armazenar os dados da tabela -->
                    <button id="salvarBtn" type="submit">Salvar</button>
                </form>
                <div class="row">
                  <div class="col-md-1">
                    <div id="rowCount">Linhas: 0</div>
                  </div>
                  <div class="col-md-6" style="text-align: right">
                    <div id="totalQuantity">Itens: 0</div>
                  </div>
                  <div class="col-md-5" style="color: blue">
                    <h4 id="totalValue" style="text-align: right; margin-right: 200px"><strong> R$ Total: 0.00 </strong></h4>
                  </div>
                </div>

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pagamentosModal">Pagamento (F9)</button>


              </div>
              </div>
            </div>
          
          </div>
          
          <script src={{ asset('js/seachInTable.js') }}></script>
          <script src={{ asset('js/functionsVendas.js') }}></script>
          <script src={{ asset('js/verBtnMoverMouse.js') }}></script>
          
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>

          <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
          
          
          <script>

            var total = 0; // Variável para armazenar o valor total
            var totalValueElement = document.getElementById('totalValue'); // Elemento do valor total
            var totalValueModalElement = document.getElementById('totalDevedor'); // Elemento devedor no modal
           
            var productValues = []; // Array para armazenar os valores das opções selecionadas
    
            // Adiciona um evento de submit ao formulário
            document.getElementById('salesForm').addEventListener('submit', function(event) {
                event.preventDefault(); // Impede o envio padrão do formulário
    
                // Obtem os valores do formulário
                var productSelect = document.getElementById('product');
                var product = productSelect.options[productSelect.selectedIndex].textContent;
                var quantity = parseInt(document.getElementById('quantity').value);
                var price = parseFloat(document.getElementById('price').value);
                var subtotal = quantity * price; // Calcula o subtotal
                var idvenda = document.getElementById('idVenda').textContent;

                // Cria uma nova linha na tabela de vendas e atribui a classe 'sales-row' ao elemento <tr>, esta classe é usada para b
                var newRow = document.createElement('tr');
                newRow.className = 'sales-row'; // Adiciona a classe 'sales-row' ao elemento <tr>
                newRow.innerHTML = '<td>' + idvenda + '</td><td>' + productSelect.value + '</td><td>' + product + '</td><td>' + quantity + '</td><td>' + price.toFixed(2) + '</td><td>' + subtotal.toFixed(2) + '</td><td><button type="button" class="btn btn-danger btn-sm removeBtn">Remover</button></td>';


                document.getElementById('salesData').appendChild(newRow);
    
                // Atualiza o valor total
                total += subtotal;

                // Atualiza a exibição do valor total
               
                // document.getElementById('totalValue').textContent = 'Valor Total: R$ ' + total.toFixed(2);
                totalValueElement.textContent = 'R$ Total: ' + total.toFixed(2);
                totalValueModalElement.textContent = total.toFixed(2);

                // Adiciona o valor selecionado ao array
                productValues.push(productSelect.value);
                console.log(productValues);
    
                // Limpa os campos do formulário
                document.getElementById('product').value = '0';
                document.getElementById('quantity').value = '';
                document.getElementById('price').value = '';
    
                document.getElementById('product').focus();

                contarLinhas();
                somarQuantidade();


                // Adiciona um evento de clique nos botões de remoção
                document.addEventListener('click', function(event) {
                  if (event.target.classList.contains('removeBtn')) {
                    var row = event.target.closest('tr');
                      var subtotal = parseFloat(row.querySelector('td:nth-child(5)').textContent);

                      
                      // Remove a linha
                      row.remove();
                      
                      // Atualiza o valor total
                      total = calcularTotal();
                      
                      // Atualiza a exibição do valor total
                      totalValueElement.textContent = 'R$ Total: ' + total.toFixed(2);
                      
                     
                     // Remove o valor correspondente do array
                      var productIndex = Array.from(document.getElementById('salesData').children).indexOf(row);
                      productValues.splice(productIndex, 1);
                      console.log(productIndex);

                      contarLinhas();

                      somarQuantidade();

                  }

              });

    
            });
        </script>

        
          <script>
                  $(document).ready(function() {
                      $('#product').select2();
                      document.querySelector('#product').focus();

                      // move o foco para dentro do input de pesquisa do select2
                      $(document).on('select2:open', () => {
                        document.querySelector('.select2-search__field').focus();
                      });
                    });
                    
          </script>

          <script>
                // Adiciona um evento de teclado ao documento
                // Ao pressionar a tecla F9 abre o modal de pagamentos
                  document.addEventListener('keydown', function(event) {
                      // Verifica se a tecla pressionada é a tecla F9 (código 120)
                      if (event.keyCode === 120) {
                          // Abre o modal de pagamentos
                          $('#pagamentosModal').modal('show');
                          
                           // Move o foco para o elemento formaSelect após 2 segundos
                            setTimeout(function() {
                                document.getElementById('formaSelect').focus();
                            }, 2000);
                                                }
                    });

          </script>

          
          <script>
            // Obtém a data atual
            var dataAtual = new Date().toISOString().split('T')[0];
            
            // Define o valor padrão para o input dataInput
            document.getElementById('dataInput').value = dataAtual;
          </script>


  <script>
    
      // Adiciona um evento de clique ao botão "adicionarPagamentoBtn" no Modal Pagamentos
      document.getElementById('adicionarPagamentoBtn').addEventListener('click', function() { 
      // Obtém os valores dos inputs
      var data = document.getElementById('dataInput').value;
      var dataFormatada = moment(data).format('DD-MM-YYYY');
      var forma = document.getElementById('formaSelect').value;
      var valor = parseFloat(document.getElementById('valorInput').value);
      
      // Remove a linha em branco, se existir
      var emptyRow = document.getElementById('emptyRow');
      if (emptyRow) {
          emptyRow.remove();
      }
      
      // Cria uma nova linha na tabela
      var newRow = document.createElement('tr');
      newRow.innerHTML = '<td>' + dataFormatada + '</td><td>' + forma + '</td><td>' + valor.toFixed(2) + '</td>';
      
      // Adiciona a nova linha à tabela
      var tableBody = document.getElementById('pagamentosTable').getElementsByTagName('tbody')[0];
      tableBody.appendChild(newRow);
      
      // Limpa os campos dos inputs
      document.getElementById('dataInput').value = '';
      document.getElementById('formaSelect').value = '';
      document.getElementById('valorInput').value = '';
      
      // Calcula e atualiza o valor total
      calculateTotal();
  });

  // Função para calcular e atualizar o valor total do modal Pagamentos
  function calculateTotal() {
      var total = 0;
      var vlDevedorModal = document.getElementById('totalDevedor').textContent;
      var saldo = 0;
      
      
      // Obtém todas as linhas da tabela
      var rows = document.getElementById('pagamentosTable').getElementsByTagName('tbody')[0].getElementsByTagName('tr');
      
      // Percorre as linhas e acumula os valores
      for (var i = 0; i < rows.length; i++) {
          var valorCell = rows[i].getElementsByTagName('td')[2];
          var valor = parseFloat(valorCell.innerText);
          
          if (!isNaN(valor)) {
              total += valor;
          }
      }
      
      // Atualiza o valor total na tabela
      document.getElementById('totalValuePag').innerText = total.toFixed(2);
      saldo = vlDevedorModal - total ;
      document.getElementById('saldoDevedor').innerText = saldo.toFixed(2);

      // console.log(saldo);
}

  </script>

  <script>
    // Adiciona um evento de input aos campos de input 
    document.getElementById('dataInput').addEventListener('input', toggleAddButton);
    document.getElementById('valorInput').addEventListener('input', toggleAddButton);

    // Função para habilitar ou desabilitar o botão "adicionarPagamentoBtn"
    function toggleAddButton() {
        var data = document.getElementById('dataInput').value;
        var valor = document.getElementById('valorInput').value;

        var addButton = document.getElementById('adicionarPagamentoBtn');

        if (data.trim() !== '' && valor.trim() !== '') {
            addButton.disabled = false;
        } else {
            addButton.disabled = true;
        }
    }

// Adiciona um evento de clique ao botão "adicionarPagamentoBtn"
    document.getElementById('adicionarPagamentoBtn').addEventListener('click', function() {
        // ...
        // Resto do código para adicionar o pagamento à tabela
        // ...

        // Limpa os campos dos inputs
        // document.getElementById('dataInput').value = '';
        document.getElementById('formaSelect').value = '';
        document.getElementById('valorInput').value = '';

        // Desabilita o botão "adicionarPagamentoBtn" novamente
        toggleAddButton();

        // Vai para o input forma de pagamento
        document.getElementById('formaSelect').focus();

        // Obtém a data atual
        var dataAtual = new Date().toISOString().split('T')[0];
        
        // Define o valor padrão para o input dataInput
        document.getElementById('dataInput').value = dataAtual;

    });


  </script>

  <script>
    
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
  </script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
  
  // ENVIAR OS ITENS DA TABELA PARA O REQUEST

$(document).ready(function() {
    $('#salvarBtn').click(function(e) {
        e.preventDefault(); // Evita o envio imediato do formulário

        var data = []; // Array para armazenar os dados da tabela

        // seleciona o elemento <tr> que contém a classe 'sales-row' e busca os dados de cada célula
        $('.sales-row').each(function() {
            var row = $(this);
            var idVenda = row.find('td:eq(0)').text();
            var idProd = row.find('td:eq(1)').text();
            var produto = row.find('td:eq(2)').text();
            var qtd = row.find('td:eq(3)').text();
            var preco = row.find('td:eq(4)').text();
            var subtotal = row.find('td:eq(5)').text();

            // Cria um objeto com os dados da venda atual
            var sale = {
                idVenda: idVenda,
                idProd: idProd,
                produto: produto,
                qtd: qtd,
                preco: preco,
                subtotal: subtotal
            };

            // Adiciona a venda ao array de dados
            data.push(sale);
            
          });

        // Adiciona os dados ao campo de formulário antes de enviar
        $('input[name="allsalesData"]').val(JSON.stringify(data));

        // Submete o formulário
        $('form').submit();
    });
});
</script>

                

       

    </div>
  
</body>
</html>
