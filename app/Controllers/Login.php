<?php

namespace App\Controllers;

class Login extends BaseController {
    
    public function index() {
        if(session()->logado === true) {
            return redirect()->to(base_url('home'));
        }

        return view('telas/login/view_login.php');
    }

    public function logout() {
        session()->destroy();

        return redirect()->to(base_url('login'));
    }

    public function contatar_suporte() {
        if(session()->logado === true) {
            return redirect()->to(base_url('home'));
        }

        return view('telas/login/view_contatar_suporte.php');
    }

}
