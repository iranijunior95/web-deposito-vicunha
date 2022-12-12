<?php

namespace App\Models;

use CodeIgniter\Model;

class ConferentesModel extends Model {

    protected $table                = 'conferentes';
    protected $primaryKey           = 'id_conferente';
    protected $allowedFields        = ['nome_conferente', 'telefone_conferente', 'status_conferente'];
    protected $returnType           = 'array';

    protected $validationRules      = [
        'nome_conferente' => 'required',
        'telefone_conferente' => 'required|min_length[15]'
    ];

    protected $validationMessages   = [
        'nome_conferente' => [
            'required' => 'Preencha o campo nome'
        ],

        'telefone_conferente' => [
            'required' => 'Preencha o campo telefone',
            'min_length' => 'Número de telefone está inválido'
        ]
    ];

    public function getAllConferentes() {
        $conferentes = esc($this->where('status_conferente', 'on')
                                ->orderBy('nome_conferente', 'ASC')
                                ->findAll());

        return $conferentes;
    }

    public function getByIdConferente($id) {
        $conferente = esc($this->where('status_conferente', 'on')
                                ->where('id_conferente', $id)
                                ->find());
        
        return $conferente;
    }

    public function searchConferente($nome) {
        $conferentes = esc($this->where('status_conferente', 'on')
                                ->like('nome_conferente', $nome)
                                ->orderBy('nome_conferente', 'ASC')
                                ->findAll());
        
        return $conferentes;
    }

    public function saveConferente($dados) {
        if($dados['id'] > 0) {

            $conferente = [
                'id_conferente' => $dados['id'],
                'nome_conferente' => mb_strtoupper($dados['nome_conferente']),
                'telefone_conferente' => $dados['telefone_conferente'],
            ];

            if($this->save($conferente)) {
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
            $conferente = [
                'nome_conferente' => mb_strtoupper($dados['nome_conferente']),
                'telefone_conferente' => $dados['telefone_conferente'],
                'status_conferente' => 'on'
            ];

            if($this->save($conferente)) {
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

    public function deleteConferente($id) {
        $conferente = [
            'id_conferente' => $id,
            'status_conferente' => 'off'
        ];

        if($this->save($conferente)) {
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