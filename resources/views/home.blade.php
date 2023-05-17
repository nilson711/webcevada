@extends('layouts.app')

@section('content')
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
                <div class="col-md-4">
                    <div class="card border-secondary mb-3" style="max-width: 18rem;">
                        <div class="card-header">Faturamento</div>
                        <div class="card-body text-secondary">
                          <h5 class="card-title">16/05/2023</h5>
                          <p class="card-text">R$ 145,66</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-danger mb-3" style="max-width: 18rem;">
                      <div class="card-header">Estoque</div>
                      <div class="card-body text-secondary">
                        <h5 class="card-title">Estoque Baixo</h5>
                        <p class="card-text">
                            <ul>Cerveja 01</ul>    
                            <ul>Cerveja 02</ul>    
                            <ul>Cerveja 03</ul>    
                            <ul>Cerveja 04</ul>    
                        </p>
                      </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-primary mb-3" style="max-width: 18rem;">
                        <div class="card-header">Header</div>
                        <div class="card-body text-primary">
                          <h5 class="card-title">Primary card title</h5>
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </div>

            </div>
              

        </div>
    </div>
</div>
@endsection
