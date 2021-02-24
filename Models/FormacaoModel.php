<?php

class FormacaoModel extends Model {

    public $tabela = 'FORMACAO';
    public $chave = 'ID_FORMACAO';

    //DADOS
    protected function dado($dado, $metodo = __METHOD__) {

        //NOME - Obrigatório e até 100 caracteres
        $this->dado['NOME'] = ucwords(mb_strtolower(trim($dado['NOME'])));
        $this->campoValidacao('NOME');

        //PONTO - Obrigatório e até 100 caracteres
        $this->dado['PONTO'] = trim($dado['PONTO']);
        $this->campoValidacao('PONTO', 3, true, true);

        //APENAS INCLUIR
        if (!$this->erro && $metodo != 'Model::alterar') {
            //NOME - Já existe?
            $sql = "SELECT PONTO FROM FORMACAO WHERE NOME = '{$this->dado['NOME']}' LIMIT 1";
            if ($this->listarRetorno($sql)) {
                $this->erro['Nome'] = 'Já cadastrado';
            }

            //PONTO - Já existe?
            $sql = "SELECT PONTO FROM FORMACAO WHERE PONTO = '{$this->dado['PONTO']}' LIMIT 1";
            if ($this->listarRetorno($sql)) {
                $this->erro['Ponto'] = 'Já cadastrado';
            }
        }

        return $this->dadosValidacao();
    }

    public function listar($valores = [], $todos = false) {
        $sql = "
            SELECT F.*,
                   (SELECT COUNT(*) FROM PESSOA_FORMACAO PF WHERE PF.ID_FORMACAO = F.ID_FORMACAO) AS ITEM_UTILIZADO
              FROM FORMACAO F 
        ";
        $this->addOrder('F.PONTO DESC');
        return $this->listarRetorno($sql, $valores, $todos);
    }

}
