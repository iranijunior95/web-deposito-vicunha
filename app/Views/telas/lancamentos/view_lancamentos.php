<div class="container">
    <br>

    <div class="panel panel-default" style="padding-bottom: 5px;">
        <h3 class="text-center"><i class="fa fa-file-text"></i> LANÇAMENTOS</h3>
    </div>

    <div class="row">
        <div class="col-md-12 text-center">
            <button type="button" class="btn btn-default text-green" data-toggle="modal" data-target="#ModalSearch"><i class="fa fa-search"></i> <b>BUSCAR LANÇAMENTOS</b></button>
            <a href="<?=base_url('lancamentos/form_cadastrar')?>" class="btn btn-default text-green"><i class="fa fa-plus"></i> <b>CADASTRAR LANÇAMENTOS</b></a>
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
                        <th style="width: 20%;" class="text-center">SETOR</th>
                        <th class="text-center">DATA DE ENTRADA</th>
                    </tr>
                </thead>

                <tbody id="listaDeLancamentos">
                    <?php
                    if(empty($listaLancamentos)) {
                    ?>
                        <tr>
                            <td colspan="6" class="text-center">Nenhum Registro Encontrado</td>
                        </tr>
                    <?php
                    }else {

                        $count = 1;

                        foreach($listaLancamentos as $lancamento) {
                    ?>
                        
                        <tr>
                            <td class="text-center"><?=$count++?></td>
                            <td class="text-center text-primary text-bold"><a href="<?=base_url('lancamentos/detalhes/'.$lancamento['id_lancamento'])?>"><?=$lancamento['nome_fornecedor']?></a></td>
                            <td class="text-center"><?=$lancamento['numero_nota']?></td>
                            <td class="text-center"><?=$lancamento['nome_conferente']?></td>
                            <td class="text-center"><?=$lancamento['nome_setor']?></td>
                            <td class="text-center"><?=date('d/m/Y',  strtotime($lancamento['data_entrada']))?></td>
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

<!-- Modal Formulario Buscar Lançamentos -->
<div class="modal fade" id="ModalSearch" data-backdrop="static" data-keyboard="false" style="display: none;">
    <div class="modal-dialog  modal-lg">
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

