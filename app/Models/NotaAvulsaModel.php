<?php

namespace App\Models;

use App\Controllers\Fornecedores;
use CodeIgniter\Model;


class NotaAvulsaModel extends Model { 

    protected $table                = 'nota_avulsa';
    protected $primaryKey           = 'id_nota_avulsa';
    protected $allowedFields        = [
        'titulo_nota_avulsa',
        'valor_total_nota_avulsa',
        'data_nota_avulsa',
        'data_entrada_nota_avulsa',
        'status_nota_avulsa',
        'fornecedores_id_fornecedor',
        'conferentes_id_conferente'
    ];

    protected $returnType           = 'array';

    protected $fornecedoresModel;

    public function getByIdNotaAvulsa($id) {
        return esc($this->from('conferentes, fornecedores, produtos, nota_avulsa_has_produtos')
                        ->where('id_nota_avulsa', $id)
                        ->where('id_nota_avulsa = nota_avulsa_id_nota_avulsa')
                        ->where('id_produto = produtos_id_produto')
                        ->where('conferentes_id_conferente = id_conferente')
                        ->where('fornecedores_id_fornecedor = id_fornecedor')
                        ->where('status_nota_avulsa', 'on')
                        ->orderBy('nome_produto', 'ESC')
                        ->find());
    }

    public function saveNotaAvulsa($dados) {

        $lista = [];

        $this->fornecedoresModel = new FornecedoresModel();
        $fornecedor = $this->fornecedoresModel->getByIdFornecedor($dados['fornecedor']);

        
        $notaAvulsa = [
            'titulo_nota_avulsa' => strtoupper('nota_avulsa-'.$fornecedor[0]['nome_fornecedor']),
            'valor_total_nota_avulsa' => $dados['valorTotal'],
            'data_nota_avulsa' => $dados['data'],
            'data_entrada_nota_avulsa' => date('Y-m-d H:i:s'),
            'status_nota_avulsa' => 'on',
            'fornecedores_id_fornecedor' => $dados['fornecedor'],
            'conferentes_id_conferente' => $dados['conferente']
        ];

        if($this->save($notaAvulsa)) {
            
            foreach($dados['tabela'] as $t) {
                array_push($lista, array(
                    'nota_avulsa_id_nota_avulsa' => $this->getInsertID(),
                    'produtos_id_produto' => $t['id_produto'],
                    'cobranca_nota_avulsa' => $t['cobranca'],
                    'qtd_cx_nota_avulsa' => $t['qtdCx'],
                    'kg_und_cx_nota_avulsa' => $t['KGUndCx'],
                    'valor_unitario' => $t['valorUnitario'],
                    'valor_total' => $t['valorTotalProduto']
                ));
            }

            $db = \Config\Database::connect();
            $builder = $db->table('nota_avulsa_has_produtos');

            if($builder->insertBatch($lista)){
                $retorno = [
                    'status' => true,
                    'id_nota_avulsa' => $this->getInsertID()
                ];

                return $retorno;
            }else {
                $retorno = [
                    'status' => false,
                    'mensagem' => 'Erro! Problema ao gerar tabela!'
                ];
    
                return $retorno;
            }

        }else {
            $retorno = [
                'status' => false,
                'mensagem' => 'Erro! Problema ao gerar tabela!'
            ];

            return $retorno;
        }
        

        return $notaAvulsa;
    }

    public function searchNota($query) {

        if(empty($query)) {
            return '';
        }else {
            $query = substr($query, 4);

            return esc($this->from('fornecedores, conferentes')
                            ->where('id_fornecedor = fornecedores_id_fornecedor')
                            ->where('id_conferente = conferentes_id_conferente')
                            ->where($query)
                            ->where('status_nota_avulsa', 'on')
                            ->orderBy('data_nota_avulsa', 'DESC')
                            ->findAll());
        }
        
    }

    public function deleteNota($id) {
        $avulsa = [
            'id_nota_avulsa' => $id,
            'status_nota_avulsa' => 'off'
        ];

        if($this->save($avulsa)) {
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