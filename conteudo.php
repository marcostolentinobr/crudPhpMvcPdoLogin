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