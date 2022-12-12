<div class="container">
    <br>

    <div class="panel panel-default" style="padding-bottom: 5px;">
        <h3 class="text-center"><i class="fa fa-book"></i> RELATÓRIOS</h3>
        <h4 class="text-center">(RECIBO TAXA DE DESCARREGO)</h4>
    </div>

    <div class="box box-solid">
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="inputSetor">FILIAL:</label>
                                    <select class="form-control" id="inputFilial" name="inputFilial">
                                        <option value="1">FILIAL 1</option>
                                        <option value="2">FILIAL 2</option>
                                        <option value="4">FILIAL 4</option>    
                                    </select>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="descricao_filial">DESCRIÇÃO FILIAL:</label>
                                <input type="text" class="form-control" id="descricao_filial" name="descricao_filial" value="ATACADÃO VICUNHA LTDA" disabled> 
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="inputFornecedor">FORNECEDOR:</label>
                                <select class="form-control select2" style="width: 100%;" id="inputFornecedor" name="inputFornecedor">
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

                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="cnpj_cpf">CPF/CNPJ:</label>
                                <input type="text" class="form-control" id="inputCnpj" name="inputCnpj" disabled> 
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group" id="groupNumeroNota">
                                <label>Nº DA NOTA:</label>
                                <input type="text" class="form-control inputNumeroDaNota" id="inputNumeroDaNota" name="inputNumeroDaNota" placeholder="Digite o número da nota...">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group" id="groupValor">
                                <label for="valor">VALOR:</label>
                                <input type="text" class="form-control" id="inputValor" name="inputValor" placeholder="R$ 0,00">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group" id="groupData">
                                <label>DATA DE ENTRADA:</label>
                                <input type="date" class="form-control" id="inputData" name="inputData">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <p style="font-size: 11px;">Para inserir mais de um número de NF faça uso de vírgulas.</p>
                            <p style="font-size: 11px; margin-top: -12px;">Ex: “0123, 01234, 012345…” </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="box-footer text-center">
            <button type="button" class="btn btn-success" id="btnGerar"><i class="fa fa-check"></i> <strong>GERAR</strong></button>
            <button type="button" class="btn btn-default" id="btnCancelar"><i class="fa fa-remove"></i> <strong>CANCELAR</strong></button>
        </div>
    </div>

</div>

<!-- Modal Previa Recibo -->
<div class="modal fade bs-example-modal-lg" id="modalPreviaRecibo" data-backdrop="static" data-keyboard="false" style="display: none;">
    <div class="modal-dialog modal-lg">
    	<div class="modal-content">
        	<div class="modal-header text-center" style="background-color: #00a65a; color:#FFFFFF">  
                <h4 class="modal-title">PRÉVIA RECIBO</h4>
            </div>

            <div class="modal-body">
	           <div class="row" id="bodyRecibo">

               </div>
            </div>

            <div class="modal-footer">
                 <div class="row text-center">
                    <button type="button" class="btn btn-success" id="btnImprimirRecibo"><i class="fa fa-print"></i> <strong>IMPRIMIR</strong></button>
                    <button type="button" class="btn btn-default" id="btnCancelarPrevia"><i class="fa fa-remove"></i> <strong>CANCELAR</strong></button>
                 </div>
            </div>
        </div>
   	</div>
</div>