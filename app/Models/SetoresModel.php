<?php

namespace App\Models;

use CodeIgniter\Model;

class SetoresModel extends Model {

    protected $table                = 'setores';
    protected $primaryKey           = 'id_setor';
    protected $allowedFields        = ['nome_setor', 'status_setor'];
    protected $returnType           = 'array';

    protected $validationRules      = ['nome_setor' => 'required'];

    protected $validationMessages   = [
        'nome_setor' => [
            'required' => 'Preencha o campo nome'
        ]
    ];

    public function getAllSetores() {
        $setores = esc($this->where('status_setor', 'on')
                                ->orderBy('nome_setor', 'ASC')
                                ->findAll());

        return $setores;
    }

    public function getByIdSetor($id) {
        $setor = esc($this->where('status_setor', 'on')
                          ->where('id_setor', $id)
                          ->find());
        
        return $setor;
    }

    public function searchSetor($nome) {
        $setor = esc($this->where('status_setor', 'on')
                          ->like('nome_setor', $nome)
                          ->orderBy('nome_setor', 'ASC')
                          ->findAll());
        
        return $setor;
    }

    public function saveSetor($dados) {
        if($dados['id'] > 0) {

            $setor = [
                'id_setor' => $dados['id'],
                'nome_setor' => mb_strtoupper($dados['nome_setor'])
            ];

            if($this->save($setor)) {
                $retorno = [
                    'status' => true,
                    'mensagem' => 'Alterado com Sucesso!'
                ];
    
                return $retorno;
            }else {
                $retorno = [
                    'status' => false,
                    'mensagem' => $this->errors()
                ];
    
                return $retorno;
            }

        }else {
            $setor = [
                'nome_setor' => mb_strtoupper($dados['nome_setor']),
                'status_setor' => 'on'
            ];

            if($this->save($setor)) {
                $retorno = [
                    'status' => true,
                    'id' => $this->getInsertID(),
                    'mensagem' => 'Cadastrado com Sucesso!'
                ];

                return $retorno;

            }else {
                $retorno = [
                    'status' => false,
                    'id' => 0,
                    'mensagem' => $this->errors()
                ];

                return $retorno;
            }
        }
    }

    public function deleteSetor($id) {
        $setor = [
            'id_setor' => $id,
            'status_setor' => 'off'
        ];

        if($this->save($setor)) {
            $retorno = [
                'status' => true,
                'mensagem' => 'Deletado com Sucesso!'
            ];

            return $retorno;
        }else {
            $retorno = [
                'status' => false,
                'mensagem' => 'Erro ao Deletar!'
            ];

            return $retorno;
        }
    }

}