<div class="container">
    <br>

    <div class="panel panel-default" style="padding-bottom: 5px;">
        <h3 class="text-center"><i class="fa fa-book"></i> RELATÓRIOS</h3>
        <h4 class="text-center">(TABELA HORTIFRUTI)</h4>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="box box-solid">
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputProdutos">PRODUTOS:</label>
                        <select class="form-control select2" style="width: 100%;" id="inputProdutos" name="inputProdutos">

                            <?php
                            foreach($produtos as $prod) {
                            ?>
                                <option value="<?=$prod['id_produto']?>"><?=$prod['nome_produto']?></option>
                            <?php
                            }
                            ?>

                        </select>
                    </div>

                    <div class="form-group">
                        <label for="inputUndCx">UND/KG:</label>
                        <select class="form-control" id="inputUndCx" name="inputUndCx">
                            <option value="cx">KG</option>
                            <option value="und">UNIDADE</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>QUANTIDADE CX:</label>
                        <input type="number" class="form-control" id="inputQtd" name="inputQtd">
                    </div>

                    <div id="camposKgUnd">
                        <div class="form-group">
                            <label>KG:</label>
                            <input type="text" class="form-control" id="inputKG" name="inputKG">
                        </div>
                    </div>
                </div>

                <div class="box-footer">
                    <div class="form-group">
                        <button type="button" class="btn btn-success btn-block" id="btnAddProduto"><i class="fa fa-plus"></i> <b>ADICIONAR</b></button>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-8">
            <div class="box box-solid">
                <div class="box-body table-responsive no-padding fixTableHead">
                    <table class="table table-hover table-bordered">
                        <thead style="background-color: #182226; color: #FFF">
                            <tr>
                                <th style="width: 3%;" class="text-center">#</th>
                                <th style="width: 35%;" class="text-center">DESCRIÇÃO</th>
                                <th style="width: 15%;" class="text-center">UND/CX</th>
                                <th style="width: 15%;" class="text-center">KG</th>
                                <th style="width: 10%;" class="text-center"></th>
                            </tr>
                        </thead>
                        <tbody id="listaTabelaProdutos">   
                            <tr>
                                <td colspan="5" class="text-center">Tabela Vazia</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Imprimir TABELA -->
<div class="modal fade" id="modalImprimirTabela" data-backdrop="static" data-keyboard="false" style="display: none;">
    <div class="modal-dialog">
    	<div class="modal-content">
        	<div class="modal-header text-center" style="background-color: #00a65a; color:#FFFFFF">
                   
                <h4 class="modal-title">IMPRIMIR TABELA HORTIFRUTI</h4>
            </div>

            <div class="modal-body">
	            <div class="box-body" id="divImprimir">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group" id="groupInputNomeMotorista">
                                <label for="inputNomeMotorista">MOTORISTA:</label>
                                <input type="text" class="form-control" id="inputNomeMotorista" name="inputNomeMotorista" placeholder="Digite o nome do motorista...">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group" id="groupInputNomeConferente">
                                <label for="inputNomeConferente">CONFERENTE:</label>
                                <select class="form-control select2" style="width: 100%;" id="inputNomeConferente" name="inputNomeConferente">

                                    <?php
                                    foreach($conferentes as $conf) {
                                    ?>
                                    <option value="<?=$conf['id_conferente']?>"><?=$conf['nome_conferente']?></option>
                                    <?php
                                    }
                                    ?>

                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group" id="groupInputDataTabela">
                                <label for="inputDataTabela">DATA TABELA:</label>
                                <input type="date" class="form-control" id="inputDataTabela" name="inputDataTabela">
                            </div>
                        </div>
                    </div>
	            </div>

                <div class="box-footer text-center">
                  	<button type="button" class="btn btn-success" id="btnTabelaImprimir"><i class="fa fa-print"></i> <strong>IMPRIMIR</strong></button>
                    <button type="button" class="btn btn-default" id="btnTabelaCancelar"><i class="fa fa-remove"></i> <strong>CANCELAR</strong></button>
                </div>
            </div>
        </div>
   	</div>
</div>