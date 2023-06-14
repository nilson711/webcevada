@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="card" style="border-color: black">
        <form action="#" method="post">
          @csrf
        <div >
          <div class="row">
            {{-- <div class="col-md-1" style="margin: 10px">
              <h5>Vendas</h5>
            </div> --}}

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
              {{-- <small>Atacado</small> --}}
              <small>Atacado</small><br> 
              <input type="checkbox" class="form-check-input" id="checkAtacado" style="width: 20px; height:20px">                
              {{-- <select class="form-control form-control-sm">
                <option selected>Varejo</option>
                <option>Atacado</option>
              </select> --}}
            </div>

            <div class="col-md-7">
              <small>Produto</small>
              {{-- <input type="text" class="form-control form-control-sm" id="myInput" onkeyup="searchTable()" placeholder="Procurar..."> --}}

              <select class="form-control form-control-sm select2" id="selectFind">
                @foreach ($estoquesCad as $Prod)
                  <option value="{{$Prod->id}}">{{$Prod->Produto}}</option>
                @endforeach
              </select>


              {{-- <select class="js-example-basic-single" name="state">
                <option value="AL">Alabama</option>
                  ...
                <option value="WY">Wyoming</option>
              </select> --}}

                            

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

<script>
  // In your Javascript (external .js resource or <script> tag)
      $(document).ready(function() {
          $('#selectFind').select2();
      });
</script>
@endsection


