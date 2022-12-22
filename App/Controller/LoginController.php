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

        //if ($this->auth->isLoggedIn())
        //{
           // return;
        //}

        //if ($validator->validate($post))
        //{
            $user = User::getOne('email', $post['email']);
            
            $this->auth->login($user);
            $this->redirect('');
        //}
        //else
        //{
            // Pass all discovered errors and valid data to session and redirect back to form
            //$this->session->setFormData($validator->getData());
            //$this->session->setFormErrors($validator->getErrors());
            //$this->view->render('Management/Management', [
                //'gallery'  => Management::getAll(),
    
            //]);
            //$this->view->render("Management/management");
            //$this->redirect('login');
        //}
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