let dadosLancamento = []
let dadosRelatorio = []

let listaDeLancamentoRelatorio = document.getElementById('listaDeLancamentoRelatorio')

document.getElementById('btnFecharModal').addEventListener('click', fecharModal)

document.getElementById('btnBuscar').addEventListener('click', ()=>{

    let dadosPesquisa = [
        {inputFornecedor : document.getElementById('inputFornecedor').value},
        {inputConferente : document.getElementById('inputConferente').value},
        {inputSetor : document.getElementById('inputSetor').value},
        {inputNumeroDaNota : document.getElementById('inputNumeroDaNota').value},
        {inputValorDaNotaInicio : document.getElementById('inputValorDaNotaInicio').value},
        {inputValorDaNotaFim : document.getElementById('inputValorDaNotaFim').value},
        {inputDataEntradaInicio : document.getElementById('inputDataEntradaInicio').value},
        {inputDataEntradaFim : document.getElementById('inputDataEntradaFim').value},
        {inputNomeMotorista : document.getElementById('inputNomeMotorista').value}
    ]
    

    $.ajax({
        url : "../ajaxController/requisicoesAjax",
        type : 'POST',
        dataType: 'json',
        data : {tabela:'lancamentos', metodo:'pesquisar', dados:montarConsultaBd(dadosPesquisa)},
        beforeSend: function() {
            $('#ModalSearch *').prop('disabled',true);

            document.getElementById('listaDeLancamentos').innerHTML = `<tr>
                                                                                <td colspan="6" class="text-center">Buscando...</td>
                                                                            </tr>`
        },
        success: function(data) {
            if(data != '') {
                document.getElementById('listaDeLancamentos').innerHTML = ''
                let count = 1

                var formatter = new Intl.DateTimeFormat('pt-BR')

                dadosLancamento = data;

                data.forEach(lancamentos => {
                    document.getElementById('listaDeLancamentos').innerHTML += `<tr>
                                                                                    <td class="text-center">${count++}</td>
                                                                                    <td class="text-center text-primary text-bold"><a href="lancamentos/detalhes/${lancamentos['id_lancamento']}">${lancamentos['nome_fornecedor']}</a></td>
                                                                                    <td class="text-center">${lancamentos['numero_nota']}</td>
                                                                                    <td class="text-center">${lancamentos['nome_conferente']}</td>
                                                                                    <td class="text-center">${lancamentos['nome_setor']}</td>
                                                                                    <td class="text-center">${lancamentos['data_entrada'].split('-').reverse().join('/')}</td>
                                                                                    <td class="text-center">
                                                                                        <button type="button" class="btn btn-default btn-xs btnAdd" onclick="addLancamentoLista(${lancamentos['id_lancamento']})"><i class="fa fa-plus"></i> ADD</button>
                                                                                    </td>
                                                                                </tr>`
                })

                document.getElementById('listaDeLancamentos').innerHTML += `<tr>
                                                                                <td colspan="7" class="text-center">
                                                                                    <button type="button" class="btn btn-default btn-xs btnAdd" onclick="addAllLancamentoLista()"><i class="fa fa-list-ol"></i> ADICIONAR TODOS</button>
                                                                                </td>
                                                                            </tr>`

            }else {
                document.getElementById('listaDeLancamentos').innerHTML = `<tr>
                                                                                <td colspan="7" class="text-center">Nenhum Registro Encontrado</td>
                                                                            </tr>`
            }

            fecharModal()
            $('#ModalSearch *').prop('disabled',false);
        }
    })
    
})

function montarConsultaBd(dadosPesquisa) {

    let query = ''

    dadosPesquisa.map((element, indice, arrayBase) => {
        
        switch (indice) {
            case 0:
                
                if(element['inputFornecedor'] == 0) {
                    query += ''
                }else {
                    query += 'AND fornecedores_id_fornecedor = ' + element['inputFornecedor'] + ' '
                }
                break;

            case 1:
                
                if(element['inputConferente'] == 0) {
                    query += ''
                }else {
                    query += 'AND conferentes_id_conferente = ' + element['inputConferente'] + ' '
                }
                break;

            case 2:
                
                if(element['inputSetor'] == 0) {
                    query += ''
                }else {
                    query += 'AND setores_id_setor = ' + element['inputSetor'] + ' '
                }
                break;

            case 3:
                
                if(element['inputNumeroDaNota'] == '') {
                    query += ''
                }else {
                    query += 'AND numero_nota = ' + element['inputNumeroDaNota'] + ' '
                }
                break;

            case 4:
                
                if(document.getElementById('inputValorDaNotaInicio').value == '' || document.getElementById('inputValorDaNotaInicio').value == '0,00' || document.getElementById('inputValorDaNotaFim').value == '' || document.getElementById('inputValorDaNotaFim').value == '0,00' || document.getElementById('inputValorDaNotaInicio').value > document.getElementById('inputValorDaNotaFim').value) {
                    query += ''

                }else {
                    query += 'AND valor_nota >= ' + '"'+document.getElementById('inputValorDaNotaInicio').value+'"' + 'AND valor_nota <= ' + '"'+document.getElementById('inputValorDaNotaFim').value+'"' + ' '
                }
                
                break;

            case 6:
                
                if(document.getElementById('inputDataEntradaInicio').value == '' || document.getElementById('inputDataEntradaFim').value == '' || document.getElementById('inputDataEntradaInicio').value > document.getElementById('inputDataEntradaFim').value) {
                    query += ''

                }else {
                    query += 'AND data_entrada >= ' + '"'+document.getElementById('inputDataEntradaInicio').value+'"' + ' AND data_entrada <= ' + '"'+document.getElementById('inputDataEntradaFim').value+'"' + ' '
                }
                
                break;

            case 8:
                
                if(element['inputNomeMotorista'] == '') {
                    query += ''
                }else {
                    query += 'AND nome_motorista = ' + '"'+element['inputNomeMotorista']+'"'
                }
                break;
    
            default:
                break;
        }
        
    })

    return query
}

function fecharModal() {
    $('#ModalSearch').modal('hide')

    $('#inputFornecedor').val('0').select2();
    $('#inputConferente').val('0').select2();

    document.getElementById('inputSetor').selectedIndex = 0
    document.getElementById('inputNumeroDaNota').value = ''
    document.getElementById('inputValorDaNotaInicio').value = ''
    document.getElementById('inputValorDaNotaFim').value = ''
    document.getElementById('inputDataEntradaInicio').value = ''
    document.getElementById('inputDataEntradaFim').value = ''
    document.getElementById('inputNomeMotorista').value = ''
}

function addLancamentoLista(value) {
    
    let result = dadosLancamento.find(lancamento => lancamento.id_lancamento === String(value));
    dadosRelatorio.push(result)

    atualizaListaRelatorio();

}

function addAllLancamentoLista() {
    dadosLancamento.forEach(function(lancamento) {
        dadosRelatorio.push(lancamento)
    });

    atualizaListaRelatorio()
}

function removerLancamento(indice) {
    
    dadosRelatorio.splice(indice, 1)
    atualizaListaRelatorio()
}

function moverParaCima(indice) {
    let posicaoAtual = indice
    let posicaoFutura = indice-1

    if(posicaoAtual == 0) {
        posicaoFutura = 0
    }
    dadosRelatorio.splice(posicaoFutura, 0, dadosRelatorio.splice(posicaoAtual, 1)[0])

    atualizaListaRelatorio()
}

function moverParaBaixo(indice) {
    let posicaoAtual = indice
    let posicaoFutura = indice+1

    dadosRelatorio.splice(posicaoFutura, 0, dadosRelatorio.splice(posicaoAtual, 1)[0])

    atualizaListaRelatorio()
}

function atualizaListaRelatorio () {
    dadosRelatorio = dadosRelatorio.filter(function (a) {
        return !this[JSON.stringify(a)] && (this[JSON.stringify(a)] = true);
    }, Object.create(null));

    listaDeLancamentoRelatorio.innerHTML = ``;
    let count = 1;
    let indice = 0;

    if(dadosRelatorio.length != 0) {
        dadosRelatorio.find(object =>{

            let data = new Date(object.data_entrada);

            listaDeLancamentoRelatorio.innerHTML += `<tr>
                                                        <td class="text-center">${count++}</td>
                                                        <td class="text-center">${object.nome_fornecedor}</td>
                                                        <td class="text-center">${object.numero_nota}</td>
                                                        <td class="text-center">${object.valor_nota}</td>
                                                        <td class="text-center">${object.peso_nota}</td>
                                                        <td class="text-center">${object.nome_conferente}</td>
                                                        <td class="text-center">${object.hora_entrada}</td>
                                                        <td class="text-center">${object.hora_saida}</td>
                                                        <td class="text-center">${data.toLocaleDateString('pt-BR', {timeZone: 'UTC'})}</td>
                                                        <td class="text-center">
                                                            <button type="button" class="btn btn-default btn-xs" onclick="moverParaCima(${indice})"><i class="glyphicon glyphicon-arrow-up"></i></button>
                                                            <button type="button" class="btn btn-default btn-xs" onclick="moverParaBaixo(${indice})"><i class="glyphicon glyphicon-arrow-down"></i></button>
                                                            <button type="button" class="btn btn-default btn-xs" onclick="removerLancamento(${indice})"><i class="fa fa-remove"></i></button>
                                                        </td>
                                                    </tr>`;

            indice++
        });

        listaDeLancamentoRelatorio.innerHTML += `<tr>
                                                    <td colspan="10" class="text-center">
                                                        <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalImprimirRelatorio"><i class="fa fa-print"></i> IMPRIMIR RELATÓRIO</button>
                                                    </td>
                                                </tr>`;
    }else {
        listaDeLancamentoRelatorio.innerHTML += `<tr>
                                                    <td colspan="10" class="text-center">Relatório Vazio</td>
                                                 </tr>`;
    }

    
}

document.getElementById('btnRelatorioCancelar').addEventListener('click', ()=>{
    $('#modalImprimirRelatorio').modal('hide')

    document.getElementById('inputTituloRelatorio').value = ''
    document.getElementById('inputDataRelatorio').value = ''

})

document.getElementById('btnRelatorioImprimir').addEventListener('click', ()=>{
    if(document.getElementById('inputTituloRelatorio').value === '' && document.getElementById('inputDataRelatorio').value != '') {
        
        document.getElementById('groupInputTituloRelatorio').innerHTML = `<label for="inputTituloRelatorio">TÍTULO DO RELATÓRIO:</label>
                                                                          <input type="text" class="form-control" id="inputTituloRelatorio" name="inputTituloRelatorio" placeholder="Digite o título do relatório..." style="border-color:#dd4b39;">
                                                                          <small class="text-red">Preencha o título do relatório</small>`;

        document.getElementById('groupInputDataRelatorio').innerHTML = `<label for="inputDataRelatorio">DATA RELATÓRIO:</label>
                                                                        <input type="date" class="form-control" id="inputDataRelatorio" name="inputDataRelatorio" value="${document.getElementById('inputDataRelatorio').value}">`;

    }else if(document.getElementById('inputDataRelatorio').value === '' && document.getElementById('inputTituloRelatorio').value != '') {
        
        document.getElementById('groupInputTituloRelatorio').innerHTML = `<label for="inputTituloRelatorio">TÍTULO DO RELATÓRIO:</label>
                                                                          <input type="text" class="form-control" id="inputTituloRelatorio" name="inputTituloRelatorio" placeholder="Digite o título do relatório..." value="${document.getElementById('inputTituloRelatorio').value}">`;

        document.getElementById('groupInputDataRelatorio').innerHTML = `<label for="inputDataRelatorio">DATA RELATÓRIO:</label>
                                                                        <input type="date" class="form-control" id="inputDataRelatorio" name="inputDataRelatorio" value="${document.getElementById('inputDataRelatorio').value}" style="border-color:#dd4b39;">
                                                                        <small class="text-red">Preencha a data do relatório</small>`;

    }else if(document.getElementById('inputTituloRelatorio').value === '' && document.getElementById('inputDataRelatorio').value === '') {
        
        document.getElementById('groupInputTituloRelatorio').innerHTML = `<label for="inputTituloRelatorio">TÍTULO DO RELATÓRIO:</label>
                                                                          <input type="text" class="form-control" id="inputTituloRelatorio" name="inputTituloRelatorio" placeholder="Digite o título do relatório..." style="border-color:#dd4b39;">
                                                                          <small class="text-red">Preencha o título do relatório</small>`;

        document.getElementById('groupInputDataRelatorio').innerHTML = `<label for="inputDataRelatorio">DATA RELATÓRIO:</label>
                                                                        <input type="date" class="form-control" id="inputDataRelatorio" name="inputDataRelatorio" value="${document.getElementById('inputDataRelatorio').value}" style="border-color:#dd4b39;">
                                                                        <small class="text-red">Preencha a data do relatório</small>`;

    }else {
        let dados = {titulo:document.getElementById('inputTituloRelatorio').value, data:document.getElementById('inputDataRelatorio').value, lista:dadosRelatorio};

        $.ajax({
            url : "../ajaxController/requisicoesAjax",
            type : 'POST',
            dataType: 'json',
            data : {tabela:'relatorios', metodo:'imprimir', dados:dados},
            beforeSend: function(){
                $('#modalImprimirRelatorio *').prop('disabled',true);
            },
            success : function(data){
                if(data['status']) {
                    window.open('../relatorios/imprimir_relatorio_lancamentos/'+data['id_relatorio'], '_blank');

                    $('#modalImprimirRelatorio *').prop('disabled',false);

                    document.getElementById('groupInputTituloRelatorio').innerHTML = `<label for="inputTituloRelatorio">TÍTULO DO RELATÓRIO:</label>
                                                                      <input type="text" class="form-control" id="inputTituloRelatorio" name="inputTituloRelatorio" placeholder="Digite o título do relatório...">`;

                    document.getElementById('groupInputDataRelatorio').innerHTML = `<label for="inputDataRelatorio">DATA RELATÓRIO:</label>
                                                                                    <input type="date" class="form-control" id="inputDataRelatorio" name="inputDataRelatorio">`;
                    $('#modalImprimirRelatorio').modal('hide');
                    
                }else {
                    console.log(data['status'])
                }
            }
        });
    }
})

document.getElementById('btnRelatorioBuscarCancelar').addEventListener('click', ()=>{
    $('#ModalListarRelatorio').modal('hide')

    document.getElementById('inputBuscarTituloRelatorio').value = ''
    document.getElementById('inputDataRelatorioInicio').value = ''
    document.getElementById('inputDataRelatorioFim').value = ''
})

document.getElementById('btnBuscarRelatorios').addEventListener('click', buscarRelatorios) 


function buscarRelatorios() {
    let dadosPesquisa = [
        {inputBuscarTituloRelatorio : document.getElementById('inputBuscarTituloRelatorio').value},
        {inputDataRelatorioInicio : document.getElementById('inputDataRelatorioInicio').value}
    ]

    
    $.ajax({
        url : "../ajaxController/requisicoesAjax",
        type : 'POST',
        dataType: 'json',
        data : {tabela:'relatorios', metodo:'pesquisar', dados:montarConsultaBdRelatorios(dadosPesquisa)},
        beforeSend: function() {
            document.getElementById('listaDeRelatorios').innerHTML = `<tr>
                                                                            <td colspan="4" class="text-center">Buscando...</td>
                                                                        </tr>`
        },
        success: function(data) {
            if(data != '') {
                document.getElementById('listaDeRelatorios').innerHTML = ''
                let count = 1

                var formatter = new Intl.DateTimeFormat('pt-BR')

                data.forEach(relatorios => {
                    document.getElementById('listaDeRelatorios').innerHTML += `<tr>
                                                                                    <td class="text-center">${count++}</td>
                                                                                    <td class="text-center">${relatorios['titulo_relatorio']}</td>
                                                                                    <td class="text-center">${relatorios['data_entrada_relatorio'].split('-').reverse().join('/')}</td>
                                                                                    <td class="text-center">
                                                                                        <button type="button" class="btn btn-default btn-xs" onclick="imprimirRelatorio(${relatorios['id_relatorio']})"><i class="fa fa-print"></i></button>
                                                                                        <button type="button" class="btn btn-default btn-xs" onclick="excluirRelatorio(${relatorios['id_relatorio']})"><i class="fa fa-trash"></i></button>
                                                                                    </td>
                                                                                </tr>`
                })

            }else {
                document.getElementById('listaDeRelatorios').innerHTML = `<tr>
                                                                            <td colspan="4" class="text-center">Nenhum Registro Encontrado</td>
                                                                        </tr>`
            }
        }

    })
}

function montarConsultaBdRelatorios(dadosPesquisa) {
    let query = ''

    dadosPesquisa.map((element, indice, arrayBase) => {
        
        switch (indice) {
            case 0:
                
                if(element['inputBuscarTituloRelatorio'] == '') {
                    query += ''
                }else {
                    query += 'AND titulo_relatorio LIKE ' + '"%'+element['inputBuscarTituloRelatorio']+'%"'
                }
                break;

            case 1:
                
                if(document.getElementById('inputDataRelatorioInicio').value == '' || document.getElementById('inputDataRelatorioFim').value == '' || document.getElementById('inputDataRelatorioInicio').value > document.getElementById('inputDataRelatorioFim').value) {
                    query += ''

                }else {
                    query += 'AND data_entrada_relatorio >= ' + '"'+document.getElementById('inputDataRelatorioInicio').value+'"' + ' AND data_entrada_relatorio <= ' + '"'+document.getElementById('inputDataRelatorioFim').value+'"' + ' '
                }
                
                break;
    
            default:
                break;
        }
        
    })

    return query
}

function imprimirRelatorio(id) {
    window.open('../relatorios/imprimir_relatorio_lancamentos/'+id, '_blank');
}

function excluirRelatorio(id) {
    $.confirm({
        title: 'DELETAR?',
        content: 'Deseja deletar esse relatório?',
        buttons: {
            deletar: {
                btnClass: 'btn-green',
                action: function () {
                    $.ajax({
                        url : "../ajaxController/requisicoesAjax",
                        type : 'POST',
                        dataType: 'json',
                        data : {tabela:'relatorios', metodo:'delete', dados:id},
                        success: function(data) {
                            if(data['status']) {
                                mensagemAlerta(1, data['mensagem'])
                                buscarRelatorios()
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


//Formatar campos
document.getElementById('inputValorDaNotaInicio').addEventListener('keyup', formataCampoValorNota);
document.getElementById('inputValorDaNotaFim').addEventListener('keyup', formataCampoValorNota);

function formataCampoValorNota() {
    var v = this.value.replace(/\D/g,'');
	v = (v/100).toFixed(2) + '';
	v = v.replace(".", ",");
	v = v.replace(/(\d)(\d{3})(\d{3}),/g, "$1.$2.$3,");
	v = v.replace(/(\d)(\d{3}),/g, "$1.$2,");
	this.value = v;
}