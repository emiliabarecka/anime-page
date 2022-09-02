<?php
declare(strict_types=1);
namespace Ap\Controller;

class ImageController extends AbstractController{

    public function showImages():array{
        $images = [];
        if(isset($_SESSION['userType']) && $_SESSION['userType'] === 'owner'){
            $user = 'owner';
        }
        else{
            $user = null;
        }
        $animes = $this->animeModel->getAnimes($user);
    
        foreach($animes as $anime){
            $id = (int)$anime['id'];
            $image =  $this->imageModel->getImage($id);
            foreach($image as  $img){
                $images[$id][] = $img['name'];
            }
        }
        return $images;
    }
    public function insertImage():void{
        $animeId = (int)$this->request->getParam('id');

        if($this->request->hasPost() && !empty($_FILES['img']['name'])){
            $img = $_FILES['img'];
            $home_dir = dirname(__FILE__);    
            $upload_target_dir = "$home_dir\..\uploaded";
            $file_tmp = $_FILES['img']['tmp_name'];
            $name = basename($_FILES['img']['name']); 
            move_uploaded_file($file_tmp, "$upload_target_dir/$name");
            // $pre = $_POST['pre-image']; 
            $imageData = [
                'id' => $animeId,
                'title' => $this->request->postParam('title'),
                'img' => $img 
            ];
            $this->imageModel->insertImage($imageData);
            $this->redirect('/?action=show&id='.$animeId, ['before'=>'edited']);
        }else{
            $this->redirect('/?action=show&id='.$animeId, ['error'=>'insertImage']);
        }

    }
    
    public function editImage():void{
        $animeId = (int)$this->request->getParam('id');

        if($this->request->hasPost() && !empty($_FILES['img']['name'])){
            $id = (int)$this->request->postParam('id');
            $imgName = $_FILES['img']['name'];
            $this->imageModel->edit($id, $imgName);
            $this->redirect('/?action=show&id='.$animeId, ['before'=>'edited']);
        }else{
            $this->redirect('/?action=show&id='.$animeId, ['error'=>'editImage']);
        }
    }
    public function deleteImage():void{
        if($this->request->isPost()){
            $animeId = (int)$this->request->postParam('animeId');
            $imageId = (int)$this->request->postParam('imageId');
            $this->imageModel->delete($animeId, $imageId);
            $this->redirect('/?action=show&id='.$animeId, ['before'=>'edited']);
        }
    }
}