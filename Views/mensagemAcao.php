<?

if (coalesce($this->ok, @$_SESSION['msgOk']) == 1) {
    echo "<h3 style='color: green'>" . coalesce($this->msgOk, @$_SESSION['msgOk']) . " com sucesso!</h3>";
} elseif ($this->msgException) {
    echo "<h3 style='color: red'>Não foi possível $this->acaoDescricaoPost! <br><small>$this->msgException</small></h3>";
}