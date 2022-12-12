document.getElementById('btnSalvar').addEventListener('click', saveDadosLancamento)
document.getElementById('btnCancelar').addEventListener('click', ()=>{window.location.href = '../lancamentos'})

function saveDadosLancamento() {
    let dadosLancamentos = {
        fornecedor: document.getElementById('inputFornecedor').value,
        conferente: document.getElementById('inputConferente').value,
        setor: document.getElementById('inputSetor').value,
        numeroNota: document.getElementById('inputNumeroDaNota').value,
        valorNota: document.getElementById('inputValorDaNota').value,
        pesoNota: document.getElementById('inputPesoDaNota').value,
        nomeMotorista: document.getElementById('inputNomeMotorista').value,
        placaVeiculo: document.getElementById('inputPlacaVeiculo').value,
        taxaDescarrego: document.getElementById('inputTaxaDescarrego').value,
        horaEntrada: document.getElementById('inputHoraEntrada').value,
        horaSaida: document.getElementById('inputHoraSaida').value,
        dataEntrada: document.getElementById('inputDataEntrada').value,
        id: document.getElementById('inputId').value
    }

    let url = ''

    if(document.getElementById('inputId').value > 0) {
        url = '../../ajaxController/requisicoesAjax'
    }else {
        url = '../ajaxController/requisicoesAjax'
    }

    $.ajax({
        url : url,
        type : 'POST',
        dataType: 'json',
        data : {tabela:'lancamentos', metodo:'save', dados:dadosLancamentos},
        beforeSend: function(){
            $('#divConteudo *').prop('disabled',true);
        },
        success : function(data){
            validaCampos('numeroNota', data['mensagem']['numero_nota'])
            validaCampos('valorNota', data['mensagem']['valor_nota'])
            validaCampos('nomeMotorista', data['mensagem']['nome_motorista'])
            validaCampos('horaEntrada', data['mensagem']['hora_entrada'])
            validaCampos('horaSaida', data['mensagem']['hora_saida'])
            validaCampos('dataEntrada', data['mensagem']['data_entrada'])
            
            if(data['status']) {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: data['mensagem'],
                    showConfirmButton: false,
                    timer: 3000,
                    didClose: (toast) => {
                        cadastrarMaisLancamentos(data['id_lancamento'])
                    }
                });
            }

            $('#divConteudo *').prop('disabled',false)
        }
    });

}

function validaCampos(campo, mensagem) {
    switch (campo) {
        case 'numeroNota':
            if(mensagem) {
                document.getElementById('campoNumeroDaNota').innerHTML = `<div class="form-group">
                                                                                <label for="inputNumeroDaNota">Nº DA NOTA:</label>
                                                                                <input type="number" class="form-control" id="inputNumeroDaNota" name="inputNumeroDaNota" placeholder="Digite o número da nota..." value="${document.getElementById('inputNumeroDaNota').value}" style="border-color:#dd4b39;">
                                                                                <small class="text-red">${mensagem} </small>
                                                                            </div>`
            }else {
                document.getElementById('campoNumeroDaNota').innerHTML = `<div class="form-group">
                                                                                <label for="inputNumeroDaNota">Nº DA NOTA:</label>
                                                                                <input type="number" class="form-control" id="inputNumeroDaNota" name="inputNumeroDaNota" placeholder="Digite o número da nota..." value="${document.getElementById('inputNumeroDaNota').value}">
                                                                            </div>`
            }
            break;

        case 'valorNota':
            if(mensagem) {
                document.getElementById('campoValorDaNota').innerHTML = `<div class="form-group">
                                                                            <label for="inputValorDaNota">VALOR DA NOTA:</label>
                                                                            <input type="text" class="form-control" id="inputValorDaNota" name="inputValorDaNota" placeholder="R$ 0,00" value="${document.getElementById('inputValorDaNota').value}" style="border-color:#dd4b39;">
                                                                            <small class="text-red">${mensagem} </small>
                                                                        </div>`
            }else {
                document.getElementById('campoValorDaNota').innerHTML = `<div class="form-group">
                                                                            <label for="inputValorDaNota">VALOR DA NOTA:</label>
                                                                            <input type="text" class="form-control" id="inputValorDaNota" name="inputValorDaNota" placeholder="R$ 0,00" value="${document.getElementById('inputValorDaNota').value}">
                                                                        </div>`
            }

            document.getElementById('inputValorDaNota').addEventListener('keyup', formataCampoValorNota)
            break;

        case 'nomeMotorista':
            if(mensagem) {
                document.getElementById('campoNomeDoMotorista').innerHTML = `<div class="form-group">
                                                                                <label for="inputNomeMotorista">NOME DO MOTORISTA:</label>
                                                                                <input type="text" class="form-control" id="inputNomeMotorista" name="inputNomeMotorista" placeholder="Digite o nome do motorista..." value="${document.getElementById('inputNomeMotorista').value}" style="border-color:#dd4b39;">
                                                                                <small class="text-red">${mensagem} </small>
                                                                            </div>`
            }else {
                document.getElementById('campoNomeDoMotorista').innerHTML = `<div class="form-group">
                                                                                <label for="inputNomeMotorista">NOME DO MOTORISTA:</label>
                                                                                <input type="text" class="form-control" id="inputNomeMotorista" name="inputNomeMotorista" placeholder="Digite o nome do motorista..." value="${document.getElementById('inputNomeMotorista').value}">
                                                                            </div>`
            }
            break;

        case 'horaEntrada':
            if(mensagem) {
                document.getElementById('campoHoraDeEntrada').innerHTML = `<div class="form-group">
                                                                                <label for="inputHoraEntrada">HORA DE ENTRADA:</label>
                                                                                <input type="time" class="form-control" id="inputHoraEntrada" name="inputHoraEntrada" placeholder="00:00 Hs" value="${document.getElementById('inputHoraEntrada').value}" style="border-color:#dd4b39;">
                                                                                <small class="text-red">${mensagem} </small>
                                                                            </div>`
            }else {
                document.getElementById('campoHoraDeEntrada').innerHTML = `<div class="form-group">
                                                                                <label for="inputHoraEntrada">HORA DE ENTRADA:</label>
                                                                                <input type="time" class="form-control" id="inputHoraEntrada" name="inputHoraEntrada" placeholder="00:00 Hs" value="${document.getElementById('inputHoraEntrada').value}">
                                                                            </div>`
            }
            break;

        case 'horaSaida':
            if(mensagem) {
                document.getElementById('campoHoraDeSaida').innerHTML = `<div class="form-group">
                                                                            <label for="inputHoraSaida">HORA DE SAÍDA:</label>
                                                                            <input type="time" class="form-control" id="inputHoraSaida" name="inputHoraSaida" placeholder="00:00 Hs" value="${document.getElementById('inputHoraSaida').value}" style="border-color:#dd4b39;">
                                                                            <small class="text-red">${mensagem} </small>
                                                                        </div>`

            }else {
                document.getElementById('campoHoraDeSaida').innerHTML = `<div class="form-group">
                                                                            <label for="inputHoraSaida">HORA DE SAÍDA:</label>
                                                                            <input type="time" class="form-control" id="inputHoraSaida" name="inputHoraSaida" placeholder="00:00 Hs" value="${document.getElementById('inputHoraSaida').value}">
                                                                        </div>`
            }
            break;

        case 'dataEntrada':
            if(mensagem) {
                document.getElementById('campoDataDeEntrada').innerHTML = `<div class="form-group">
                                                                                <label for="inputDataEntrada">DATA DE ENTRADA:</label>
                                                                                <input type="date" class="form-control" id="inputDataEntrada" name="inputDataEntrada" value="${document.getElementById('inputDataEntrada').value}" style="border-color:#dd4b39;">
                                                                                <small class="text-red">${mensagem} </small>
                                                                            </div>`
            }else {
                document.getElementById('campoDataDeEntrada').innerHTML = `<div class="form-group">
                                                                                <label for="inputDataEntrada">DATA DE ENTRADA:</label>
                                                                                <input type="date" class="form-control" id="inputDataEntrada" name="inputDataEntrada" value="${document.getElementById('inputDataEntrada').value}">
                                                                            </div>`
            }
            break;
    
        default:
            break;
    }
}

function cadastrarMaisLancamentos(idLancamento) {
    $.confirm({
        title: 'CONTINUAR CADASTRANDO?',
        content: 'Deseja continuar cadastrando Lançamentos?',
        buttons: {
            continuar: {
                btnClass: 'btn-green',
                action: function () {
                    document.getElementById('inputNumeroDaNota').value = ''
                    document.getElementById('inputValorDaNota').value = ''
                    document.getElementById('inputPesoDaNota').value = ''
                }
            },
            cancelar: function () {
                window.location.href = `../lancamentos/detalhes/${idLancamento}`
            }
        }
    });
}

//Formatar campos
document.getElementById('inputValorDaNota').addEventListener('keyup', formataCampoValorNota);

function formataCampoValorNota() {
    var v = this.value.replace(/\D/g,'');
	v = (v/100).toFixed(2) + '';
	v = v.replace(".", ",");
	v = v.replace(/(\d)(\d{3})(\d{3}),/g, "$1.$2.$3,");
	v = v.replace(/(\d)(\d{3}),/g, "$1.$2,");
	this.value = v;
}

$('#inputTaxaDescarrego').keyup(function() {
	var v = this.value.replace(/\D/g,'');
	v = (v/100).toFixed(2) + '';
	v = v.replace(".", ",");
	v = v.replace(/(\d)(\d{3})(\d{3}),/g, "$1.$2.$3,");
	v = v.replace(/(\d)(\d{3}),/g, "$1.$2,");
	this.value = v;
});

$('#inputPesoDaNota').keyup(function () {
	var v = this.value,
	integer = v.split('.')[0];

	v = v.replace(/\D/g, "");

	v = v.replace(/^[0]+/, "");

	if (v.length <= 3 || !integer) {

		if (v.length === 1) v = '0.00' + v;

		if (v.length === 2) v = '0.0' + v;

		if (v.length === 3) v = '0.' + v;
	} else {
		v = v.replace(/^(\d{1,})(\d{3})$/, "$1.$2");
	}
this.value = v;

});