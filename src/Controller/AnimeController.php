<?php
declare(strict_types=1);
namespace Ap\Controller;

use Ap\Model\ImageModel;

class AnimeController extends AbstractController{

    public function main(): void{
        $page = 'mainPage/main';

        $id = $this->request->getParam('id');
        $imageController = new ImageController($this->request);
        $images = $imageController->showImages();
        //dobra sciezka bez upublicznienia struktory plikow
        $upload_target_dir = basename(getcwd()."\uploaded");
        if(isset($_SESSION['userType']) && $_SESSION['userType'] === 'owner'){
            $user = 'owner';
        }else{
            $user = null;
        }

        $viewParams = [
            'animes' =>  $this->animeModel->getAnimes($user),
            'images' => $images ?? null,
            'directory' => $upload_target_dir,
            'id' => $id ?? null
        ];    
        $this->view->render($page, $viewParams ?? []);
    }

    public function show():  void{
        $page = 'show';
        $animeId = (int)$this->request->getParam('id');
        $images = $this->imageModel->getImage($animeId);
        $anime = $this->getAnime();
        $error = $this->request->getParam('error');
        $descriptionPart = $this->animeModel->putImagesToDescription($anime['description_0'], $images);
        
        $viewParams = [
            'anime' => $anime,
            'animeText' => $descriptionPart ?? null,
            'error' => $error ?? null
        ];
        
        $this->view->render($page, $viewParams ?? []);
    }

    public function create(): void{
        if(isset($_SESSION) && $_SESSION['userType'] === 'owner'){
            $page = 'create';        
            $animeData = [
                'title' => $this->request->postParam('title'),
                'desc' => $this->request->postParam('desc'),
                'characters' => $this->request->postParam('characters'),
                'eps' => $this->request->postParam('eps'),   
                ];
            if($this->request->hasPost() && $this->request->postParam('title')){
                    $id = $this->animeModel->create($animeData);
                    $this->redirect('/animePage/?action=show&id='.$id, ['before' => 'created']);
            }   
        }
        $this->view->render($page, $viewParams ?? []);
    }
    
    public function edit(): void{
        $page = 'create'; 
        if($this->request->isPost()){
            $animeId = (int)$this->request->postParam('id');
            
            if(!empty($this->request->postParam('published'))){
                $published = $this->request->postParam('published');
            }
            else{
                $published = $this->request->postParam('ifPublished');
            }

            $animeData = [
                'title' => $this->request->postParam('title'),
                'desc' => $this->request->postParam('desc'),
                'characters' => $this->request->postParam('characters'),
                'eps' => $this->request->postParam('eps'),
                'published' => $published  
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
            $this->redirect('/animePage/?action=main', ['before' => 'deleted']);
        }
        $viewParams = [
            'before' => 'deleted',
            'anime'=> $this->getAnime()
        ];
        $this->view->render($page, $viewParams);
    }
    private function getAnime(): array{
        $animeId = (int)$this->request->getParam('id');
        if(!$animeId){
            // header('Location:/animePage/');
            // exit();
            $this->redirect('/animePage/?action=main', ['error' => 'animeNotFound']);
        }
        return $this->animeModel->get($animeId);     
    }
    
}