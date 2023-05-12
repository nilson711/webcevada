@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Estoque') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    
                    <input type="text" id="myInput" onkeyup="searchTable()" placeholder="Search...">
<table id="myTable">
  <thead>
    <tr>
      <th>Nome</th>
      <th>Email</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>João</td>
      <td>joao@example.com</td>
    </tr>
    <tr>
      <td>Maria</td>
      <td>maria@example.com</td>
    </tr>
    <tr>
      <td>Lucas</td>
      <td>lucas@example.com</td>
    </tr>
  </tbody>
</table>

<script>
    function searchTable() {
  // Declare variáveis para a barra de pesquisa e a tabela
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop através de todas as linhas da tabela e oculta as que não correspondem à consulta da pesquisa
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0]; // 0 significa que estamos buscando na primeira coluna
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}


</script>
                    
                                        
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
