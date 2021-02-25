<?php

class UsuarioModel extends Model {

    public $tabela = 'USUARIO';
    public $chave = 'ID_USUARIO';

    //DADOS
    protected function dado($dado, $metodo = __METHOD__) {

        //NOME - Obrigatório e até 50 caracteres
        $this->dado['NOME'] = ucwords(mb_strtolower(campo($dado['NOME'], 'S')));
        $this->campoValidacao('NOME', 50, true, false, 7);
        if (!nomeSobreNomeValidar($this->dado['NOME'])) {
            $this->erro['Nome'] = 'É necessário nome e sobrenome';
        }

        //NOME - Obrigatório e até 100 caracteres
        $this->dado['CPF'] = ucwords(mb_strtolower(campo($dado['CPF'], 'I')));
        //$this->campoValidacao('CPF', 11, true, true, 11);
        if (!cpfValidar($this->dado['CPF'])) {
            $this->erro['CPF'] = 'CPF inválido';
        }

        //SENHA - Obrigatório e até 20 caracteres
        $this->dado['SENHA'] = ucwords(mb_strtolower(campo($dado['SENHA'])));
        $this->campoValidacao('SENHA', 20);

        //CPF - Já existe?
        if (!$this->erro && $metodo != 'Model::alterar') {
            $sql = "SELECT CPF FROM USUARIO WHERE CPF = '{$this->dado['CPF']}' LIMIT 1";
            if ($this->listarRetorno($sql)) {
                $this->erro['CPF'] = 'Já cadastrado';
            }
        }

        return $this->dadosValidacao();
    }

    public function listar($valores = [], $todos = false) {
        $sql = "
            SELECT U.*
              FROM USUARIO U 
        ";
        return $this->listarRetorno($sql, $valores, $todos);
    }

}
