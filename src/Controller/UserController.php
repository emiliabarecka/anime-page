<?php
declare(strict_types=1);
namespace Ap\Controller;


class UserController extends AbstractController{
    
    public function logInAction(): void{
        $postUserPassword = $this->request->postParam('password');
        $postUserName = $this->request->postParam('name');
       
        $users = $this->userModel->getUsers();
        
        foreach($users as $user){
            $userName = $user['name'];
            $userPassword = $user['password'];
            $userType = $user['user_type'];
            $userId = $user['id'];
    
            if(password_verify($postUserPassword, $userPassword) && $postUserName === $userName){
                $_SESSION['userName'] = $userName;
                $_SESSION['userId'] = $userId;
                switch($userType){
                    case 'owner':
                        $_SESSION['userType'] = 'owner';
                        break;
                    case 'normal_user':
                        $_SESSION['userType'] = 'normal_user';
                        break;
                    default :
                        $_SESSION['userType'] = null;
                        $_SESSION['userName'] = null;       
                }
            }
        }  
    }
    public function logIn(): void{
        $page = 'log'; 

        if ($this->request->postParam('password') &&
            $this->request->postParam('name')) {    
            $this->logInAction();
            if(isset($_SESSION['userType']) && $_SESSION['userType'] === 'normal_user'){
                if(isset($_POST['animeId'])){
                    $this->redirect('/animePage/?action=show&id='.$_POST['animeId'], []);
                }else{
                     $this->redirect('/animePage', []);
                }
            }
            else if(isset($_SESSION['userType']) && $_SESSION['userType'] === 'owner'){
                $this->redirect('/animePage/?action=admin', []);
            }
            else{
                echo "<div><p style= 'color:red'>Nieprawidłowy login lub hasło</p></div>";
            }
            
        }
        
        $this->view->render($page, $viewParams ?? []); 
    }
    public function register():void{
        $page = 'register';
        $userData = [];
        
        if($this->request->hasPost() && 
        $this->request->postParam('password') === $this->request->postParam('passwordRepeat')
        ){
            $userData = [
                'name' => $this->request->postParam('name'),
                'email' => $this->request->postParam('email'),
                'password' => crypt($this->request->postParam('password'), 'trocheSoliZebyDobreBylo'),
                'userType' => 'normal_user'
            ];
        }
        
        if(!empty($userData)){
            $_SESSION['userType'] = 'normal_user';
            $_SESSION['userName'] = $userData['name'];
            $userData = $this->view->escape($userData);
            $id = $this->userModel->register($userData);
            $_SESSION['userId'] = $id;
            $this->redirect('/animePage', []);
        }
        $this->view->render($page, []);  
    }

    public function logOut():void{
        session_unset();
        
        $this->redirect('/animePage', []);
    }
}