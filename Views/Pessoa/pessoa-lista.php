<table border="1">
    <tr>
        <th>Nome</th>
        <th>Curso</th>
        <th>Formações</th>
        <th>Pontos</th>
        <th>Ações</th>
    </tr>
    <? while ($dado = $this->qry->fetch(PDO::FETCH_ASSOC)) { ?>
        <tr>
            <td><?= reticencias($dado['NOME'], 30) ?></td>
            <td><?= reticencias($dado['CUR_NOME'], 30) ?></td>
            <td><?= $dado['FORMACAO_QUANTIDADE'] ?></td>
            <td><?= $dado['FORMACAO_PONTOS'] ?></td>
            <td><? require __DIR__ . '/../botoesLista.php'; ?></td>
        </tr>
    <? } ?>

</table>