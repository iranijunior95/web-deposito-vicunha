function mensagemAlerta(tipo, mensagem) {
    if(tipo == 1) {
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: mensagem,
            showConfirmButton: false,
            timer: 3000
        });

        
    }else{
        Swal.fire({
            position: 'center',
            icon: 'error',
            title: mensagem,
            showConfirmButton: false,
            timer: 3000
        });
    }
}
