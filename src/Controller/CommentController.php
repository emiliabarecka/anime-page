<?php
declare (strict_types=1);
namespace Ap\Controller;

class CommentController extends AbstractController{
    public function addComment(){
        if(isset($_SESSION['userType'])){
            $page = 'comments';
            $commentData = [];
            if($this->request->postParam('content')){
            
            $commentData = [
                'name' => $this->request->postParam('name'),
                'userId' => $this->request->postParam('userId'),
                'content' => $this->request->postParam('content'),
                'date' => $this->request->postParam('date'),
                'animeId' => $this->request->postParam('animeId')
            ];
        }
        if(!empty($commentData)){
            $commentData = $this->view->escape($commentData);
            $this->commentModel->addComment($commentData);
        } 
        }
        else{
            $page = 'log';
        }
        $this->view->render($page, $viewParams ?? []); 
        
          
    }
}
