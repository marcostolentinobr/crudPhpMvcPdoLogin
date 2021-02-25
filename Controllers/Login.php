<?php

class Login extends Controller {

    protected $descricao = '';
    protected $acaoDescricao = 'Acessar';
    protected $listarMostrar = false;
    protected $listarLargura = 200;

    public function sair($redirecionar = true) {
        session_destroy();
        session_start();

        //Caso não exista usuario logado, logue antes
        if ($redirecionar) {
            header('Location: ' . URL . 'Login/acessar');
        }
    }

    protected function acao() {
        parent::acao();

        try {
            //ACESSAR
            if ($this->acaoDescricaoPost == 'Acessar') {
                //Caso for acessar já destruir a sessão
                $this->sair(false);

                //Dados
                $dado = $this->Model->dado($_POST, __METHOD__);

                //Where
                $this->where = [
                    'CPF' => $dado['CPF'],
                    'SENHA' => $dado['SENHA']
                ];

                //Executa
                $this->dado = @$this->Model->listar($this->where, true)[0];

                //Caso existe usuario e senha salva na sessão
                if ($this->dado) {
                    $_SESSION['USUARIO'] = $this->dado;
                    header('Location: ' . URL);
                }
                //Caso contrário mostrar que os dados não conferem
                else {
                    throw new Exception("<div style='color: black'>Dados não conferem</div>");
                }

                $this->msgOk = @$_SESSION['msgOk'] = 'Acesso autorizado';
                $this->ok = @$_SESSION['ok'] = isset($this->dado);
            }
        } catch (Exception $ex) {
            $this->msgException = $ex->getMessage();
        }
    }

    public function acessar() {
        require_once RAIZ . '/Views/templatePadrao.php';
    }

}
