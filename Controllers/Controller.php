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

    public function __construct() {
        $this->acao();
    }

    private function acao() {

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
        }
    }

    public function tamplateLista() {
        require_once __DIR__ . '/../Views/tamplateLista.php';
    }

    public function listar() {
        $this->qry = $this->Model->listar();
        require_once RAIZ . '/Views/templatePadrao.php';
    }

}
