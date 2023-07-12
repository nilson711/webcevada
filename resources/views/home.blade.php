@extends('layouts.app')



@section('content')


{{--------------------- MODAL COMANDAS --------------------}}

<div class="modal fade" id="comandaSelecionada" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="comandaSelecionada">Comanda - nº 09 | Cliente: Puta véia</h5>
          
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action= # method="post">
          @csrf
          <div class="modal-body">


            <table class="table table-borderless table-sm" id="listProd">
                <thead>
                  <tr>
                    <th scope="col">Qtd</th>
                    <th scope="col">Produto</th>
                    <th scope="col">Unit</th>
                    <th scope="col" style="text-align: right">Total</th>
                  </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($produtosCad as $prod) --}}
                      <tr>
                        <td>03</td>
                        <td>Cerveja Skol 269 ml</td>
                        <td style="text-align: right">3.00</td>
                        <td style="text-align: right">9.00</td>
                      </tr>
                      <tr>
                        <td>05</td>
                        <td>Cerveja Heineken 350 ml</td>
                        <td style="text-align: right">7.00</td>
                        <td style="text-align: right">35.00</td>
                      </tr>
                      <tr>
                        <td>04</td>
                        <td>Cerveja Brahma Duplo Malte 350 ml</td>
                        <td style="text-align: right">4.00</td>
                        <td style="text-align: right">16.00</td>
                      </tr>
                    {{-- @endforeach --}}
                </tbody>
            </table>
            <tfoot>
                <tr>
                    <h5 style="text-align: right; color:red">60,00</h5>
                </tr>
                <hr>
            </tfoot>

            {{-- Tabela de Pagamentos --}}

            <h5>Pagamentos</h5>
            <table class="table table-borderless table-sm" id="listProd">
                <thead>
                  <tr>
                    <th scope="col">Data</th>
                    <th scope="col">Forma</th>
                    <th scope="col" style="text-align: right">Valor</th>
                  </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($produtosCad as $prod) --}}
                      <tr>
                        <td>01/06/2023</td>
                        <td>Dinheiro</td>
                        <td style="text-align: right">20.00</td>
                      </tr>
                      <tr>
                        <td>05/06/2023</td>
                        <td>Pix</td>
                        <td style="text-align: right">10.00</td>
                      </tr>
                      
                    {{-- @endforeach --}}
                </tbody>
            </table>
            <tfoot>
                <tr>
                    <h5 style="text-align: right; color:blue">30,00</h5>
                </tr>
                <hr>
            </tfoot>

            <div class="row">
                <div class="col-md-6">
                    <h5>Devedor</h5>
                </div>
                <div class="col-md-6">
                    <h5 style="text-align: right">30,00</h5>
                </div>

            </div>
                <tr>
                </tr>

            </div>
            <div class="modal-footer">
              {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button> --}}
              <button type="button" class="btn btn-primary">Novo Pagamento</button>
            </div>
        </form>
      </div>
    </div>
  </div>
  {{-- ==================================================================================== --}}


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- <h1>Cevada</h1>
            <h5> <span style="color:blue"><strong>C</strong></span>ontrole de <br>
                <span style="color:blue"><strong>E</strong></span>stoque, <br>
                <span style="color:blue"><strong>V</strong></span>enda e <br>
                <span style="color:blue"><strong>A</strong></span>dministração de <br>
                <span style="color:blue"><strong>D</strong></span>epósito de bebidas e <br>
                <span style="color:blue"><strong>A</strong></span>fins 
            </h5> --}}

            <div class="row">
                <div class="col-md-8">
                    <div class="card border-secondary mb-3" >
                        <div class="card-header">Faturamento: {{ date('d/m/Y', strtotime($caixa->dtPagto)) }}</div>
                        <div class="card-body text-secondary">
                          {{-- <h5 class="card-title"></h5> --}}
                          <h3 class="card-text celula text-right">{{$caixa->pgts}}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-danger mb-3" style="max-width: 18rem;">
                      <div class="card-header">Comandas</div>
                      <div class="card-body text-secondary">
                        {{-- <h5 class="card-title">Comandas</h5> --}}
                            <table class="table table-borderless table-sm" id="myTable">
                                <thead>
                                <tr>
                                    {{-- <th scope="col">Cliente</th>
                                    <th scope="col">Valor</th> --}}
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($comandas as $comanda)
                                    <tr>
                                        <td><a href="/editvenda/{{$comanda->id}}">{{$comanda->nomeClient}}</a></td>
                                        <td class="celula">{{$comanda->valorProdutos - $comanda->pgts}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                    <td> <strong>TOTAL:</strong></td>
                                    <td><strong class="celula"> {{$somaTotalDiferenca}}</strong></td>
                                 
                            </table>

                               
                      </div>
                    </div>
                </div>
                {{-- <div class="col-md-4">
                    <div class="card border-primary mb-3" style="max-width: 18rem;">
                        <div class="card-header">Header</div>
                        <div class="card-body text-primary">
                          <h5 class="card-title">Primary card title</h5>
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </div> --}}

            </div>
              

        </div>
    </div>
</div>
@endsection
