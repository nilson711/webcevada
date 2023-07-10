@extends('layouts.app')

@section('content')

<style>
  .btn-oculto {
    display: none;
  }
</style>

{{--------------------- MODAL Adicionar Novo Estoque --------------------}}

<div class="modal fade" id="addEstoque" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addEstoque">Adicionar Novo Estoque</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action= {{route('newEstoqueSubmit')}} method="post">
        @csrf
        <div class="modal-body">
            
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label for="cod">Código</label>
                        <input type="text" class="form-control editInput" id="cod" name="cod" maxlength="13" type="number" required placeholder="Ex: 78936683" value="{{old('cod')}}" >
                        <div style="color:red"> {{$errors->has('cod') ? $errors->first('cod') : ''}} </div>
                    </div>
                    <div class="col-md-6">
                        <label for="id">Fornecedor</label>
                        <select class="form-control" id="fornecedors_id" name="fornecedors_id" required>
                            <option value="" selected>Selecione</option>
                            @foreach ($FornecedorsCad as $Fornec)
                                <option value="{{$Fornec->id}}">{{$Fornec->fornecedor}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="idProduto">Produto</label>
                <select class="form-control editInput" id="produtos_id" name="produtos_id">
                    @foreach ($estoquesCad as $itemEstoq)
                        <option value="{{$itemEstoq->id}}">{{$itemEstoq->Produto}}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group">
                <div class="row">
                    <div class="col-md-2">
                        <label for="qtd">Qtd</label>
                        <input type="number" class="form-control" title="Qtd em UNIDADES que entrará no Estoque" name="qtd" id="qtd" min="1" required onchange="calculaCustoAddEstoque()">
                    </div>
                    <div class="col-md-2">
                        <label for="custoUnit">Custo Unit</label>
                        <input type="text" class="form-control" title="Custo Unitário" name="unit" id="unit" value="0" required onchange="calculaCustoAddEstoque()">
                    </div>
                    <div class="col-md-3">
                        <label for="custoTotal">Custo Total</label>
                        <input type="text" class="form-control" title="Custo Total" name="custoTotal" id="custoTotal" onchange="calculaCustoUnit()" required>
                    </div>
                    <div class="col-md-2">
                        <label for="vlVenda">Venda Varejo</label>
                        <input type="text" class="form-control" title="Preço p/ Varejo (unidade) " name="vlVenda" id="vlVenda" value="0" required onchange="calculaLucroVarejo()">
                        <small id="margemVarejo" title="margem de lucro">0%</small>
                    </div>
                    <div class="col-md-2">
                        <label for="vlAtacado">Venda Atacado</label>
                        <input type="text" class="form-control" title="Preço p/ Atacado (caixa)" name="vlAtacado" id="vlAtacado" value="0" required onchange="calculaLucroAtacado()">
                        <small id="margemAtacado" title="margem de lucro">0%</small>
                    </div>
                </div>
                
            </div>
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" id="btnSalvarAddEstoque" disabled class="btn btn-primary" onclick="exibirAlerta('A operação foi realizada com êxito.', 'success', 5000);">Salvar</button>
          </div>
      </form>
    </div>
  </div>
</div>

{{-- ==================================================================================== --}}

{{--------------------- MODAL Editar Estoque --------------------}}

<div class="modal fade" id="editEstoque" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editEstoque">Editar Estoque</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
        
        <form id="form-edit" action="{{route('editProductSubmit', 999)}}" method="post">
            @csrf

            <div class="form-group">
              <label for="cod">Código</label>
              <input type="hidden" name="idProd" id="idProd">
              <input type="text" class="form-control" id="newcod" name="newcod" maxlength="13" type="number" required placeholder="Ex: 78936683"  >
                <div style="color:red"> {{$errors->has('cod') ? $errors->first('cod') : ''}} </div>
            </div>
            <div class="form-group">
              <label for="Estoque">Descrição</label>
              <input type="text" class="form-control" id="newEstoque" name="newEstoque" onkeydown="upperCaseF(this)" required placeholder="Ex: CERVEJA HEINEKEN LONG NECK 330ML CX C/ 12 UND"  >
              <div style="color:red">{{$errors->has('Estoque') ? $errors->first('Estoque') : ''}} </div>
            </div>
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Salvar</button>
          </div>
      </form>
    </div>
  </div>
</div>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-1">

		</div>
    <div class="col-md-10">
                @if ($errors->any())
                  <div style="position: absolute; top:0px; left:0px; width:100%; color:white; background-color: red; text-align:center">
                    @foreach ($errors->all() as $erro)
                        {{$erro}}<br>
                    @endforeach
                  </div>
                <hr><br><br>
                @endif
            <div class="card">
              
                <div class="card-header">
                  <div class="row">
                    <div class="col-md-5">
                      <h3>
                        Estoque
                      </h3> 
                    </div>
                    <div class="col-md-5">
                      <input type="text" id="myInput" onkeyup="searchTable()" placeholder="Procurar...">
                    </div>
                    <div class="col-md-2">
                      {{-- <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addEstoque">+</button> --}}
                    </div>
                  </div>
                </div>
                
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                            Estou logado!
                        </div>
                    @endif
      
                    <div style="display: block; height:370px; overflow-y:scroll">

                      <table class="table table-hover table-borderless table-sm" id="myTable">
                        <thead>
                          <tr>
                            {{-- <th scope="col">#</th> --}}
                            <th scope="col">Cód Barras</th>
                            <th scope="col">Produto</th>
                            <th scope="col">Qtd</th>
                            <th scope="col" style="color:white">Opções</th>
                          </tr>
                        </thead>
                        <tbody>

                            @foreach ($estoquesCad as $estoque)
                                
                              <tr onmouseover="mostrarBotao(this);" onmouseout="ocultarBotao(this);">
                                <td>{{$estoque->cod}}</td>
                                <td>{{$estoque->id}} - {{$estoque->Produto}}</td>
                                <td style="text-align: right">{{$estoque->emEstoque ? $estoque->emEstoque : "0" }}</td>
                                <td>
                                  <button type="button" class="btn btn-sm btn-oculto btn-primary float-right" data-idp="{{$estoque->id}}" data-cod="{{$estoque->cod}}" data-nome="{{$estoque->Produto}}"  data-toggle="modal" data-target="#addEstoque">+</button>
                                </td> 
                              </tr>

                            @endforeach
                        </tbody>
                      </table>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-md-1 alertaqui" id="alertaqui">
                            {{-- Alertas da página --}}
                            
            </div>
        </div>
    </div>
</div>


{{-- <script src="js/alertSucess.js" defer></script> --}}
<script src="js/seachInTable.js"></script>
<script src="js/verBtnMoverMouse.js"></script>
{{-- <script src="js/valueToModal.js"></script> --}}
<script src="js/idRouteToModal.js"></script>
<script src="js/upperCaseF.js"></script>
<script src="js/valueToModalEstoque.js"></script>
<script src="js/functionsEstoque.js"></script>


@if ($msgSalvo)
  <script src="js/alertSucess.js"></script>
@endif


@endsection

