<label>Nome:</label>
<input type="text" name="NOME" value="<?= @$this->dado['NOME'] ?>" autofocus minlength="3" maxlength="50" required><br>
<label>Curso:</label>
<select name="ID_CURSO" required>
    <option></option>
    <? foreach ($this->cursoLista as $curso) { ?>
        <option value="<?= $curso['ID_CURSO'] ?>" <?= (@$this->dado['ID_CURSO'] == $curso['ID_CURSO'] ? 'selected' : '') ?>><?= $curso['NOME'] ?></option>
    <? } ?>
</select><br>
<label style="font-weight: normal">Formação:</label>
<select name="ID_FORMACAO[]" multiple>
    <? foreach ($this->formacaoLista as $formacao) { ?>
        <option value="<?= $formacao['ID_FORMACAO'] ?>" <?= (isset($this->pessoaFormacaoLista[$formacao['ID_FORMACAO']]) ? 'selected' : '') ?>><?= $formacao['NOME'] ?></option>
    <? } ?>
</select><br>
<label style="font-weight: normal">Observação:</label>
<textarea maxlength="1000" style="height: 100px" name="OBSERVACAO"><?= @$this->dado['OBSERVACAO'] ?></textarea>