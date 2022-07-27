<?php
declare(strict_types=1);

spl_autoload_register(function(string $classNameSpace){
$path = str_replace(['\\', 'Ap/'], ['/', ''], $classNameSpace);
$path = "src/$path.php";
require_once($path);

});
use Ap\Request;
use Ap\Controller\AbstractController;
use Ap\Controller\PageController;
use Ap\Exception\AppException;
use Ap\Exception\ConfigurationException;
require_once('src/Utils/debug.php');
$config = require_once('config/config.php');

$request = new Request($_GET, $_POST, $_SERVER);

//wyłączenie zglaszania błędow
// error_reporting(0);
// ini_set('display_errors', '0');

session_start();

try{
    AbstractController::initConfiguration($config);
    (new PageController($request))->run();
}
catch (ConfigurationException $e){
    echo '<h3>Błąd konfiguracji</h3>';
    echo 'Skontaktuj się z administratorem na adres e-mail : xxx@xxx.com';
}
catch (AppException $e){
    echo '<h3>Bład w aplikacji </h3>';
    echo '<h5>'.$e->getMessage().'</h5>';    
}
catch (\Throwable $e){
    echo '<h3>Bład w aplikacji </h3>';
    echo '<h3>' . $e->getMessage() . '</h3>';
}
?>