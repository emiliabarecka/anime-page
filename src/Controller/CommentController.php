<?php
declare (strict_types=1);
namespace Ap\Controller;

class CommentController extends AbstractController{
    public function addComment(){
        $page = 'comments';
            
            $commentData = [
                'name' => $this->request->postParam('name'),
                'userId' => $this->request->postParam('userId'),
                'content' => $this->request->postParam('content'),
                'date' => $this->request->postParam('date')
            ];
        
        if(!empty($commentData)){
            $commentData = $this->view->escape($commentData);
            $this->commentModel->addComment($commentData);
        }
        
        $this->view->render($page, $viewParams ?? []);
    }
}
