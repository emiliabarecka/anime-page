<?php
declare(strict_types=1);
namespace Ap;

use Ap\Exception\NotFoundException;
require_once('src/Exception/NotFoundException.php');
require_once('AbstractController.php');

class AnimeController extends AbstractController{


    public function logInAction(){
        
        $password = $this->database->getPassword();
        $password2 = $this->request->postParam('password');
        
        if(!empty($password2)){    
            if(password_verify($password2, $password['password'])){
                $_SESSION['user_type'] = 'owner';    
            }
            else{
                echo 'Nieprawidłowe hasło';
                $_SESSION['user_type'] = null;    
            }
        }
        
    }
    public function mainAction(){
        $page = 'main';
        $before= $this->request->getParam('before');
        $error = $this->request->getParam('error');
        $id = $this->request->getParam('id');
        //dobra sciezka bez upublicznienia struktory plikow
        $upload_target_dir = basename(getcwd()."\uploaded");
        $viewParams = [
            'animes' =>  $this->database->getAnimes(),
            'before' => $before ?? null,
            'directory' => $upload_target_dir,
            'error' => $error ?? null,
            'id' => $id ?? null
        ];
        
        $this->view->render($page, $viewParams ?? []);
    }

    public function showAction(){
        $page = 'show';
        $noteId = (int)$this->request->getParam('id');
            
        try{
           $anime = $this->database->getAnime($noteId);
        }
        catch (NotFoundException $e){
            header('Location:/animePage/?error=animeNotFound&id='."$noteId");
            exit;
        }
        $viewParams = [
            'anime' => $anime
        ];
        $this->view->render($page, $viewParams ?? []);
    }

    public function createAction(){
        if(isset($_SESSION) && $_SESSION['user_type'] === 'owner'){
            $page = 'create';        
            $img = $_FILES['img'] ?? null;   
            
                $animeData = [
                    'title' => $this->request->postParam('title'),
                    'desc' => $this->request->postParam('desc'),
                    'desc2' =>$this->request->postParam('desc2'),
                    'characters' => $this->request->postParam('characters'),
                    'eps' => $this->request->postParam('eps'),
                    'img' => $img,    
                ];
                
                if($this->request->isPost() || !empty($img)){
                    $this->database->createAnime($animeData);
                    header('Location:/animePage/?before=created');
                } 
                          
            
            $this->view->render($page, $viewParams ?? []);
        }
        else{
            echo "<h1>XX Nieprawidłowe hasło</h1>";
            header('Location:/animePage/?action=log');
        }
    }
    public function logAction(){
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
  
    public function editAction(){
        $page = 'edit';
        $data = $this->request->getParam('action');
        $noteId = $data['id'];
        $viewParams = [
            'anime' => $this->database->getAnime($noteId),
            'id' => $noteId
        ];
        $this->view->render($page, $viewParams ?? []);
    }
}