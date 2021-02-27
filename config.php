<?

session_start();

//BANCO DE DADOS
define('DB_LIB', 'mysql');
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'CRUD');
define('DB_CHARSET', 'utf8');
define('DB_USER', 'root');
define('DB_PASS', '');

//Funções
require_once 'funcoes.php';

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
    //Pode acessar a classe usuário para cadastrar algum
    if (CLASSE != 'Usuario') {
        header('Location: ' . URL . 'Login/acessar');
    }
}