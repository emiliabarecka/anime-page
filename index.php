<?php
declare(strict_types=1);
namespace Ap;
require_once('src/View.php');
//wyłączenie zglaszania błędow
// error_reporting(0);
// ini_set('display_errors', '0');

const DEFAULT_ACTION = 'main';
$action = $_GET['action'] ?? DEFAULT_ACTION;

$view = new View();

$viewParams = [];
//sprawdzamy co przyszlo z geta i sami okreslamy strone dla widoku
if($action === 'create'){
    $page = 'create';
    $viewParams['resultCreate'] = 'Stwórz';
}
else if($action === 'show'){
    $page = 'show';
    $viewParams['resultShow'] = 'Pokarz';
}
else{
    $page = 'main';
    $viewParams['resultMain'] = 'Główna';
}
//zmienilismy z action na page, ktory sami okreslamy dla vidoku
$view->render($page, $viewParams);
?>