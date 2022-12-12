<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="shortcut icon" href="<?=base_url()?>/assets/sistema/img/favicon-min.png" type="image/x-icon" />

        <title>WEB DEPÓSITO | LOGIN</title>
        
        <link rel="stylesheet" href="<?=base_url()?>/assets/template/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?=base_url()?>/assets/template/bower_components/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?=base_url()?>/assets/template/bower_components/Ionicons/css/ionicons.min.css">
        <link rel="stylesheet" href="<?=base_url()?>/assets/template/dist/css/AdminLTE.min.css">
        <link rel="stylesheet" href="<?=base_url()?>/assets/sistema/css/login/style_view_login.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-box-body">

                <div class="login-logo">
					<img src="<?=base_url()?>/assets/sistema/img/logo_oficial_grupo_vicunha.png" width="200" height="75" class="user-image" alt="logo">
					<h4><b>WEB</b> DEPÓSITO</h4>
				</div>

                <form id="formLogin">
                    <div class="form-group has-feedback" id="groupInputUsuario">
                        <input type="text" class="form-control" id="inputUsuario" placeholder="Usuário">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback" id="groupInputSenha">
                        <input type="password" class="form-control" id="inputSenha" placeholder="Senha">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>

                    <div class="row text-center">
                        <button type="button" class="btn btn-success" id="btnEntrar"><i class="fa fa-unlock-alt"></i> ENTRAR</button>
                    </div>
                </form>

                <div class="social-auth-links text-center">
                    
                    <p>- OUTRAS OPÇÕES -</p>
                
                </div>

                <a href="<?=base_url('login/contatar_suporte')?>">Contatar suporte?</a><br>

                
            </div>
        </div>
        
        <script src="<?=base_url()?>/assets/template/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="<?=base_url()?>/assets/template/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        
        <script src="<?=base_url()?>/assets/sistema/js/login/script_view_login.js"></script>
    </body>
</html>
