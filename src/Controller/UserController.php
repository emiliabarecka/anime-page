<?php
declare(strict_types=1);
namespace Ap\Controller;


class UserController extends AbstractController{
    
    public function logInAction(){

        $users = $this->userModel->getUsers();
        foreach($users as $user){
            $userName = $user['name'];
            $userPassword = $user['password'];
        }    
        
        $password2 = $this->request->postParam('password');    
        if(!empty($password2)){    
            if(password_verify($password2, $userPassword)){
                $_SESSION['userType'] = 'owner'; 
                $_SESSION['userName'] = $userName;  
            }
            else{
                echo '<h3 style="color:red;">Nieprawidłowe hasło</h3>';
                $_SESSION['userType'] = null;    
            }
        }    
    }
    public function logIn(): void{
        $page = 'log'; 
        // jeśli hasło zostało wpisane czyli nastąpił POST
        if ($this->request->postParam('password')) {    
            // uruchom funkcję sprawdzającą hasło
            $this->logInAction();
            if(isset($_SESSION) && $_SESSION['user_type'] === 'owner'){
                $this->redirect('/?action=admin', []);
            } else {
                $_SESSION['user_type'] = null;
            } 
        } else {
            echo '<h2>Nie wpisano hasła</h2>';
        }
        $this->view->render($page, $viewParams ?? []); 
    }
    public function register():void{
        $page = 'register';
        $viewParams = [
            'lang' => $this->request->getParam('lang')
        ];
        $this->view->render($page, $viewParams ?? []);
    }
    public function logOut():void{
        $_SESSION['user_type'] = null;
        $this->redirect('/', []);
    }
}