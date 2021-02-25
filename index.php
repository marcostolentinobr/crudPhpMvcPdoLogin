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

//Acrescenta uma mascara pára algum dado
function mascara($mask, $str) {
    $str = str_replace(' ', '', $str);
    for ($i = 0; $i < strlen($str); $i++) {
        @$mask[strpos($mask, '#')] = $str[$i];
    }
    return $mask;
}

//Formata uma data passada para um tipo determinado
function dataFormatar($string, $tipo = 'B', $hora = false) {
    $retorno = '';
    try {
        $date = explode('/', $string);
        if (count($date) == 3) {
            $string = $date[2] . '-' . $date[1] . '-' . $date[0];
        }
        $string = trim($string);
        if ($string != '') {
            $string = new DateTime($string);
            if ($tipo == 'HM') {
                return $string->format('H:i');
            } else if ($tipo == 'B') {
                return $string->format('Y-m-d');
            } else {
                $dataReturn = $string->format('d/m/Y');
                if ($hora && ($string->format('H') != '00' || $string->format('i') != '00' || $string->format('s') != '00')) {
                    $dataReturn .= ' às ' . $string->format('H:i:s');
                }
                $retorno = $dataReturn;
            }
        }
    } catch (Exception $ex) {
        $retorno = '';
    }
    return $retorno;
}

//Formata algum numero passado
function numeroFormatar($numero, $decimal = 2) {
    return number_format(mCoalesce($numero, 0), $decimal, ',', '.');
}

//Retorna a UF
function getUf($uf = '') {
    $estados = array();
    $estados['AC'] = 'ACRE';
    $estados['AL'] = 'ALAGOAS';
    $estados['AP'] = 'AMAPÁ';
    $estados['AM'] = 'AMAZONAS';
    $estados['BA'] = 'BAHIA';
    $estados['CE'] = 'CEARÁ';
    $estados['DF'] = 'DISTRITO FEDERAL';
    $estados['ES'] = 'ESPÍRITO SANTO';
    $estados['GO'] = 'GOIÁS';
    $estados['MA'] = 'MARANHÃO';
    $estados['MT'] = 'MATO GROSSO';
    $estados['MS'] = 'MATO GROSSO DO SUL';
    $estados['MG'] = 'MINAS GERAIS';
    $estados['PA'] = 'PARÁ';
    $estados['PB'] = 'PARAÍBA';
    $estados['PR'] = 'PARANÁ';
    $estados['PE'] = 'PERNAMBUCO';
    $estados['PI'] = 'PIAUÍ';
    $estados['RJ'] = 'RIO DE JANEIRO';
    $estados['RN'] = 'RIO GRANDE DO NORTE';
    $estados['RS'] = 'RIO GRANDE DO SUL';
    $estados['RO'] = 'RONDÔNIA';
    $estados['RR'] = 'RORAIMA';
    $estados['SC'] = 'SANTA CATARINA';
    $estados['SP'] = 'SÃO PAULO';
    $estados['SE'] = 'SERGIPE';
    $estados['TO'] = 'TOCANTINS';
    if (!empty($uf)) {
        return isset($estados[$uf]) ? $estados[$uf] : '';
    }
    return $estados;
}

//Valida CPF
function cpfValidar($cpf = null) {
    if (empty($cpf)) {
        return false;
    }
    $cpf = preg_replace('[^0-9]', '', $cpf);
    $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
    if (strlen($cpf) != 11) {
        return false;
    } else if ($cpf == '00000000000' ||
            $cpf == '11111111111' ||
            $cpf == '22222222222' ||
            $cpf == '33333333333' ||
            $cpf == '44444444444' ||
            $cpf == '55555555555' ||
            $cpf == '66666666666' ||
            $cpf == '77777777777' ||
            $cpf == '88888888888' ||
            $cpf == '99999999999') {
        return false;
    } else {
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf{$c} * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf{$c} != $d) {
                return false;
            }
        }
        return true;
    }
    return false;
}

//Valida nome e sobre 
function nomeSobreNomeValidar($nomeSobrenome) {
    list($nome, $sobrenome) = explode(' ', $nomeSobrenome . ' ');
    $nome = trim($nome);
    $sobrenome = trim($sobrenome);
    if (empty($nome) || empty($sobrenome)) {
        return false;
    }
    return true;
}

//Pre define campos
function campo($elemento, $tipo = '', $maiuscula = false, $decimal = 2) {
    //Inteiro
    if ($tipo == 'I') {
        $elemento = str_replace(' ', '', preg_replace('/[^0-9\s]/', '', $elemento));
    }
    //Número
    if ($tipo == 'N') {
        $elemento = (@is_nan($elemento) ? 0 : numeroFormatar($elemento, $decimal));
    }
    //Letras
    if ($tipo == 'S') {
        $elemento = str_replace(array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9'), '', $elemento);
    }
    //Letras
    if ($tipo == 'S') {
        $elemento = str_replace(array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9'), '', $elemento);
    }
    //Data - banco com hora
    elseif ($tipo == 'D') {
        $elemento = dataFormatar($elemento);
    }
    //HORA - mostrar
    elseif ($tipo == 'HM') {
        $elemento = dataFormatar($elemento, 'HM', true);
    }
    //Data - mostrar
    elseif ($tipo == 'DM') {
        $elemento = dataFormatar($elemento, 'M', true);
    }
    //Data - mostrar
    elseif ($tipo == 'F') {
        $elemento = str_replace('() -', '', str_replace('#', '', mascara('(##) ####-#####', $elemento)));
    }
    //CPF - mostrar
    elseif ($tipo == 'CPF') {
        $elemento = str_replace('#', '', mascara('###.###.###-##', $elemento));
    }
    //PIS/PASEP - mostrar
    elseif ($tipo == 'PIS') {
        $elemento = str_replace('#', '', mascara('###.#####.##-#', $elemento));
    }
    //TITULO - mostrar
    elseif ($tipo == 'TITULO') {
        $elemento = str_replace('#', '', mascara('####.####.####', $elemento));
    }
    //CEP
    elseif ($tipo == 'CEP') {
        $elemento = str_replace('#', '', mascara('#####-###', $elemento));
    }
    //UF
    elseif ($tipo == 'UF') {
        $elemento = getUf($elemento);
    }
    //nl2br
    elseif ($tipo == 'T') {
        $elemento = nl2br($elemento, true);
    }
    //Siglas
    elseif ($tipo == 'SG') {
        $siglas = array(
            'S' => 'Sim',
            'N' => 'Não',
            'M' => 'Masculino',
            'F' => 'Feminino',
            'C' => 'Conta corrente',
            'P' => 'Paupança',
            'D' => 'Doador de sangue',
            'H' => 'Hipossuficiente'
        );
        $elemento = isset($siglas[$elemento]) ? $siglas[$elemento] : $elemento;
    }
    //Remove espaços extras
    $elemento = preg_replace('/[ ]{2,}/', ' ', trim($elemento));
    if ($maiuscula) {
        mb_internal_encoding("UTF-8");
        $elemento = mb_strtoupper($elemento);
    }
    return $elemento;
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
    <a href="<?= URL ?>Usuario/listar">USUARIO</a> |
    <?
    if (isset($_SESSION['USUARIO'])) {
        echo '<small>(' . reticencias($_SESSION['USUARIO']['NOME'], 10) . ')</small>';
        ?>
        <small> <a href="<?= URL ?>Login/sair"><sup>Sair</sup></a> </small>
    <? } ?>
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