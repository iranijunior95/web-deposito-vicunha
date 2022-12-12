document.getElementById('btnGerar').addEventListener('click', validaDados)

document.getElementById('btnCancelar').addEventListener('click', (event)=>{
    window.location.href = '../relatorios'
})

document.getElementById('inputFilial').addEventListener('change', (event)=>{
    let value = document.getElementById('inputFilial').value;
    let descricao = document.getElementById('descricao_filial');

    switch (value) {
        case '1':
            descricao.value = 'ATACADÃO VICUNHA LTDA';
            break;

        case '2':
            descricao.value = 'ATACADÃO VICUNHA LTDA FILIAL';
            break;

        case '4':
            descricao.value = 'COMERCIAL VICUNHA INDUSTRIA E COMERCIO LTDA';
            break;
    
        default:
            break;
    }
})

$('#inputFornecedor').change(function (){
	let value = $('#inputFornecedor').val()
    buscaDadosFornecedor(value)
    
})

function buscaDadosFornecedor(value){
    $.ajax({
        url : "../ajaxController/requisicoesAjax",
        type : 'POST',
        dataType: 'json',
        data : {tabela:'fornecedores', metodo:'getById', dados:value},
        success : function(data){
            document.getElementById('inputCnpj').value = data[0]['cnpj_cpf_fornecedor']
        }
    })
}

document.getElementById('inputValor').addEventListener('keyup', function() {
	var v = this.value.replace(/\D/g,'');
	v = (v/100).toFixed(2) + '';
	v = v.replace(".", ",");
	v = v.replace(/(\d)(\d{3})(\d{3}),/g, "$1.$2.$3,");
	v = v.replace(/(\d)(\d{3}),/g, "$1.$2,");
	this.value = v;
})

function validaDados() {

    if(exibirMensagenDeErro('numero_nota') & exibirMensagenDeErro('valor') & exibirMensagenDeErro('data')) {
        exibirPreviaRecibo();
    }else {
        console.log('não pode gerar...')
    }

}

function exibirMensagenDeErro(campo) {
    let inputNumeroNota = document.getElementById('inputNumeroDaNota').value;
    let inputValor = document.getElementById('inputValor').value;
    let inputData = document.getElementById('inputData').value;

    switch (campo) {
        case 'numero_nota':
            
            if(inputNumeroNota === '') {
                document.getElementById('groupNumeroNota').innerHTML = `<label>Nº DA NOTA:</label>
                                                                        <input type="text" class="form-control inputNumeroDaNota" id="inputNumeroDaNota" name="inputNumeroDaNota" placeholder="Digite o número da nota..." style="border-color:#dd4b39;" value="${inputNumeroNota}">
                                                                        <small class="text-red">Preencha o campo número da nota</small>`;

                return false;
            }else {
                document.getElementById('groupNumeroNota').innerHTML = `<label>Nº DA NOTA:</label>
                                                                        <input type="text" class="form-control inputNumeroDaNota" id="inputNumeroDaNota" name="inputNumeroDaNota" placeholder="Digite o número da nota..." value="${inputNumeroNota}">`;

                return true;
            }
            break;
            
        case 'valor':
            
            if(inputValor === '') {
                document.getElementById('groupValor').innerHTML = `<label for="valor">VALOR:</label>
                                                                   <input type="text" class="form-control" id="inputValor" name="inputValor" placeholder="R$ 0,00" style="border-color:#dd4b39;" value="${inputValor}">
                                                                   <small class="text-red">Preencha o campo valor</small>`;

                document.getElementById('inputValor').addEventListener('keyup', function() {
                    var v = this.value.replace(/\D/g,'');
                    v = (v/100).toFixed(2) + '';
                    v = v.replace(".", ",");
                    v = v.replace(/(\d)(\d{3})(\d{3}),/g, "$1.$2.$3,");
                    v = v.replace(/(\d)(\d{3}),/g, "$1.$2,");
                    this.value = v;
                });

                return false;
            }else {
                document.getElementById('groupValor').innerHTML = `<label for="valor">VALOR:</label>
                                                                   <input type="text" class="form-control" id="inputValor" name="inputValor" placeholder="R$ 0,00" value="${inputValor}">`;

                document.getElementById('inputValor').addEventListener('keyup', function() {
                    var v = this.value.replace(/\D/g,'');
                    v = (v/100).toFixed(2) + '';
                    v = v.replace(".", ",");
                    v = v.replace(/(\d)(\d{3})(\d{3}),/g, "$1.$2.$3,");
                    v = v.replace(/(\d)(\d{3}),/g, "$1.$2,");
                    this.value = v;
                });

                return true;
            }
            break;

        case 'data':
            
            if(inputData === '') {
                document.getElementById('groupData').innerHTML = `<label>DATA DE ENTRADA:</label>
                                                                  <input type="date" class="form-control" id="inputData" name="inputData" style="border-color:#dd4b39;" value="${inputData}">
                                                                  <small class="text-red">Preencha o campo data</small>`;

                return false;
            }else {
                document.getElementById('groupData').innerHTML = `<label>DATA DE ENTRADA:</label>
                                                                  <input type="date" class="form-control" id="inputData" name="inputData" value="${inputData}">`;

                return true;
            }
            break;
    
        default:
            break;
    }
}

function exibirPreviaRecibo() {

    let dadosRecibo = {
        'filial' : document.getElementById('inputFilial').value,
        'fornecedor' : document.getElementById('inputFornecedor').value,
        'numero_nota' : document.getElementById('inputNumeroDaNota').value,
        'valor' : document.getElementById('inputValor').value,
        'data' : document.getElementById('inputData').value
    };

    $.ajax({
        url : "../ajaxController/requisicoesAjax",
        type : 'POST',
        dataType: 'json',
        data : {tabela:'recibos', metodo:'retornaDados', dados:dadosRecibo},
        success : function(data){

            let filial = 'ATACADÃO VICUNHA LTDA';
            let cnpjFilial = '35.298.801/0001-60';

            switch (data['filial']) {
                case '1':

                    filial = 'ATACADÃO VICUNHA LTDA';
                    cnpjFilial = '35.298.801/0001-60';
                    break;

                case '2':
                    
                    filial = 'ATACADÃO VICUNHA LTDA FILIAL';
                    cnpjFilial = '35.298.801/0003-21';
                    break;

                case '4':
                    
                    filial = 'COMERCIAL VICUNHA INDUSTRIA E COMERCIO LTDA';
                    cnpjFilial = '35.367.588/0001-09 ';
                    break;
            
                default:
                    break;
            }

            document.getElementById('bodyRecibo').innerHTML = `
            <div class="row text-center">
                <img src="../assets/sistema/img/logo_oficial_grupo_vicunha.png" width="207" height="80">
            </div>

            <h4 class="text-center"><b>RECIBO</b></h4>

            <br>
			
            <div class="row">
                <div class="col-md-1"></div>

                <div class="col-md-10 text-justify">
                    <p>Por meio deste documento declaro que recebi a quantia de <b>R$${data['valor']}</b> (<b>${data['valor_extenso']}</b>)
                    referente ao descarrego dos produtos constantes na(s) nota(s) fiscal(ais) de número: <b>“${data['numero_nota']}”</b>, emitida(s) pelo fornecedor: <b>${data['fornecedor'][0]['nome_fornecedor']}</b>, cadastrado no CNPJ/CPF de
                    número: <b>${data['fornecedor'][0]['cnpj_cpf_fornecedor']}</b>.</p>
                </div>

                <div class="col-md-1"></div>
            </div>

            <br>
			<br>
			<br>
			<br>
			<br>
			<br>

            <div class="row text-center">
                <p>______________________________________________</p>
		        <p style="font-size: 11px; margin-top: -10px;"><b>${filial}</b></p>
		        <p style="font-size: 11px; margin-top: -13px;"><b>${cnpjFilial}</b></p>

                <p>CURRAIS NOVOS - RN / ( ${data['data']} )</p>
            </div>
            `;

            $('#modalPreviaRecibo').modal('show');
        }
    });

}

document.getElementById('btnCancelarPrevia').addEventListener('click', function() {
    $('#modalPreviaRecibo').modal('hide');
})

document.getElementById('btnImprimirRecibo').addEventListener('click', (event)=>{
    let dadosRecibo = {
        'numero_filial': document.getElementById('inputFilial').value,
        'descricao_filial': document.getElementById('descricao_filial').value,
        'numero_nota_recibo': document.getElementById('inputNumeroDaNota').value,
        'valor_recibo': document.getElementById('inputValor').value,
        'data_recibo': document.getElementById('inputData').value,
        'fornecedores_id_fornecedor': document.getElementById('inputFornecedor').value
    }

    $.ajax({
        url : "../ajaxController/requisicoesAjax",
        type : 'POST',
        dataType: 'json',
        data : {tabela:'recibos', metodo:'save', dados:dadosRecibo},
        success : function(data){
            if(data['status']){
                window.open('../relatorios/imprimir_recibo_descarrego/'+data['id_recibo'], '_blank')
            }else {
                console.log(data['mensagem'])
            }
        }
    })
})

buscaDadosFornecedor($('#inputFornecedor').val())