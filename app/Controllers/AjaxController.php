<?php

namespace App\Controllers;

use App\Models\ConferentesModel;
use App\Models\FornecedoresModel;
use App\Models\HortifrutiModel;
use App\Models\LancamentosModel;
use App\Models\RelatoriosModel;
use App\Models\LoginModel;
use App\Models\NotaAvulsaModel;
use App\Models\ProdutosModel;
use App\Models\RecibosModel;
use App\Models\SetoresModel;

class AjaxController extends BaseController {

    protected $loginModel;
    protected $conferenteModel;
    protected $fornecedorModel;
    protected $setorModel;
    protected $produtoModel;
    protected $lancamentosModel;
    protected $relatoriosModel;
    protected $recibosModel;
    protected $hortifrutiModel;
    protected $notaAvulsaModel;

	public function __construct() {
		
		$this->loginModel = new LoginModel();
        $this->conferenteModel = new ConferentesModel();
        $this->fornecedorModel = new FornecedoresModel();
        $this->setorModel = new SetoresModel();
        $this->produtoModel = new ProdutosModel();
        $this->lancamentosModel = new LancamentosModel();
        $this->relatoriosModel = new RelatoriosModel();
        $this->recibosModel = new RecibosModel();
        $this->hortifrutiModel = new HortifrutiModel();
        $this->notaAvulsaModel = new NotaAvulsaModel();
        
	}

    public function requisicoesAjax() {

        $tabela = $this->request->getPost('tabela');
        $metodo = $this->request->getPost('metodo');
        $dados = $this->request->getPost('dados');

        if(empty($tabela) || empty($metodo)) {
            $resposta = [
                'status' => false,
                'mensagem' => 'Erro! Problema de requisicao!'
            ];

            echo json_encode($resposta);

        }else {

            switch ($tabela) {
                case 'login':
                    $this->requisicoesLogin($metodo, $dados);
                    break;

                case 'conferentes':
                    $this->requisicoesConferentes($metodo, $dados);
                    break;

                case 'fornecedores':
                    $this->requisicoesFornecedores($metodo, $dados);
                    break;

                case 'setores':
                    $this->requisicoesSetores($metodo, $dados);
                    break;

                case 'produtos':
                    $this->requisicoesProdutos($metodo, $dados);
                    break;

                case 'lancamentos':
                    $this->requisicoesLancamentos($metodo, $dados);
                    break;

                case 'relatorios':
                    $this->requisicoesRelatorios($metodo, $dados);
                    break;

                case 'recibos':
                    $this->requisicoesRecibos($metodo, $dados);
                    break;

                case 'tabelaHorti':
                    $this->requisicoesTabelaHorti($metodo, $dados);
                    break;

                case 'tabelaNotaAvulsa':
                    $this->requisicoesTabelaNotaAvulsa($metodo, $dados);
                    break;
            }

        }
    }

    private function requisicoesLogin($metodo, $dados) {

        switch ($metodo) {
            case 'login':
                echo json_encode($this->loginModel->login($dados));
                break;
        }
    }

    private function requisicoesConferentes($metodo, $dados) {
        switch ($metodo) {
            case 'buscar':
                echo json_encode($this->conferenteModel->searchConferente($dados));
                break;

            case 'getById':
                echo json_encode($this->conferenteModel->getByIdConferente($dados));
                break;

            case 'save':
                echo json_encode($this->conferenteModel->saveConferente($dados));
                break;

            case 'delete':
                echo json_encode($this->conferenteModel->deleteConferente($dados));
                break;
        }
    }

    private function requisicoesFornecedores($metodo, $dados) {
        switch ($metodo) {
            case 'buscar':
                echo json_encode($this->fornecedorModel->searchfornecedor($dados));
                break;

            case 'getById':
                echo json_encode($this->fornecedorModel->getByIdFornecedor($dados));
                break;

             case 'save':
                echo json_encode($this->fornecedorModel->saveFornecedor($dados));
                break;

            case 'delete':
                echo json_encode($this->fornecedorModel->deleteFornecedor($dados));
                break;
        }
    }

    private function requisicoesSetores($metodo, $dados) {
        switch ($metodo) {
            case 'buscar':
                echo json_encode($this->setorModel->searchSetor($dados));
                break;

            case 'getById':
                echo json_encode($this->setorModel->getByIdSetor($dados));
                break;

            case 'save':
                echo json_encode($this->setorModel->saveSetor($dados));
                break;

            case 'delete':
                echo json_encode($this->setorModel->deleteSetor($dados));
                break;
        }
    }

    private function requisicoesProdutos($metodo, $dados) {
        switch ($metodo) {
            case 'getAllProdutos':
                echo json_encode($this->produtoModel->getAllProdutos());
                break;

            case 'buscar':
                echo json_encode($this->produtoModel->searchProduto($dados));
                break;

            case 'getById':
                echo json_encode($this->produtoModel->getByIdProduto($dados));
                break;

            case 'save':
                echo json_encode($this->produtoModel->saveProduto($dados));
                break;

            case 'delete':
                echo json_encode($this->produtoModel->deleteProduto($dados));
                break;
        }
    }

    private function requisicoesLancamentos($metodo, $dados) {
        switch ($metodo) {
            case 'save':
                echo json_encode($this->lancamentosModel->saveLancamento($dados));
                break;

            case 'delete':
                echo json_encode($this->lancamentosModel->deleteLancamentos($dados));
                break;

            case 'pesquisar':
                if(empty($dados)) {
                    $dados = [];

                    echo json_encode($dados);
                }else {
                    echo json_encode($this->lancamentosModel->pesquisarLancamento($dados));
                }
                
                break;
        }
    }

    private function requisicoesRelatorios($metodo, $dados) {
        switch ($metodo) {
            case 'imprimir':
                echo json_encode($this->relatoriosModel->saveRelatorio($dados));

                break;

            case 'pesquisar':
                echo json_encode($this->relatoriosModel->pesquisarRelatorios($dados));

                break;

            case 'delete':
                echo json_encode($this->relatoriosModel->deleteRelatorios($dados));

                break;

        }
    }

    private function requisicoesRecibos($metodo, $dados) {
        switch ($metodo) {
            case 'retornaDados':
                echo json_encode($this->recibosModel->retornaDadosRecibos($dados));

                break;

            case 'save':
                echo json_encode($this->recibosModel->saveRecibo($dados));

                break;

            case 'buscarDados': 
                echo json_encode($this->recibosModel->searchRecibo($dados));
                
                break;

            case 'delete': 
                echo json_encode($this->recibosModel->deleteRecibo($dados));
                
                break;
        }
    }

    private function requisicoesTabelaHorti($metodo, $dados) {
        switch ($metodo) {
            case 'save':
                echo json_encode($this->hortifrutiModel->saveHortifruti($dados));

                break;

            case 'buscarDados':
                echo json_encode($this->hortifrutiModel->searchHortifruti($dados));

                break;

            case 'delete':
                echo json_encode($this->hortifrutiModel->deleteHortifruti($dados));

                break;
        }
    }

    private function requisicoesTabelaNotaAvulsa($metodo, $dados) {
        switch ($metodo) {
            case 'save': 
                echo json_encode($this->notaAvulsaModel->saveNotaAvulsa($dados));
                
                break;

            case 'buscarDados': 
                echo json_encode($this->notaAvulsaModel->searchNota($dados));
                
                break;

            case 'delete': 
                echo json_encode($this->notaAvulsaModel->deleteNota($dados));
                
                break;
        }
    }

}
?>