<?php

namespace App\Controllers;

use App\Models\SetoresModel;

class Setores extends BaseController {

    protected $setoresModel;

    public function __construct() {
       $this->setoresModel = new SetoresModel();
    }

    public function index() {
        $dados = [
            'titulo' => 'SETORES',
            'menu' => 'cadastros',
            'tela' => 'setores/view_setores',
            'listaSetores' => $this->setoresModel->getAllSetores(),
            'css' => [
                '/assets/sistema/css/setores/style_view_setores.css'
            ],
            'js' => [
                '/assets/sistema/js/setores/script_view_setores.js'
            ]
        ];

        return view('view_index.php', $dados);
    }
}