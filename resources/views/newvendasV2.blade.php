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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-ABC123..." crossorigin="anonymous">

    

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
            
           
                <div class="form-row" id="inputsPagts">
                    <div class="form-group col-md-4">
                        <label for="dataInput">Data</label>
                        <input type="date" class="form-control" id="dataInput">
                    </div>
                    <div class="form-group col-md-3" style="display:inline">
                        <label for="formaSelect">Forma</label>
                        <select class="form-control" id="formaSelect" required onchange="habilitaValor()">
                            <option value= "n" selected>Selecione...</option>
                            <option value="debito">Débito</option>
                            <option value="credito">Crédito</option>
                            <option value="pix">Pix</option>
                            <option value="dinheiro">Dinheiro</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="valorInput">Valor</label>
                        <input type="text" class="form-control" id="valorInput"  disabled>
                    </div>
                    <div class="col-md-1">
                      <label for="adicionarPagamentoBtn">Shift+F7</label>
                      <button  class="btn btn-primary" id="adicionarPagamentoBtn" disabled>Ok</button>

                    </div>
                </div>
           
              <div class="form-row">
                <div class="form-group" id="divdinheiroRec" style="display: none">
                  <div class="row">
                    <div class="col-5">
                      <label for="dinheiroRec">Dinheiro</label>
                      <input type="text" class="form-control" name="dinheiroRec" id="dinheiroRec" placeholder="Digite o valor recebido" onchange="calcTroco()">
                    </div>
                    <div class="col-5">
                      <label for="troco">Troco</label>
                      <input type="text" class="form-control" name="troco" id="troco" disabled>
  
                    </div>

                  </div>

                </div>

              </div>
              <hr>
              <form id="pagamentosForm" action="/newpagto" method="POST">
                @csrf
            
                <table id="pagamentosTable" class="table table-sm">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Forma</th>
                            <th class="text-right">Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Linhas da tabela de pagamentos serão adicionadas dinamicamente aqui -->
                        @foreach ($pagtos as $pagto)
                          <tr>
                            {{-- <td> {{$pagto->dtPagto}} </td> --}}
                            <td>{{ date('d/m', strtotime($pagto->dtPagto)) }} </td>
                            
                            <td>{{$pagto->forma}}</td>
                            <td class="celula text-right">{{$pagto->valor}}</td>
                          </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr style="color: blue">
                            <th colspan="2">Total Pago</th>
                            <td id="totalValuePag" class="celula text-right">{{$totalPago}}</td>
                        </tr>
                        <tr style="color: red">
                            <th colspan="2">Devedor</th>
                            <td id="totalDevedor" class="celula text-right">{{$totalItens}}</td>
                        </tr>
                        <tr>
                            <th colspan="2">Saldo</th>
                            <td id="saldoDevedor" class="celula text-right {{$saldo < 0 ? 'text-danger' : ''}}" >{{$saldo}} </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                            </td>
                          </tr>
                        </tfoot>
                      </table>
                      <input type="hidden" name="allPagtos"><!--Campo que receberá os datos de pagamento-->
                      <button type="submit" id="salvarPagtos" class="btn btn-primary">Gravar Pagamentos (Shift+F8)</button>
                      
              </form>
            
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
                      <div class="col-md-3">
                        <div class="row">
                          <a class="navbar-brand" href="{{ url('/home') }}">
                            {{-- {{ config('app.name', 'WebCevada') }} --}}
                            <i class="fas fa-home fa-lg"></i> <!-- Ícone do foguete -->
                          </a>
                          <h1>Vendas</h1>

                        </div>
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

                <form method="post" id="itensForm" action="/newitens">
                  @csrf
                    <table id="salesTable" class="table table-sm">
                        <thead>
                            <tr>
                                <th>IdVenda</th>
                                <th>IdProd</th>
                                <th>Produto</th>
                                <th class="text-center">Qtd</th>
                                <th class="text-right">Preço</th>
                                <th class="text-right">Subtotal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="salesData">
                          @foreach ($itens as $item)
                          <tr>

                            <td>{{$item->vendas_id}}</td>
                            <td>{{$item->produto_id}}</td>
                            <td>{{$item->Produto}}</td>
                            <td class="text-center">{{$item->qtd}}</td>
                            <td class="celula text-right">{{$item->vlUnit}}</td>
                            <td class="celula text-right">{{$item->totItem}}</td>
                          </tr>
                          @endforeach
                            <!-- Os registros de vendas serão adicionados dinamicamente aqui -->
                        </tbody>
                    </table>
                    <input type="hidden" name="allsalesData"> <!-- Campo oculto para armazenar os dados da tabela -->
                    <button id="salvarBtn" class="btn btn-primary" type="submit">Salvar (F8)</button>
                    <button id="pagtoBtn" type="button" class="btn btn-primary"  data-toggle="modal"  data-target="#pagamentosModal">Pagamento (F9)</button>
                    <a href={{route('newvenda')}}><button type="button" class="btn btn-primary" id="newVenda" style="margin-right: 10px">Nova Venda (Shift+F2)</button></a>
                    <input type="hidden" name="valorProdutos" id="valorProdutos" value="{{$totalItens}} ">
                </form>
                <div class="row">
                  <div class="col-md-1">
                    <div id="rowCount">Linhas: 0</div>
                  </div>
                  <div class="col-md-6 text-right">
                    <div id="totalQuantity">Itens: 0</div>
                  </div>
                  <div class="col-md-5" style="color: blue">
                    <h4 id="totalValue" class="text-right" style="margin-right: 20px"><strong><span class="celula"> {{$totalItens}} </span></strong></h4>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <h4 class="text-right text-success" style="margin-right: 20px">Pago: <span class="celula" id="totalPago"> {{$totalPago}} </span></h4>

                  </div>
                </div>



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
                // totalValueElement.textContent = 'R$ Total: ' + total;
                totalValueModalElement.textContent = total;

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

                      // Calcula e atualiza o valor total
                    calculateTotal();
                    });
                    
          </script>

          <script>
                // Adiciona um evento de teclado ao documento
                // Ao pressionar a tecla F9 abre o modal de pagamentos
                  document.addEventListener('keydown', function(event) {

                      total = document.getElementById('totalDevedor').textContent;
                      // console.log(total);
                    
                      if (document.getElementById('pagtoBtn').disabled) {
                          // console.log('está desabilitado');
                      } else {
                        // console.log('está habilitado');
                        
                          if (event.keyCode === 120) {
                              // Abre o modal de pagamentos
                              $('#pagamentosModal').modal('show');

                              tDev = document.getElementById('totalDevedor').textContent;
                              tPag = document.getElementById('totalValuePag').textContent;
                               
                              // Se o total Devedor for maior que o total pago torna os inputs de pagamento visíveis
                              if (tDev > tPag ) {
                                document.getElementById('inputsPagts').style.visibility = "visible";
                                document.getElementById('salvarPagtos').style.visibility = "visible";
                              } else {
                                // AQUI
                                document.getElementById('inputsPagts').style.visibility = "hidden";
                                document.getElementById('salvarPagtos').style.visibility = "hidden";
                                
                              }

                              
                              
                              // Move o foco para o elemento formaSelect após 2 segundos
                                setTimeout(function() {
                                    document.getElementById('formaSelect').focus();
                                }, 2000);
                                                    }
                      }
                      
                    });

                      // Evento de teclado ao pressionar F9
                    $(document).keydown(function(e) {
                        if (e.which === 120) { // Código da tecla F9
                            $('#pagtoBtn').trigger('click');
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
      var valor = document.getElementById('valorInput').value;
    
      // Remove a linha em branco, se existir
      var emptyRow = document.getElementById('emptyRow');
      if (emptyRow) {
          emptyRow.remove();
      }
      
      // Cria uma nova linha na tabela
      var newRow = document.createElement('tr');
      newRow.className = 'pagtos-row'; //Adiciona a classe pagtos-row a linha <tr>
      newRow.innerHTML = '<td>' + dataFormatada + '</td><td>' + forma + '</td><td>' + valor + '</td>';

      newRow.style.backgroundColor = 'lightblue'; // Define a cor de fundo como lightblue
      
      // Adiciona a nova linha à tabela
      var tableBody = document.getElementById('pagamentosTable').getElementsByTagName('tbody')[0];
      tableBody.appendChild(newRow);
      
      // Limpa os campos dos inputs
      document.getElementById('dataInput').value = '';
      document.getElementById('formaSelect').value = '';
      document.getElementById('valorInput').value = '';
      document.getElementById('valorInput').disabled = true;
      
      // Calcula e atualiza o valor total
      calculateTotal();
  });

  // Função para calcular e atualizar o valor total do modal Pagamentos
  function calculateTotal() {
      var total = 0;
      var vlDevedorModal = document.getElementById('totalDevedor').textContent;
      var vlDevedorModalnr = parseFloat(vlDevedorModal);
      var saldo = 0;
      
      
      // Obtém todas as linhas da tabela
      var rows = document.getElementById('pagamentosTable').getElementsByTagName('tbody')[0].getElementsByTagName('tr');
      
      // Percorre as linhas e acumula os valores
      for (var i = 0; i < rows.length; i++) {
        var valorCell = rows[i].getElementsByTagName('td')[2];
        var valor = parseFloat(valorCell.innerText);
        
        if (!isNaN(valor)) {
          total += valor;
        }else{
          total = 0;
        }
      }
      
      // Atualiza o valor total na tabela
      // document.getElementById('totalValuePag').innerText = total;
      saldo = vlDevedorModalnr - total ;
      // document.getElementById('saldoDevedor').innerText = saldo;
      
      
      // console.log(valor);
      // console.log(vlDevedorModalnr);
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
        var forma = document.getElementById('formaSelect').value;
        var valor = document.getElementById('valorInput').value;

        var addButton = document.getElementById('adicionarPagamentoBtn');

        if (data.trim() !== '' && valor.trim() !== '' && forma.trim() !== 'n' || forma !== null || forma !== '') {
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
        document.getElementById('dinheiroRec').value = '';
        document.getElementById('troco').value = '';

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

       // Verifica se o campo allsalesData não é um array vazio
       if (data.length !== 0) {
          // Submete o formulário se o array não for vazio
          // $('form').submit();
          $('#itensForm').submit();
        } 

    });

    // Evento de teclado ao pressionar F8
    $(document).keydown(function(e) {

      var tPag = document.getElementById('totalPago').textContent;
      var tVenda = document.getElementById('totalValue').textContent;
      
        if (e.which === 119) { // Código da tecla F8
            $('#salvarBtn').trigger('click');

            // tPag == '0,00' ? console.log('é zero') : console.log(tPag);
            // Habilitar botão Pagamento quando valor pago for menor que o valor do débito
            if (tPag < tVenda) {
              console.log('não pagou tudo');
              document.getElementById('pagtoBtn').disabled=false;
            }

            
        }
    });
});


</script>


<script>

  // ENVIAR OS PAGAMENTOS PARA O REQUEST

  $(document).ready(function() {
    $('#salvarPagtos').click(function(e) {
        e.preventDefault(); // Evita o envio imediato do formulário

        var arrayPagtos = []; // Array para armazenar os dados da tabela
        var idv = document.getElementById('idVenda').textContent;

        // seleciona o elemento <tr> que contém a classe 'pagtos-row' e busca os dados de cada célula
        $('.pagtos-row').each(function() {
            var row = $(this);
            var data = row.find('td:eq(0)').text();
            var forma = row.find('td:eq(1)').text();
            var valor = row.find('td:eq(2)').text().replace(',', '.');

            // Cria um objeto com os dados da venda atual
            var pagtos = {
                idv: idv,
                data: data,
                forma: forma,
                valor: valor
            };

            // Adiciona o pagto ao array de dados
            arrayPagtos.push(pagtos);
        });

        // Adiciona os dados ao campo de formulário antes de enviar
        $('input[name="allPagtos"]').val(JSON.stringify(arrayPagtos));

       // Verifica se o campo allPagtos não é um array vazio
       if (arrayPagtos.length !== 0) {
          // Submete o formulário se o array não for vazio
          // $('form').submit();
          $('#pagamentosForm').submit();
      
        } 
       
    });

    // Evento de teclado ao pressionar F#
    // $(document).keydown(function(e) {
    //     if (e.which === 119) { // Código da tecla F#
    //         $('#salvarPagtos').trigger('click');
    //     }
    // });
});

</script>

<script>
  // FORMATA O VALOR PARA DUAS CASA DECIMAIS
  const celulas = document.getElementsByClassName('celula');

  for (let i = 0; i < celulas.length; i++) {
    const numero = parseFloat(celulas[i].textContent);
    const numeroFormatado = numero.toFixed(2).replace('.', ',');
    // const numeroFormatado = numero.toFixed(2);
    celulas[i].textContent = numeroFormatado;
  }
</script>
                
<script>
  // GRAVAR PAGAMENTOS AO PRESSIONAR SHIF+F8
  var gravarPagtos = document.getElementById("salvarPagtos");

  document.addEventListener("keydown", function(event) {
    if (event.shiftKey && event.keyCode === 119) { // 119 é o código da tecla F8
      gravarPagtos.click();
    }
  });

</script>

<script>
  // LANÇA O VALOR DO PAGAMENTO AO PRESSIONAR O BTN OK
  var addPagtos = document.getElementById("adicionarPagamentoBtn");

  document.addEventListener("keydown", function(event) {
    if (event.shiftKey && event.keyCode === 118) { // 118 é o código da tecla F7
      addPagtos.click();
    }
  });

</script>

<script>
  // ABRE NOVA VENDA BOTÃO NOVA VENDA
  var newVenda = document.getElementById("newVenda");

  document.addEventListener("keydown", function(event) {
    if (event.shiftKey && event.keyCode === 113) { // 113 é o código da tecla F2
      newVenda.click();
    }
  });

</script>



       

    </div>
  
</body>
</html>
