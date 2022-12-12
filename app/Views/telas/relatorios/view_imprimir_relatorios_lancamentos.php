<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>IMPRIMIR RELATÓRIO</title>

        <!-- Bootstrap -->
        <link href="<?=base_url()?>/assets/template/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <style>
        .campoId {
          width: 30px;
          font-size: 16px;
          height: 30px;
        }

        .campoMotorista {
          width: 130px;
          font-size: 16px;
          height: 30px;
        }

        .campoPlaca {
          width: 85px;
          font-size: 16px;
          height: 30px;
        }

        .campoNumeroNota {
          width: 100px;
          font-size: 16px;
          height: 30px;
        }

        .campoFornecedor {
          width: 310px;
          font-size: 16px;
          height: 30px;
        }

        .campoPesoNota {
          width: 100px;
          font-size: 16px;
          height: 30px;
        }

        .campoValorNota {
          width: 120px;
          font-size: 16px;
          height: 30px;
        }

        .campoDataRecebimento {
          width: 130px;
          font-size: 16px;
          height: 30px;
        }

        .campoEntrada {
          width: 90px;
          font-size: 16px;
          height: 30px;
        }

        .campoSaida {
          width: 90px;
          font-size: 16px;
          height: 30px;
        }

        .campoRecebedor {
          width: 170px;
          font-size: 16px;
          height: 30px;
        }

        .campoWinthor {
          width: 120px;
          font-size: 16px;
          height: 30px;
        }

        .campoDescarrego{
          width: 120px;
          font-size: 16px;
          height: 30px;
        }

        .campoContasAPagar{
          width: 120px;
          font-size: 16px;
          height: 30px;
        }
        </style>
    </head>
    <body>
        
        <div class="container-fluid">

            <div class="row text-center">
                <img src="<?=base_url()?>/assets/sistema/img/logo_oficial.png" width="207" height="80" class="user-image" alt="logo">
            </div>

            <div class="" id="cabecalho">
              <table class="table">
                <tbody>
                  <tr>
                    <th style="width: 275px;"><p>RELATÓRIO DE MERCADORIAS</p></th>
                    <th class="text-center" style="color: #fff"><p>ATACADÃO VICUNHA</p></th>
                    <th class="text-right" style="width: 275px;"><p>DATA: <?=date('d/m/Y',  strtotime($dadosRelatorio[0]['data_relatorio']))?></p></th>
                  </tr>
                </tbody>
              </table>
			      </div>

            <table class="table table-bordered">
                <thead style="background-color: #182226; color: #FFF">
                    <tr>
                        <th class="text-center campoId" style="background-color: #f3f0f0">#</th>
                        <th class="text-center campoFornecedor" style="background-color: #f3f0f0">FORNECEDOR</th>
                        <th class="text-center campoNumeroNota" style="background-color: #f3f0f0">Nº NOTA FISCAL</th>
                        <th class="text-center campoPesoNota" style="background-color: #f3f0f0">PESO DA NOTA</th>
                        <th class="text-center campoValorNota" style="background-color: #f3f0f0">VALOR DA NOTA</th>
                        <th class="text-center campoRecebedor" style="background-color: #f3f0f0">CONFERENTE</th>
                        <th class="text-center campoDescarrego" style="background-color: #f3f0f0">TAXA DESCARREGO</th>
                        <th class="text-center campoMotorista" style="background-color: #f3f0f0">MOTORISTA</th>
                        <th class="text-center campoPlaca" style="background-color: #f3f0f0">PLACA</th>
                        <th class="text-center campoDataRecebimento" style="background-color: #f3f0f0">DATA RECEBIMENTO</th>
                        <th class="text-center campoEntrada" style="background-color: #f3f0f0">ENTRADA</th>
                        <th class="text-center campoSaida" style="background-color: #f3f0f0">SAÍDA</th>
                        <th class="text-center campoWinthor" style="background-color: #f3f0f0">WINTHOR</th>
                        <th class="text-center campoContasAPagar" style="background-color: #f3f0f0">CONTAS A PAGAR</th>
                    </tr>
                </thead>
                <tbody id="listaDeLancamentoRelatorio">   
                    <?php
                    $count = 1;

                    foreach ($dadosRelatorio as $relatorio) {
                    ?>
                        <tr>
                            <td class="text-center campoId"><?=$count++?></td>
                            <td class="text-center campoFornecedor"><?=$relatorio['nome_fornecedor']?></td>
                            <td class="text-center campoNumeroNota"><?=$relatorio['numero_nota']?></td>
                            <td class="text-center campoPesoNota"><?=$relatorio['peso_nota']?></td>
                            <td class="text-center campoValorNota">R$ <?=$relatorio['valor_nota']?></td>
                            <td class="text-center campoRecebedor"><?=$relatorio['nome_conferente']?></td>
                            <td class="text-center campoDescarrego">R$ <?=$relatorio['taxa_descarrego']?></td>
                            <td class="text-center campoMotorista"><?=$relatorio['nome_motorista']?></td>
                            <td class="text-center campoPlaca">
                                <?php
                                if($relatorio['placa_veiculo'] == '') {
                                    echo '-------';
                                }else {
                                    echo $relatorio['placa_veiculo'];
                                }
                                ?>
                            </td>
                            <td class="text-center campoDataRecebimento"><?=date('d/m/Y',  strtotime($relatorio['data_entrada']))?></td>
                            <td class="text-center campoEntrada"><?=$relatorio['hora_entrada']?> Hs</td>
                            <td class="text-center campoSaida"><?=$relatorio['hora_saida']?> Hs</td>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>

            <br>

            <div>
                <table class="table">
					<tbody>
						<tr>
							<th><p><small>*Outras observações colocar no verso deste relatório.</small></p></th>
							<th class="text-right"><p><small>Ass. Do Supervisor: _________________________________________</small></p></th>
						</tr>
					</tbody>
				</table>
            </div>

        </div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="<?=base_url()?>/assets/template/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    </body>
</html>