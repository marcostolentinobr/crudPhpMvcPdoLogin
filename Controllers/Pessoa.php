<?php

class Pessoa extends Controller {

    protected $descricao = 'Pessoa';
    //Curso
    private $Curso;
    protected $cursoLista;
    //Formacao
    protected $Formacao;
    protected $formacaoLista;
    //PessoaFormacao
    protected $PessoaFormacao;
    public $pessoaFormacaoLista;

    public function __construct() {
        parent::__construct();

        $this->Curso = instanciaModel('Curso');
        $this->cursoLista = $this->Curso->listar([], true);

        $this->Formacao = instanciaModel('Formacao');
        $this->formacaoLista = $this->Formacao->listar([], true);

        if ($this->where) {
            $this->PessoaFormacao = instanciaModel('PessoaFormacao');
            $pessoaFormacaoLista = $this->PessoaFormacao->listar($this->where, true);
            foreach ($pessoaFormacaoLista as $pessoaFormacao) {
                $this->pessoaFormacaoLista[$pessoaFormacao['ID_FORMACAO']] = $pessoaFormacao;
            }
        }
    }

    public function tamplateLista() {
        require __DIR__ . '/../Views/' . CLASSE . '/' . strtolower(CLASSE) . '-lista.php';
    }

}
