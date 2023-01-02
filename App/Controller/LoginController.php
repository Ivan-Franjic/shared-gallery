<?php

namespace App\Controller;

use App\Model\User;
use App\Validation\LoginValidator;
use Core\Input;

class LoginController extends AbstractController
{
    public function __construct()
    {
        parent::__construct();

        
    }

    public function loginSubmitAction()
    {
        // Clear errors and data if they exist for next validation
        $this->session->resetFormInput();

        $validator = new LoginValidator();
        $post = Input::validatePost();

        if ($this->auth->isLoggedIn())
        {
            return;
        }

        if ($validator->validate($post))
        {
            $user = User::getOne('email', $post['email']);
            if($post['remember-me'] != NULL) {
                setcookie('email', $post['email'], time() + (86400 * 30), "/");
                setcookie('password', $post['password'], time() + (86400 * 30), "/");
                $this->auth->login($user);
                $this->redirect('');
            }
            else{
                $this->auth->login($user);
                $this->redirect('');
            }
  
        }
        else
        {
            // Pass all discovered errors and valid data to session and redirect back to form
            $this->session->setFormData($validator->getData());
            $this->session->setFormErrors($validator->getErrors());
            
            $this->redirect('login');
        }
    }

    public function logoutSubmitAction()
    {
        if ($this->auth->isLoggedIn())
        {
            $this->auth->logout();
        }

        $this->redirect('');
    }
}