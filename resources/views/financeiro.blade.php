@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Financeiro') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="container">
                        <h1>Gráfico de Pizza</h1>
                        <canvas id="myChart" width="400" height="400"></canvas>
                    </div>

                    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
                    <script>
                        // Dados do gráfico
                        var data = {
                        labels: ["Prod 1", "Prod 2", "Prod 3", "Produ 4"],
                        datasets: [{
                            data: [50, 20, 25, 5],
                            backgroundColor: ["#FF6384", "#36A2EB", "#FFCE56"],
                            hoverBackgroundColor: ["#FF6384", "#36A2EB", "#FFCE56"]
                        }]
                        };

                        // Opções do gráfico
                        var options = {
                        responsive: true
                        };

                        // Criação do gráfico de pizza
                        var ctx = document.getElementById("myChart").getContext("2d");
                        var myPieChart = new Chart(ctx, {
                        type: 'bar',
                        data: data,
                        options: options
                        });
                    </script>
                    
                                        
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
