<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>WEB DEPÓSITO | <?=$titulo?></title>

        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="shortcut icon" href="<?=base_url()?>/assets/sistema/img/favicon-min.png" type="image/x-icon" />

        <link rel="stylesheet" href="<?=base_url()?>/assets/template/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?=base_url()?>/assets/template/bower_components/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?=base_url()?>/assets/template/bower_components/Ionicons/css/ionicons.min.css">
        <link rel="stylesheet" href="<?=base_url()?>/assets/template/bower_components/select2/dist/css/select2.min.css"> 
        <link rel="stylesheet" href="<?=base_url()?>/assets/template/dist/css/AdminLTE.min.css">
        <link rel="stylesheet" href="<?=base_url()?>/assets/template/dist/css/skins/_all-skins.min.css">
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" id="theme-styles">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

        <?php
        if(isset($css)) {
            foreach($css as $css) {
                echo '<link rel="stylesheet" href="'.base_url().$css.'"></script>';
            }
        }
        ?>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>

    <body class="hold-transition skin-green fixed layout-top-nav">
        <div class="wrapper">

            <header class="main-header">
                <nav class="navbar navbar-static-top">
                    <div class="container">
                        <div class="navbar-header">
                            <a href="<?=base_url('home')?>" class="navbar-brand"><b>WEB</b> DEPÓSITO</a>
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                                <i class="fa fa-bars"></i>
                            </button>
                        </div>

                        
                        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">

                            <ul class="nav navbar-nav">

                                <!-- LINK HOME -->
                                <?php
                                if($menu === 'home') {
                                ?>
                                    <li class="active">
                                        <a href="<?=base_url('home')?>"><i class="fa fa-home"></i> HOME</a>
                                    </li>
                                <?php
                                }else {
                                ?>
                                    <li>
                                        <a href="<?=base_url('home')?>"><i class="fa fa-home"></i> HOME</a>
                                    </li>
                                <?php
                                }
                                ?>

                                 <!-- LINK LANCAMENTOS -->
                                 <?php
                                if($menu === 'lancamentos') {
                                ?>
                                    <li class="active">
                                        <a href="<?=base_url('lancamentos')?>"><i class="fa fa-file-text"></i> LANÇAMENTOS</a>
                                    </li>
                                <?php
                                }else {
                                ?>
                                    <li>
                                        <a href="<?=base_url('lancamentos')?>"><i class="fa fa-file-text"></i> LANÇAMENTOS</a>
                                    </li>
                                <?php
                                }
                                ?>

                                <!-- LINK RELATORIOS -->
                                <?php
                                if($menu === 'relatorios') {
                                ?>
                                    <li class="active">
                                        <a href="<?=base_url('relatorios')?>"><i class="fa fa-book"></i> RELATÓRIOS</a>
                                    </li>
                                <?php
                                }else {
                                ?>
                                    <li>
                                        <a href="<?=base_url('relatorios')?>"><i class="fa fa-book"></i> RELATÓRIOS</a>
                                    </li>
                                <?php
                                }
                                ?>

                                <!-- LINK CADASTROS -->
                                <?php
                                if($menu === 'cadastros') {
                                ?>
                                    <li class="dropdown active">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">CADASTROS <span class="caret"></span></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="<?=base_url('conferentes')?>"><i class="fa fa-users"></i>CONFERENTES</a></li>
                                            <li><a href="<?=base_url('fornecedores')?>"><i class="fa fa-truck"></i>FORNECEDORES</a></li>
                                            <li><a href="<?=base_url('setores')?>"><i class="fa fa-bank"></i>SETORES</a></li>
                                            <li class="divider"></li>
                                            <li><a href="<?=base_url('produtos')?>"><i class="fa fa-cubes"></i>PRODUTOS</a></li>
                                        </ul>
                                    </li>
                                <?php
                                }else {
                                ?>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">CADASTROS <span class="caret"></span></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="<?=base_url('conferentes')?>"><i class="fa fa-users"></i>CONFERENTES</a></li>
                                            <li><a href="<?=base_url('fornecedores')?>"><i class="fa fa-truck"></i>FORNECEDORES</a></li>
                                            <li><a href="<?=base_url('setores')?>"><i class="fa fa-bank"></i>SETORES</a></li>
                                            <li class="divider"></li>
                                            <li><a href="<?=base_url('produtos')?>"><i class="fa fa-cubes"></i>PRODUTOS</a></li>
                                        </ul>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>
                            
                        </div>
                        
                        <div class="navbar-custom-menu">
                            <ul class="nav navbar-nav">
                            
                                <li class="dropdown user user-menu">

                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <img src="<?=base_url()?>/assets/sistema/img/user-vicunha2.jpg" class="user-image" alt="User Image">
                                        <span class="hidden-xs"><?=session()->get('nome_usuario')?></span>
                                    </a>

                                    <ul class="dropdown-menu">
                                        <li class="user-header">
                                            <img src="<?=base_url()?>/assets/sistema/img/user-vicunha2.jpg" class="img-circle" alt="User Image">

                                            <p><?=session()->get('nome_usuario')?></p>
                                        </li>
                                        
                                        <li class="user-footer">
                                            <div class="text-center">
                                                <a href="<?=base_url('login/logout')?>" class="btn btn-default btn-flat"><i class="fa fa-sign-in"></i> SAIR</a>
                                            </div>
                                        </li>
                                    </ul>

                                </li>

                            </ul>
                        </div>

                    </div>
                </nav>
            </header>

            <!-- =============================================== -->

            <div class="content-wrapper" id="body">
                <?php
                if(isset($tela)) {
                    echo view('telas/'.$tela);
                }
                ?>
            </div>

            <!-- =============================================== -->

            <footer class="main-footer">
                <div class="container">
                    <div class="pull-right hidden-xs">
                        <b>Versão</b> 1.0.0
                    </div>
                    <strong>WEB DEPÓSITO &copy; 2022</strong> (Irani Junior)
                </div>
            </footer>
      
        </div>

            <script src="<?=base_url()?>/assets/template/bower_components/jquery/dist/jquery.min.js"></script>
            <script src="<?=base_url()?>/assets/template/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
            <script src="<?=base_url()?>/assets/template/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
            <script src="<?=base_url()?>/assets/template/bower_components/fastclick/lib/fastclick.js"></script>
            <script src="<?=base_url()?>/assets/template/dist/js/adminlte.min.js"></script>
            <script src="<?=base_url()?>/assets/template/dist/js/demo.js"></script>
            <script src="<?=base_url()?>/assets/template/bower_components/select2/dist/js/select2.full.min.js"></script>
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script src="<?=base_url()?>/assets/sistema/js/mensagemAlerta.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

            <script>
                $('.select2').select2();
            </script>

            <?php
            if(isset($js)) {
                foreach($js as $js) {
                    echo '<script src="'.base_url().$js.'"></script>';
                }
            }
            ?>
    </body>
</html>
