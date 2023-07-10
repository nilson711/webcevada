
function calculaCustoAddEstoque() {

    var qtd = document.getElementById('qtd').value;
    var unit  = document.getElementById('unit').value;
    document.getElementById('custoTotal').value = qtd * unit;

}

function calculaCustoUnit(){

    var qtd = document.getElementById('qtd').value;
    var custoTotal = document.getElementById('custoTotal').value;
    document.getElementById('unit').value = custoTotal / qtd;

}

function calculaLucroVarejo(){

    var vlCompra = document.getElementById('unit').value;
    var vlVenda = document.getElementById('vlVenda').value;
    
    if (vlVenda <= vlCompra) {
        alert('O valor de venda não pode ser igual ou menor ao valor de compra!')
        document.getElementById('margemVarejo').innerHTML = "Atenção Prejuízo!";
        document.getElementById('margemVarejo').style.backgroundColor = "red";
        document.getElementById('margemVarejo').style.color = "yellow";
        document.getElementById('vlVenda').focus();
        document.getElementById('btnSalvarAddEstoque').disabled = true;
       
    } else {
        var lucro = vlVenda - vlCompra;
        var porcent = (lucro / vlCompra)*100
        var porcentFormat = porcent.toFixed(2);
        document.getElementById('margemVarejo').innerHTML = porcentFormat + "%";
        document.getElementById('margemVarejo').style.backgroundColor = "";
        document.getElementById('margemVarejo').style.color = "";
        liberaSalvar();
    }
    
}
function calculaLucroAtacado(){
   
    var vlCompra = document.getElementById('unit').value;
    var vlAtacado = document.getElementById('vlAtacado').value;
   
    if (vlAtacado <= vlCompra) {
        alert('O valor de venda não pode ser igual ou menor ao valor de compra!')
        document.getElementById('margemAtacado').innerHTML = "Atenção Prejuízo!";
        document.getElementById('margemAtacado').style.backgroundColor = "red";
        document.getElementById('margemAtacado').style.color = "yellow";
        document.getElementById('vlAtacado').focus();
        document.getElementById('btnSalvarAddEstoque').disabled = true;
       
    } else {
        var lucro = vlAtacado - vlCompra;
        var porcent = (lucro / vlCompra)*100;
        var porcentFormat = porcent.toFixed(2);
        document.getElementById('margemAtacado').innerHTML = porcentFormat + "%";
        document.getElementById('margemAtacado').style.backgroundColor = "";
        document.getElementById('margemAtacado').style.color = "";
        liberaSalvar();
    }


}

function liberaSalvar(){

    var vlCompra = document.getElementById('unit').value;
    var vlVenda = document.getElementById('vlVenda').value;
    var vlAtacado = document.getElementById('vlAtacado').value;

    if (vlVenda > vlCompra && vlAtacado > vlCompra) {
        
        document.getElementById('btnSalvarAddEstoque').disabled = false;
        
    }else{
        document.getElementById('btnSalvarAddEstoque').disabled = true;
    }
}

