<h2 style="text-align: center;"><?= $this->acaoDescricao ?></h2> 
<form method="POST">
    <input type="text" name="<?= $this->ID_CHAVE ?>" value="<?= @$this->dado[$this->ID_CHAVE] ?>" hidden>
    <? require_once __DIR__ . '/' . CLASSE . '/' . strtolower(CLASSE) . "-formulario{$this->arquivoForm}.php"; ?>
    <hr>
    <div style="border: 0px solid; text-align: center">
        <input name="ACAO" value="<?= $this->acaoDescricao ?>" type="submit">
    </div>
</form>