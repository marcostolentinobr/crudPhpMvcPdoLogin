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