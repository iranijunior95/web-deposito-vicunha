document.getElementById('btnBuscarFornecedor').addEventListener('click', buscarFornecedores)
document.getElementById('btnCancelar').addEventListener('click', fecharModal)
document.getElementById('btnSalvar').addEventListener('click', salvarDadosFornecedores)
document.getElementById('btnAbrirModalForm').addEventListener('click', ()=>{
    abrirModalForm(0)
})

function buscarFornecedores() {
    let inputBuscar = document.getElementById('inputBuscarFornecedor')

    $.ajax({
        url : "./ajaxController/requisicoesAjax",
        type : 'POST',
        dataType: 'json',
        data : {tabela:'fornecedores', metodo:'buscar', dados:inputBuscar.value},
        beforeSend: function() {
            document.getElementById('listaDeFornecedores').innerHTML = `<tr>
                                                                        <td colspan="4" class="text-center">Buscando...</td>
                                                                    </tr>`
        },
        success: function(data){
            renderizaTabelaFornecedores(data)
        }
    })
}

function renderizaTabelaFornecedores(dados) {
    if(dados.length > 0) {
        document.getElementById('listaDeFornecedores').innerHTML = ''
        let count = 1

        dados.forEach(fornecedor => {
            document.getElementById('listaDeFornecedores').innerHTML += `<tr>
                                                                            <td class="text-center">${count++}</td>
                                                                            <td class="text-center">${fornecedor['nome_fornecedor']}</td>
                                                                            <td class="text-center">${fornecedor['cnpj_cpf_fornecedor']}</td>
                                                                            <td class="text-center">
                                                                                <button type="button" class="btn btn-default btn-xs" onclick="abrirModalForm(${fornecedor['id_fornecedor']})"><i class="fa fa-edit"></i></button> 
                                                                                <button type="button" class="btn btn-default btn-xs" onclick="deletarConferente(${fornecedor['id_fornecedor']})"><i class="fa fa-trash"></i></button>
                                                                            </td> 
                                                                        </tr>`
        });
    }else {
        document.getElementById('listaDeFornecedores').innerHTML = `<tr>
                                                                        <td colspan="4" class="text-center">Nenhum Registro Encontrado</td>
                                                                    </tr>`
    }
}

function abrirModalForm(idFornecedor) {
    if(idFornecedor === 0) {
        document.getElementsByClassName('modal-title')[0].innerHTML = 'CADASTRAR FORNECEDOR'

        document.getElementById('groupNomeFornecedor').innerHTML = `<label for="inputNomeFornecedor">NOME DO FORNECEDOR:</label>
                                                                    <input type="text" class="form-control" id="inputNomeFornecedor" placeholder="Nome do fornecedor">`

        document.getElementById('groupCnpjFornecedor').innerHTML = `<label for="inputCnpjFornecedor">CNPJ DO FORNECEDOR:</label>
                                                                    <input type="text" class="form-control" id="inputCnpjFornecedor" onkeypress='mascaraMutuario(this,cpfCnpj)' onblur='clearTimeout()' maxlength="18" placeholder="xx.xxx.xxx/xxxx-xx">`

        document.getElementById('inputIdFornecedor').value = '0'
    }else {

        $.ajax({
            url : "./ajaxController/requisicoesAjax",
            type : 'POST',
            dataType: 'json',
            data : {tabela:'fornecedores', metodo:'getById', dados:idFornecedor},
            success: function(data){
                document.getElementsByClassName('modal-title')[0].innerHTML = 'EDITAR FORNECEDOR'

                document.getElementById('groupNomeFornecedor').innerHTML = `<label for="inputNomeFornecedor">NOME DO FORNECEDOR:</label>
                                                                            <input type="text" class="form-control" id="inputNomeFornecedor" placeholder="Nome do fornecedor" value="${data[0]['nome_fornecedor']}">`

                document.getElementById('groupCnpjFornecedor').innerHTML = `<label for="inputCnpjFornecedor">CNPJ DO FORNECEDOR:</label>
                                                                            <input type="text" class="form-control" id="inputCnpjFornecedor" onkeypress='mascaraMutuario(this,cpfCnpj)' onblur='clearTimeout()' maxlength="18" placeholder="xx.xxx.xxx/xxxx-xx" value="${data[0]['cnpj_cpf_fornecedor']}">`

                document.getElementById('inputIdFornecedor').value = data[0]['id_fornecedor']
            }
        })
    }

    $('#modalFormFornecedor').modal('show');
}

function fecharModal() {
    $('#modalFormFornecedor').modal('hide');

    document.getElementsByClassName('modal-title')[0].innerHTML = 'CADASTRAR FORNECEDOR'

    document.getElementById('groupNomeFornecedor').innerHTML = `<label for="inputNomeFornecedor">NOME DO FORNECEDOR:</label>
                                                                    <input type="text" class="form-control" id="inputNomeFornecedor" placeholder="Nome do fornecedor">`

    document.getElementById('groupCnpjFornecedor').innerHTML = `<label for="inputCnpjFornecedor">CNPJ DO FORNECEDOR:</label>
                                                                    <input type="text" class="form-control" id="inputCnpjFornecedor" onkeypress='mascaraMutuario(this,cpfCnpj)' onblur='clearTimeout()' maxlength="18" placeholder="xx.xxx.xxx/xxxx-xx">`

    document.getElementById('inputIdFornecedor').value = '0'
}

function salvarDadosFornecedores() {
    let dadosFornecedor = {
        id: document.getElementById('inputIdFornecedor').value,
        nome_fornecedor: document.getElementById('inputNomeFornecedor').value,
        cnpj_cpf_fornecedor: document.getElementById('inputCnpjFornecedor').value
    }

    $.ajax({
        url : "./ajaxController/requisicoesAjax",
        type : 'POST',
        dataType: 'json',
        data : {tabela:'fornecedores', metodo:'save', dados:dadosFornecedor},
        beforeSend: function() {
            $('#modalFormFornecedor *').prop('disabled',true);
        },
        success: function(data) {
            if(data['status']) {
                mensagemAlerta(1, data['mensagem'])
                fecharModal()

                document.getElementById('inputBuscarFornecedor').value = ''
                buscarFornecedores()
            }else {
                mensagemDeErro('nome_fornecedor', data['mensagem']['nome_fornecedor'])
                mensagemDeErro('cnpj_cpf_fornecedor', data['mensagem']['cnpj_cpf_fornecedor'])
            }
            $('#modalFormFornecedor *').prop('disabled',false);
        }
    })

}

function mensagemDeErro(campo, mensagem) {
    switch (campo) {
        case 'nome_fornecedor':
            if(mensagem) {
                document.getElementById('groupNomeFornecedor').innerHTML = `<label for="inputNomeFornecedor">NOME DO FORNECEDOR:</label>
                                                                            <input type="text" class="form-control" id="inputNomeFornecedor" placeholder="Nome do fornecedor" value="${document.getElementById('inputNomeFornecedor').value}" style="border-color:#dd4b39;">
                                                                            <small class="text-red">${mensagem}</small>`
            }else {
                document.getElementById('groupNomeFornecedor').innerHTML = `<label for="inputNomeFornecedor">NOME DO FORNECEDOR:</label>
                                                                            <input type="text" class="form-control" id="inputNomeFornecedor" placeholder="Nome do fornecedor" value="${document.getElementById('inputNomeFornecedor').value}">`
            }
            break;

        case 'cnpj_cpf_fornecedor':
            if(mensagem) {
                document.getElementById('groupCnpjFornecedor').innerHTML = `<label for="inputCnpjFornecedor">CNPJ DO FORNECEDOR:</label>
                                                                                <input type="text" class="form-control" id="inputCnpjFornecedor" onkeypress='mascaraMutuario(this,cpfCnpj)' onblur='clearTimeout()' maxlength="18" placeholder="xx.xxx.xxx/xxxx-xx" value="${document.getElementById('inputCnpjFornecedor').value}" style="border-color:#dd4b39;">
                                                                                <small class="text-red">${mensagem} </small>`
            }else {
                document.getElementById('groupCnpjFornecedor').innerHTML = `<label for="inputCnpjFornecedor">CNPJ DO FORNECEDOR:</label>
                                                                                <input type="text" class="form-control" id="inputCnpjFornecedor" onkeypress='mascaraMutuario(this,cpfCnpj)' onblur='clearTimeout()' maxlength="18" placeholder="xx.xxx.xxx/xxxx-xx" value="${document.getElementById('inputCnpjFornecedor').value}">`
            }
            break;
    }
}

function deletarConferente(idFornecedor) {
    $.confirm({
        title: 'DELETAR?',
        content: 'Deseja deletar esse fornecedor?',
        buttons: {
            deletar: {
                btnClass: 'btn-green',
                action: function () {
                    $.ajax({
                        url : "./ajaxController/requisicoesAjax",
                        type : 'POST',
                        dataType: 'json',
                        data : {tabela:'fornecedores', metodo:'delete', dados:idFornecedor},
                        success: function(data) {
                            if(data['status']) {
                                mensagemAlerta(1, data['mensagem'])
                                
                                document.getElementById('inputBuscarFornecedor').value = ''
                                buscarFornecedores()
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

//==================== Formatar CNPJ E CPF ====================//
function mascaraMutuario(o,f){
    v_obj=o
    v_fun=f
    setTimeout('execmascara()',1)
}
 
function execmascara(){
    v_obj.value=v_fun(v_obj.value)
}

function cpfCnpj(v){
 
    //Remove tudo o que nÃ£o Ã© dÃ­gito
    v=v.replace(/\D/g,"")
 
    if (v.length <= 13) { //CPF
 
        //Coloca um ponto entre o terceiro e o quarto dÃ­gitos
        v=v.replace(/(\d{3})(\d)/,"$1.$2")
 
        //Coloca um ponto entre o terceiro e o quarto dÃ­gitos
        //de novo (para o segundo bloco de nÃºmeros)
        v=v.replace(/(\d{3})(\d)/,"$1.$2")
 
        //Coloca um hÃ­fen entre o terceiro e o quarto dÃ­gitos
        v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2")
 
    } else { //CNPJ
 
        //Coloca ponto entre o segundo e o terceiro dÃ­gitos
        v=v.replace(/^(\d{2})(\d)/,"$1.$2")
 
        //Coloca ponto entre o quinto e o sexto dÃ­gitos
        v=v.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3")
 
        //Coloca uma barra entre o oitavo e o nono dÃ­gitos
        v=v.replace(/\.(\d{3})(\d)/,".$1/$2")
 
        //Coloca um hÃ­fen depois do bloco de quatro dÃ­gitos
        v=v.replace(/(\d{4})(\d)/,"$1-$2")
 
    }
 
    return v
 
}