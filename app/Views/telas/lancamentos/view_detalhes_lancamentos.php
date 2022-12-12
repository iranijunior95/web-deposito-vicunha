<div class="container">
    <br>

    <div class="panel panel-default" style="padding-bottom: 5px;">
        <h3 class="text-center"><i class="fa fa-file-text"></i> DETALHES LANÇAMENTO</h3>
    
        <h4 class="text-center">(<?=$lancamentos[0]['nome_fornecedor']?>)</h4>

        <p class="page-header"></p>

        <div class="text-center">
            <a href="<?=base_url('lancamentos/form_editar/'.$lancamentos[0]['id_lancamento'])?>" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> <strong>EDITAR</strong></a>
			<button class="btn btn-default btn-sm" id="btnExcluir" onclick="deletarLancamento('<?=$lancamentos[0]['id_lancamento']?>')"><i class="fa fa-trash"></i> <strong>EXCLUIR</strong></button>
			<a href="<?=base_url('lancamentos')?>" class="btn btn-default btn-sm"><i class="fa fa-reply-all"></i> <strong>VOLTAR</strong></a>
        
        </div>
            
    </div>

    <div class="row">
		<div class="col-md-12">
			<div class="box box-solid">
				<div class="box-body table-responsive no-padding">
					<table class="table table-striped">
						<tbody>
                            <tr>
								<td><strong>Nº LANÇAMENTO:</strong></td>
								<td>#<?=$lancamentos[0]['id_lancamento']?></td>
							</tr>
                            <tr>
								<td><strong>FORNECEDOR:</strong></td>
								<td><?=$lancamentos[0]['nome_fornecedor']?></td>
							</tr>
                            <tr>
								<td><strong>CONFERENTE:</strong></td>
								<td><?=$lancamentos[0]['nome_conferente']?></td>
							</tr>
							<tr>
								<td><strong>SETOR:</strong></td>
								<td><?=$lancamentos[0]['nome_setor']?></td>
							</tr>

                            <tr>
								<td colspan="2"><p class="page-header"></p></td>
							</tr>

                            <tr>
								<td><strong>Nº DA NOTA:</strong></td>
								<td><?=$lancamentos[0]['numero_nota']?></td>
							</tr>
							<tr>
								<td><strong>VALOR DA NOTA:</strong></td>
								<td>R$ <?=$lancamentos[0]['valor_nota']?></td>
							</tr>

							<?php
                            if($lancamentos[0]['peso_nota'] != '') {
                            ?>
								<tr>
									<td><strong>PESO DA NOTA:</strong></td>
									<td><?=$lancamentos[0]['peso_nota']?> Kg</td>
								</tr>
							<?php
							}else {
							?>
								<tr>
									<td><strong>PESO DA NOTA:</strong></td>
									<td>0.000 Kg</td>
								</tr>
							<?php
							}
							?>

                            <tr>
								<td colspan="2"><p class="page-header"></p></td>
							</tr>

							<tr>
								<td><strong>NOME DO MOTORISTA:</strong></td>
								<td><?=$lancamentos[0]['nome_motorista']?></td>
							</tr>
							<tr>
								<td><strong>PLACA DO VEÍCULO:</strong></td>
								<td><?=$lancamentos[0]['placa_veiculo']?></td>
							</tr>

                            <?php
                            if($lancamentos[0]['taxa_descarrego'] != '') {
                            ?>
                                <tr>
                                    <td><strong>TAXA DE DESCARREGO:</strong></td>
                                    <td>R$ <?=$lancamentos[0]['taxa_descarrego']?></td>
                                </tr>
                            <?php
                            }else {
                            ?>
                                <tr>
                                    <td><strong>TAXA DE DESCARREGO:</strong></td>
                                    <td>R$ 0,00</td>
                                </tr>
                            <?php
                            }
                            ?>
                            
                            <tr>
								<td colspan="2"><p class="page-header"></p></td>
							</tr>

							<tr>
								<td><strong>HORA DE ENTRADA:</strong></td>
								<td><?=$lancamentos[0]['hora_entrada']?> Hs</td>
							</tr>
							<tr>
								<td><strong>HORA DE SAÍDA:</strong></td>
								<td><?=$lancamentos[0]['hora_saida']?> Hs</td>
							</tr>
							<tr>
								<td><strong>DATA DE ENTRADA:</strong></td>
								<td><?=date('d/m/Y',  strtotime($lancamentos[0]['data_entrada']))?></td>
							</tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>