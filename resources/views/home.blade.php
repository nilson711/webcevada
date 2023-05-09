@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Menu') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

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
                                        
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
