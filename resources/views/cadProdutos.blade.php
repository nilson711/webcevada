@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Cadastro de Produtos') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-striped table-hover table-borderless table-sm">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Cód Barras</th>
                            <th scope="col">Produto</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th scope="row">1</th>
                            <td>78905498</td>
                            <td>Cerveja Heineken Pilsen 12 Unidades Lata 350ml</td>
                          </tr>
                          <tr>
                            <th scope="row">2</th>
                            <td>7891991298834</td>
                            <td>CERVEJA BRAHMA DUPLO MALTE LATA 473 ML</td>
                          </tr>
                          <tr>
                            <th scope="row">2</th>
                            <td>7891149100002</td>
                            <td>Cerveja Skol 350ml 12 und</td>
                          </tr>
                          </tr>
                          <tr>
                            <th scope="row">2</th>
                            <td>7891149100002</td>
                            <td>Cerveja Brahma Duplo Malte, Puro Malte, LATA 350ml</td>
                          </tr>
                          
                        </tbody>
                      </table>
                    
                                        
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
