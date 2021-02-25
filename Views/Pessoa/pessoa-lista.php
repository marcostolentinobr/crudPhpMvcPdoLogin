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
            <td>
                <span class="sublinhadoPointer" 
                      title="<?= "$dado[NOME]&#013;Observação: $dado[OBSERVACAO]" ?>" 
                      >
                          <?= reticencias($dado['NOME'], 15) ?>
                </span>
            </td>
            <td><?= reticencias($dado['CUR_NOME'], 15) ?></td>
            <td><?= $dado['FORMACAO_QUANTIDADE'] ?></td>
            <td><?= $dado['FORMACAO_PONTOS'] ?></td>
            <td>
                <?
                if (getSession('ID_USUARIO') == $dado['ID_USUARIO']) {
                    require __DIR__ . '/../botoesLista.php';
                } else {
                    echo '
                        <small class="sublinhadoPontilhadoPointer"
                               title="Cadastrado por: ' . $dado['USU_NOME'] . '"
                        >
                                Não pode alterar
                        </small>
                    ';
                }
                ?>
            </td>
        </tr>
    <? } ?>

</table>