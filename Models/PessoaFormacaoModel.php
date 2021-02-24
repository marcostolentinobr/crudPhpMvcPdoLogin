<?

class PessoaFormacaoModel extends Model {

    public $tabela = 'PESSOA_FORMACAO';
    public $chave = 'ID_PESSOA';

    public function incluirPessoaFormacao($okPessoa) {
        if (!$okPessoa) {
            return $okPessoa;
        }
        $this->dado['ID_PESSOA'] = coalesce($_POST['ID_PESSOA'], $this->pdo()->lastInsertId());
        if (!parent::excluir()) {
            return 0;
        }
        if (isset($_POST['ID_FORMACAO'])) {
            foreach ($_POST['ID_FORMACAO'] as $ID_FORMACAO) {
                $this->dado['ID_FORMACAO'] = $ID_FORMACAO;
                if (!parent::incluir()) {
                    return 0;
                }
            }
        }
        return $okPessoa;
    }

}
