<?php
declare (strict_types=1);
namespace Ap\Controller;

class CommentController extends AbstractController{
    private const PAGE_SIZE = 3;

    public function addComment(): void{
        if(isset($_SESSION['userType'])){
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
                $this->redirect('/animePage/?action=show&id='.$commentData['animeId'] , ['before' => 'commented']);
            } 
        }     
    }
    public function showComments() : array{
        $id = (int)$this->request->getParam('id');
        $sortBy = $this->sortComments();
        $numberOfComments = $this->numberOfComments();
    
        $comments = $this->commentModel->showComments($id, $sortBy, $numberOfComments);

        return $comments;
    }
    public function sortComments(): string{
        $id = (int)$this->request->getParam('id');
        if( $this->request->postParam('sortBy')){
            $sortBy = $this->request->postParam('sortBy');
            if($sortBy === 'newest'){
                $sortBy = 'desc';
            }
            else{
                $sortBy = 'asc';
            }
        }else{
            $sortBy = 'asc';
        }
        return $sortBy;
        
    }
    public function numberOfComments(): array{
        $pageSize = $this->request->postParam('pageSize', self::PAGE_SIZE);
        $pageNumber = $this->request->postParam('pageNumber', 1);

        if(!in_array($pageSize, [1 ,5, 10, 25])){
            $pageSize = self::PAGE_SIZE;
        }
        return ['number' => $pageSize,'page' => $pageNumber];
    }
}
