<?php

namespace App\Models;

use CodeIgniter\Model;

class LancamentosModel extends Model {

    protected $table                = 'lancamentos';
    protected $primaryKey           = 'id_lancamento';
    protected $allowedFields        = [
        'numero_nota',
        'valor_nota', 
        'peso_nota', 
        'hora_entrada', 
        'hora_saida', 
        'data_entrada', 
        'data_lancamento',
        'nome_motorista', 
        'placa_veiculo', 
        'taxa_descarrego', 
        'status_lancamento',
        'fornecedores_id_fornecedor',
        'conferentes_id_conferente',
        'setores_id_setor'
    ];

    protected $returnType           = 'array';

    protected $validationRules      = [
        'numero_nota' => 'required',
        'valor_nota' => 'required',
        'nome_motorista' => 'required',
        'hora_entrada' => 'required',
        'hora_saida' => 'required',
        'data_entrada' => 'required'
    ];

    protected $validationMessages   = [
        'numero_nota' => [
            'required' => 'Preencha o campo número da nota'
        ],

        'valor_nota' => [
            'required' => 'Preencha o campo valor da nota'
        ],
        
        'nome_motorista' => [
            'required' => 'Preencha o campo nome do motorista'
        ],

        'hora_entrada' => [
            'required' => 'Preencha o campo hora de entrada'
        ],
        
        'hora_saida' => [
            'required' => 'Preencha o campo hora de saída'
        ],

        'data_entrada' => [
            'required' => 'Preencha o campo data de entrada'
        ]
    ];

    public function saveLancamento($dados) {
        if($dados['id'] > 0) {

            $lancamento = [
                'id_lancamento' => $dados['id'],
                'numero_nota' => $dados['numeroNota'],
                'valor_nota' => $dados['valorNota'],
                'peso_nota' => $dados['pesoNota'],
                'hora_entrada' => $dados['horaEntrada'],
                'hora_saida' => $dados['horaSaida'],
                'data_entrada' => $dados['dataEntrada'],
                'nome_motorista' => mb_strtoupper($dados['nomeMotorista']),
                'placa_veiculo' => mb_strtoupper($dados['placaVeiculo']),
                'taxa_descarrego' => $dados['taxaDescarrego'],
                'fornecedores_id_fornecedor' => $dados['fornecedor'],
                'conferentes_id_conferente' => $dados['conferente'],
                'setores_id_setor' => $dados['setor']
            ];

            if($this->save($lancamento)) {
                $retorno = [
                    'status' => true,
                    'id_lancamento' => $dados['id'],
                    'mensagem' => 'Alterado com Sucesso!'
                ];

                session()->setFlashdata($retorno);

                return $retorno;

            }else {
                $retorno = [
                    'status' => false,
                    'mensagem' => $this->errors()
                ];
    
                return $retorno;
            }

        }else {

            $lancamento = [
                'numero_nota' => $dados['numeroNota'],
                'valor_nota' => $dados['valorNota'],
                'peso_nota' => $dados['pesoNota'],
                'hora_entrada' => $dados['horaEntrada'],
                'hora_saida' => $dados['horaSaida'],
                'data_entrada' => $dados['dataEntrada'],
                'data_lancamento' => date('Y-m-d H:i:s'),
                'nome_motorista' => mb_strtoupper($dados['nomeMotorista']),
                'placa_veiculo' => mb_strtoupper($dados['placaVeiculo']),
                'taxa_descarrego' => $dados['taxaDescarrego'],
                'status_lancamento' => 'on',
                'fornecedores_id_fornecedor' => $dados['fornecedor'],
                'conferentes_id_conferente' => $dados['conferente'],
                'setores_id_setor' => $dados['setor']
            ];
            
            if($this->save($lancamento)) {
                $retorno = [
                    'status' => true,
                    'id_lancamento' => $this->getInsertID(),
                    'mensagem' => 'Cadastrado com Sucesso!'
                ];
                
                session()->setFlashdata($retorno);

                return $retorno;
            }else {
                $retorno = [
                    'status' => false,
                    'mensagem' => $this->errors()
                ];
    
                return $retorno;
            }

            

        }
    }

    public function getAllLancamentos() {
        return esc($this->from('fornecedores, setores, conferentes')
                    ->where('id_fornecedor = fornecedores_id_fornecedor')
                    ->where('id_setor = setores_id_setor')
                    ->where('id_conferente = conferentes_id_conferente')
                    ->where('status_lancamento', 'on')
                    ->orderBy('data_lancamento', 'DESC')
                    ->findAll());
    }

    public function getLancamentosById($id) {
        return esc($this->from('fornecedores, setores, conferentes')
                    ->where('id_fornecedor = fornecedores_id_fornecedor')
                    ->where('id_setor = setores_id_setor')
                    ->where('id_conferente = conferentes_id_conferente')
                    ->where('id_lancamento',$id)
                    ->where('status_lancamento', 'on')
                    ->findAll());
    }

    public function getAllLancamentosDoDia() {
        return esc($this->from('fornecedores, setores, conferentes')
                    ->where('id_fornecedor = fornecedores_id_fornecedor')
                    ->where('id_setor = setores_id_setor')
                    ->where('id_conferente = conferentes_id_conferente')
                    ->where('data_entrada',date('Y-m-d'))
                    ->where('status_lancamento', 'on')
                    ->orderBy('data_lancamento', 'DESC')
                    ->findAll());
    }

    public function pesquisarLancamento($query) {
        $query = substr($query, 4);
        
        return esc($this->from('fornecedores, setores, conferentes')
                        ->where('id_fornecedor = fornecedores_id_fornecedor')
                        ->where('id_setor = setores_id_setor')
                        ->where('id_conferente = conferentes_id_conferente')
                        ->where($query)
                        ->where('status_lancamento', 'on')
                        ->orderBy('data_lancamento', 'DESC')
                        ->findAll());
    }

    public function deleteLancamentos($id) {
        $lancamento = [
            'id_lancamento' => $id,
            'status_lancamento' => 'off'
        ];

        if($this->save($lancamento)) {
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