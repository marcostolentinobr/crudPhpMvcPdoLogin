<?

if ($this->ok == 1) {
    echo "<h3 style='color: green'>$this->msgOk com sucesso!</h3>";
} elseif ($this->msgException) {
    echo "<h3 style='color: red'>Não foi possível $this->acaoDescricaoPost! <br><small>$this->msgException</small></h3>";
}