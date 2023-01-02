<?php

declare(strict_types = 1);

namespace App\Controller;

error_reporting(E_ALL);
ini_set('display_errors', 'on');

use App\Model\User;

class PagesController extends AbstractController
{
    public function indexAction(): void
    {
        if(isset($_COOKIE['email']) && isset($_COOKIE['password']))
        {
            $_SESSION['email'] = $_COOKIE['email'];
            $user = User::getOne('email', $_SESSION['email']);
            $this->auth->login($user);
            $this->view->render('Pages/Home');
        }
        else{
            $this->view->render('Pages/Home');
        }
       
    }

    public function loginAction(): void
    {
        $this->view->render('Pages/login');
    }

    public function registerAction(): void
    {
        $this->view->render('Pages/register');
    }

    public function notFoundAction(): void
    {
        $this->view->render('Pages/404');
    }

    public function serverErrorAction(): void
    {
        $this->view->render('Pages/500');
    }
}