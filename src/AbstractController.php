<?php
declare(strict_types=1);
namespace Ap;
use App\Exception\ConfigurationException;
use Ap\Request;
require_once('src/Exception/ConfigurationException.php');
require_once('src/View.php');
require_once('src/Database.php');
require_once('src/Request.php');

class AbstractController{
    private static array $configuration = [];
    protected const DEFAULT_ACTION = 'main';
    protected Request $request;
    protected View $view;
    protected Database $database;

       //zamiast tworzyc polaczenie z bazą w kocntruktorze robimy metode statytczną
       public static function initConfiguration(array $configuration): void{
        self::$configuration = $configuration;
    }
   

    public function __construct(Request $request){
        if(empty(self::$configuration['db'])){
            throw new ConfigurationException('Configuration error');
        }
        $this->database = new Database(self::$configuration['db']);
        $this->request = $request;
        $this->view = new View();   
    }
    public function run(): void{ 
        //sprawdzamy co przyszlo z geta i sami okreslamy strone dla widoku
        $action = $this->action() . 'Action';
        
    
        if(!method_exists($this, $action)){
            $action = self::DEFAULT_ACTION . 'Action';    
        }
        $this->$action();
        
        //albo switch
        // switch($this->action()){
        //     case 'log': 
        //        $this->log();                     
        //     break;
        //     case 'create':
        //         $this->create();    
        //     break;
        //     case 'show':
        //         $this->show();
        //     break;
        //     case 'edit':
        //      $this->edit();     
        //     break;
        //     default:
        //       $this->main();
        //     break;
        //     }
        }
        //przenieslismy rozpoznawanie akcji do wlasnej metody
    private function action():string{
        return $this->request->getParam('action', self::DEFAULT_ACTION);
    } 
}