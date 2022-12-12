<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Session\Session;

class LoginModel extends Model { 

    protected $usuarioModel;

    public function __construct() {
        $this->usuarioModel = new UsuariosModel();
    }


    public function login($dados) {

        $usuario = $dados['usuario'];
        $senha = $dados['senha'];

        $user =  $this->usuarioModel->getByNomeUsuario($usuario);
        
        if($this->validaSeCampoEstaVazio($usuario, $senha)['status']) {
            
            if($this->validaUsuarioSenha($usuario, $senha, $user)['status']) {

                $resposta = [
                    'status' => true,
                    'logado' => true,
                    'id_usuario' => $user[0]['id_usuario'],
                    'nome_usuario' => $user[0]['nome_usuario'],
                    'perfil_usuario' => $user[0]['perfil_usuario']
                ];

                session()->set($resposta);

                return $resposta;

            }else {
                return $this->validaUsuarioSenha($usuario, $senha, $user);
            }

        }else {
            return $this->validaSeCampoEstaVazio($usuario, $senha);
        }

    }

    private function validaSeCampoEstaVazio($usuario, $senha) {
        $mensagensDeErro = [
            'status' => true,
            'usuario' => '',
            'senha' => ''
        ];

        if(empty($usuario) && empty($senha)) {
            $mensagensDeErro['status'] = false;
            $mensagensDeErro['usuario'] = 'Preencha o campo usuário';
            $mensagensDeErro['senha'] = 'Preencha o campo senha';

            return $mensagensDeErro;

        }else if(empty($usuario)) {
            $mensagensDeErro['status'] = false;
            $mensagensDeErro['usuario'] = 'Preencha o campo usuário';

            return $mensagensDeErro;

        }else if(empty($senha)) {
            $mensagensDeErro['status'] = false;
            $mensagensDeErro['senha'] = 'Preencha o campo senha';

            return $mensagensDeErro;

        }else {
            return $mensagensDeErro;
        }
    }

    private function validaUsuarioSenha($usuario, $senha, $user) {

        $mensagensDeErro = [
            'status' => true,
            'usuario' => '',
            'senha' => ''
        ];

        if(empty($user)) {
            $mensagensDeErro['status'] = false;
            $mensagensDeErro['usuario'] = 'Usuário não encontrado';

            return $mensagensDeErro;

        }else if(!empty($user) && !password_verify($senha, $user[0]['senha_usuario'])) {
            $mensagensDeErro['status'] = false;
            $mensagensDeErro['senha'] = 'Senha incorreta';
            
            return $mensagensDeErro;
            
        }else {
            
            return $mensagensDeErro;
        }
    }

}
