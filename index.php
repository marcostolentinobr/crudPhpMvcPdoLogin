<?
session_start();

//BANCO DE DADOS
define('DB_LIB', 'mysql');
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'CRUD');
define('DB_CHARSET', 'utf8');
define('DB_USER', 'root');
define('DB_PASS', '');

//PRINT_R
function pr($dado, $print_r = true) {
    echo '<pre style="text-align: left">';
    if ($print_r) {
        print_r($dado);
    } else {
        var_dump($dado);
    }
    echo '</pre>';
}

//Acrescenta reticencias quando chegar a uma quantidade definida
function reticencias($descricao, $tamanhoMaximo) {
    if (strlen($descricao) > $tamanhoMaximo) {
        return substr($descricao, 0, $tamanhoMaximo) . '...';
    }
    return $descricao;
}

//Se não for um vai o outro
function coalesce() {
    foreach (func_get_args() as $arg) {
        if (!empty($arg) || $arg === 0 || $arg === '0') {
            return $arg;
        }
    }
    return null;
}

//Instancia Model
function instanciaModel($classe, $pdo = '') {
    require_once RAIZ . "/Models/{$classe}Model.php";
    $classe = "{$classe}Model";
    return new $classe($pdo);
}

//URL
$url = [];
if (isset($_GET['pg'])) {
    $url = explode('/', $_GET['pg']);
}
define('CLASSE', isset($url[0]) ? $url[0] : '');
define('METODO', isset($url[1]) ? $url[1] : '');

//DIRETORIO RAIZ
define('RAIZ', __DIR__);

//URL
$protocolo = (strpos(strtolower($_SERVER['SERVER_PROTOCOL']), 'https') === false) ? 'http' : 'https';
$url = $protocolo . '://' . $_SERVER['HTTP_HOST'] . str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
define('URL', $url);

//Caso não exista usuario logado, logue antes
if (@!$_SESSION['USUARIO'] && CLASSE != 'Login') {
    header('Location: ' . URL . 'Login/acessar');
}
?>

<style>
    label {
        font-weight: bold;
        display: block;
    }
    select, textarea {
        width: 173px;        
    }
</style>
<center>
    <BR>
    <a href="<?= URL ?>Index">INÍCIO</a> |
    <a href="<?= URL ?>Curso/listar">CURSO</a> |
    <a href="<?= URL ?>Formacao/listar">FORMAÇÃO</a> |
    <a href="<?= URL ?>Pessoa/listar">PESSOA</a> | 
    <small> <a href="<?= URL ?>Login/sair">sair</a> </small>
    <BR>
    <?
    //Model
    $FileModel = 'Models/' . CLASSE . 'Model.php';
    if (file_exists($FileModel)) {
        require_once 'Models/Model.php';
        require_once $FileModel;
    }

    //Controller
    $FileControler = 'Controllers/' . CLASSE . '.php';
    if (file_exists($FileControler)) {
        require_once 'Controllers/Controller.php';
        require_once $FileControler;
    }

    //Classe
    $Classe = CLASSE;
    if (class_exists($Classe)) {
        $Classe = new $Classe();

        //Metodo
        $Metodo = METODO;
        if (method_exists($Classe, $Metodo)) {
            $Classe->$Metodo();
        }
    }
    //Não existe classe
    else {
        echo '<h2>1ª Cadastre os cursos</h2>';
        echo '<h2>2ª Cadastre as formações</h2>';
        echo '<h2>3ª Cadastre as pessoas</h2>';
    }
    ?>
</center>