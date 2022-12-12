let dadosProdutos = []
let dadosTabela = []

let btnAddProduto = document.getElementById('btnAddProduto')

document.getElementById('inputKGUndCx').addEventListener('keyup', formatarPeso)
document.getElementById('inputValor').addEventListener('keyup', formataCampoValor)

document.getElementById('inputCobranca').addEventListener('change', () => {
    switch (document.getElementById('inputCobranca').value) {
        case 'kg':
            document.getElementById('camposKgUndCX').innerHTML = `<div class="form-group">
                                                                        <label>KG:</label>
                                                                        <input type="text" class="form-control" id="inputKGUndCx" name="inputKGUndCx">
                                                                    </div>`

            document.getElementById('inputKGUndCx').addEventListener('keyup', formatarPeso)
            break;

        case 'und':
            document.getElementById('camposKgUndCX').innerHTML = `<div class="form-group">
                                                                        <label>UNIDADES:</label>
                                                                        <input type="text" class="form-control" id="inputKGUndCx" name="inputKGUndCx">
                                                                    </div>`
        break;

    case 'cx':
            document.getElementById('camposKgUndCX').innerHTML = `<div class="form-group">
                                                                        <label>KG:</label>
                                                                        <input type="text" class="form-control" id="inputKGUndCx" name="inputKGUndCx">
                                                                    </div>`

            document.getElementById('inputKGUndCx').addEventListener('keyup', formatarPeso)
        break;
    
    }
})

btnAddProduto.addEventListener('click', () => {
    if(validaCamposAddProdutos()) {

        let dados = {
            'id_produto' : document.getElementById('inputProdutos').value,
            'produto' : buscarDadosProdutoId(document.getElementById('inputProdutos').value),
            'cobranca' : document.getElementById('inputCobranca').value,
            'qtdCx' : document.getElementById('inputQtd').value,
            'KGUndCx' : document.getElementById('inputKGUndCx').value,
            'valorUnitario' : document.getElementById('inputValor').value,
            'valorTotalProduto' : calcularValor()
        }

        let result = dadosTabela.find( produto => produto.id_produto === dados.id_produto)

        if(!result) {
            dadosTabela.push(dados)

            renderizarDadosTabela()

            document.getElementById('inputQtd').value = ''
            document.getElementById('inputKGUndCx').value = ''
            document.getElementById('inputValor').value = ''
            document.getElementById('inputProdutos').focus()


        }else {
            $.confirm({
                title: '',
                content: 'Produto já inserido na tabela!',
                buttons: {
                    ok: {
                        btnClass: 'btn-green',
                        action: function () {
                            return true
                        }
                    },
                }
            })
        }

    }else {
        $.confirm({
            title: '',
            content: 'Existem campos não preenchidos!',
            buttons: {
                ok: {
                    btnClass: 'btn-green',
                    action: function () {
                        return true
                    }
                },
            }
        })
    }
    
})

function validaCamposAddProdutos() {
    if(document.getElementById('inputQtd').value === '' || document.getElementById('inputKGUndCx').value === '' || document.getElementById('inputValor').value === '') {
        return false
    }else {
        return true
    }
}

function calcularValor() {

    switch (document.getElementById('inputCobranca').value) {
        case 'kg':
            let medidaKg = parseFloat(document.getElementById('inputKGUndCx').value)
            //medidaKg = parseInt(medidaKg.replace(/[^\d]+/g,''))
            let valorKg = parseInt(document.getElementById('inputValor').value.replace(/[^\d]+/g,''))

            let resultadoKg = Math.round((medidaKg * valorKg))/100

            return resultadoKg.toLocaleString('pt-br', {minimumFractionDigits: 2})
            break;

        case 'und':
            let medidaUnd = parseInt(document.getElementById('inputKGUndCx').value.replace(/[^\d]+/g,''))
            let valorUnd = parseInt(document.getElementById('inputValor').value.replace(/[^\d]+/g,''))
            
            let resultadoUnd = Math.round((medidaUnd * valorUnd))/100

            return resultadoUnd.toLocaleString('pt-br', {minimumFractionDigits: 2})
            break;

        case 'cx':
            let medidaCx = parseInt(document.getElementById('inputQtd').value.replace(/[^\d]+/g,''))
            let valorCx = parseInt(document.getElementById('inputValor').value.replace(/[^\d]+/g,''))

            let resultadoCx = Math.round((medidaCx * valorCx))/100

            return resultadoCx.toLocaleString('pt-br', {minimumFractionDigits: 2})
            break;
    }
}

function calcularValorTotal() {
    let valorTotal = '0'

    dadosTabela.find(Object =>{
        let resultado = (parseInt(valorTotal.replace(/[^\d]+/g,'')) + parseInt(Object.valorTotalProduto.replace(/[^\d]+/g,''))) / 100
        valorTotal = resultado.toLocaleString('pt-br', {minimumFractionDigits: 2})
    })

    return valorTotal
}

function buscarDadosProdutoId(id) {
    let produtos = [];

    for(let prod of dadosProdutos) {
        if(prod.id_produto.indexOf(id) >= 0) {
            produtos.push(prod);
        }
    }

    return produtos[0].nome_produto;
}

function getAllDados() {

    $.ajax({
        url : "../ajaxController/requisicoesAjax",
        type : 'POST',
        dataType: 'json',
        data : {tabela:'produtos', metodo:'getAllProdutos'},
        success : function(data){ 
            dadosProdutos = data;

        }
    })
}

function renderizarDadosTabela() {

    if(dadosTabela == '') {
        document.getElementById('listaTabelaProdutos').innerHTML = `<tr>
                                                                        <td colspan="7" class="text-center">Tabela Vazia</td>
                                                                    </tr>`
    }else {

        dadosTabela = dadosTabela.sort(compare);
        document.getElementById('listaTabelaProdutos').innerHTML = ``;
        let count = 1;
        let indice = 0;
        let medida = 'Kg';

        dadosTabela.find(Object =>{

            if(Object.cobranca === 'und') {
                medida = 'UND';
            }else {
                medida = 'KG';
            }

            document.getElementById('listaTabelaProdutos').innerHTML += `<tr>
                                                                            <td class="text-center">${count++}</td>
                                                                            <td class="text-center">${Object.produto}</td>
                                                                            <td class="text-center">${Object.qtdCx} cx</td>
                                                                            <td class="text-center">${Object.KGUndCx} ${medida}</td>
                                                                            <td class="text-center">R$ ${Object.valorUnitario}</td>
                                                                            <td class="text-center text-bold">R$ ${Object.valorTotalProduto}</td>
                                                                            <td style="width: 10%;" class="text-center">
                                                                                <button type="button" class="btn btn-default btn-xs" onclick="removerProduto(${indice++})"><i class="fa fa-remove"></i> REMOVER</button>
                                                                            </td>
                                                                        </tr>`;
        })


        document.getElementById('listaTabelaProdutos').innerHTML += `<tr>
                                                                        <td colspan="5" class="text-right text-bold" style="background-color: #d2d6de">
                                                                            VALOR TOTAL:
                                                                        </td>
                                                                        <td colspan="2" class="text-center text-bold" style="background-color: #00a65a; color: #FFFFFF;">R$ ${calcularValorTotal()}</td>
                                                                    </tr>`
                                                                    
        document.getElementById('listaTabelaProdutos').innerHTML += `<tr>
                                                                        <td colspan="7" class="text-center">
                                                                            <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalImprimirTabela"><i class="fa fa-print"></i> IMPRIMIR TABELA</button>
                                                                        </td>
                                                                    </tr>`

    }
}

function compare(a,b) {
    if (a.produto < b.produto)
       return -1;
    if (a.produto > b.produto)
      return 1;
    return 0;
}

function removerProduto(indice) {
    
    dadosTabela.splice(indice, 1)
    renderizarDadosTabela()
}

//Formata campo Peso
function formatarPeso() {
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
}

function formataCampoValor() {
    var v = this.value.replace(/\D/g,'');
	v = (v/100).toFixed(2) + '';
	v = v.replace(".", ",");
	v = v.replace(/(\d)(\d{3})(\d{3}),/g, "$1.$2.$3,");
	v = v.replace(/(\d)(\d{3}),/g, "$1.$2,");
	this.value = v;
}

getAllDados()
renderizarDadosTabela()

document.getElementById('btnTabelaImprimir').addEventListener('click', () => {
    if(verificaCampoData()) {
        let dados = {
            fornecedor: document.getElementById('inputNomeFornecedor').value,
            conferente: document.getElementById('inputNomeConferente').value,
            data: document.getElementById('inputDataTabela').value,
            tabela: dadosTabela,
            valorTotal: calcularValorTotal()
        }

        $.ajax({
            url : "../ajaxController/requisicoesAjax",
            type : 'POST',
            dataType: 'json',
            data : {tabela:'tabelaNotaAvulsa', metodo:'save', dados:dados},
            beforeSend: function(){
                $('#modalImprimirTabela *').prop('disabled',true)
            },
            success : function(data){
                window.open('../relatorios/imprimir_tabela_nota_avulsa/'+data['id_nota_avulsa'], '_blank');

                document.getElementById('groupInputDataTabela').innerHTML = `<label for="inputDataTabela">DATA TABELA:</label>
                                                                            <input type="date" class="form-control" id="inputDataTabela" name="inputDataTabela">`

                $('#modalImprimirTabela').modal('hide');
            }
        })

    }else {
        console.log('não pode gerar...')
    }

    $('#modalImprimirTabela *').prop('disabled',false)
})

function verificaCampoData() {
    if(document.getElementById('inputDataTabela').value === '') {
        document.getElementById('groupInputDataTabela').innerHTML = `<label for="inputDataTabela">DATA TABELA:</label>
                                                                     <input type="date" class="form-control" id="inputDataTabela" name="inputDataTabela" style="border-color:#dd4b39;" value="${document.getElementById('inputDataTabela').value}">
                                                                     <small class="text-red">Preencha a data da tabela</small>`;

        return false;
    }else {
        document.getElementById('groupInputDataTabela').innerHTML = `<label for="inputDataTabela">DATA TABELA:</label>
                                                                     <input type="date" class="form-control" id="inputDataTabela" name="inputDataTabela" value="${document.getElementById('inputDataTabela').value}">`;

        return true;
    }
}