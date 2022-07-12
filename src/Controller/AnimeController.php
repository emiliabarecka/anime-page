<?php
declare(strict_types=1);
namespace Ap\Controller;

class AnimeController extends AbstractController{

    public function logInAction(){    
        $password = $this->animeModel->getPassword();
        $password2 = $this->request->postParam('password');    
        if(!empty($password2)){    
            if(password_verify($password2, $password['password'])){
                $_SESSION['user_type'] = 'owner';    
            }
            else{
                echo '<h3 style="color:red;">Nieprawidłowe hasło</h3>';
                $_SESSION['user_type'] = null;    
            }
        }    
    }
    public function mainAction(): void{
        $page = 'main';
        $before= $this->request->getParam('before');
        $error = $this->request->getParam('error');
        $id = $this->request->getParam('id');
        //dobra sciezka bez upublicznienia struktory plikow
        $upload_target_dir = basename(getcwd()."\uploaded");
        $viewParams = [
            'animes' =>  $this->animeModel->getAnimes(),
            'before' => $before ?? null,
            'directory' => $upload_target_dir,
            'error' => $error ?? null,
            'id' => $id ?? null
        ];
        
        $this->view->render($page, $viewParams ?? []);
    }

    public function showAction():  void{
        $page = 'show';
        $viewParams = [
            'anime' => $this->getAnime()
        ];
        $this->view->render($page, $viewParams ?? []);
    }

    public function createAction(): void{
        if(isset($_SESSION) && $_SESSION['user_type'] === 'owner'){
            $page = 'create';        
            $img = $_FILES['img'] ?? null;   
            
                $animeData = [
                    'title' => $this->request->postParam('title'),
                    'desc' => $this->request->postParam('desc'),
                    'desc2' =>$this->request->postParam('desc2'),
                    'characters' => $this->request->postParam('characters'),
                    'eps' => $this->request->postParam('eps'),
                    'img' => $img    
                ];
                if($this->request->hasPost() && $this->request->postParam('title')){
                    $this->animeModel->create($animeData);
                    $this->redirect('/animePage', ['before' => 'created']);
                } 
        }
        $this->view->render($page, $viewParams ?? []);
    }
    public function logAction(): void{
        $page = 'log'; 
        // jeśli hasło zostało wpisane czyli nastąpił POST
        if ($this->request->postParam('password')) {    
            // uruchom funkcję sprawdzającą hasło
            $this->logInAction();
            if(isset($_SESSION) && $_SESSION['user_type'] === 'owner'){
                $page = 'create';
            } else {
                $_SESSION['user_type'] = 'other';
            } 
        } else {
            echo '<h2>Nie wpisano hasła</h2>';
        }
        $this->view->render($page, $viewParams ?? []); 
    }
  
    public function editAction(): void{
        $page = 'edit'; 
        if($this->request->isPost()){
            $animeId = (int)$this->request->postParam('id');
            $img = $_FILES['img']['name'];
            $pre = $_POST['pre-image'];
             
            $animeData = [
                'title' => $this->request->postParam('title'),
                'desc' => $this->request->postParam('desc'),
                'desc1' =>$this->request->postParam('desc1'),
                'characters' => $this->request->postParam('characters'),
                'eps' => $this->request->postParam('eps'),
                'img' => $img ?: $pre
            ];
            
            $animeData = $this->view->escape($animeData);
            
            $this->animeModel->edit($animeId, $animeData);
            $this->redirect('/animePage/?action=show&id='.$animeId, ['before'=>'edited']);
        }
        
        $viewParams = [
            'anime' => $this->getAnime()
        ];
        $this->view->render($page, $viewParams ?? []);
    }
    public function deleteAction():void{
        $page = 'delete';
        if($this->request->isPost()){
            $id = (int)$this->request->postParam('id');
            $this->animeModel->delete($id);
            $this->redirect('/animePage', ['before' => 'deleted']);
        }
        $viewParams = [
            'anime' => $this->getAnime()
        ];
        $this->view->render($page, $viewParams);
    }
    private function getAnime(): array{
        $animeId = (int)$this->request->getParam('id');
        if(!$animeId){
            $this->redirect('/animePage', ['error' => 'missingId']);
        }
        return $this->animeModel->get($animeId);     
    }
    
}