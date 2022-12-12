<?php

namespace App\Models;

use CodeIgniter\Model;

class HortifrutiModel extends Model { 

    protected $table                = 'hortifruti';
    protected $primaryKey           = 'id_hortifruti';
    protected $allowedFields        = [
        'titulo_hortifruti',
        'nome_motorista_hortifruti',
        'data_hortifruti',
        'data_entrada_hortifruti',
        'status_hortifruti',
        'conferentes_id_conferente'
    ];

    protected $returnType           = 'array';

    public function getByIdHortifruti($id) {
        return esc($this->from('conferentes, produtos, hortifruti_has_produtos')
                        ->where('id_hortifruti', $id)
                        ->where('id_hortifruti = hortifruti_id_hortifruti')
                        ->where('id_produto = produtos_id_produto')
                        ->where('conferentes_id_conferente = id_conferente')
                        ->where('status_hortifruti', 'on')
                        ->orderBy('nome_produto', 'ESC')
                        ->find());
    }

    public function saveHortifruti($dados) {

        $lista = [];

        $hortifruti = [
            'titulo_hortifruti' => 'tabela_hortifruti_'.date('Y-m-d').'_'.rand(100, 999),
            'nome_motorista_hortifruti' => strtoupper($dados['nome_motorista']),
            'data_hortifruti' => $dados['data'],
            'data_entrada_hortifruti' => date('Y-m-d H:i:s'),
            'status_hortifruti' => 'on',
            'conferentes_id_conferente' => $dados['conferente']
        ];

        if($this->save($hortifruti)) {

            foreach($dados['tabela'] as $t) {
                array_push($lista,array (
                    'hortifruti_id_hortifruti' => $this->getInsertID(),
                    'produtos_id_produto' => $t['id_produto'],
                    'und_kg' => strtoupper($t['undCx']),
                    'quantidade_cx' => $t['qtd'],
                    'quantidade' => $t['kg']
                ));
            }
            
            $db = \Config\Database::connect();
            $builder = $db->table('hortifruti_has_produtos');

            if($builder->insertBatch($lista)){
                $retorno = [
                    'status' => true,
                    'id_hortifruti' => $this->getInsertID()
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

        
    }

    public function searchHortifruti($query) {

        if(empty($query)) {
            return '';
        }else {
            $query = substr($query, 4);

            return esc($this->from('conferentes')
                            ->where('id_conferente = conferentes_id_conferente')
                            ->where($query)
                            ->where('status_hortifruti', 'on')
                            ->orderBy('data_hortifruti', 'DESC')
                            ->findAll());
        }
        
    }

    public function deleteHortifruti($id) {
        $hortifruti = [
            'id_hortifruti' => $id,
            'status_hortifruti' => 'off'
        ];

        if($this->save($hortifruti)) {
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