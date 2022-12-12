<?php

namespace App\Controllers;

use App\Models\FornecedoresModel;

class Fornecedores extends BaseController {

    protected $fornecedoresModel;

    public function __construct() {
       $this->fornecedoresModel = new FornecedoresModel();
    }

    public function index() {

        $dados = [
            'titulo' => 'FORNECEDORES',
            'menu' => 'cadastros',
            'tela' => 'fornecedores/view_fornecedores',
            'listafornecedores' => $this->fornecedoresModel->getAllFornecedores(),
            'css' => [
                '/assets/sistema/css/fornecedores/style_view_fornecedores.css'
            ],
            'js' => [
                '/assets/sistema/js/fornecedores/script_view_fornecedores.js'
            ]
        ];

        return view('view_index.php', $dados);
    }
}
