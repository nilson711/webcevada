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
                              {{-- <option value="1" selected>Balcão</option> --}}
                              <option value="{{$Cliente->id}}">{{$Cliente->nomeClient}}</option>
                            @endforeach
                          </select>
                      </div>
          
                      <div class="form-group col-md-3">
                        
                                        
                        
                      </div>

                  </div>
          
                </div>


                <form id="salesForm">
                    <div class="form-row">
                        <div class="form-group col-md-7">
                            <label for="product">Produto:</label>
                            {{-- <input type="text" class="form-control" id="product" required> --}}

                            <select class="form-control form-control-sm select2" id="product" onchange="mostrarValor()" >
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
                <table id="salesTable" class="table table-sm">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Produto</th>
                            <th>Qtd</th>
                            <th>Preço</th>
                            <th>Subtotal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="salesData">
                        <!-- Os registros de vendas serão adicionados dinamicamente aqui -->
                    </tbody>
                    {{-- <tfoot>
                      <tr>
                          <td colspan="2" id="rowCount">Linhas: 0</td>
                          <td>Itens: 0</td>
                          <td></td>
                          <td><strong>Total: R$ 0.00</strong></td>
                          <td></td>
                      </tr>
                  </tfoot> --}}
                </table>
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

                </div>
              </div>
            </div>
          
          </div>
          
          <script src="js/seachInTable.js"></script>
          <script src="js/functionsVendas.js"></script>
          <script src="js/verBtnMoverMouse.js"></script>
          
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>
          
          
          <script>

            var total = 0; // Variável para armazenar o valor total
            var totalValueElement = document.getElementById('totalValue'); // Elemento do valor total
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

    
                // Cria uma nova linha na tabela de vendas
                var newRow = document.createElement('tr');
                // newRow.innerHTML = '<td>' + product + '</td><td>' + quantity + '</td><td>' + price + '</td><td>' + subtotal + '</td>';
                // newRow.innerHTML = '<td>' + product + '</td><td>' + quantity + '</td><td>' + price.toFixed(2) + '</td><td>' + subtotal.toFixed(2) + '</td><td><button type="button" class="btn btn-danger btn-sm removeBtn">Remover</button></td>';

                newRow.innerHTML = '<td>' + productSelect.value + '</td><td>' + product + '</td><td>' + quantity + '</td><td>' + price.toFixed(2) + '</td><td>' + subtotal.toFixed(2) + '</td><td><button type="button" class="btn btn-danger btn-sm removeBtn">Remover</button></td>';

                document.getElementById('salesData').appendChild(newRow);
    
                // Atualiza o valor total
                total += subtotal;

                // Atualiza a exibição do valor total
               
                // document.getElementById('totalValue').textContent = 'Valor Total: R$ ' + total.toFixed(2);
                totalValueElement.textContent = 'R$ Total: ' + total.toFixed(2);

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
            
          </script>

                

       

    </div>
  
</body>
</html>
