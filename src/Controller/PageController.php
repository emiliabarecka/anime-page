<?php
declare(strict_types=1);
namespace Ap\Controller;
use Ap\Controller\UserController;
use Ap\Controller\AnimeController;
use Ap\Controller\ImageController;

class PageController extends AbstractController{

    public function mainAction(){
        $animeController = new AnimeController($this->request);
        $animeController->main();
    }
    public function createAction():void{
        $animeController = new AnimeController($this->request);
        $animeController->create();
    }
    public function editAction():void{
        $animeController = new AnimeController($this->request);
        $animeController->edit(); 
    }
    public function showAction():void{
        $animeController = new AnimeController($this->request);
        $animeController->show();
    }
    public function deleteAction():void{
        $animeController = new AnimeController($this->request);
        $animeController->delete(); 
    }
    public function adminAction():void{
        $animeController = new AnimeController($this->request);
        $animeController->main(); 
    }
    public function registerAction():void{
        $userController = new UserController($this->request);
        $userController->register();
    }
    public function addCommentAction():void{
        $userController = new CommentController($this->request);
        $userController->addComment();
    }
    public function logInAction():void{
        $userController = new UserController($this->request);
        $userController->logIn();   
    }
    public function logOutAction():void{
        $userController = new UserController($this->request);
        $userController->logOut();
    }
    public function insertImageAction():void{
        $imageController = new ImageController($this->request);
        $imageController->insertImage();
    }
    public function editImageAction():void{
        $imageController = new ImageController($this->request);
        $imageController->editImage();
    }
    public function deleteImageAction():void{
        $imageController = new ImageController($this->request);
        $imageController->deleteImage();  
    }
}