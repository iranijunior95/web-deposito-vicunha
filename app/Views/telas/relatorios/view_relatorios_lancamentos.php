<div class="container">
    <br>

    <div class="panel panel-default" style="padding-bottom: 5px;">
        <h3 class="text-center"><i class="fa fa-book"></i> RELATÓRIOS</h3>
        <h4 class="text-center">(RELATÓRIO DE LANÇAMENTOS)</h4>
    </div>

    <div class="row">
        <div class="col-md-12 text-center">
            <button type="button" class="btn btn-default text-green" data-toggle="modal" data-target="#ModalSearch"><i class="fa fa-search"></i> <b>BUSCAR LANÇAMENTOS</b></button>
            <button type="button" class="btn btn-default text-green" data-toggle="modal" data-target="#ModalListarRelatorio"><i class="fa fa-list"></i> <b>LISTAR RELATÓRIOS</b></button>
        </div>
    </div>

    <br>

    <div class="box box-solid">
        <div class="box-body table-responsive no-padding fixTableHead">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th style="width: 3%;" class="text-center">#</th>
                        <th style="width: 30%;" class="text-center">FORNECEDOR</th>
                        <th style="width: 15%;" class="text-center">Nº NOTA</th>
                        <th style="width: 20%;" class="text-center">CONFERENTE</th>
                        <th style="width: 15%;" class="text-center">SETOR</th>
                        <th class="text-center">DATA DE ENTRADA</th>
                        <th class="text-center" style="width: 5%;"></th>
                    </tr>
                </thead>

                <tbody id="listaDeLancamentos">
                    <tr>
                        <td colspan="7" class="text-center">Nenhum Registro Encontrado</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">

            <div class="box box-solid">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover table-bordered">
                        <thead style="background-color: #182226; color: #FFF">
                            <tr>
                                <th style="width: 3%;" class="text-center">#</th>
                                <th class="text-center">FORNECEDOR</th>
                                <th class="text-center">Nº NOTA FISCAL</th>
                                <th class="text-center">VALOR DA NOTA</th>
                                <th class="text-center">PESO</th>
                                <th class="text-center">CONFERENTE</th>
                                <th class="text-center">ENTRADA</th>
                                <th class="text-center">SAÍDA</th>
                                <th class="text-center">DATA ENTRADA</th>
                                <th class="text-center"></th>
                            </tr>
                        </thead>
                        <tbody id="listaDeLancamentoRelatorio">   
                            <tr>
                                <td colspan="10" class="text-center">Relatório Vazio</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="box-footer text-center" id="footer">
                    
                </div>
            </div>

        </div>
    </div>

</div>

<!-- Modal Formulario Buscar Lançamentos -->
<div class="modal fade" id="ModalSearch" data-backdrop="static" data-keyboard="false" style="display: none;">
    <div class="modal-dialog modal-lg">
    	<div class="modal-content">
        	<div class="modal-header text-center" style="background-color: #00a65a; color:#FFFFFF">
                <button type="button" id="btnFecharModal" class="close" aria-label="Close">
                  	<span aria-hidden="true">×</span>
				</button>

                <h4 class="modal-title">BUSCAR LANÇAMENTOS</h4>
            </div>

            <div class="modal-body">
	            <div class="box-body" id="bodyModalLancamento">
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputFornecedor">FORNECEDOR:</label>
                                    <select class="form-control select2" style="width: 100%;" id="inputFornecedor" name="inputFornecedor">
                                        <option value="0"></option>
                                        <?php
                                        foreach($fornecedores as $forn) {
                                        ?>
                                        <option value="<?=$forn['id_fornecedor']?>"><?=$forn['nome_fornecedor']?></option>
                                        <?php
                                        }
                                        ?>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="inputConferente">CONFERENTE:</label>
                                    <select class="form-control select2" style="width: 100%;" id="inputConferente" name="inputConferente">
                                    <option value="0"></option>
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

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="inputSetor">SETOR:</label>
                                    <select class="form-control" id="inputSetor" name="inputSetor">
                                        <option value="0"></option>
                                        <?php
                                        foreach($setores as $set) {
                                        ?>
                                        <option value="<?=$set['id_setor']?>"><?=$set['nome_setor']?></option>
                                        <?php
                                        }
                                        ?>

                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputNumeroDaNota">Nº DA NOTA:</label>
                                    <input type="number" class="form-control" id="inputNumeroDaNota" name="inputNumeroDaNota">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputValorDaNotaInicio">VALOR DA NOTA INICIAL:</label>
                                    <input type="text" class="form-control" id="inputValorDaNotaInicio" name="inputValorDaNotaInicio" placeholder="R$ 0,00">
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputValorDaNotaFim">VALOR DA NOTA FINAL:</label>
                                    <input type="text" class="form-control" id="inputValorDaNotaFim" name="inputValorDaNotaFim" placeholder="R$ 0,00">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="inputDataEntradaInicio">DATA DE ENTRADA INICIAL:</label>
                                    <input type="date" class="form-control" id="inputDataEntradaInicio" name="inputDataEntradaInicio">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="inputDataEntradaFim">DATA DE ENTRADA FINAL:</label>
                                    <input type="date" class="form-control" id="inputDataEntradaFim" name="inputDataEntradaFim">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputNomeMotorista">NOME DO MOTORISTA:</label>
                                    <input type="text" class="form-control" id="inputNomeMotorista" name="inputNomeMotorista">
                                </div>
                            </div>
                        </div>
                    </form>
	            </div>

	            <div class="box-footer text-center">
                  	<button type="button" class="btn btn-success" id="btnBuscar"><i class="fa fa-search"></i> <strong>PESQUISAR</strong></button>
                </div>
            </div>
        </div>
   	</div>
</div>

<!-- Modal Imprimir Relatorio -->
<div class="modal fade" id="modalImprimirRelatorio" data-backdrop="static" data-keyboard="false" style="display: none;">
    <div class="modal-dialog">
    	<div class="modal-content">
        	<div class="modal-header text-center" style="background-color: #00a65a; color:#FFFFFF">
                   
                <h4 class="modal-title">IMPRIMIR RELATÓRIO</h4>
            </div>

            <div class="modal-body">
	            <div class="box-body" id="divImprimir">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group" id="groupInputTituloRelatorio">
                                <label for="inputTituloRelatorio">TÍTULO DO RELATÓRIO:</label>
                                <input type="text" class="form-control" id="inputTituloRelatorio" name="inputTituloRelatorio" placeholder="Digite o título do relatório...">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group" id="groupInputDataRelatorio">
                                <label for="inputDataRelatorio">DATA RELATÓRIO:</label>
                                <input type="date" class="form-control" id="inputDataRelatorio" name="inputDataRelatorio">
                            </div>
                        </div>
                    </div>
	            </div>

                <div class="box-footer text-center">
                  	<button type="button" class="btn btn-success" id="btnRelatorioImprimir"><i class="fa fa-print"></i> <strong>IMPRIMIR</strong></button>
                    <button type="button" class="btn btn-default" id="btnRelatorioCancelar"><i class="fa fa-remove"></i> <strong>CANCELAR</strong></button>
                </div>
            </div>
        </div>
   	</div>
</div>

<!-- Modal Listar Relatorios -->
<div class="modal fade" id="ModalListarRelatorio" data-backdrop="static" data-keyboard="false" style="display: none;">
    <div class="modal-dialog modal-lg">
    	<div class="modal-content">
        	<div class="modal-header text-center" style="background-color: #00a65a; color:#FFFFFF">
                   
                <h4 class="modal-title">LISTAR RELATÓRIOS</h4>
            </div>

            <div class="modal-body">
	            <div class="box-body" id="divListar">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group" id="groupInputBuscarTituloRelatorio">
                                <label for="inputBuscarTituloRelatorio">TÍTULO DO RELATÓRIO:</label>
                                <input type="text" class="form-control" id="inputBuscarTituloRelatorio" name="inputBuscarTituloRelatorio" placeholder="Digite o título do relatório...">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group" id="groupInputDataRelatorioInicio">
                                <label for="inputDataRelatorioInicio">DATA RELATÓRIO INICIAL:</label>
                                <input type="date" class="form-control" id="inputDataRelatorioInicio" name="inputDataRelatorioInicio">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group" id="groupInputDataRelatorioFim">
                                <label for="inputDataRelatorioFim">DATA RELATÓRIO FIM:</label>
                                <input type="date" class="form-control" id="inputDataRelatorioFim" name="inputDataRelatorioFim">
                            </div>
                        </div>
                    </div>

                    <table class="table table-hover table-bordered">
                        <thead style="background-color: #182226; color: #FFF">
                            <tr>
                                <th style="width: 3%;" class="text-center">#</th>
                                <th class="text-center">TÍTULO DO RELATÓRIO</th>
                                <th style="width: 20%;" class="text-center">DATA ENTRADA</th>
                                <th style="width: 10%;" class="text-center"></th>
                            </tr>
                        </thead>
                        <tbody id="listaDeRelatorios">   
                            <tr>
                                <td colspan="4" class="text-center">Nenhum Registro Encontrado</td>
                            </tr>
                        </tbody>
                    </table>
	            </div>

                <div class="box-footer text-center">
                    <button type="button" class="btn btn-success" id="btnBuscarRelatorios"><i class="fa fa-search"></i> <strong>PESQUISAR</strong></button>
                    <button type="button" class="btn btn-default" id="btnRelatorioBuscarCancelar"><i class="fa fa-remove"></i> <strong>CANCELAR</strong></button>
                </div>
            </div>
        </div>
   	</div>
</div>