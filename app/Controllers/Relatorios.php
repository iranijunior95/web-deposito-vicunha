<?php

namespace App\Controllers;

use App\Models\ConferentesModel;
use App\Models\FornecedoresModel;
use App\Models\HortifrutiModel;
use App\Models\NotaAvulsaModel;
use App\Models\ProdutosModel;
use App\Models\RecibosModel;
use App\Models\SetoresModel;
use App\Models\RelatoriosModel;
use \Mpdf\Mpdf;

class Relatorios extends BaseController {

    protected $fornecedoresModel;
    protected $conferentesModel;
    protected $setoresModel;
    protected $produtosModel;
    protected $relatoriosModel;
    protected $recibosModel;
    protected $hortifrutiModel;
    protected $notaAvulsaModel;

    function __construct() {
        $this->fornecedoresModel = new FornecedoresModel();
        $this->conferentesModel = new ConferentesModel();
        $this->setoresModel = new SetoresModel();
        $this->produtosModel = new ProdutosModel();
        $this->relatoriosModel = new RelatoriosModel();
        $this->recibosModel = new RecibosModel();
        $this->hortifrutiModel = new HortifrutiModel();
        $this->notaAvulsaModel = new NotaAvulsaModel(); 
    }

    public function index() {
        $dados = [
            'titulo' => 'RELATÓRIOS', 
            'menu' => 'relatorios',
            'tela' => 'relatorios/view_relatorios',
            'fornecedores' => $this->fornecedoresModel->getAllFornecedores(),
            'conferentes' => $this->conferentesModel->getAllConferentes(),
            'css' => [
                '/assets/sistema/css/relatorios/style_view_relatorios.css'
            ],
            'js' => [
                '/assets/sistema/js/relatorios/script_view_relatorios.js'
            ]
        ];

        return view('view_index.php', $dados);
    }

    public function relatorio_lancamentos() {
        $dados = [
            'titulo' => 'RELATÓRIOS', 
            'menu' => 'relatorios',
            'tela' => 'relatorios/view_relatorios_lancamentos',
            'fornecedores' => $this->fornecedoresModel->getAllFornecedores(),
            'conferentes' => $this->conferentesModel->getAllConferentes(),
            'setores' => $this->setoresModel->getAllSetores(),
            'css' => [
                '/assets/sistema/css/relatorios/style_view_relatorios_lancamentos.css'
            ],
            'js' => [
                '/assets/sistema/js/relatorios/script_view_relatorios_lancamentos.js'
            ]
        ];

        return view('view_index.php', $dados);
    }

    public function imprimir_relatorio_lancamentos($id) {
        $dados['dadosRelatorio'] = $this->relatoriosModel->getByIdRelatorio($id);
                
        $mpdf = new Mpdf(['orientation' => 'L']);
        $html = view('telas/relatorios/view_imprimir_relatorios_lancamentos', $dados,[]);
		$mpdf->WriteHTML($html);
		$this->response->setHeader('Content-Type', 'application/pdf');
		$mpdf->Output($dados['dadosRelatorio'][0]['titulo_relatorio'].'-'.$dados['dadosRelatorio'][0]['data_relatorio'].'.pdf','I');
        
    }

    public function recibo_descarrego() {
        $dados = [
            'titulo' => 'RELATÓRIOS', 
            'menu' => 'relatorios',
            'tela' => 'relatorios/view_recibo_descarrego',
            'fornecedores' => $this->fornecedoresModel->getAllFornecedores(),
            'js' => [
                '/assets/sistema/js/relatorios/script_view_recibo_descarrego.js'
            ]
        ];

        return view('view_index.php', $dados);
    }

    public function imprimir_recibo_descarrego($id) {
        $dados['dadosRecibo'] = $this->recibosModel->getByIdRecibo($id);

        $mpdf = new Mpdf(['orientation' => '']);
        $html = view('telas/relatorios/view_imprimir_recibos_descarrego', $dados,[]);
		$mpdf->WriteHTML($html);
		$this->response->setHeader('Content-Type', 'application/pdf');
		$mpdf->Output($dados['dadosRecibo'][0]['nome_fornecedor'].'-'.$dados['dadosRecibo'][0]['data_entrada_recibo'].'.pdf','I');

    }

    public function tabela_hortifruti() {
        $dados = [
            'titulo' => 'RELATÓRIOS', 
            'menu' => 'relatorios',
            'tela' => 'relatorios/view_tabela_hortifruti',
            'produtos' => $this->produtosModel->getAllProdutos(),
            'conferentes' => $this->conferentesModel->getAllConferentes(),
            'css' => [
                '/assets/sistema/css/relatorios/style_view_tabela_hortifruti.css'
            ],
            'js' => [
                '/assets/sistema/js/relatorios/script_view_tabela_hortifruti.js'
            ]
        ];

        return view('view_index.php', $dados);
    } 

    public function imprimir_tabela_hortifruti($id) {
        $dados['dadosHortifruti'] = $this->hortifrutiModel->getByIdHortifruti($id);

        $mpdf = new Mpdf(['orientation' => '']);
        $html = view('telas/relatorios/view_imprimir_tabela_hortifruti', $dados,[]);
		$mpdf->WriteHTML($html);
		$this->response->setHeader('Content-Type', 'application/pdf');
		$mpdf->Output($dados['dadosHortifruti'][0]["titulo_hortifruti"].'.pdf','I');
        

    }

    public function tabela_nota_avulsa() {
        $dados = [
            'titulo' => 'RELATÓRIOS', 
            'menu' => 'relatorios',
            'tela' => 'relatorios/view_tabela_nota_avulsa',
            'produtos' => $this->produtosModel->getAllProdutos(),
            'fornecedores' => $this->fornecedoresModel->getAllFornecedores(),
            'conferentes' => $this->conferentesModel->getAllConferentes(),
            'css' => [
                '/assets/sistema/css/relatorios/style_view_tabela_nota_avulsa.css'
            ],
            'js' => [
                '/assets/sistema/js/relatorios/script_view_tabela_nota_avulsa.js'
            ]
        ];

        return view('view_index.php', $dados);
    }

    public function imprimir_tabela_nota_avulsa($id) {
        $dados['dadosNotaAvulsa'] = $this->notaAvulsaModel->getByIdNotaAvulsa($id);

        $mpdf = new Mpdf(['orientation' => '']);
        $html = view('telas/relatorios/view_imprimir_tabela_nota_avulsa', $dados,[]);
		$mpdf->WriteHTML($html);
		$this->response->setHeader('Content-Type', 'application/pdf');
		$mpdf->Output($dados['dadosNotaAvulsa'][0]["titulo_nota_avulsa"].'.pdf','I');
        
    }

}
