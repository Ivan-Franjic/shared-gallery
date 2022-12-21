<?php

declare(strict_types = 1);

namespace App\Controller;


use App\Model\User;
use App\Validation\RegisterValidator;
use Core\Input;

class RegisterController extends AbstractController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function registerAction()
    {
        $this->redirect('');
    }

    public function registerSubmitAction()
    {
        // Clear errors and data if they exist for next validation
        $this->session->resetFormInput();

        $validator = new RegisterValidator();
        $post = Input::validatePost();

        if ($validator->validate($post))
        {
            $username = $post['username'];
            $email = $post['email'];
            $password = $post['password'];

            User::insert([
                'username' => $username,
                'email' => $email,
                'password' => $password
            ]);
            $this->redirect('login');
        }
        else
        {
            // Pass all discovered errors and valid data to session and redirect back to form
            $this->session->setFormData($validator->getData());
            $this->session->setFormErrors($validator->getErrors());
            $this->redirect('register');
        }
    }
}