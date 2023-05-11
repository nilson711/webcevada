@extends('layouts.app')

@section('content')

{{-- Adicionar Novo Produto --}}

<div class="modal fade" id="addProduto" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addProduto">Adicionar Novo Produto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action= {{route('newProductSubmit')}} method="post">
        @csrf
        <div class="modal-body">
          
            <div class="form-group">
              <label for="cod">Código</label>
              <input type="text" class="form-control" id="cod" name="cod" maxlength="13" type="number" required placeholder="Ex: 78936683" value="{{old('cod')}}" >
                <div style="color:red"> {{$errors->has('cod') ? $errors->first('cod') : ''}} </div>
            </div>
            <div class="form-group">
              <label for="Produto">Descrição</label>
              <input type="text" class="form-control" id="Produto" name="Produto" required placeholder="Ex: CERVEJA HEINEKEN LONG NECK 330ML CX C/ 12 UND" value="{{old('Produto')}}" >
              <div style="color:red">{{$errors->has('Produto') ? $errors->first('Produto') : ''}} </div>
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

{{-- ================================================= --}}


<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
          @if ($errors->any())
            <div style="position: absolute; top:0px; left:0px; width:100%; color:white; background-color: red; text-align:center">
              @foreach ($errors->all() as $erro)
                  {{$erro}}<br>
              @endforeach
            </div>
          <hr>
          @endif
            <div class="card">
              
                <div class="card-header">
                  <div class="row">
                    <div class="col-md-10">
                      <h3>
                        Cadastro Produtos
                      </h3> 
                    </div>
                    <div class="col-md-2">
                      <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addProduto">+</button>
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

                      <table class="table table-striped table-hover table-borderless table-sm">
                        <thead>
                          <tr>
                            <th scope="col">Cód Barras</th>
                            <th scope="col">Produto</th>
                          </tr>
                        </thead>
                        <tbody>
                              @foreach ($produtosCad as $prod)
                                <tr>
                                  <td>{{$prod->cod}}</td>
                                  <td>{{$prod->Produto}}</td>
                                </tr>
                              @endforeach
                            </tbody>
                      </table>
                    </div>

                    </div>

                    
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

