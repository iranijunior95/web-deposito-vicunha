<?php

namespace App\Controllers;

use App\Models\ConferentesModel;

class Conferentes extends BaseController {

    protected $conferentesModel;

    public function __construct() {
       $this->conferentesModel = new ConferentesModel();
    }

    public function index() {

        $dados = [
            'titulo' => 'CONFERENTES',
            'menu' => 'cadastros',
            'tela' => 'conferentes/view_conferentes',
            'listaConferentes' => $this->conferentesModel->getAllConferentes(),
            'css' => [
                '/assets/sistema/css/conferentes/style_view_conferentes.css'
            ],
            'js' => [
                '/assets/sistema/js/conferentes/script_view_conferentes.js'
            ]
        ];

        return view('view_index.php', $dados);
    }
}
