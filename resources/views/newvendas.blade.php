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
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet"/>
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}


</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    {{ config('app.name', 'WebCevada') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                        <div class="btn-group" role="group" style="margin-right: 10px">
                            <button  id="btnGroupDrop1" type="button" class="btn btn-outline-primary btn-lg dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Cadastro
                            </button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                              <a class="dropdown-item" href={{ route('cadProdutos') }}>Produtos</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href={{route('cadClientes')}}>Clientes</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href={{route('cadFornecedores')}}>Fornecedores</a>
                            </div>
                        </div>

                        <a href={{route('estoque')}}><button type="button" class="btn btn-outline-primary btn-lg" style="margin-right: 10px">Estoque</button></a>
                        <a href={{route('venda')}}><button type="button" class="btn btn-outline-primary btn-lg" style="margin-right: 10px">Vendas</button></a>
                        <a href={{route('financeiro')}}><button type="button" class="btn btn-outline-primary btn-lg" style="margin-right: 10px">Financeiro</button></a>
                    </ul>
                    

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        
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
                <div class="card">
                  <form action="#" method="post">
                    @csrf
                  <div class="card-header" >
                    <div class="row">
                      <div class="col-md-1" style="margin: 3px">
                        <h5>Vendas</h5>
                      </div>
          
                      <div class="form-group col-md-2">
                        <small>Cliente</small>
                          <select class="form-control form-control-sm">
                            @foreach ($ClientesCad as $Cliente)
                              {{-- <option value="1" selected>Balcão</option> --}}
                              <option value="{{$Cliente->id}}">{{$Cliente->nomeClient}}</option>
                            @endforeach
                          </select>
                      </div>
          
                      <div class="form-group col-md-1" style="text-align: center">
                        <small>Atacado</small><br> 
                        <input type="checkbox" class="form-check-input" id="checkAtacado" style="width: 20px; height:20px">                
                        
                      </div>
          
                      <div class="col-md-7">
                        <small>Produto</small>
                        {{-- <input type="text" class="form-control form-control-sm" id="myInput" onkeyup="searchTable()" placeholder="Procurar..."> --}}
          
                        <select class="form-control form-control-sm select2" id="selectFind" onchange="mostrarValor()" >
                          <option value="" selected>Selecione um Produto</option>
                          @foreach ($estoquesCad as $Prod)
                            <option value="{{$Prod->id}}" data-value2={{$Prod->precoVenda}} data-value3={{$Prod->precoAtacado}}>{{$Prod->Produto}} / R$ {{$Prod->precoVenda}}</option>
                          @endforeach
                        </select>

                      </div>
                    </div>
          
                  </div>
          
                  <div class="card-body">
                      <div class="form-group">
                        {{-- <small>Produto</small> --}}
                        <div style="display: block; height:100px; overflow-y:scroll">
                          <table class="table table-hover table-borderless table-sm" id="myTable">
                            <thead>
                              <tr>
                                {{-- <th scope="col" style="color:white">Opções</th> --}}
                              </tr>
                            </thead>
                            <tbody>
            
                                @foreach ($estoquesCad as $estoque)
                                    
                                  <tr onmouseover="mostrarBotao(this);" onmouseout="ocultarBotao(this);">
                                    {{-- <td>{{$estoque->cod}}</td> --}}
                                    <td>{{$estoque->Produto}}</td>
                                    {{-- <td style="text-align: right">{{$estoque->emEstoque ? $estoque->emEstoque : "0" }}</td> --}}
                                    <td>
                                      <button onclick="prodSelect()" style="display: none" type="button" class="btn btn-sm btn-oculto btn-primary float-right" 
                                      data-idp="{{$estoque->id}}" data-cod="{{$estoque->cod}}" data-nome="{{$estoque->Produto}}" data-venda={{$estoque->precoVenda}} data-atacad={{$estoque->precoAtacado}} data-toggle="modal" data-target="#editProduto">+</button>
                                    </td> 
                                  </tr>
            
                                @endforeach
                            </tbody>
                          </table>
                        </div>
          
                      </div>
                      <div class="row">
                        
                        <div class="form-group col-md-12">
                          <small>item</small>
                          <input type="text" name="item" id="item" class="form-control form-control-lg " >
                        </div>
                      
                      </div>
                      <div class="row">
                        <div class="form-group col-md-4">
                          <small>Quantidade</small>
                          <input type="number" name="qtd" id="qtd" onchange="calcSubtotal()" class="form-control form-control-lg " value="1">
                        </div>
                        <div class="form-group col-md-4">
                          <small>R$ Unit</small>
                          <input type="text" name="vlUnit" id="vlUnit" readonly class="form-control form-control-lg " >
                        </div>
                        <div class="form-group col-md-4">
                          <small>Subtotal</small>
                          <input type="text" name="subtotal" id="subtotal" readonly class="form-control form-control-lg " >
                        </div>
                      </div>
          
                    </form>
                  </div>
                </div>
              </div>
            </div>
          
            <div class="row">
               {{-- Tabela Lista de Compras --}}
               <div class="col-md-5">
                {{-- <h1>Vendas</h1> --}}
                <div class="card" style="background-color:rgb(255, 255, 180)">
          
                  <div class="card-body" style="height:400px">
                    
                    <table class="table table-sm">
                      <thead>
                        <tr>
                          <th scope="col" style="width: 30px">Qtd</th>
                          <th scope="col" style="width: 400px">Produto</th>
                          <th scope="col" style="text-align: right">Unit</th>
                          <th scope="col" style="text-align: right">Subtotal</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row">10</th>
                          <td>Antarctica</td>
                          <td style="text-align: right">2,50</td>
                          <td style="text-align: right">25,00</td>
                        </tr>
                        <tr>
                          <th scope="row">6</th>
                          <td>Skol</td>
                          <td style="text-align: right">4,50</td>
                          <td style="text-align: right">27,00</td>
                        </tr>
                        <tr>
                          <th scope="row">3</th>
                          <td>Heineken</td>
                          <td style="text-align: right">8,00</td>
                          <td style="text-align: right">24,00</td>
                        </tr>
                      </tbody>
                    </table>
          
                    
                  </div>
                  <div class="card-footer">
                    <div class="float-right">
                      <h4>Total: 76,00</h4>
                    </div>
                    
                  </div>
                </div>
                {{--  --}}
                </div>
            </div>
            
              
          
              
          </div>
          
          <script src="js/seachInTable.js"></script>
          <script src="js/functionsVendas.js"></script>
          <script src="js/verBtnMoverMouse.js"></script>
          
          {{-- <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script> --}}
          {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script> --}}
          {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script> --}}
          {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
          {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
          
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>
          
          
          <script>
                  $(document).ready(function() {
                      $('#selectFind').select2();
                      document.querySelector('#selectFind').focus();

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
