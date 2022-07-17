<?php
declare(strict_types=1);
namespace Ap\Controller;


class UserController extends AbstractController{
    
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