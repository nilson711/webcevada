
function idRouteToModal(id){

    
    const formEdit = document.getElementById('form-edit');
    const campo1 = document.getElementById(id);
    
        var url = formEdit.getAttribute('action');
        var valueCampo1 = campo1.value;
        var newUrl = url.replace('999', valueCampo1);
        formEdit.setAttribute('action', newUrl);
        
        console.log(newUrl);
        // formEdit.submit();
    
    
}
