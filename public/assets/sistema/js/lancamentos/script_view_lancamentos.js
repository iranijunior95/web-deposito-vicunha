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
        url : "./ajaxController/requisicoesAjax",
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

                data.forEach(lancamentos => {
                    document.getElementById('listaDeLancamentos').innerHTML += `<tr>
                                                                                    <td class="text-center">${count++}</td>
                                                                                    <td class="text-center text-primary text-bold"><a href="lancamentos/detalhes/${lancamentos['id_lancamento']}">${lancamentos['nome_fornecedor']}</a></td>
                                                                                    <td class="text-center">${lancamentos['numero_nota']}</td>
                                                                                    <td class="text-center">${lancamentos['nome_conferente']}</td>
                                                                                    <td class="text-center">${lancamentos['nome_setor']}</td>
                                                                                    <td class="text-center">${lancamentos['data_entrada'].split('-').reverse().join('/')}</td>
                                                                                </tr>`
                })

            }else {
                document.getElementById('listaDeLancamentos').innerHTML = `<tr>
                                                                                <td colspan="6" class="text-center">Nenhum Registro Encontrado</td>
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
