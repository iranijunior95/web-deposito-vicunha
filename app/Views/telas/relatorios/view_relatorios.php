<div class="container">
    <br>

    <div class="panel panel-default" style="padding-bottom: 5px;">
        <h3 class="text-center"><i class="fa fa-book"></i> RELATÓRIOS</h3>
    </div>

    <div class="panel panel-default">
        <br>
        <div class="row text-center">
            <div class="col-md-3">
                <a href="<?=base_url('relatorios/relatorio_lancamentos')?>" class="btn btn-app btn-flat">
                    <i class="fa fa-file-word-o"></i> <strong>GERAR RELATÓRIO DE LANÇAMENTOS</strong>
                </a>
            </div>

            <div class="col-md-3">
                <a href="<?=base_url('relatorios/recibo_descarrego')?>" class="btn btn-app btn-flat">
                    <i class="fa fa-files-o"></i> <strong>GERAR RECIBO DE DESCARREGO</strong>
                </a>
            </div>

            <div class="col-md-3">
                <a href="<?=base_url('relatorios/tabela_hortifruti')?>" class="btn btn-app btn-flat">
                    <i class="fa fa-file-excel-o"></i> <strong>GERAR TABELA DE HORTIFRUTI</strong>
                </a>
            </div>

            <div class="col-md-3">
                <a href="<?=base_url('relatorios/tabela_nota_avulsa')?>" class="btn btn-app btn-flat">
                    <i class="fa fa-file-pdf-o"></i> <strong>GERAR TABELA DE NOTA AVULSA</strong>
                </a>
            </div>
        </div> 
        
        <p class="page-header"></p>

        <h4 class="text-center">BUSCAR REGISTROS</h4>

        <p class="page-header"></p>

        
        <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-custom tab-success">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">IMPRIMIR MODELOS PDF</a></li>
                        <li><a href="#tab_2" data-toggle="tab">RECIBO DE DESCARREGO</a></li>
                        <li><a href="#tab_3" data-toggle="tab">TABELA DE HORTIFRUTI</a></li>
                        <li><a href="#tab_4" data-toggle="tab">NOTA AVULSA</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1" style="height: 500px;">

                            <h4 class="text-center">IMPRIMIR MODELOS EM PDF</h4>
                            <br>

                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td><strong>TABELA DE RECEBIMENTO DE MERCADORIA :</strong></td>
                                        <td class="text-right"><a href="<?=base_url()?>/assets/sistema/arquivos/tabela_recebimento_mercadoria.pdf" target="_blank"><i class="glyphicon glyphicon-print"></i> <strong>IMPRIMIR</strong></a></td>
                                    </tr>
                                    <tr>
                                        <td><strong>TABELA CONFERÊNCIA CEGA HORTIFRUTI :</strong></td>
                                        <td class="text-right"><a href="<?=base_url()?>/assets/sistema/arquivos/hortifruti.pdf" target="_blank"><i class="glyphicon glyphicon-print"></i> <strong>IMPRIMIR</strong></a></td>
                                    </tr>
                                    <tr>
                                        <td><strong>TABELA DE COMPRA AVULSA :</strong></td>
                                        <td class="text-right"><a href="<?=base_url()?>/assets/sistema/arquivos/nota_avulsa.pdf" target="_blank"><i class="glyphicon glyphicon-print"></i> <strong>IMPRIMIR</strong></a></td>  
                                    </tr>   
                                    <tr>
                                        <td><strong>TABELA DE COMPRA AVULSA (AÇOUGUE) :</strong></td>
                                        <td class="text-right"><a href="<?=base_url()?>/assets/sistema/arquivos/nota_avulsa_acougue.pdf" target="_blank"><i class="glyphicon glyphicon-print"></i> <strong>IMPRIMIR</strong></a></td>
                                    </tr>        
                                    <tr>
                                        <td><strong>TABELA POSIÇÃO DE ESTOQUE :</strong></td>
                                        <td class="text-right"><a href="<?=base_url()?>/assets/sistema/arquivos/planilha_posição_de_estoque.pdf" target="_blank"><i class="glyphicon glyphicon-print"></i> <strong>IMPRIMIR</strong></a></td>
                                    </tr>
                                </tbody>
                            </table>
                            
                        </div>

                        <div class="tab-pane" id="tab_2" style="height: 500px;">
                            <h4 class="text-center">LISTAR RECIBOS DE DESCARREGO</h4>
                            <br>

                            <div class="row">
                                <div class="col-md-4" id="divElementosBuscarRecibos">
                                    <div class="box box-solid" style="background-color: #f4f4f4; border: 1px solid #ddd;">
                                        <div class="box-body" style="background-color: #FFFFFF;">

                                            <div class="form-group">
                                                <label for="inputFilial">FILIAL:</label>
                                                <select class="form-control" id="inputFilialRecibo" name="inputFilialRecibo">
                                                    <option value="0"></option>
                                                    <option value="1">FILIAL 1</option>
                                                    <option value="2">FILIAL 2</option>
                                                    <option value="4">FILIAL 4</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="inputFornecedor">FORNECEDOR:</label>
                                                <select class="form-control select2" style="width: 100%;" id="inputFornecedorRecibo" name="inputFornecedor">
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

                                            <div class="form-group">
                                                <label for="inputValorRecibo">VALOR RECIBO:</label>
                                                <input type="text" class="form-control" id="inputValorRecibo" name="inputValorRecibo" placeholder="R$ 0,00">
                                            </div>

                                            <div class="form-group">
                                                <label for="inputDataEntradaInicio">DATA DE ENTRADA INICIAL:</label>
                                                <input type="date" class="form-control" id="inputDataEntradaInicioRecibo" name="inputDataEntradaInicio">
                                            </div>

                                            <div class="form-group">
                                                <label for="inputDataEntradaFim">DATA DE ENTRADA FINAL:</label>
                                                <input type="date" class="form-control" id="inputDataEntradaFimRecibo" name="inputDataEntradaFim">
                                            </div>

                                            <div class="form-group">
                                                <button type="button" class="btn btn-success btn-block" id="btnPesquisarReciboDescarrego"><i class="fa fa-search"></i> <b>PESQUISAR</b></button>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="box box-solid" style="background-color: #f4f4f4; border: 1px solid #ddd;">
                                        <div class="box-body table-responsive no-padding fixTableHeadDescarrego" style="background-color: #FFFFFF;">

                                            <table class="table table-hover table-bordered">
                                                <thead style="background-color: #182226; color: #FFF">
                                                    <tr>
                                                        <th style="width: 3%;" class="text-center">#</th>
                                                        <th style="width: 10%;" class="text-center">FILIAL</th>
                                                        <th style="width: 40%;" class="text-center">FORNECEDOR</th>
                                                        <th style="width: 15%;" class="text-center">R$ VALOR</th>
                                                        <th style="width: 10%;" class="text-center"></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="listaTabelaRecibos">
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
                    
                        <div class="tab-pane" id="tab_3" style="height: 500px;">
                            <h4 class="text-center">LISTAR TABELAS DE HORTIFRUTI</h4>
                            <br>

                            <div class="row">
                                <div class="col-md-4" id="divElementosBuscarHortifruti">
                                    <div class="box box-solid" style="background-color: #f4f4f4; border: 1px solid #ddd;">
                                        <div class="box-body" style="background-color: #FFFFFF;">

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

                                            <div class="form-group">
                                                <label for="inputDataEntradaInicio">DATA DE ENTRADA INICIAL:</label>
                                                <input type="date" class="form-control" id="inputDataEntradaInicioHortifruti" name="inputDataEntradaInicio">
                                            </div>

                                            <div class="form-group">
                                                <label for="inputDataEntradaFim">DATA DE ENTRADA FINAL:</label>
                                                <input type="date" class="form-control" id="inputDataEntradaFimHortifruti" name="inputDataEntradaFim">
                                            </div>

                                            <div class="form-group">
                                                <button type="button" class="btn btn-success btn-block" id="btnPesquisarTabelaHortifruti"><i class="fa fa-search"></i> <b>PESQUISAR</b></button>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="box box-solid" style="background-color: #f4f4f4; border: 1px solid #ddd;">
                                        <div class="box-body table-responsive no-padding fixTableHeadHortifruti" style="background-color: #FFFFFF;">

                                            <table class="table table-hover table-bordered">
                                                <thead style="background-color: #182226; color: #FFF">
                                                    <tr>
                                                        <th style="width: 3%;" class="text-center">#</th>
                                                        <th style="width: 37%;" class="text-center">TÍTULO</th>
                                                        <th style="width: 30%;" class="text-center">CONFERENTE</th>
                                                        <th style="width: 20%;" class="text-center">MOTORISTA</th>
                                                        <th style="width: 10%;" class="text-center"></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="listaTabelaHortifruti">
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

                        <div class="tab-pane" id="tab_4" style="height: 500px;">
                            <h4 class="text-center">LISTAR NOTAS AVULSA</h4>
                            <br>

                            <div class="row">
                                <div class="col-md-4" id="divElementosBuscarNotaAvulsa">
                                    <div class="box box-solid" style="background-color: #f4f4f4; border: 1px solid #ddd;">
                                        <div class="box-body" style="background-color: #FFFFFF;">

                                            <div class="form-group">
                                                <label for="inputFornecedor">FORNECEDOR:</label>
                                                <select class="form-control select2" style="width: 100%;" id="inputFornecedorAvulsa" name="inputFornecedor">
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

                                            <div class="form-group">
                                                <label for="inputConferente">CONFERENTE:</label>
                                                <select class="form-control select2" style="width: 100%;" id="inputConferenteAvulsa" name="inputConferente">
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

                                            <div class="form-group">
                                                <label for="inputValorAvulsa">VALOR RECIBO:</label>
                                                <input type="text" class="form-control" id="inputValorAvulsa" name="inputValorAvulsa" placeholder="R$ 0,00">
                                            </div>

                                            <div class="form-group">
                                                <label for="inputDataEntradaInicio">DATA DE ENTRADA INICIAL:</label>
                                                <input type="date" class="form-control" id="inputDataEntradaInicioAvulsa" name="inputDataEntradaInicio">
                                            </div>

                                            <div class="form-group">
                                                <label for="inputDataEntradaFim">DATA DE ENTRADA FINAL:</label>
                                                <input type="date" class="form-control" id="inputDataEntradaFimAvulsa" name="inputDataEntradaFim">
                                            </div>

                                            <div class="form-group">
                                                <button type="button" class="btn btn-success btn-block" id="btnPesquisarAvulsa"><i class="fa fa-search"></i> <b>PESQUISAR</b></button>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="box box-solid" style="background-color: #f4f4f4; border: 1px solid #ddd;">
                                        <div class="box-body table-responsive no-padding fixTableHeadAvulsa" style="background-color: #FFFFFF;">

                                            <table class="table table-hover table-bordered">
                                                <thead style="background-color: #182226; color: #FFF">
                                                    <tr>
                                                        <th style="width: 3%;" class="text-center">#</th>
                                                        <th style="width: 42%;" class="text-center">FORNECEDOR</th>
                                                        <th style="width: 30%;" class="text-center">CONFERENTE</th>
                                                        <th style="width: 15%;" class="text-center">R$ VALOR</th>
                                                        <th style="width: 10%;" class="text-center"></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="listaTabelaAvulsa">
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

                    </div>
                </div>
            </div>
        </div>
        
    </div>

</div>