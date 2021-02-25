<form method="POST" style="display: inline">
    <input name="<?= $this->ID_CHAVE ?>" value="<?= $dado[$this->ID_CHAVE] ?>" hidden>
    <? if (isset($dado['ITEM_UTILIZADO']) && !$dado['ITEM_UTILIZADO']) { ?>
        <input name="ACAO" value="Editar" type="submit">
        <input name="ACAO" value="Excluir" type="submit">
    <? } ?>
</form>