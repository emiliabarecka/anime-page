<?php
declare(strict_types=1);
namespace Ap;
//ta page jest actionem od geta
class View{  
    public function render(string $page, array $params): void{
        
        require_once('template/layout.php');    
    }
}

?>