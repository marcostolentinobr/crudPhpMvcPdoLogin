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
            <? require_once 'tamplateFormulario.php' ?>
        </td>
    </tr>
</table>