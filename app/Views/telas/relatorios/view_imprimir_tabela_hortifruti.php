<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>IMPRIMIR TABELA HORTIFRUTI</title>

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
          font-size: 14px;
          height: 25px;
        }

        .campoProduto {
          width: 200px;
          font-size: 14px;
          height: 25px;
        }

        .campoUndCx {
          width: 100px;
          font-size: 14px;
          height: 25px;
        }

        .campoKg {
          width: 100px;
          font-size: 14px;
          height: 25px;
        }

        .campoObservacoes {
          width: 350px;
          font-size: 14px;
          height: 25px;
        }

        </style>
    </head>
    <body>

        <div class="container-fluid">
            <div class="row text-center">
                <img src="<?=base_url()?>/assets/sistema/img/logo_oficial.png" width="207" height="80" class="user-image" alt="logo">
            </div>

            <br>

            <div class="" id="cabecalho">
              <table class="table">
                <tbody>
                  <tr>
                    <th class="text-left" style="width: 30%; font-size: 13px"><p>DATA: <?=date('d/m/Y',  strtotime($dadosHortifruti[0]['data_hortifruti']))?></p></th>
                    <th class="text-center" style="width: 40%; font-size: 13px"><p>CONFERENTE: <?=$dadosHortifruti[0]['nome_conferente']?></p></th>
                    <th class="text-right" style="width: 30%; font-size: 13px"><p>MOTORISTA: <?=$dadosHortifruti[0]['nome_motorista_hortifruti']?></p></th>
                  </tr>
                </tbody>
              </table>
			      </div>

            <table class="table table-bordered">
                <thead style="background-color: #182226; color: #FFF">
                    <tr>
                        <th class="text-center campoId" style="background-color: #f3f0f0">#</th>
                        <th class="text-center campoProduto" style="background-color: #f3f0f0">PRODUTOS</th>
                        <th class="text-center campoUndCx" style="background-color: #f3f0f0">UND/CX</th>
                        <th class="text-center campoKg" style="background-color: #f3f0f0">KG</th>
                        <th class="text-center campoObservacoes" style="background-color: #f3f0f0">OBSERVAÇÕES</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $count = 1;

                    foreach($dadosHortifruti as $horti) {
                    ?>
                    <tr>
                        <td class="text-center campoId"><?=$count++?></td>
                        <td class="text-center campoProduto"><?=$horti['nome_produto']?></td>
                        <td class="text-center campoUndCx"><?=$horti['quantidade_cx']?> CX</td>
                        <?php
                        if($horti['und_kg'] === 'CX') {
                        ?>
                            <td class="text-center campoKg"><?=$horti['quantidade']?> KG</td>
                        <?php
                        }else {
                        ?>
                            <td class="text-center campoKg"><?=$horti['quantidade']?> UND</td>
                        <?php
                        }
                        ?>
                        <td class="text-center campoObservacoes"></td>
                    </tr>
                    <?php
                    }
                    ?>

                </tbody>
            </table>
        </div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="<?=base_url()?>/assets/template/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    </body>
</html>