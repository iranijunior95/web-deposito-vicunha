function deletarLancamento(idLancamento) {
    $.confirm({
        title: 'DELETAR?',
        content: 'Deseja deletar esse lançamento?',
        buttons: {
            deletar: {
                btnClass: 'btn-green',
                action: function () {
                    $.ajax({
                        url : "../../ajaxController/requisicoesAjax",
                        type : 'POST',
                        dataType: 'json',
                        data : {tabela:'lancamentos', metodo:'delete', dados:idLancamento},
                        success: function(data) {
                            if(data['status']) {
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: data['mensagem'],
                                    showConfirmButton: false,
                                    timer: 3000,
                                    didClose: (toast) => {
                                        
                                        window.location.href = `../../lancamentos`
                                    }
                                });
                            }
                        }
                    })
                }
            },
            cancelar: function () {
                return true
            }
        }
    });
}