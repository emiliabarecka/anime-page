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
    
            if(password_verify($postUserPassword, $userPassword) && $postUserName === $userName){
                $_SESSION['userName'] = $userName;
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
            if($_SESSION['userType'] === 'owner'){
                $this->redirect('/animePage/?action=admin', []);
            }
            if($_SESSION['userType'] === 'normal_user'){
                $this->redirect('/animePage', []);
            }
        }
        
        $this->view->render($page, $viewParams ?? []); 
    }
    public function register():void{
        $page = 'register';
        $userData = [];
        $viewParams = [
            'lang' => $this->request->getParam('lang')
        ];
        $this->view->render($page, $viewParams ?? []);

        if($this->request->hasPost() && 
        $this->request->postParam('userPassword') === $this->request->postParam('passwordRepeat')
        ){
            $userData = [
                'name' => $this->request->postParam('name'),
                'email' => $this->request->postParam('email'),
                'password' => crypt($this->request->postParam('userPassword'), 'trocheSoliZebyDobreBylo'),
                'userType' => 'normal_user'
            ];
        }

        $_SESSION['userType'] = 'normal_user';
        if(!empty($userData)){
            $userData = $this->view->escape($userData);
            $this->userModel->register($userData);
        }  
    }

    public function logOut():void{
        $_SESSION['userType'] = null;
        $_SESSION['userName'] = null;
        $this->redirect('/animePage', []);
    }
}