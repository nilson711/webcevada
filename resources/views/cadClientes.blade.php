@extends('layouts.app')

@section('content')

<style>
  .btn-oculto {
    display: none;
  }
</style>

{{--------------------- MODAL Adicionar Novo Cliente --------------------}}

<div class="modal fade" id="addCliente" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addCliente">Adicionar Novo Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action= {{route('newclientSubmit')}} method="post">
        @csrf
        <div class="modal-body">
            
            <div class="form-group">
              
              <input type="hidden" name="users_id" id="users_id" value="{{$idUser}}">

              <label for="Cliente">Nome:</label>
              <input type="text" class="form-control" id="Cliente" name="nomeClient" onkeydown="upperCaseF(this)" required placeholder="Nome do Cliente" value="{{old('nomeClient')}}" >
              <div style="color:red">{{$errors->has('Cliente') ? $errors->first('Cliente') : ''}} </div>
            </div>
            <div class="form-group">
              <label for="Endereço">Endereço:</label>
              <input type="text" class="form-control" id="end" name="EndClient" onkeydown="upperCaseF(this)"  placeholder="Endereço do Cliente" value="{{old('EndClient')}}" >
              <div style="color:red">{{$errors->has('end') ? $errors->first('Cliente') : ''}} </div>
            </div>
            <div class="form-group">
              <label for="Cliente">Telefone:</label>
              <input type="text" class="form-control" id="tel" name="tel1Client" onkeydown="upperCaseF(this)"  placeholder="9999-9999" value="{{old('tel1Client')}}" >
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

{{--------------------- MODAL Editar Cliente --------------------}}

<div class="modal fade" id="editCliente" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editCliente">Editar Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
        
        <form id="form-edit" action="{{route('editclientSubmit', 999)}}" method="post">
            @csrf

            <div class="form-group">
              <input type="hidden" name="users_idEdit" id="users_idEdit" value="{{$idUser}}">
              <label for="Cliente">Nome:</label>
              <input type="hidden" name="IdClient" id="IdClient" class="editInput">
              <input type="text" class="form-control editInput" id="newCliente" name="newCliente" onkeydown="upperCaseF(this)" required placeholder="Nome do Cliente" value="{{old('newCliente')}}" >
              {{-- <div style="color:red">{{$errors->has('Cliente') ? $errors->first('Cliente') : ''}} </div> --}}
            </div>
            <div class="form-group">
              <label for="Endereço">Endereço:</label>
              <input type="text" class="form-control editInput" id="newEnd" name="newEnd" onkeydown="upperCaseF(this)"  placeholder="Endereço do Cliente" value="{{old('newEnd')}}" >
              {{-- <div style="color:red">{{$errors->has('end') ? $errors->first('Cliente') : ''}} </div> --}}
            </div>
            <div class="form-group">
              <label for="Cliente">Telefone:</label>
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
                        Cadastro Clientes
                      </h3> 
                    </div>
                    <div class="col-md-5">
                      <input type="text" id="myInput" onkeyup="searchTable()" placeholder="Procurar...">
                    </div>
                    <div class="col-md-2">
                      <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addCliente">+</button>
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
                            <th scope="col">Cliente</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($ClientesCad as $client)
                            
                              <tr onmouseover="mostrarBotao(this);" onmouseout="ocultarBotao(this);">
                                {{-- <td>{{$client->id}}</td> --}}
                                <td>{{$client->id}}</td>
                                <td>{{$client->nomeClient}}</td>
                                <td>
                                  <button type="button" onclick="ValuesToModais('editCliente', '{{$client->id}}', '{{$client->nomeClient}}', '{{$client->EndClient}}', '{{$client->tel1Client}}')" class="btn btn-sm btn-oculto btn-primary float-right" data-idp="{{$client->id}}" data-nome="{{$client->nomeClient}}"  data-toggle="modal" data-target="#editCliente">Editar</button>
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
{{-- <script src="js/idRouteToModal.js"></script> --}}
<script src="js/upperCaseF.js"></script>
<script src="js/ValuesToModais.js"></script>
<script src="js/idToRouteToModal.js"></script>

{{-- @if ($msgSalvo)
  <script src="js/alertSucess.js"></script>
@endif --}}


 
  <script>

  </script>

@endsection

