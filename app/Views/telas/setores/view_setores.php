<div class="container">
    <br>

    <div class="panel panel-default" style="padding-bottom: 5px;">
        <h3 class="text-center"><i class="fa fa-bank"></i> SETORES</h3>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="input-group">
                <input name="inputBuscarSetor" class="form-control" id="inputBuscarSetor" type="text" placeholder="Buscar setor...">
                <span class="input-group-btn">
                    <button type="button" class="btn btn-success" id="btnBuscarSetores">
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
                        <th class="text-center">SETOR</th>
                        <th style="width: 10%;" class="text-center">AÇÃO</th>
                    </tr>
                </thead>

                <tbody id="listaDeSetores">
                    <?php
                    if(empty($listaSetores)) {
                    ?>
                        <tr>
                            <td colspan="3" class="text-center">Nenhum Registro Encontrado</td>
                        </tr>
                    <?php
                    }else {
                        $count = 1;

                        foreach($listaSetores as $setores) {
                    ?>
                            <tr>
                                <td class="text-center"><?=$count++?></td>
                                <td class="text-center"><?=$setores['nome_setor']?></td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-default btn-xs" onclick="abrirModalForm(<?=$setores['id_setor']?>)"><i class="fa fa-edit"></i></button> 
                                    <button type="button" class="btn btn-default btn-xs" onclick="deletarSetor(<?=$setores['id_setor']?>)"><i class="fa fa-trash"></i></button>
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

<!-- Modal Formulario Setores -->
<div class="modal fade" id="modalFormSetor" data-backdrop="static" data-keyboard="false" style="display: none;">
    <div class="modal-dialog">
    	<div class="modal-content">
        	<div class="modal-header text-center" style="background-color: #00a65a; color:#FFFFFF">
                <h4 class="modal-title">CADASTRAR SETOR</h4>
            </div>

            <div class="modal-body">
	            <div class="box-body" id="bodyModalCadastro">
                    
                        <div class="form-group" id="groupNomeSetor">
                            <label for="inputNomeSetor">NOME DO SETOR:</label>
                            <input type="text" class="form-control" id="inputNomeSetor" placeholder="Nome do setor">
                        </div>

                        <input type="hidden" id="inputIdSetor" value="0">
                    
	            </div>

	            <div class="box-footer text-center">
                  	<button type="button" class="btn btn-success" id="btnSalvar"><i class="fa fa-check"></i> <strong>SALVAR</strong></button>
                    <button type="button" class="btn btn-default" id="btnCancelar"><i class="fa fa-remove"></i> <strong>CANCELAR</strong></button>
                </div>
            </div>
        </div>
   	</div>
</div>