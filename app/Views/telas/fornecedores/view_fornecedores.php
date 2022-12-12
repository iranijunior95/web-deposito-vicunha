<div class="container">
    <br>

    <div class="panel panel-default" style="padding-bottom: 5px;">
        <h3 class="text-center"><i class="fa fa-truck"></i> FORNECEDORES</h3>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="input-group">
                <input name="inputBuscarFornecedor" class="form-control" id="inputBuscarFornecedor" type="text" placeholder="Buscar fornecedor...">
                <span class="input-group-btn">
                    <button type="button" class="btn btn-success" id="btnBuscarFornecedor">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </div>

        <div class="col-md-4 text-center"></div>

        <div class="col-md-4 text-right">
            <button type="button" class="btn btn-default text-green" id="btnAbrirModalForm"><i class="fa fa-plus"></i> <b>CADASTRAR NOVO</b></button>
        </div>
    </div>

    <br>

    <div class="box box-solid">
        <div class="box-body table-responsive no-padding fixTableHead">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th style="width: 3%;" class="text-center">#</th>
                        <th style="width: 50%;" class="text-center">FORNECEDOR</th>
                        <th class="text-center">CNPJ</th>
                        <th style="width: 10%;" class="text-center">AÇÃO</th>
                    </tr>
                </thead>

                <tbody id="listaDeFornecedores">
                    <?php
                    if(empty($listafornecedores)) {
                    ?>
                        <tr>
                            <td colspan="4" class="text-center">Nenhum Registro Encontrado</td>
                        </tr>
                    <?php
                    }else {
                        $count = 1;

                        foreach($listafornecedores as $fornecedores) {
                    ?>
                            <tr>
                                <td class="text-center"><?=$count++?></td>
                                <td class="text-center"><?=$fornecedores['nome_fornecedor']?></td>
                                <td class="text-center"><?=$fornecedores['cnpj_cpf_fornecedor']?></td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-default btn-xs" onclick="abrirModalForm(<?=$fornecedores['id_fornecedor']?>)"><i class="fa fa-edit"></i></button> 
                                    <button type="button" class="btn btn-default btn-xs" onclick="deletarConferente(<?=$fornecedores['id_fornecedor']?>)"><i class="fa fa-trash"></i></button>
                                </td> 
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Formulario Fornecedores -->
<div class="modal fade" id="modalFormFornecedor" data-backdrop="static" data-keyboard="false" style="display: none;">
    <div class="modal-dialog">
    	<div class="modal-content">
        	<div class="modal-header text-center" style="background-color: #00a65a; color:#FFFFFF">
                <h4 class="modal-title">CADASTRAR FORNECEDOR</h4>
            </div>

            <div class="modal-body">
	            <div class="box-body" id="bodyModalCadastro">
                    <form>
                        <div class="form-group" id="groupNomeFornecedor">
                            <label for="inputNomeFornecedor">NOME DO FORNECEDOR:</label>
                            <input type="text" class="form-control" id="inputNomeFornecedor" placeholder="Nome do fornecedor">
                        </div>

                        <div class="form-group" id="groupCnpjFornecedor">
                            <label for="inputCnpjFornecedor">CNPJ DO FORNECEDOR:</label>
                            <input type="text" class="form-control" id="inputCnpjFornecedor" onkeypress='mascaraMutuario(this,cpfCnpj)' onblur='clearTimeout()' maxlength="18" placeholder="xx.xxx.xxx/xxxx-xx">
                        </div>

                        <input type="hidden" id="inputIdFornecedor" value="0">
                    </form>
	            </div>

	            <div class="box-footer text-center">
                  	<button type="button" class="btn btn-success" id="btnSalvar"><i class="fa fa-check"></i> <strong>SALVAR</strong></button>
                    <button type="button" class="btn btn-default" id="btnCancelar"><i class="fa fa-remove"></i> <strong>CANCELAR</strong></button>
                </div>
            </div>
        </div>
   	</div>
</div>