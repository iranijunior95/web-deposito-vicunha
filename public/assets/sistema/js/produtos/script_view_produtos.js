document.getElementById('btnBuscarProdutos').addEventListener('click', buscarProdutos)
document.getElementById('btnCancelar').addEventListener('click', fecharModal)
document.getElementById('btnSalvar').addEventListener('click', salvarDadosProdutos)
document.getElementById('btnAbrirModalForm').addEventListener('click', ()=>{
    abrirModalForm(0)
})

function buscarProdutos() {
    let inputBuscar = document.getElementById('inputBuscarProduto')

    $.ajax({
        url : "./ajaxController/requisicoesAjax",
        type : 'POST',
        dataType: 'json',
        data : {tabela:'produtos', metodo:'buscar', dados:inputBuscar.value},
        beforeSend: function() {
            document.getElementById('listaDeProdutos').innerHTML = `<tr>
                                                                        <td colspan="3" class="text-center">Buscando...</td>
                                                                    </tr>`
        },
        success: function(data){
            renderizaTabelaProdutos(data)
        }
    })
}

function renderizaTabelaProdutos(dados) {
    if(dados.length > 0) {
        document.getElementById('listaDeProdutos').innerHTML = ''
        let count = 1

        dados.forEach(setor => {
            document.getElementById('listaDeProdutos').innerHTML += `<tr>
                                                                            <td class="text-center">${count++}</td>
                                                                            <td class="text-center">${setor['nome_produto']}</td>
                                                                            <td class="text-center">
                                                                                <button type="button" class="btn btn-default btn-xs" onclick="abrirModalForm(${setor['id_produto']})"><i class="fa fa-edit"></i></button> 
                                                                                <button type="button" class="btn btn-default btn-xs" onclick="deletarProduto(${setor['id_produto']})"><i class="fa fa-trash"></i></button>
                                                                            </td> 
                                                                        </tr>`
        });
    }else {
        document.getElementById('listaDeProdutos').innerHTML = `<tr>
                                                                        <td colspan="3" class="text-center">Nenhum Registro Encontrado</td>
                                                                    </tr>`
    }
}

function abrirModalForm(idProduto) {
    if(idProduto === 0) {
        document.getElementsByClassName('modal-title')[0].innerHTML = 'CADASTRAR PRODUTO'

        document.getElementById('groupNomeProduto').innerHTML = `<label for="inputNomeProduto">NOME DO PRODUTO:</label>
                                                                <input type="text" class="form-control" id="inputNomeProduto" placeholder="Nome do produto">`

        document.getElementById('inputIdProduto').value = '0'
    }else {

        $.ajax({
            url : "./ajaxController/requisicoesAjax",
            type : 'POST',
            dataType: 'json',
            data : {tabela:'produtos', metodo:'getById', dados:idProduto},
            success: function(data){
                document.getElementsByClassName('modal-title')[0].innerHTML = 'EDITAR PRODUTO'

                document.getElementById('groupNomeProduto').innerHTML = `<label for="inputNomeProduto">NOME DO PRODUTO:</label>
                                                                        <input type="text" class="form-control" id="inputNomeProduto" placeholder="Nome do produto" value="${data[0]['nome_produto']}">`

                document.getElementById('inputIdProduto').value = data[0]['id_produto']
            }
        })
    }

    $('#modalFormProduto').modal('show');
}

function fecharModal() {
    $('#modalFormProduto').modal('hide');

    document.getElementsByClassName('modal-title')[0].innerHTML = 'CADASTRAR PRODUTO'

    document.getElementById('groupNomeProduto').innerHTML = `<label for="inputNomeProduto">NOME DO PRODUTO:</label>
                                                            <input type="text" class="form-control" id="inputNomeProduto" placeholder="Nome do produto">`

    document.getElementById('inputIdProduto').value = '0'
}

function salvarDadosProdutos() {
    let dadosProdutos = {
        id: document.getElementById('inputIdProduto').value,
        nome_produto: document.getElementById('inputNomeProduto').value
    }

    $.ajax({
        url : "./ajaxController/requisicoesAjax",
        type : 'POST',
        dataType: 'json',
        data : {tabela:'produtos', metodo:'save', dados:dadosProdutos},
        beforeSend: function() {
            $('#modalFormProduto *').prop('disabled',true);
        },
        success: function(data) {
            if(data['status']) {
                mensagemAlerta(1, data['mensagem'])
                fecharModal()

                document.getElementById('inputBuscarProduto').value = ''
                buscarProdutos()
            }else {
                mensagemDeErro('nome_produto', data['mensagem']['nome_produto'])
            }
            $('#modalFormProduto *').prop('disabled',false);
        }
    })

}

function deletarProduto(idProduto) {
    $.confirm({
        title: 'DELETAR?',
        content: 'Deseja deletar esse produto?',
        buttons: {
            deletar: {
                btnClass: 'btn-green',
                action: function () {
                    $.ajax({
                        url : "./ajaxController/requisicoesAjax",
                        type : 'POST',
                        dataType: 'json',
                        data : {tabela:'produtos', metodo:'delete', dados:idProduto},
                        success: function(data) {
                            if(data['status']) {
                                mensagemAlerta(1, data['mensagem'])
                                
                                document.getElementById('inputBuscarProduto').value = ''
                                buscarProdutos()
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
        case 'nome_produto':
            if(mensagem) {
                document.getElementById('groupNomeProduto').innerHTML = `<label for="inputNomeProduto">NOME DO PRODUTO:</label>
                                                                            <input type="text" class="form-control" id="inputNomeProduto" placeholder="Nome do produto" value="${document.getElementById('inputNomeProduto').value}" style="border-color:#dd4b39;">
                                                                            <small class="text-red">${mensagem} </small>`
            }else {
                document.getElementById('groupNomeProduto').innerHTML = `<label for="inputNomeProduto">NOME DO PRODUTO:</label>
                                                                            <input type="text" class="form-control" id="inputNomeProduto" placeholder="Nome do produto" value="${document.getElementById('inputNomeProduto').value}">`
            }
            break;
    }
}