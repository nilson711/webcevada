
  // FUNÇÃO BUSCA DADOS DIGITADOS DO INPUT EM TODAS AS COLUNAS DA TABELA
  function searchTable() {
    // Declare variáveis para a barra de pesquisa e a tabela
    var input, filter, table, tr, td1, td2, i, j;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");
  
    // Loop através de todas as linhas da tabela e oculta as que não correspondem à consulta da pesquisa
    for (i = 1; i < tr.length; i++) {
      td1 = tr[i].getElementsByTagName("td")[0]; // 0 significa que estamos buscando na primeira coluna
      td2 = tr[i].getElementsByTagName("td")[1]; // 1 significa que estamos buscando na segunda coluna
      if (td1 || td2) {
        if (td1.innerHTML.toUpperCase().indexOf(filter) > -1 || td2.innerHTML.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }
    }
  }
  


/*

  // FUNÇÃO BUSCA DADOS DIGITADOS DO INPUT NA COLUNA PRODUTO
  function searchTable() {
  // Declare variáveis para a barra de pesquisa e a tabela
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop através de todas as linhas da tabela e oculta as que não correspondem à consulta da pesquisa
  for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[1]; // 0 significa que estamos buscando na primeira coluna, 1 é na segunda coluna...
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

*/