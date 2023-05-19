// FUNÇÃO ValuesToModais 
// o Parametro modal é o id do modal que deseja utilizar
// o primeiro input deve ser o id do registro que se deseja editar
// inputs são os campos do modal que receberão os values

function ValuesToModais(modal, ...inputs)
{
    //  id do modal que se deseja abrir
  const idModal = document.getElementById(modal);
  
  // Obtém os elementos de input do modal
  var inputElements = document.querySelectorAll('.editInput');
  
  // Verifica se a quantidade de inputs corresponde à quantidade de elementos de input no modal
    if (inputs.length !== inputElements.length) {
          console.error("A quantidade de inputs enviados que é:" + inputs.length +  " não corresponde à quantidade de elementos de input no modal que é:" + inputElements.length);
          return;
      }
      
    // Atribui os valores dos inputs aos elementos de input no modal usando um loop for
    for (var i = 0; i < inputs.length; i++) {
        inputElements[i].value = inputs[i];
    }

}

/**
 * Exemplo de como deve se usar no evento onclick
 * editProduto é o id do Modal que deseja abrir e alterar os inputs
 * 
 * onclick="ValuesToModais('editProduto', '{{$prod->id}}', '{{$prod->cod}}', '{{$prod->Produto}}');"
 */

 




    
  

  