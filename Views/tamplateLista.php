<?

while ($dado = $this->qry->fetch(PDO::FETCH_ASSOC)) {
    require __DIR__ . '/' . CLASSE . '/' . strtolower(CLASSE) . '-lista.php';
    require __DIR__ . '/botoesLista.php';
    echo '<hr>';
}