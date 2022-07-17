<?php
declare(strict_types=1);
namespace Ap;
//ta page jest actionem od geta
class View{ 
    const PARAMS_TO_ESCAPE = [
        'animes',
        'anime'
    ];

    public string $page;

    public function render(string $page, array $params = []): void{
        $this->page = $page;
        foreach(self::PARAMS_TO_ESCAPE as $escapedParam){
            if(!empty($params[$escapedParam])){
                $params[$escapedParam] = $this->escape($params[$escapedParam]);
            }    
        }    
        require_once('template/layout.php');   
    }

    public function escape(array $params){
        $clearParams = [];
        foreach($params as $key => $param){
            
            if (is_array($param)){
                $clearParams[$key] = $this->escape($param);
            }
            // elseif($key == 'description_0'){
            //     $clearParams[$key] = $param; 
            // }
            else {
                $clearParams[$key] = htmlspecialchars($param, ENT_QUOTES, 'UTF-8');
                $clearParams[$key] = preg_replace('/\s+/', ' ', $clearParams[$key]);    
            } 
        }
        return $clearParams;
    }
}


