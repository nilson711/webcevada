<!DOCTYPE html>
<html>
<head>
    <title>Sistema de PDV</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    {{--  --}}
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

    <!-- Select2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet"/>

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

            <div>
                <div class="row">
                    <div class="col-md-4">
                        <h1>Sistema de PDV</h1>

                    </div>
                    
                    <div class="col-md-4">
                        
                        <small>Cliente</small>
                          <select class="form-control form-control-sm">
                            @foreach ($ClientesCad as $Cliente)
                              {{-- <option value="1" selected>Balcão</option> --}}
                              <option value="{{$Cliente->id}}">{{$Cliente->nomeClient}}</option>
                            @endforeach
                          </select>
                      
                    </div>

                    <div class="col-md-3">

                        <small for="checkAtacado">Atacado</small><br>
                        <input type="checkbox" class="form-check-input" id="checkAtacado" style="width: 50px; height:22px">                

                    </div>

                </div>
                <hr>
                <form id="salesForm">
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label for="product">Produto:</label>
                            {{-- <input type="text" class="form-control" id="product" required> --}}

                            <select class="form-control select2" id="product" onchange="mostrarValor()" >
                                <option value="" selected>Selecione um Produto</option>
                                @foreach ($estoquesCad as $Prod)
                                  <option value="{{$Prod->id}}" data-value2={{$Prod->precoVenda}} data-value3={{$Prod->precoAtacado}}>{{$Prod->Produto}} / R$ {{$Prod->precoVenda}}</option>
                                @endforeach
                              </select>


                        </div>
                        <div class="form-group col-md-1">
                            <label for="quantity">Quantidade:</label>
                            <input type="number" class="form-control" id="quantity" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="price">Preço:</label>
                            <input type="number" class="form-control" id="price" step="0.01" required>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary" style="margin-top: 30px">Ok</button>
                        </div>
                    </div>
                </form>
                <hr>
                <h2>Registro de Vendas</h2>
                <table id="salesTable" class="table table-sm">
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Quantidade</th>
                            <th>Preço</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody id="salesData">
                        <!-- Os registros de vendas serão adicionados dinamicamente aqui -->
                    </tbody>
                </table>
                <h3 id="totalValue" style="text-align: right">Valor Total: R$ 0.00</h3>
            </div>
        </div>


    </div>
</div>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>

    <script>

        var total = 0; // Variável para armazenar o valor total
        var totalValueElement = document.getElementById('totalValue'); // Elemento do valor total

        // Adiciona um evento de submit ao formulário
        document.getElementById('salesForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Impede o envio padrão do formulário

            // Obtem os valores do formulário
            var product = document.getElementById('product').value;
            var quantity = parseInt(document.getElementById('quantity').value);
            var price = parseFloat(document.getElementById('price').value);
            var subtotal = quantity * price; // Calcula o subtotal

            // Cria uma nova linha na tabela de vendas
            var newRow = document.createElement('tr');
            newRow.innerHTML = '<td>' + product + '</td><td>' + quantity + '</td><td>' + price + '</td><td>' + subtotal + '</td>';
            document.getElementById('salesData').appendChild(newRow);

            // Atualiza o valor total
            total += subtotal;

            // Atualiza a exibição do valor total
           
            // document.getElementById('totalValue').textContent = 'Valor Total: R$ ' + total.toFixed(2);
            totalValueElement.textContent = 'Valor Total: R$ ' + total.toFixed(2);

            // Limpa os campos do formulário
            document.getElementById('product').value = '';
            document.getElementById('quantity').value = '';
            document.getElementById('price').value = '';

            document.getElementById('product').focus();

        });
    </script>
    <script>
                  $(document).ready(function() {
                      $('#product').select2();
                      document.querySelector('#product').focus();

                      // move o foco para dentro do input de pesquisa do select2
                      $(document).on('product:open', () => {
                        document.querySelector('.select2-search__field').focus();
                      });
                    });
                    
    </script>
    </div>
</body>
</html>
