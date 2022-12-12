document.getElementById('btnPesquisarReciboDescarrego').addEventListener('click', buscarRecibosDescarrego)
document.getElementById('btnPesquisarTabelaHortifruti').addEventListener('click', buscarTabelaHortifruti)
document.getElementById('btnPesquisarAvulsa').addEventListener('click', buscarNotaAvulsa)

// Funções para buscar recibos descarrego INCIO
function buscarRecibosDescarrego() {
    let dadosPesquisaRecibo = [
        {filial : document.getElementById('inputFilialRecibo').value},
        {fornecedor: document.getElementById('inputFornecedorRecibo').value},
        {valor: document.getElementById('inputValorRecibo').value},
        {dataInicio: document.getElementById('inputDataEntradaInicioRecibo').value},
        {dataFim: document.getElementById('inputDataEntradaFimRecibo').value}
    ]

    $.ajax({
        url : "./ajaxController/requisicoesAjax",
        type : 'POST',
        dataType: 'json',
        data : {tabela:'recibos', metodo:'buscarDados', dados:montarConsultaReciboDescarrego(dadosPesquisaRecibo)},
        beforeSend : function() {
            $('#divElementosBuscarRecibos *').prop('disabled',true);

            document.getElementById('listaTabelaRecibos').innerHTML = `<tr>
                                                                            <td colspan="5" class="text-center">Buscando...</td>
                                                                        </tr>`
        },
        success : function(data) {
            if(data != '') {
                document.getElementById('listaTabelaRecibos').innerHTML = ''
                let count = 1

                data.forEach(recibo => {
                    document.getElementById('listaTabelaRecibos').innerHTML += `<tr>
                                                                                    <td class="text-center">${count++}</td>
                                                                                    <td class="text-center">${recibo['numero_filial']}</td>
                                                                                    <td class="text-center">${recibo['nome_fornecedor']}</td>
                                                                                    <td class="text-center">R$ ${recibo['valor_recibo']}</td>
                                                                                    <td class="text-center">
                                                                                        <a href="./relatorios/imprimir_recibo_descarrego/${recibo['id_recibos']}" target="_blank" class="btn btn-default btn-xs"><i class="fa fa-print"></i></a> 
                                                                                        <button type="button" class="btn btn-default btn-xs" onclick="deletarReciboDescarrego(${recibo['id_recibos']})"><i class="fa fa-trash"></i></button>
                                                                                    </td>
                                                                               </tr>`
                })
            
            }else {
                document.getElementById('listaTabelaRecibos').innerHTML = `<tr>
                                                                                <td colspan="5" class="text-center">Nenhum Registro Encontrado</td>
                                                                            </tr>`
            }

            $('#divElementosBuscarRecibos *').prop('disabled',false);
        } 
    })
}

function montarConsultaReciboDescarrego(dadosPesquisa) {

    let query = ''

    dadosPesquisa.map((element, indice, arrayBase) => {
        switch (indice) {
            case 0: 

                if(element['filial'] == 0) {
                    query += ''
                }else {
                    query += 'AND numero_filial = ' + element['filial'] + ' '
                }

            break;

            case 1:

                if(element['fornecedor'] == 0) {
                    query += ''
                }else {
                    query += 'AND fornecedores_id_fornecedor = ' + element['fornecedor'] + ' '
                }

            break;

            case 2:

                if(element['valor'] == '' || element['valor'] == 0 || element['valor'] == '0,00') {
                    query += ''
                }else {
                    query += 'AND valor_recibo = ' +'"'+ element['valor'] + '"'+' '
                }

            break;

            case 3:
                
                if(document.getElementById('inputDataEntradaInicioRecibo').value == '' || document.getElementById('inputDataEntradaFimRecibo').value == '' || document.getElementById('inputDataEntradaInicioRecibo').value > document.getElementById('inputDataEntradaFimRecibo').value) {
                    query += ''

                }else {
                    query += 'AND data_entrada_recibo >= ' + '"'+document.getElementById('inputDataEntradaInicioRecibo').value+'"' + ' AND data_entrada_recibo <= ' + '"'+document.getElementById('inputDataEntradaFimRecibo').value+'"' + ' '
                }
                
            break;
        }
    })

    return query
}

function deletarReciboDescarrego(idRecibos) {
    $.confirm({
        title: 'DELETAR?',
        content: 'Deseja deletar esse RECIBO?',
        buttons: {
            deletar: {
                btnClass: 'btn-green',
                action: function () {
                    $.ajax({
                        url : "./ajaxController/requisicoesAjax",
                        type : 'POST',
                        dataType: 'json',
                        data : {tabela:'recibos', metodo:'delete', dados:idRecibos},
                        success: function(data) {
                            if(data['status']) {
                                mensagemAlerta(1, data['mensagem'])

                                buscarRecibosDescarrego()
                            
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
    })
}
// Funções para buscar recibos descarrego FIM

// Funções para buscar tabelas hortifruti INCIO
function buscarTabelaHortifruti() {
    let dadosPesquisaHortifruti = [
        {conferente: document.getElementById('inputConferente').value},
        {dataInicio: document.getElementById('inputDataEntradaInicioHortifruti').value},
        {dataFim: document.getElementById('inputDataEntradaFimHortifruti').value}
    ]

    $.ajax({
        url : "./ajaxController/requisicoesAjax",
        type : 'POST',
        dataType: 'json',
        data : {tabela:'tabelaHorti', metodo:'buscarDados', dados:montarConsultaTabelaHortifruti(dadosPesquisaHortifruti)},
        beforeSend : function() {
            $('#divElementosBuscarHortifruti *').prop('disabled',true);

            document.getElementById('listaTabelaHortifruti').innerHTML = `<tr>
                                                                            <td colspan="5" class="text-center">Buscando...</td>
                                                                        </tr>`
        },
        success : function(data) {
            if(data != '') {
                document.getElementById('listaTabelaHortifruti').innerHTML = ''
                let count = 1

                data.forEach(hortifruti => {
                    document.getElementById('listaTabelaHortifruti').innerHTML += `<tr>
                                                                                    <td class="text-center">${count++}</td>
                                                                                    <td class="text-center">${hortifruti['titulo_hortifruti']}</td>
                                                                                    <td class="text-center">${hortifruti['nome_conferente']}</td>
                                                                                    <td class="text-center">${hortifruti['nome_motorista_hortifruti']}</td>
                                                                                    <td class="text-center">
                                                                                        <a href="./relatorios/imprimir_tabela_hortifruti/${hortifruti['id_hortifruti']}" target="_blank" class="btn btn-default btn-xs"><i class="fa fa-print"></i></a> 
                                                                                        <button type="button" class="btn btn-default btn-xs" onclick="deletaTabelaHortifruti(${hortifruti['id_hortifruti']})"><i class="fa fa-trash"></i></button>
                                                                                    </td>
                                                                               </tr>`
                })

            }else {
                document.getElementById('listaTabelaHortifruti').innerHTML = `<tr>
                                                                                <td colspan="5" class="text-center">Nenhum Registro Encontrado</td>
                                                                            </tr>`
            }

            $('#divElementosBuscarHortifruti *').prop('disabled',false);
        }

    })

}

function montarConsultaTabelaHortifruti(dadosPesquisa) {
    let query = ''

    dadosPesquisa.map((element, indice, arrayBase) => {
        switch (indice) {
            case 0: 

                if(element['conferente'] == 0) {
                    query += ''
                }else {
                    query += 'AND conferentes_id_conferente = ' + element['conferente'] + ' '
                }

            break;

            case 1:
                
                if(document.getElementById('inputDataEntradaInicioHortifruti').value == '' || document.getElementById('inputDataEntradaFimHortifruti').value == '' || document.getElementById('inputDataEntradaInicioHortifruti').value > document.getElementById('inputDataEntradaFimHortifruti').value) {
                    query += ''

                }else {
                    query += 'AND data_entrada_hortifruti >= ' + '"'+document.getElementById('inputDataEntradaInicioHortifruti').value+'"' + ' AND data_entrada_hortifruti <= ' + '"'+document.getElementById('inputDataEntradaFimHortifruti').value+'"' + ' '
                }
                
            break;
        }
    })

    return query
}

function deletaTabelaHortifruti(idHortifruti) {
    $.confirm({
        title: 'DELETAR?',
        content: 'Deseja deletar essa TABELA?',
        buttons: {
            deletar: {
                btnClass: 'btn-green',
                action: function () {
                    $.ajax({
                        url : "./ajaxController/requisicoesAjax",
                        type : 'POST',
                        dataType: 'json',
                        data : {tabela:'tabelaHorti', metodo:'delete', dados:idHortifruti},
                        success: function(data) {
                            if(data['status']) {
                                mensagemAlerta(1, data['mensagem'])

                                buscarTabelaHortifruti()
                            
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
    })
}
// Funções para buscar tabelas hortifruti FIM

// Funções para buscar nota avulsa INCIO
function buscarNotaAvulsa() {
    let dadosPesquisaNotaAvulsa = [
        {fornecedor: document.getElementById('inputFornecedorAvulsa').value},
        {conferente: document.getElementById('inputConferenteAvulsa').value},
        {valor: document.getElementById('inputValorAvulsa').value},
        {dataInicio: document.getElementById('inputDataEntradaInicioAvulsa').value},
        {dataFim: document.getElementById('inputDataEntradaFimAvulsa').value}
    ]

    $.ajax({
        url : "./ajaxController/requisicoesAjax",
        type : 'POST',
        dataType: 'json',
        data : {tabela:'tabelaNotaAvulsa', metodo:'buscarDados', dados:montarConsultaNotaAvulsa(dadosPesquisaNotaAvulsa)},
        beforeSend : function() {
            $('#divElementosBuscarNotaAvulsa *').prop('disabled',true);

            document.getElementById('listaTabelaAvulsa').innerHTML = `<tr>
                                                                            <td colspan="5" class="text-center">Buscando...</td>
                                                                        </tr>`
        },
        success : function(data) {
            if(data != '') {
                document.getElementById('listaTabelaAvulsa').innerHTML = ''
                let count = 1

                data.forEach(avulsa => {
                    document.getElementById('listaTabelaAvulsa').innerHTML += `<tr>
                                                                                        <td class="text-center">${count++}</td>
                                                                                        <td class="text-center">${avulsa['nome_fornecedor']}</td>
                                                                                        <td class="text-center">${avulsa['nome_conferente']}</td>
                                                                                        <td class="text-center">R$ ${avulsa['valor_total_nota_avulsa']}</td>
                                                                                        <td class="text-center">
                                                                                            <a href="./relatorios/imprimir_tabela_nota_avulsa/${avulsa['id_nota_avulsa']}" target="_blank" class="btn btn-default btn-xs"><i class="fa fa-print"></i></a> 
                                                                                            <button type="button" class="btn btn-default btn-xs" onclick="deletaNotaAvulsa(${avulsa['id_nota_avulsa']})"><i class="fa fa-trash"></i></button>
                                                                                        </td>
                                                                                </tr>`
                })

            }else {
                document.getElementById('listaTabelaAvulsa').innerHTML = `<tr>
                                                                                    <td colspan="5" class="text-center">Nenhum Registro Encontrado</td>
                                                                                </tr>`
            }

            $('#divElementosBuscarNotaAvulsa *').prop('disabled',false);
        }

    })
}

function montarConsultaNotaAvulsa(dadosPesquisa) {
    let query = ''

    dadosPesquisa.map((element, indice, arrayBase) => {
        switch (indice) {
            case 0: 

                if(element['fornecedor'] == 0) {
                    query += ''
                }else {
                    query += 'AND fornecedores_id_fornecedor = ' + element['fornecedor'] + ' '
                }

            break;

            case 1: 

                if(element['conferente'] == 0) {
                    query += ''
                }else {
                    query += 'AND conferentes_id_conferente = ' + element['conferente'] + ' '
                }

            break;

            case 2:

                if(element['valor'] == '' || element['valor'] == 0 || element['valor'] == '0,00') {
                    query += ''
                }else {
                    query += 'AND valor_total_nota_avulsa = ' +'"'+ element['valor'] + '"'+' '
                }

            break;

            case 3:
                
                if(document.getElementById('inputDataEntradaInicioAvulsa').value == '' || document.getElementById('inputDataEntradaFimAvulsa').value == '' || document.getElementById('inputDataEntradaInicioAvulsa').value > document.getElementById('inputDataEntradaFimAvulsa').value) {
                    query += ''

                }else {
                    query += 'AND data_entrada_nota_avulsa >= ' + '"'+document.getElementById('inputDataEntradaInicioAvulsa').value+'"' + ' AND data_entrada_nota_avulsa <= ' + '"'+document.getElementById('inputDataEntradaFimAvulsa').value+'"' + ' '
                }
                
            break;
        }
    })

    return query
}

function deletaNotaAvulsa(idNotaAvulsa) {
    $.confirm({
        title: 'DELETAR?',
        content: 'Deseja deletar essa NOTA?',
        buttons: {
            deletar: {
                btnClass: 'btn-green',
                action: function () {
                    $.ajax({
                        url : "./ajaxController/requisicoesAjax",
                        type : 'POST',
                        dataType: 'json',
                        data : {tabela:'tabelaNotaAvulsa', metodo:'delete', dados:idNotaAvulsa},
                        success: function(data) {
                            if(data['status']) {
                                mensagemAlerta(1, data['mensagem'])

                               buscarNotaAvulsa()
                            
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
    })
}
// Funções para buscar nota avulsa FIM

//Formatar campos
document.getElementById('inputValorRecibo').addEventListener('keyup', formataCampoValor)
document.getElementById('inputValorAvulsa').addEventListener('keyup', formataCampoValor)

function formataCampoValor() {
    var v = this.value.replace(/\D/g,'');
	v = (v/100).toFixed(2) + '';
	v = v.replace(".", ",");
	v = v.replace(/(\d)(\d{3})(\d{3}),/g, "$1.$2.$3,");
	v = v.replace(/(\d)(\d{3}),/g, "$1.$2,");
	this.value = v;
}