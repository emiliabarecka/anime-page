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

    //zamiast tworzyc polaczenie z bazą w kocntruktorze robimy metode statytczną
    public static function initConfiguration(array $configuration): void{
        self::$configuration = $configuration;
    }

    public function __construct(array $request){
        if(empty(self::$configuration['db'])){
            throw new ConfigurationException('Configuration error');
        }
        $db = new Database(self::$configuration['db']);
        $this->request = $request;
        $this->view = new View();   
    }  

    public function run(): void{
        
        $viewParams = [];
        
//sprawdzamy co przyszlo z geta i sami okreslamy strone dla widoku
    switch($this->action()){
        case 'create':
            $page = 'create';
            //rozróżnienie wchodzimy na strone z formularzem(get)czy wysylamy(post)
            $created = false;
            $data = $this->getRequestPost();
            if(!empty($data)){
                $created = true;
                $viewParams = [
                    'title' => $data['title'],
                    'desc' => $data['desc'],
                    'desc2' => $data['desc2'],
                    'characters' => $data['characters'],
                    'eps' => $data['eps'],
                    'img' => $data['img']
                ];       
            }
            //przekazujemy do widoku informacje, czy wchodzimy dopiero na formularz, czy juz go wysłalismy
            $viewParams['created'] = $created;
        break;
        case 'show':
            $page = 'show';
        break;
        default:
            $page = 'main';
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