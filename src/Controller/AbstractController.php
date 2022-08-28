<?php
declare(strict_types=1);
namespace Ap\Controller;
use Ap\Exception\ConfigurationException;
use Ap\Request;
use Ap\Exception\NotFoundException;
use Ap\Exception\StorageException;
use Ap\Model\AnimeModel;
use Ap\View;
use Ap\Model\ImageModel;
use Ap\Model\UserModel;
use Ap\Model\CommentModel;

class AbstractController{
    private static array $configuration = [];
    protected const DEFAULT_ACTION = 'main';
    protected Request $request;
    protected View $view;
    protected AnimeModel $animeModel;
    protected ImageModel $imageModel;
    protected UserModel $userModel;
    protected CommentModel $commentModel;

       //zamiast tworzyc polaczenie z bazą w kocntruktorze robimy metode statytczną
       public static function initConfiguration(array $configuration): void{
        self::$configuration = $configuration;
    }
   

    public function __construct(Request $request){
        if(empty(self::$configuration['db'])){
            throw new ConfigurationException('Configuration error');
        }
        $this->animeModel = new AnimeModel(self::$configuration['db']);
        $this->userModel = new UserModel(self::$configuration['db']);
        $this->imageModel = new ImageModel(self::$configuration['db']);
        $this->commentModel = new CommentModel(self::$configuration['db']);
        $this->request = $request;
        $this->view = new View();   
    }
    final public function run(): void{ 
        try{
            $action = $this->action() . 'Action';
            
            if(!method_exists($this, $action)){
                $action = self::DEFAULT_ACTION . 'Action';    
            }
            $this->$action();
        }
        catch(StorageException $e){
            $page = 'error';
            $this->view->render($page, [
                'message' => $e->getMessage()
            ]);
        }
        catch(NotFoundException $e){
            $animeId = (int)$this->request->getParam('id');
            $this->redirect('/animePage', ['error' => 'animeNotFound&id='. $animeId]);
        }
        
        
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
    
    final protected function redirect(string $to, array $params): void{
        $location = $to;
        
        if(count($params)){
            $queryParams = [];
            foreach($params as $key => $value){
                $queryParams[] = urlencode($key) .'='. urldecode($value);
            }
            $queryParams = implode('&', $queryParams);
            $location = $to . '&'. $queryParams;
        } 
        header("Location:$location");
        exit();
    } 
}