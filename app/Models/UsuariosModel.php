<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuariosModel extends Model {

    protected $table                = 'usuarios';
    protected $primaryKey           = 'id_usuario';
    protected $allowedFields        = ['nome_usuario', 'senha_usuario', 'perfil_usuario', 'status_usuario'];
    protected $returnType           = 'array';


    //Funções
    public function getByNomeUsuario($nome_usuario) {
        $usuario = esc($this->where('nome_usuario', $nome_usuario)
                            ->where('status_usuario', 'on')
                            ->find());

        return $usuario;
    }

    public function getAllUsuarios() {
        $usuarios = esc($this->where('status_usuario', 'on')
                             ->orderBy('nome_usuario', 'ASC')
                             ->findAll());

        return $usuarios;
    }

} 