<?php

namespace App\Controllers;

class Home extends BaseController {

    public function index() {
        $dados = [
            'titulo' => 'HOME',
            'menu' => 'home',
            'tela' => 'view_home'
        ];

        return view('view_index.php', $dados);
    }
}
