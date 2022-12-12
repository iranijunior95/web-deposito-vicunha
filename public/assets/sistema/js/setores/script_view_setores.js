document.getElementById('btnBuscarSetores').addEventListener('click', buscarSetores)
document.getElementById('btnCancelar').addEventListener('click', fecharModal)
document.getElementById('btnSalvar').addEventListener('click', salvarDadosSetores)
document.getElementById('btnAbrirModalForm').addEventListener('click', ()=>{
    abrirModalForm(0)
})

function buscarSetores() {
    let inputBuscar = document.getElementById('inputBuscarSetor')

    $.ajax({
        url : "./ajaxController/requisicoesAjax",
        type : 'POST',
        dataType: 'json',
        data : {tabela:'setores', metodo:'buscar', dados:inputBuscar.value},
        beforeSend: function() {
            document.getElementById('listaDeSetores').innerHTML = `<tr>
                                                                        <td colspan="3" class="text-center">Buscando...</td>
                                                                    </tr>`
        },
        success: function(data){
            renderizaTabelaSetores(data)
        }
    })
}

function renderizaTabelaSetores(dados) {
    if(dados.length > 0) {
        document.getElementById('listaDeSetores').innerHTML = ''
        let count = 1

        dados.forEach(setor => {
            document.getElementById('listaDeSetores').innerHTML += `<tr>
                                                                            <td class="text-center">${count++}</td>
                                                                            <td class="text-center">${setor['nome_setor']}</td>
                                                                            <td class="text-center">
                                                                                <button type="button" class="btn btn-default btn-xs" onclick="abrirModalForm(${setor['id_setor']})"><i class="fa fa-edit"></i></button> 
                                                                                <button type="button" class="btn btn-default btn-xs" onclick="deletarSetor(${setor['id_setor']})"><i class="fa fa-trash"></i></button>
                                                                            </td> 
                                                                        </tr>`
        });
    }else {
        document.getElementById('listaDeSetores').innerHTML = `<tr>
                                                                        <td colspan="3" class="text-center">Nenhum Registro Encontrado</td>
                                                                    </tr>`
    }
}

function abrirModalForm(idsetor) {
    if(idsetor === 0) {
        document.getElementsByClassName('modal-title')[0].innerHTML = 'CADASTRAR SETOR'

        document.getElementById('groupNomeSetor').innerHTML = `<label for="inputNomeSetor">NOME DO SETOR:</label>
                                                               <input type="text" class="form-control" id="inputNomeSetor" placeholder="Nome do setor">`

        document.getElementById('inputIdSetor').value = '0'
    }else {

        $.ajax({
            url : "./ajaxController/requisicoesAjax",
            type : 'POST',
            dataType: 'json',
            data : {tabela:'setores', metodo:'getById', dados:idsetor},
            success: function(data){
                document.getElementsByClassName('modal-title')[0].innerHTML = 'EDITAR SETOR'

                document.getElementById('groupNomeSetor').innerHTML = `<label for="inputNomeSetor">NOME DO SETOR:</label>
                                                                       <input type="text" class="form-control" id="inputNomeSetor" placeholder="Nome do setor" value="${data[0]['nome_setor']}">`

                document.getElementById('inputIdSetor').value = data[0]['id_setor']
            }
        })
    }

    $('#modalFormSetor').modal('show');
}

function fecharModal() {
    $('#modalFormSetor').modal('hide');

    document.getElementsByClassName('modal-title')[0].innerHTML = 'CADASTRAR SETOR'

    document.getElementById('groupNomeSetor').innerHTML = `<label for="inputNomeSetor">NOME DO SETOR:</label>
                                                           <input type="text" class="form-control" id="inputNomeSetor" placeholder="Nome do setor">`

    document.getElementById('inputIdSetor').value = '0'
}

function salvarDadosSetores() {
    let dadosSetores = {
        id: document.getElementById('inputIdSetor').value,
        nome_setor: document.getElementById('inputNomeSetor').value
    }

    $.ajax({
        url : "./ajaxController/requisicoesAjax",
        type : 'POST',
        dataType: 'json',
        data : {tabela:'setores', metodo:'save', dados:dadosSetores},
        beforeSend: function() {
            $('#modalFormSetor *').prop('disabled',true);
        },
        success: function(data) {
            if(data['status']) {
                mensagemAlerta(1, data['mensagem'])
                fecharModal()

                document.getElementById('inputBuscarSetor').value = ''
                buscarSetores()
            }else {
                mensagemDeErro('nome_setor', data['mensagem']['nome_setor'])
            }
            $('#modalFormSetor *').prop('disabled',false);
        }
    })

}

function deletarSetor(idSetor) {
    $.confirm({
        title: 'DELETAR?',
        content: 'Deseja deletar esse setor?',
        buttons: {
            deletar: {
                btnClass: 'btn-green',
                action: function () {
                    $.ajax({
                        url : "./ajaxController/requisicoesAjax",
                        type : 'POST',
                        dataType: 'json',
                        data : {tabela:'setores', metodo:'delete', dados:idSetor},
                        success: function(data) {
                            if(data['status']) {
                                mensagemAlerta(1, data['mensagem'])
                                
                                document.getElementById('inputBuscarSetor').value = ''
                                buscarSetores()
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
        case 'nome_setor':
            if(mensagem) {
                document.getElementById('groupNomeSetor').innerHTML = `<label for="inputNomeSetor">NOME DO SETOR:</label>
                                                                            <input type="text" class="form-control" id="inputNomeSetor" placeholder="Nome do setor" value="${document.getElementById('inputNomeSetor').value}" style="border-color:#dd4b39;">
                                                                            <small class="text-red">${mensagem} </small>`
            }else {
                document.getElementById('groupNomeSetor').innerHTML = `<label for="inputNomeSetor">NOME DO SETOR:</label>
                                                                            <input type="text" class="form-control" id="inputNomeSetor" placeholder="Nome do setor" value="${document.getElementById('inputNomeSetor').value}">`
            }
            break;
    }
}