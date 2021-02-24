<? require_once __DIR__ . '/mensagemAcao.php'; ?>
<h1><?= $this->descricao ?></h1>
<table border="1" style="min-width: <?= $this->listarLargura ?>px">
    <tr style=" vertical-align: top">
        <? if ($this->listarMostrar) { ?>
            <td style="text-align: right; padding-right: 10px">
                <h2 style="text-align: center">Listar</h2> 
                <?
                require_once __DIR__ . '/mensagemSemDadosListar.php';
                $this->tamplateLista();
                ?>
            </td>
        <? } ?>
        <td style="padding-left: 10px">
            <h2 style="text-align: center;"><?= $this->acaoDescricao ?></h2> 
            <form method="POST">
                <input type="text" name="<?= $this->ID_CHAVE ?>" value="<?= @$this->dado[$this->ID_CHAVE] ?>" hidden>
                <? require_once __DIR__ . '/' . CLASSE . '/' . strtolower(CLASSE) . '-formulario.php'; ?>
                <hr>
                <div style="border: 0px solid; text-align: center">
                    <input name="ACAO" value="<?= $this->acaoDescricao ?>" type="submit">
                </div>
            </form>
        </td>
    </tr>
</table>