<?php
declare(strict_types=1);
namespace Ap;

use App\Exception\ConfigurationException;
require_once('src/Exception/ConfigurationException.php');
require_once('src/View.php');
require_once('src/Database.php');

class Controller{
    private static array $configuration = [];
    private const DEFAULT_ACTION = 'main';
    private array $request;
    private View $view;
    private Database $database;

    //zamiast tworzyc polaczenie z bazą w kocntruktorze robimy metode statytczną
    public static function initConfiguration(array $configuration): void{
        self::$configuration = $configuration;
    }
   

    public function __construct(array $request){
        if(empty(self::$configuration['db'])){
            throw new ConfigurationException('Configuration error');
        }
        $this->database = new Database(self::$configuration['db']);
        $this->request = $request;
        $this->view = new View();   
    }


    public function logIn(){
        
        $password = $this->database->getPassword();
    
        $data = $this->getRequestPost();
        $password2 = $data['log'];
    
        if(!empty($password2)){
            // if(hash_equals($password['password'], ($password2))){
            if(password_verify($password2, $password['password'])){
                session_start();
                $_SESSION['user_type'] = 'owner';
            
                
            }
            else{
                echo 'Nieprawidłowe hasło';
                header('Location:/animePage/?action=log');
                
            }
        }
    }

    public function run(): void{    
        $viewParams = [];

    //sprawdzamy co przyszlo z geta i sami okreslamy strone dla widoku
    switch($this->action()){
        case 'log':
           
            $pass = $this->getRequestPost()['log'] ?? null;

            if($pass){

                $this->request['get']['action'] = 'logIn';
                $this->run();
            } 
            $page = 'log';
                 
        break;
        case 'logIn':
            $this->logIn();
            if(isset($_SESSION) && $_SESSION['user_type'] === 'owner'){
                $page = 'create';
            }else{
                $page = 'log';
            }    
        break;
        case 'create':
            if(isset($_SESSION) && $_SESSION['user_type'] === 'owner'){
                $page = 'create';    
                //rozróżnienie wchodzimy na strone z formularzem(get)czy wysylamy(post)
                $data = $this->getRequestPost();
                $img = $_FILES['img'] ?? null;
               
                if(!empty($data) || !empty($img)){
                    $animeData = [
                        'title' => $data['title'],
                        'desc' => $data['desc'],
                        'desc2' => $data['desc2'],
                        'characters' => $data['characters'],
                        'eps' => $data['eps'],
                        'img' => $img,
                        
                    ];
                   
                    $this->database->createAnime($animeData);
                    header('Location:/animePage/?before=created');          
                }
            }else{
                $page = 'log';
            }  
        break;
        case 'show':
            $page = 'show';
        break;
        case 'edit':
            $page = 'edit';
            $viewParams = [
                'animes' =>  $this->database->getAnimes()
            ];
        break;
        default:
            $page = 'main';
            $data= $this->getRequestGet();
            
            //dobra sciezka bez upublicznienia struktory plikow
            $upload_target_dir = basename(getcwd()."\uploaded");
            $viewParams = [
                'animes' =>  $this->database->getAnimes(),
                'before' => $data['before'] ?? null,
                'directory' => $upload_target_dir
            ];
        break;
        }
        $this->view->render($page, $viewParams);
    }
    //przenieslismy rozpoznawanie akcji do wlasnej metody
    private function action():string{
        $data = $this->getRequestGet();
        return $data['action'] ?? self::DEFAULT_ACTION;
    } 

    private function getRequestPost(): array{
        return $this->request['post'] ?? [];
    }

    private function getRequestGet(): array{
        return $this->request['get'] ?? [];
    }
   
}