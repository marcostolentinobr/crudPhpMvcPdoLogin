<?php

class Controller {

    protected $qry;
    protected $msgOk;
    protected $acaoDescricaoPost;
    protected $msgException;
    protected $ok;
    protected $Model;
    protected $dado;
    protected $where;
    protected $acaoDescricao = 'Incluir';
    protected $ID_CHAVE;
    protected $listarMostrar = true;
    protected $listarLargura = 500;
    protected $arquivoForm = '';

    public function __construct() {
        $this->acao();
    }

    protected function acao() {

        $Classe = CLASSE . 'Model';
        $this->Model = new $Classe();

        $this->ID_CHAVE = $this->Model->chave;
        if (!isset($_POST['ACAO'])) {
            return;
        }
        $this->acaoDescricaoPost = $_POST['ACAO'];
        try {
            //INCLUIR
            if ($this->acaoDescricaoPost == 'Incluir') {
                $this->msgOk = 'Incluído';
                $this->ok = $this->Model->incluir();
            }
            //ALTERAR
            elseif ($this->acaoDescricaoPost == 'Alterar') {
                $this->msgOk = 'Alterado';
                $this->ok = $this->Model->alterar();
                $this->dado = $this->Model->getDados();
                $this->acaoDescricao = 'Incluir';
            }
            //EXCLUIR
            elseif ($this->acaoDescricaoPost == 'Excluir') {
                $this->msgOk = 'Excluído';
                $this->ok = $this->Model->excluir();
            }
            //EDITAR
            elseif ($this->acaoDescricaoPost == 'Editar') {
                $this->where = [$this->ID_CHAVE => $_POST[$this->ID_CHAVE]];
                $this->dado = $this->Model->listar($this->where, true)[0];
                $this->acaoDescricao = 'Alterar';
            }
        } catch (Exception $ex) {
            $this->msgException = $ex->getMessage();
            //Caso der erro manter os dados para tratar os erros
            $this->acaoDescricao = $_POST['ACAO'];
            $this->dado = $_POST;
        }
        $this->executaPosAcao();
    }

    protected function executaPosAcao() {
        
    }

    protected function requireForm($arquivo, $acaoDescricao) {
        $this->acaoDescricao = $acaoDescricao;
        $this->arquivoForm = "-$arquivo";
        require_once RAIZ . '/Views/mensagemAcao.php';
        require_once RAIZ . '/Views/tamplateFormulario.php';
    }

    protected function tamplateLista() {
        require_once __DIR__ . '/../Views/tamplateLista.php';
    }

    public function listar() {
        if ($this->listarMostrar) {
            $this->qry = $this->Model->listar();
        }
        require_once RAIZ . '/Views/templatePadrao.php';
    }

}
