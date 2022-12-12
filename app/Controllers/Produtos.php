<?php

namespace App\Controllers;

use App\Models\ProdutosModel;

class Produtos extends BaseController {

    protected $produtosModel;

    public function __construct() {
       $this->produtosModel = new ProdutosModel();
    }

    public function index() {

        $dados = [
            'titulo' => 'PRODUTOS',
            'menu' => 'cadastros',
            'tela' => 'produtos/view_produtos',
            'listaProdutos' => $this->produtosModel->getAllProdutos(),
            'css' => [
                '/assets/sistema/css/produtos/style_view_produtos.css'
            ],
            'js' => [
                '/assets/sistema/js/produtos/script_view_produtos.js'
            ]
        ];

        return view('view_index.php', $dados);
    }
}