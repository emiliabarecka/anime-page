<?php
declare(strict_types=1);
namespace Ap\Controller;

class AnimeController extends AbstractController{

    public function main(): void{
        $page = 'main';
        $error = $this->request->getParam('error');
        $id = $this->request->getParam('id');
        $imageController = new ImageController($this->request);
        $images = $imageController->showImages();
        //dobra sciezka bez upublicznienia struktory plikow
        $upload_target_dir = basename(getcwd()."\uploaded");
        $viewParams = [
            'animes' =>  $this->animeModel->getAnimes(),
            'images' => $images,
            'directory' => $upload_target_dir,
            'error' => $error ?? null,
            'id' => $id ?? null
        ];    
        $this->view->render($page, $viewParams ?? []);
    }

    public function show():  void{
        $page = 'show';
        $animeId = (int)$this->request->getParam('id');
        $images = $this->imageModel->getImage($animeId);
        $upload_target_dir = basename(getcwd()."\uploaded");
        $anime = $this->getAnime();
        $text = [];
        
        if(str_contains($anime['description_0'], '#image')){
            $descriptionPart = explode('#image', $anime['description_0']);
            foreach($descriptionPart as $key => $part){
                $part .= 
                    '<div class="col-4">' .
                    '<img src='. $upload_target_dir. '\\' . $images[rand(0 , count($images)-1)]['name'].' '.'class=img-fluid>'.
                    '</div>';
                $descriptionPart[$key] = $part;
            }
            $descWithImages = implode($descriptionPart);
        }
        $viewParams = [
            'anime' => $anime,
            'animeText' => $descWithImages,
            'img' => $images ?? null
        ];
        $this->view->render($page, $viewParams ?? []);
    }

    public function create(): void{
        if(isset($_SESSION) && $_SESSION['user_type'] === 'owner'){
            $page = 'create';        
            $animeData = [
                'title' => $this->request->postParam('title'),
                'desc' => $this->request->postParam('desc'),
                'characters' => $this->request->postParam('characters'),
                'eps' => $this->request->postParam('eps'),   
                ];
            if($this->request->hasPost() && $this->request->postParam('title')){
                    $this->animeModel->create($animeData);
                    $this->redirect('/animePage/?action=admin', ['before' => 'created']);
            }
            
        }
        $this->view->render($page, $viewParams ?? []);
    }
    
    public function admin(){
        $page='admin';
        $before = $this->request->getParam('before');
        $error = $this->request->getParam('error');
        $id = $this->request->getParam('id');
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
    public function edit(): void{
        $page = 'create'; 
        if($this->request->isPost()){
            $animeId = (int)$this->request->postParam('id');
            
            $animeData = [
                'title' => $this->request->postParam('title'),
                'desc' => $this->request->postParam('desc'),
                'characters' => $this->request->postParam('characters'),
                'eps' => $this->request->postParam('eps'),   
            ];   
            $animeData = $this->view->escape($animeData);  
            $this->animeModel->edit($animeId, $animeData);
            $this->redirect('/animePage/?action=show&id='.$animeId, ['before'=>'edited']);
        } 
        $id = (int)$this->request->getParam('id');
        $img = $this->imageModel->getImage($id);
        $upload_target_dir = basename(getcwd()."\uploaded"); 
        $viewParams = [
            'anime' => $this->getAnime(),
            'before' => $this->request->getParam('before'),
            'img' => $img,
            'directory' => $upload_target_dir,
        ];
        $this->view->render($page, $viewParams ?? []);
    }
    public function delete():void{
        $page = 'delete';
        if($this->request->isPost()){
            $id = (int)$this->request->postParam('id');
            $this->animeModel->delete($id);
            $this->redirect('/animePage/?action=admin', ['before' => 'deleted']);
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