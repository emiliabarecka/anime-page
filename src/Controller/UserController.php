<?php
declare(strict_types=1);
namespace Ap\Controller;


class UserController extends AbstractController{
    
    public function logInAction(){
    
        $owner = $this->userModel->getOwner();
        
        $postPassword = $this->request->postParam('password');
        $ownerPassword = $owner['password'];
        $userName = $owner['name'];    
            
        if(!empty($postPassword)){    
            if(password_verify($postPassword, $ownerPassword)){
                $_SESSION['userType'] = 'owner'; 
                $_SESSION['userName'] = $userName;  
            }
            else{
                $this->userLogIn();

                // echo '<h3 style="color:red;">Nieprawidłowe hasło lub login</h3>';
                // $_SESSION['userType'] = null;
            }
        }    
    }
    public function logIn(): void{
        $page = 'log'; 
        // jeśli hasło zostało wpisane czyli nastąpił POST
        if ($this->request->postParam('password')) {    
            // uruchom funkcję sprawdzającą hasło
            $this->logInAction();
            if(isset($_SESSION) && $_SESSION['userType'] === 'owner'){
                $this->redirect('/animePage/?action=admin', []);
            }
        } else {
            echo '<h2 style="color:black">Nie wpisano hasła</h2>';
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
                'userType' => 'regular'
            ];
        }
        $_SESSION['userType'] = 'regular';
        
        $userData = $this->view->escape($userData);
        $this->userModel->register($userData);
        
    }
    public function userLogIn():void{

        $users = $this->userModel->getUsers();

        foreach($users as $user){
            $userName = $user['name'];
            $userPassword = $user['password'];
            $userType = $user['user_type'];
        }

        $postUserPassword = $this->request->postParam('password');
        $postUserName = $this->request->postParam('name');

        if(!empty($postUserPassword) && !empty($postUserName)){
            if($postUserName === $userName){
                $_SESSION['userType'] = $userType;
                $_SESSION['userName'] = $userName;
                dump($_SESSION['userName']);
                exit();
            }
            else{
                $_SESSION['userType'] = null;
                echo '<p class="h3">Nieprawidłowy login lub hasło</p>';
            }
        }
        else{
            echo 'Wpisz login i hasło';
        }
    }

    public function logOut():void{
        $_SESSION['userType'] = null;
        $this->redirect('/animePage', []);
    }
}