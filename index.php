<?php
declare(strict_types=1);
namespace Ap;

use Ap\Exception\AppException;
use App\Exception\ConfigurationException;
use Throwable;

require_once('src/Controller.php');
require_once('src/Utils/debug.php');
$config = require_once('config/config.php');
require_once('src/Exception/AppException.php');
//wyłączenie zglaszania błędow
// error_reporting(0);
// ini_set('display_errors', '0');


//przekazujemy tablice post i get do konstruktora
$request = [
    'get' => $_GET,
    'post' => $_POST    
];
try{
    Controller::initConfiguration($config);
    (new Controller($request))->run();
}
catch (ConfigurationException $e){
    echo '<h3>Błąd konfiguracji</h3>';
    echo 'Skontaktuj się z administratorem na adres e-mail : xxx@xxx.com';
}
catch (AppException $e){
    echo '<h3>Bład w aplikacji </h3>';
    echo '<h5>'.$e->getMessage().'</h5>';    
}
catch (Throwable $e){
    echo '<h3>Bład w aplikacji </h3>';
    dump($e);
}
?>