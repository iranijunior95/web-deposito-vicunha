<?php

namespace App\Models;

use CodeIgniter\Model;

class FornecedoresModel extends Model {

    protected $table                = 'fornecedores';
    protected $primaryKey           = 'id_fornecedor';
    protected $allowedFields        = ['nome_fornecedor', 'cnpj_cpf_fornecedor', 'status_fornecedor'];
    protected $returnType           = 'array';

    protected $validationRules      = [
        'nome_fornecedor' => 'required',
        'cnpj_cpf_fornecedor' => 'required'
    ];

    protected $validationMessages   = [
        'nome_fornecedor' => [
            'required' => 'Preencha o campo nome'
        ],

        'cnpj_cpf_fornecedor' => [
            'required' => 'CNPJ ou CPF inválido'
        ]
    ];

    public function getAllFornecedores() {
        $fornecedores = esc($this->where('status_fornecedor', 'on')
                                ->orderBy('nome_fornecedor', 'ASC')
                                ->findAll());

        return $fornecedores;
    }

    public function getByIdFornecedor($id) {
        $fornecedor = esc($this->where('status_fornecedor', 'on')
                                ->where('id_fornecedor', $id)
                                ->find());
        
        return $fornecedor;
    }

    public function searchfornecedor($nome) {
        $fornecedores = esc($this->where('status_fornecedor', 'on')
                                ->like('nome_fornecedor', $nome)
                                ->orderBy('nome_fornecedor', 'ASC')
                                ->findAll());
        
        return $fornecedores;
    }

    public function saveFornecedor($dados) {
        if($dados['id'] > 0) {
            $fornecedor = [
                'id_fornecedor' => $dados['id'],
                'nome_fornecedor' => mb_strtoupper($dados['nome_fornecedor']),
                'cnpj_cpf_fornecedor' => $this->validaCnpjFornecedor($dados['cnpj_cpf_fornecedor'])
            ];

            if($this->save($fornecedor)) {
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
            $fornecedor = [
                'nome_fornecedor' => mb_strtoupper($dados['nome_fornecedor']),
                'cnpj_cpf_fornecedor' => $this->validaCnpjFornecedor($dados['cnpj_cpf_fornecedor']),
                'status_fornecedor' => 'on'
            ];

            if($this->save($fornecedor)) {
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

    public function deleteFornecedor($id) {
        $fornecedor = [
            'id_fornecedor' => $id,
            'status_fornecedor' => 'off'
        ];

        if($this->save($fornecedor)) {
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

    private function validaCnpjFornecedor($cnpj) {
        if(empty($cnpj)) {
            return $cnpj;
        }else {
            
            switch ($cnpj) {
                case strlen($cnpj) < 14:
                    $cnpj = '';

                    return $cnpj; 
                    break;

                case strlen($cnpj) === 14:
                    return $cnpj; 
                    break;

                case strlen($cnpj) > 14 && strlen($cnpj) < 18:
                    $cnpj = '';

                    return $cnpj; 
                    break;

                case strlen($cnpj) === 18:
                    return $cnpj; 
                    break;

                case strlen($cnpj) > 18:
                    $cnpj = '';

                    return $cnpj; 
                    break;
            }
        }
    }

}