<?php

class LoginModel extends Model {

    public $tabela = 'USUARIO';
    public $chave = 'ID_USUARIO';

    //DADOS
    public function dado($dado, $metodo = __METHOD__) {
        //CPF  - numero, obrigatório e 11 digitos
        $this->dado['CPF'] = trim($dado['CPF']);
        $this->campoValidacao('CPF', 11, true, true, 11);

        //SENHA  - obrigatório de 3 ate 20 caracteres
        $this->dado['SENHA'] = trim($dado['SENHA']);
        $this->campoValidacao('SENHA', 20, true, false, 3);
        
        return $this->dadosValidacao();
    }

}
