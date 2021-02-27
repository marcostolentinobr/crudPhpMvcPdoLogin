<?php

class UsuarioModel extends Model {

    public $tabela = 'USUARIO';
    public $chave = 'ID_USUARIO';

    //DADOS
    protected function dado($dado, $metodo = __METHOD__) {

        //SENHA - Obrigatório e até 20 caracteres
        $this->dado['SENHA'] = campo($dado['SENHA']);
        $this->campoValidacao('SENHA', 20);

        //Caso exista a variavel SENHA_ATUAL então é alteração de senha
        if (isset($dado['SENHA_ATUAL'])) {
            //Senha tem que ser a mesma que a senha da sessão
            if ($dado['SENHA_ATUAL'] != getSession('SENHA')) {
                $this->erro['CPF'] = 'Senha atual inválida';
            }
        } else {
            //NOME - Obrigatório e até 50 caracteres
            $this->dado['NOME'] = ucwords(mb_strtolower(campo($dado['NOME'], 'S')));
            $this->campoValidacao('NOME', 50, true, false, 7);
            if (!nomeSobreNomeValidar($this->dado['NOME'])) {
                $this->erro['Nome'] = 'É necessário nome e sobrenome';
            }

            //CPF - Obrigatório e válido
            $this->dado['CPF'] = ucwords(mb_strtolower(campo($dado['CPF'], 'I')));
            if (!cpfValidar($this->dado['CPF'])) {
                $this->erro['CPF'] = 'CPF inválido';
            }

            //CPF - Já existe?
            if (!$this->erro && $metodo != 'Model::alterar') {
                $sql = "SELECT CPF FROM USUARIO WHERE CPF = '{$this->dado['CPF']}' LIMIT 1";
                if ($this->listarRetorno($sql)) {
                    $this->erro['CPF'] = 'Já cadastrado';
                }
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
