<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdutosModel extends Model {

    protected $table                = 'produtos';
    protected $primaryKey           = 'id_produto';
    protected $allowedFields        = ['nome_produto', 'status_produto'];
    protected $returnType           = 'array';

    protected $validationRules      = ['nome_produto' => 'required'];

    protected $validationMessages   = [
        'nome_produto' => [
            'required' => 'Preencha o campo nome'
        ]
    ];

    public function getAllProdutos() {
        $produtos = esc($this->where('status_produto', 'on')
                                ->orderBy('nome_produto', 'ASC')
                                ->findAll());

        return $produtos;
    }

    public function getByIdProduto($id) {
        $produto = esc($this->where('status_produto', 'on')
                          ->where('id_produto', $id)
                          ->find());
        
        return $produto;
    }

    public function searchProduto($nome) {
        $produto = esc($this->where('status_produto', 'on')
                          ->like('nome_produto', $nome)
                          ->orderBy('nome_produto', 'ASC')
                          ->findAll());
        
        return $produto;
    }

    public function saveProduto($dados) {
        if($dados['id'] > 0) {

            $produto = [
                'id_produto' => $dados['id'],
                'nome_produto' => mb_strtoupper($dados['nome_produto'])
            ];

            if($this->save($produto)) {
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
            $produto = [
                'nome_produto' => mb_strtoupper($dados['nome_produto']),
                'status_produto' => 'on'
            ];

            if($this->save($produto)) {
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

    public function deleteProduto($id) {
        $produto = [
            'id_produto' => $id,
            'status_produto' => 'off'
        ];

        if($this->save($produto)) {
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