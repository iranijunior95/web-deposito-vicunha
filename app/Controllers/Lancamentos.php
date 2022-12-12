<?php

namespace App\Controllers;

use App\Models\ConferentesModel;
use App\Models\FornecedoresModel;
use App\Models\LancamentosModel;
use App\Models\SetoresModel;

class Lancamentos extends BaseController {

    protected $lancamentosModel;
    protected $fornecedoresModel;
    protected $conferentesModel;
    protected $setoresModel;

    function __construct() {
        $this->lancamentosModel = new LancamentosModel();
        $this->fornecedoresModel = new FornecedoresModel();
        $this->conferentesModel = new ConferentesModel();
        $this->setoresModel = new SetoresModel();
    }

    public function index() {

        $dados = [
            'titulo' => 'LANÇAMENTOS',
            'menu' => 'lancamentos',
            'tela' => 'lancamentos/view_lancamentos',
            'fornecedores' => $this->fornecedoresModel->getAllFornecedores(),
            'conferentes' => $this->conferentesModel->getAllConferentes(),
            'setores' => $this->setoresModel->getAllSetores(),
            'listaLancamentos' => $this->lancamentosModel->getAllLancamentosDoDia(),
            'css' => [
                '/assets/sistema/css/lancamentos/style_view_lancamentos.css'
            ],
            'js' => [
                '/assets/sistema/js/lancamentos/script_view_lancamentos.js'
            ]
        ];

        return view('view_index.php', $dados);
    }

    public function form_cadastrar() {
        $dados = [
            'titulo' => 'LANÇAMENTOS',
            'menu' => 'lancamentos',
            'tela' => 'lancamentos/view_form_cadastrar_lancamentos',
            'fornecedores' => $this->fornecedoresModel->getAllFornecedores(),
            'conferentes' => $this->conferentesModel->getAllConferentes(),
            'setores' => $this->setoresModel->getAllSetores(),
            'js' => [
                '/assets/sistema/js/lancamentos/script_view_form_cadastrar_lancamentos.js'
            ]
        ];

        return view('view_index.php', $dados);
    }

    public function form_editar($id) {
        $dados = [
            'titulo' => 'LANÇAMENTOS',
            'menu' => 'lancamentos',
            'tela' => 'lancamentos/view_form_editar_lancamentos',
            'fornecedores' => $this->fornecedoresModel->getAllFornecedores(),
            'conferentes' => $this->conferentesModel->getAllConferentes(),
            'setores' => $this->setoresModel->getAllSetores(),
            'lancamentos' => $this->lancamentosModel->getLancamentosById($id),
            'js' => [
                '/assets/sistema/js/lancamentos/script_view_form_editar_lancamentos.js'
            ]
        ];

        return view('view_index.php', $dados);
    }

    public function detalhes($id) {
        $dados = [
            'titulo' => 'LANÇAMENTOS',
            'menu' => 'lancamentos',
            'tela' => 'lancamentos/view_detalhes_lancamentos',
            'lancamentos' => $this->lancamentosModel->getLancamentosById($id),
            'js' => [
                '/assets/sistema/js/lancamentos/script_view_detalhes_lancamentos.js'
            ]
        ];

        return view('view_index.php', $dados);
    }

    public function test() {
        $dados = "AND valor_nota >= '0,01' AND valor_nota <= '0,11'";
        echo json_encode($this->lancamentosModel->pesquisarLancamento($dados));
    }
}
