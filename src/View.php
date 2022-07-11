<?php
declare(strict_types=1);
namespace Ap;
//ta page jest actionem od geta
class View{ 
    const PARAMS_TO_ESCAPE = [
        'animes',
        'anime'
    ];

    public function render(string $page, array $params = []): void{

        foreach( self::PARAMS_TO_ESCAPE as $escapedParam){
            if(!empty($params[$escapedParam])){
                $params[$escapedParam] = $this->escape($params[$escapedParam]);
            }    
        }    
        require_once('template/layout.php');    
    }

    private function escape(array $params){
        $clearParams = [];
        foreach($params as $key =>$param){
            
            if(is_array($param)){
                $clearParams[$key] = $this->escape($param);
            }
            else {
                $clearParams[$key] =  htmlentities($param);
            } 
        }
        return $clearParams;
    }
}


