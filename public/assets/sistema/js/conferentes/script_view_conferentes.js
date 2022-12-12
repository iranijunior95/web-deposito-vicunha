document.getElementById('btnBuscarConferente').addEventListener('click', buscarConferentes)
document.getElementById('btnCancelar').addEventListener('click', fecharModal)
document.getElementById('btnSalvar').addEventListener('click', salvarDadosConferentes)
document.getElementById('btnAbrirModalForm').addEventListener('click', ()=>{
    abrirModalForm(0)
})

function buscarConferentes() {
    let inputBuscar = document.getElementById('inputBuscarConferente')

    $.ajax({
        url : "./ajaxController/requisicoesAjax",
        type : 'POST',
        dataType: 'json',
        data : {tabela:'conferentes', metodo:'buscar', dados:inputBuscar.value},
        beforeSend: function() {
            document.getElementById('listaDeConferentes').innerHTML = `<tr>
                                                                        <td colspan="4" class="text-center">Buscando...</td>
                                                                    </tr>`
        },
        success: function(data){
            renderizaTabelaConferentes(data)
        }
    })
}

function renderizaTabelaConferentes(dados) {
    if(dados.length > 0) {
        document.getElementById('listaDeConferentes').innerHTML = ''
        let count = 1

        dados.forEach(conferente => {
            document.getElementById('listaDeConferentes').innerHTML += `<tr>
                                                                            <td class="text-center">${count++}</td>
                                                                            <td class="text-center">${conferente['nome_conferente']}</td>
                                                                            <td class="text-center">${conferente['telefone_conferente']}</td>
                                                                            <td class="text-center">
                                                                                <button type="button" class="btn btn-default btn-xs" onclick="abrirModalForm(${conferente['id_conferente']})"><i class="fa fa-edit"></i></button> 
                                                                                <button type="button" class="btn btn-default btn-xs" onclick="deletarConferente(${conferente['id_conferente']})"><i class="fa fa-trash"></i></button>
                                                                            </td> 
                                                                        </tr>`
        });
    }else {
        document.getElementById('listaDeConferentes').innerHTML = `<tr>
                                                                        <td colspan="4" class="text-center">Nenhum Registro Encontrado</td>
                                                                    </tr>`
    }
}

function abrirModalForm(idConferente) {
    if(idConferente === 0) {
        document.getElementsByClassName('modal-title')[0].innerHTML = 'CADASTRAR CONFERENTE'

        document.getElementById('groupNomeConferente').innerHTML = `<label for="inputNomeConferente">NOME DO CONFERENTE:</label>
                                                                    <input type="text" class="form-control" id="inputNomeConferente" placeholder="Nome do conferente">`

        document.getElementById('groupTelefoneConferente').innerHTML = `<label for="inputTelefoneConferente">TELEFONE DO CONFERENTE:</label>
                                                                        <input type="text" class="form-control" id="inputTelefoneConferente" placeholder="(00) 00000-0000" onkeydown="return mascaraTelefone(event)">`

        document.getElementById('inputIdConferente').value = '0'
    }else {

        $.ajax({
            url : "./ajaxController/requisicoesAjax",
            type : 'POST',
            dataType: 'json',
            data : {tabela:'conferentes', metodo:'getById', dados:idConferente},
            success: function(data){
                document.getElementsByClassName('modal-title')[0].innerHTML = 'EDITAR CONFERENTE'

                document.getElementById('groupNomeConferente').innerHTML = `<label for="inputNomeConferente">NOME DO CONFERENTE:</label>
                                                                            <input type="text" class="form-control" id="inputNomeConferente" placeholder="Nome do conferente" value="${data[0]['nome_conferente']}">`

                document.getElementById('groupTelefoneConferente').innerHTML = `<label for="inputTelefoneConferente">TELEFONE DO CONFERENTE:</label>
                                                                                <input type="text" class="form-control" id="inputTelefoneConferente" placeholder="(00) 00000-0000" onkeydown="return mascaraTelefone(event)" value="${data[0]['telefone_conferente']}">`

                document.getElementById('inputIdConferente').value = data[0]['id_conferente']
            }
        })
    }

    $('#modalFormConferente').modal('show');
}

function fecharModal() {
    $('#modalFormConferente').modal('hide');

    document.getElementsByClassName('modal-title')[0].innerHTML = 'CADASTRAR CONFERENTE'

    document.getElementById('groupNomeConferente').innerHTML = `<label for="inputNomeConferente">NOME DO CONFERENTE:</label>
                                                                <input type="text" class="form-control" id="inputNomeConferente" placeholder="Nome do conferente">`

    document.getElementById('groupTelefoneConferente').innerHTML = `<label for="inputTelefoneConferente">TELEFONE DO CONFERENTE:</label>
                                                                    <input type="text" class="form-control" id="inputTelefoneConferente" placeholder="(00) 00000-0000" onkeydown="return mascaraTelefone(event)">`

    document.getElementById('inputIdConferente').value = '0'
}

function salvarDadosConferentes() {
    let dadosConferente = {
        id: document.getElementById('inputIdConferente').value,
        nome_conferente: document.getElementById('inputNomeConferente').value,
        telefone_conferente: document.getElementById('inputTelefoneConferente').value
    }

    $.ajax({
        url : "./ajaxController/requisicoesAjax",
        type : 'POST',
        dataType: 'json',
        data : {tabela:'conferentes', metodo:'save', dados:dadosConferente},
        beforeSend: function() {
            $('#modalFormConferente *').prop('disabled',true);
        },
        success: function(data) {
            if(data['status']) {
                mensagemAlerta(1, data['mensagem'])
                fecharModal()

                document.getElementById('inputBuscarConferente').value = ''
                buscarConferentes()
            }else {
                mensagemDeErro('nome_conferente', data['mensagem']['nome_conferente'])
                mensagemDeErro('telefone_conferente', data['mensagem']['telefone_conferente'])
            }
            $('#modalFormConferente *').prop('disabled',false);
        }
    })

}

function deletarConferente(idConferente) {
    $.confirm({
        title: 'DELETAR?',
        content: 'Deseja deletar esse conferente?',
        buttons: {
            deletar: {
                btnClass: 'btn-green',
                action: function () {
                    $.ajax({
                        url : "./ajaxController/requisicoesAjax",
                        type : 'POST',
                        dataType: 'json',
                        data : {tabela:'conferentes', metodo:'delete', dados:idConferente},
                        success: function(data) {
                            if(data['status']) {
                                mensagemAlerta(1, data['mensagem'])
                                
                                document.getElementById('inputBuscarConferente').value = ''
                                buscarConferentes()
                            }else {
                                mensagemAlerta(0, data['mensagem'])
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

function mensagemDeErro(campo, mensagem) {
    switch (campo) {
        case 'nome_conferente':
            if(mensagem) {
                document.getElementById('groupNomeConferente').innerHTML = `<label for="inputNomeConferente">NOME DO CONFERENTE:</label>
                                                                            <input type="text" class="form-control" id="inputNomeConferente" placeholder="Nome do conferente" value="${document.getElementById('inputNomeConferente').value}" style="border-color:#dd4b39;">
                                                                            <small class="text-red">${mensagem} </small>`
            }else {
                document.getElementById('groupNomeConferente').innerHTML = `<label for="inputNomeConferente">NOME DO CONFERENTE:</label>
                                                                            <input type="text" class="form-control" id="inputNomeConferente" placeholder="Nome do conferente" value="${document.getElementById('inputNomeConferente').value}">`
            }
            break;

        case 'telefone_conferente':
            if(mensagem) {
                document.getElementById('groupTelefoneConferente').innerHTML = `<label for="inputTelefoneConferente">TELEFONE DO CONFERENTE:</label>
                                                                                <input type="text" class="form-control" id="inputTelefoneConferente" placeholder="(00) 00000-0000" onkeydown="return mascaraTelefone(event)" value="${document.getElementById('inputTelefoneConferente').value}" style="border-color:#dd4b39;">
                                                                                <small class="text-red">${mensagem} </small>`
            }else {
                document.getElementById('groupTelefoneConferente').innerHTML = `<label for="inputTelefoneConferente">TELEFONE DO CONFERENTE:</label>
                                                                                <input type="text" class="form-control" id="inputTelefoneConferente" placeholder="(00) 00000-0000" onkeydown="return mascaraTelefone(event)" value="${document.getElementById('inputTelefoneConferente').value}">`
            }
            break;
    }
}

//Mascara telefone
function mascaraTelefone(event) {
    let tecla = event.key;
    let telefone = event.target.value.replace(/\D+/g, "");

    if (/^[0-9]$/i.test(tecla)) {
        telefone = telefone + tecla;
        let tamanho = telefone.length;

        if (tamanho >= 12) {
            return false;
        }
        
        if (tamanho > 10) {
            telefone = telefone.replace(/^(\d\d)(\d{5})(\d{4}).*/, "($1) $2-$3");
        } else if (tamanho > 5) {
            telefone = telefone.replace(/^(\d\d)(\d{4})(\d{0,4}).*/, "($1) $2-$3");
        } else if (tamanho > 2) {
            telefone = telefone.replace(/^(\d\d)(\d{0,5})/, "($1) $2");
        } else {
            telefone = telefone.replace(/^(\d*)/, "($1");
        }

        event.target.value = telefone;
    }

    if (!["Backspace", "Delete"].includes(tecla)) {
        return false;
    }
}
