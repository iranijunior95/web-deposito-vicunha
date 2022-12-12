<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>IMPRIMIR TABELA NOTA AVULSA</title>

        <!-- Bootstrap -->
        <link href="<?=base_url()?>/assets/template/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <style>
            .cabecalho {
                display: block;
            }

            .cabecalho1 {
                width: 50%;
                float: left;
                text-align: left;
                font-weight: bold;
            }

            .cabecalho2 {
                width: 50%;
                float: right;
                text-align: right;
                font-weight: bold;
            }

            .cabecalho_dados_empresa {
                width: 100%;
                border: 1px solid #000;
                padding: 5px 5px 0px 5px;
            }

            .cabecalho_dados_empresa_empresa {
                width: 50%;
                float: left;
                text-align: left;
                font-size: 12px;
            }

            .cabecalho_dados_empresa_cnpj {
                width: 50%;
                float: right;
                text-align: right;
                font-size: 12px;
            }

            .cabecalho_dados_empresa_endereco {
                width: 50%;
                float: left;
                text-align: left;
                font-size: 12px;
                margin-top: -5px;
            }

            .cabecalho_dados_empresa_dist {
                width: 50%;
                float: right;
                text-align: right;
                font-size: 12px;
                margin-top: -5px;
            }

            .cabecalho_dados_empresa_conteudo {
                display: inline-block;
                width: 100%;
                margin: 0 auto;
                
            }

            .cabecalho_dados_empresa_cidade { 
                float: left;
                width: 25%;
                font-size: 12px;
                text-align: left;
                margin-top: -5px;
            }

            .cabecalho_dados_empresa_uf { 
                float: left;
                width: 25%;
                font-size: 12px;
                text-align: center;
                margin-top: -5px;
            }

            .cabecalho_dados_empresa_cep { 
                float: left;
                width: 25%;
                font-size: 12px;
                text-align: center;
                margin-top: -5px;
            }

            .cabecalho_dados_empresa_fone { 
                float: left;
                width: 25%;
                font-size: 12px;
                text-align: right;
                margin-top: -5px;
            }

            .cabecalho_dados_fornecedor {
                width: 100%;
                border: 1px solid #000;
                padding: 5px 5px 0px 5px;
                margin-top: 10px;
                margin-bottom: 10px;
            }

            .cabecalho_dados_fornecedor_nome {
                width: 80%;
                float: left;
                text-align: left;
                font-size: 12px;
            }

            .cabecalho_dados_fornecedor_cod {
                float: right;
                text-align: right;
                font-size: 12px;
            }

            .cabecalho_dados_fornecedor_endereco {
                width: 70%;
                float: left;
                text-align: left;
                font-size: 12px;
                margin-top: -3px;
            }
            .cabecalho_dados_fornecedor_numero {
                float: right;
                text-align: right;
                font-size: 12px;
                margin-top: -3px;
                
            }

            .cabecalho_dados_fornecedor_conteudo {
                display: inline-block;
                width: 100%;
                margin: 0 auto;
            }

            .cabecalho_dados_fornecedor_cidade {
                float: left;
                width: 55%;
                font-size: 12px;
                text-align: left;
                margin-top: -3px;
            }

            .cabecalho_dados_fornecedor_uf { 
                float: left;
                width: 10%;
                font-size: 12px;
                text-align: center;
                margin-top: -3px;
            }

            .cabecalho_dados_fornecedor_fone {
                float: right;
                font-size: 12px;
                text-align: right;
                margin-top: -3px;
            }

            b {
                font-weight: bold;
            }

            .campoId {
            width: 30px;
            font-size: 14px;
            height: 25px;
            }

            .campoProduto {
            width: 300px;
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

            .campoValor {
            width: 120px;
            font-size: 14px;
            height: 25px;
            }

            .campoTotal {
                width: 130px;
            font-size: 14px;
            height: 25px;
            }

            .rodape {
                display: block;
                margin-top: 30px;
            }

            .rodape1 {
                width: 50%;
                float: left;
                text-align: center;
            }

            .rodape2 {
                width: 50%;
                float: right;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class="container-fluid">

            <div class="row text-center">
                <img src="<?=base_url()?>/assets/sistema/img/logo_oficial.png" width="207" height="80" class="user-image" alt="logo">
            </div>

            <br>

            <div class="cabecalho">
                <div class="cabecalho1">
                    <p>NÚMERO DO PEDIDO: ____________________</p>
                </div>
                <div class="cabecalho2">
                    <p>DATA: <?=date('d/m/Y',  strtotime($dadosNotaAvulsa[0]['data_nota_avulsa']))?></p>
                </div>
            </div>

            <div class="cabecalho_dados_empresa">
                <div>
                    <div class="cabecalho_dados_empresa_empresa">
                        <p><b>EMPRESA:</b> ATACADÃO VICUNHA LTDA</p>
                    </div>
                    <div class="cabecalho_dados_empresa_cnpj">
                        <p><b>CNPJ:</b> 35.298.801/0001-60</p>
                    </div>
                </div>

                <div>
                    <div class="cabecalho_dados_empresa_endereco">
                        <p><b>ENDEREÇO:</b> BR 427 KM2 </p>
                    </div>
                    <div class="cabecalho_dados_empresa_dist">
                        <p><b>DISTRITO INDUSTRIAL IE:</b> 200331884 </p>
                    </div>
                </div>

                <div class="cabecalho_dados_empresa_conteudo">
                    <div class="cabecalho_dados_empresa_cidade">
                        <p><b>CIDADE:</b> CURRAIS NOVOS</p>
                    </div>

                    <div class="cabecalho_dados_empresa_uf">
                        <p><b>UF:</b> RN</p>
                    </div>

                    <div class="cabecalho_dados_empresa_cep">
                        <p><b>CEP:</b> 59380000</p>
                    </div>
                    
                    <div class="cabecalho_dados_empresa_fone">
                        <p><b>TELEFONE:</b> (84) 3431-1940</p>
                    </div>
                </div>

            </div>

            <div class="cabecalho_dados_fornecedor">
                <div>
                    <div class="cabecalho_dados_fornecedor_nome">
                        <p><b>FORNECEDOR:</b> <?=$dadosNotaAvulsa[0]['nome_fornecedor']?></p>
                    </div>
                    <div class="cabecalho_dados_fornecedor_cod">
                        <p><b>COD:</b> _______________</p>
                    </div>
                </div>

                <div>
                    <div class="cabecalho_dados_fornecedor_endereco">
                        <p><b>ENDEREÇO:</b> ______________________________________________________________</p>
                    </div>
                    <div class="cabecalho_dados_fornecedor_numero">
                        <p><b>NÚMERO:</b> _______________</p>
                    </div>
                </div>

                <div class="cabecalho_dados_fornecedor_conteudo">
                    <div class="cabecalho_dados_fornecedor_cidade">
                        <p><b>CIDADE:</b> __________________________________________________</p>
                    </div>

                    <div class="cabecalho_dados_fornecedor_uf">
                        <p><b>UF:</b> _____</p>
                    </div>
                    
                    <div class="cabecalho_dados_fornecedor_fone">
                        <p><b>TELEFONE:</b> ____________________</p>
                    </div>
                </div>
            </div>

            <table class="table table-bordered">
                <thead style="background-color: #182226; color: #FFF">
                    <tr>
                        <th class="text-center campoId" style="background-color: #f3f0f0">#</th>
                        <th class="text-center campoProduto" style="background-color: #f3f0f0">PRODUTOS</th>
                        <th class="text-center campoUndCx" style="background-color: #f3f0f0">CX</th>
                        <th class="text-center campoKg" style="background-color: #f3f0f0">UND/KG</th>
                        <th class="text-center campoValor" style="background-color: #f3f0f0">R$ VALOR</th>
                        <th class="text-center campoTotal" style="background-color: #f3f0f0">R$ TOTAL</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                        $count = 1;

                        foreach($dadosNotaAvulsa as $nota) {
                        ?>
                        <tr>
                            <td class="text-center campoId"><?=$count++?></td>
                            <td class="text-center campoProduto"> <?=$nota['nome_produto']?></td>
                            <td class="text-center campoUndCx"> <?=$nota['qtd_cx_nota_avulsa']?> CX</td>
                            <?php
                            if($nota['cobranca_nota_avulsa'] === 'cx') {
                            ?>
                                <td class="text-center campoKg"> <?=$nota['kg_und_cx_nota_avulsa']?> KG</td>
                            <?php
                            }else if($nota['cobranca_nota_avulsa'] === 'und') {
                            ?>
                                <td class="text-center campoKg"> <?=$nota['kg_und_cx_nota_avulsa']?> UND</td>
                            <?php
                            }else {
                            ?>
                                <td class="text-center campoKg"> <?=$nota['kg_und_cx_nota_avulsa']?> KG</td>
                            <?php
                            }
                            ?>
                            <td class="text-center campoValor"> R$ <?=$nota['valor_unitario']?></td>
                            <td class="text-center campoTotal"> R$ <?=$nota['valor_total']?></td>
                        </tr>
                        <?php
                        }
                    ?>
                        <tr>
                            <td colspan="5" class="text-center" style="font-size: 16px;"><br><b>VALOR TOTAL GERAL:</b></td>
                            <td colspan="2" class="text-center" style="font-size: 16px;"><br><b>R$ <?=$nota['valor_total_nota_avulsa']?></b><td>
                        </tr>
                </tbody>
            </table>

            <div class="rodape">
                <div class="rodape1">
                    <p style="margin-bottom: -20px;"><?=$dadosNotaAvulsa[0]['nome_conferente']?></p>
                    <p>___________________________________</p>
                    <p class="text-center"><b>CONFERENTE</b></p>
                </div>
                <div class="rodape2">
                    <p>___________________________________</p>
                    <p class="text-center"><b>VENDEDOR</b></p>
                </div>
            </div>
        </div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="<?=base_url()?>/assets/template/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    </body>
</html>