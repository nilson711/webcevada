@extends('layouts.app')

@section('content')

<style>
  .btn-oculto {
    display: none;
  }
</style>

{{--------------------- MODAL Adicionar Novo Fornecedor --------------------}}

<div class="modal fade" id="addFornecedor" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addFornecedor">Adicionar Novo Fornecedor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action= {{route('newFornecSubmit')}} method="post">
        @csrf
        <div class="modal-body">
            
            <div class="form-group">
              <label for="Fornecedor">Nome:</label>
              <input type="text" class="form-control" id="Fornecedor" name="fornecedor" onkeydown="upperCaseF(this)" required placeholder="Nome do Fornecedor" value="{{old('nomefornec')}}" >
              <div style="color:red">{{$errors->has('Fornecedor') ? $errors->first('Fornecedor') : ''}} </div>
            </div>
            {{-- <div class="form-group">
              <label for="Endereço">Endereço:</label>
              <input type="text" class="form-control" id="end" name="Endfornec" onkeydown="upperCaseF(this)"  placeholder="Endereço do Fornecedor" value="{{old('Endfornec')}}" >
              <div style="color:red">{{$errors->has('end') ? $errors->first('Fornecedor') : ''}} </div>
            </div> --}}
            <div class="form-group">
              <label for="Fornecedor">Telefone:</label>
              <input type="text" class="form-control" id="tel" name="telefone" onkeydown="upperCaseF(this)"  placeholder="9999-9999" value="{{old('tel1fornec')}}" >
              <div style="color:red">{{$errors->has('end') ? $errors->first('end') : ''}} </div>
            </div>
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary" onclick="exibirAlerta('A operação foi realizada com êxito.', 'success', 5000);">Salvar</button>
          </div>
      </form>
    </div>
  </div>
</div>

{{-- ==================================================================================== --}}

{{--------------------- MODAL Editar Fornecedor --------------------}}

<div class="modal fade" id="editFornecedor" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editFornecedor">Editar Fornecedor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
                
        <form id="form-edit" action="#" method="post">
            @csrf

            <div class="form-group">
              <label for="Fornecedor">Nome:</label>
              <input type="hidden" class="editInput" name="idFornec" id="idFornec">
              <input type="text" class="form-control editInput" id="newFornecedor" name="newFornecedor" onkeydown="upperCaseF(this)" required placeholder="Nome do Fornecedor" value="{{old('newFornecedor')}}" >
              {{-- <div style="color:red">{{$errors->has('Fornecedor') ? $errors->first('Fornecedor') : ''}} </div> --}}
            </div>
            
            <div class="form-group">
              <label for="Fornecedor">Telefone:</label>
              <input type="text" class="form-control editInput" id="newTel" name="newTel" onkeydown="upperCaseF(this)"  placeholder="9999-9999" value="{{old('newTel')}}" >
              {{-- <div style="color:red">{{$errors->has('end') ? $errors->first('end') : ''}} </div> --}}
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
    <div class="col-md-2">

		</div>
    <div class="col-md-8">
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
                        Cadastro Fornecedores
                      </h3> 
                    </div>
                    <div class="col-md-5">
                      <input type="text" id="myInput" onkeyup="searchTable()" placeholder="Procurar...">
                    </div>
                    <div class="col-md-2">
                      <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addFornecedor">+</button>
                    </div>
                  </div>
                </div>
                
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
      
                    <div style="display: block; height:370px; overflow-y:scroll">

                      <table class="table table-hover table-borderless table-sm" id="myTable">
                        <thead>
                          <tr>
                            {{-- <th scope="col">#</th> --}}
                            <th scope="col">#</th>
                            <th scope="col">Fornecedor</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($FornecedorsCad as $fornec)
                            
                              <tr onmouseover="mostrarBotao(this);" onmouseout="ocultarBotao(this);">
                                {{-- <td>{{$fornec->id}}</td> --}}
                                <td>{{$fornec->id}}</td>
                                <td>{{$fornec->fornecedor}}</td>
                                <td>
                                  <button type="button" onclick="ValuesToModais('editFornecedor', '{{$fornec->id}}', '{{$fornec->fornecedor}}', '{{$fornec->telefone}}');" class="btn btn-sm btn-oculto btn-primary float-right" data-idp="{{$fornec->id}}" data-nome="{{$fornec->fornecedor}}"  data-toggle="modal" data-target="#editFornecedor">Editar</button>
                                </td> 
                              </tr>

                            @endforeach
                        </tbody>
                      </table>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 alertaqui" id="alertaqui">
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
<script src="js/ValuesToModais.js"></script>

{{-- @if ($msgSalvo)
  <script src="js/alertSucess.js"></script>
@endif --}}


 
  <script>

  </script>

@endsection

