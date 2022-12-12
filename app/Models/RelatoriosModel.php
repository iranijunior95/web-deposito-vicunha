<?php

namespace App\Models;

use CodeIgniter\Model;

class RelatoriosModel extends Model { 

    protected $table                = 'relatorios';
    protected $primaryKey           = 'id_relatorio';
    protected $allowedFields        = [
        'titulo_relatorio',
        'data_relatorio',
        'data_entrada_relatorio',
        'status_relatorio'
    ];

    protected $returnType           = 'array';

    public function getByIdRelatorio($id) {
        return esc($this->from('lancamentos, relatorios_has_lancamentos, fornecedores, conferentes')
                        ->where('id_relatorio', $id)
                        ->where('id_relatorio = relatorios_id_relatorio')
                        ->where('id_lancamento = lancamentos_id_lancamento')
                        ->where('fornecedores_id_fornecedor = id_fornecedor')
                        ->where('conferentes_id_conferente = id_conferente')
                        ->where('status_relatorio', 'on')
                        ->orderBy('ordem_sequencia', 'ESC')
                        ->find());
    }

    public function pesquisarRelatorios($query) {

        if(!empty($query)) {
            $query = substr($query, 4);

            return esc($this->where($query)
                            ->where('status_relatorio', 'on')
                            ->find());
        }else {
            return $dados = [];
        }
        
    }

    public function saveRelatorio($dados) {

        $lista = [];
        $count = 0;

        $relatorio = [
            'titulo_relatorio' => strtoupper($dados['titulo']),
            'data_relatorio' => $dados['data'],
            'data_entrada_relatorio' => date('Y-m-d H:i:s'),
            'status_relatorio' => 'on'
        ];

        if($this->save($relatorio)) {

            foreach($dados['lista'] as $l) {
                array_push($lista,array (
                    'relatorios_id_relatorio' => $this->getInsertID(),
                    'lancamentos_id_lancamento' => $l['id_lancamento'],
                    'ordem_sequencia' => $count++
                ));
            }
            
            $db = \Config\Database::connect();
            $builder = $db->table('relatorios_has_lancamentos');

            if($builder->insertBatch($lista)){
                $retorno = [
                    'status' => true,
                    'id_relatorio' => $this->getInsertID()
                ];

                return $retorno;
            }else {
                $retorno = [
                    'status' => false,
                    'mensagem' => 'Erro! Problema ao gerar relatório!'
                ];
    
                return $retorno;
            }
            
        }else {
            $retorno = [
                'status' => false,
                'mensagem' => 'Erro! Problema ao gerar relatório!'
            ];

            return $retorno;
        }
    }

    public function deleteRelatorios($id) {
        $relatorios = [
            'id_relatorio' => $id,
            'status_relatorio' => 'off'
        ];

        if($this->save($relatorios)) {
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