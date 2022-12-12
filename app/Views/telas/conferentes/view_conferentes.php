<div class="container">
    <br>

    <div class="panel panel-default" style="padding-bottom: 5px;">
        <h3 class="text-center"><i class="fa fa-users"></i> CONFERENTES</h3>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="input-group">
                <input name="inputBuscarConferente" class="form-control" id="inputBuscarConferente" type="text" placeholder="Buscar conferente...">
                <span class="input-group-btn">
                    <button type="button" class="btn btn-success" id="btnBuscarConferente">
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
                        <th style="width: 50%;" class="text-center">CONFERENTE</th>
                        <th class="text-center">TELEFONE</th>
                        <th style="width: 10%;" class="text-center">AÇÃO</th>
                    </tr>
                </thead>

                <tbody id="listaDeConferentes">
                    <?php
                    if(empty($listaConferentes)) {
                    ?>
                        <tr>
                            <td colspan="4" class="text-center">Nenhum Registro Encontrado</td>
                        </tr>
                    <?php
                    }else {
                        $count = 1;

                        foreach($listaConferentes as $conferentes) {
                    ?>
                            <tr>
                                <td class="text-center"><?=$count++?></td>
                                <td class="text-center"><?=$conferentes['nome_conferente']?></td>
                                <td class="text-center"><?=$conferentes['telefone_conferente']?></td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-default btn-xs" onclick="abrirModalForm(<?=$conferentes['id_conferente']?>)"><i class="fa fa-edit"></i></button> 
                                    <button type="button" class="btn btn-default btn-xs" onclick="deletarConferente(<?=$conferentes['id_conferente']?>)"><i class="fa fa-trash"></i></button>
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

<!-- Modal Formulario Conferentes -->
<div class="modal fade" id="modalFormConferente" data-backdrop="static" data-keyboard="false" style="display: none;">
    <div class="modal-dialog">
    	<div class="modal-content">
        	<div class="modal-header text-center" style="background-color: #00a65a; color:#FFFFFF">
                <h4 class="modal-title">CADASTRAR CONFERENTE</h4>
            </div>

            <div class="modal-body">
	            <div class="box-body" id="bodyModalCadastro">
                    <form>
                        <div class="form-group" id="groupNomeConferente">
                            <label for="inputNomeConferente">NOME DO CONFERENTE:</label>
                            <input type="text" class="form-control" id="inputNomeConferente" placeholder="Nome do conferente">
                        </div>

                        <div class="form-group" id="groupTelefoneConferente">
                            <label for="inputTelefoneConferente">TELEFONE DO CONFERENTE:</label>
                            <input type="text" class="form-control" id="inputTelefoneConferente" placeholder="(00) 00000-0000" onkeydown="return mascaraTelefone(event)">
                        </div>

                        <input type="hidden" id="inputIdConferente" value="0">
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