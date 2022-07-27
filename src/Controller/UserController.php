<?php
declare(strict_types=1);
namespace Ap\Controller;


class UserController extends AbstractController{
    
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
    public function logIn(): void{
        $page = 'log'; 
        // jeśli hasło zostało wpisane czyli nastąpił POST
        if ($this->request->postParam('password')) {    
            // uruchom funkcję sprawdzającą hasło
            $this->logInAction();
            if(isset($_SESSION) && $_SESSION['user_type'] === 'owner'){
                $this->redirect('/animePage/?action=admin', []);
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
        $this->redirect('/animePage', []);
    }
}