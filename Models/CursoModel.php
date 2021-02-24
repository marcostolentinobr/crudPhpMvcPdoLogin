<?php

class CursoModel extends Model {

    public $tabela = 'CURSO';
    public $chave = 'ID_CURSO';

    //DADOS
    protected function dado($dado, $metodo = __METHOD__) {

        //NOME - Obrigatório e até 100 caracteres
        $this->dado['NOME'] = ucwords(mb_strtolower(trim($dado['NOME'])));
        $this->campoValidacao('NOME');

        //NOME - Já existe?
        if (!$this->erro && $metodo != 'Model::alterar') {
            $sql = "SELECT NOME FROM CURSO WHERE NOME = '{$this->dado['NOME']}' LIMIT 1";
            if ($this->listarRetorno($sql)) {
                $this->erro['Nome'] = 'Já cadastrado';
            }
        }

        return $this->dadosValidacao();
    }

    public function listar($valores = [], $todos = false) {
        $sql = "
            SELECT C.*,
                   (SELECT COUNT(*) FROM PESSOA P WHERE P.ID_CURSO = C.ID_CURSO) AS ITEM_UTILIZADO
              FROM CURSO C 
        ";
        return $this->listarRetorno($sql, $valores, $todos);
    }

}
