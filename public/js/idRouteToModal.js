const formEdit = document.getElementById('form-edit');
const campo1 = document.getElementById('idProd');

    formEdit.addEventListener('submit', (event) => {
        event.preventDefault();
        var url = formEdit.getAttribute('action');
        var valueCampo1 = campo1.value;
        var newUrl = url.replace('999', valueCampo1);
        formEdit.setAttribute('action', newUrl);
        
        console.log(newUrl);
        formEdit.submit();
    });

