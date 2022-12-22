<?php

declare(strict_types = 1);

namespace App\Controller;

use App\Model\User;
use App\Validation\MyaccountValidator;
use Core\Input;


class MyaccountController extends AbstractController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function indexAction()
    {
        if ($this->auth->getCurrentUser() === null || !$this->auth->isLoggedIn())
        {
            $this->redirect('');
        }

        $userId = $this->auth->getCurrentUser()->getid();

        $this->view->render("Myaccount/myaccount", [
            'users' => User::getMultiple('id', $userId)
        ]);
    }

    public function editAction()
    {
        if($this->auth->getCurrentUser() === null || !$this->auth->isLoggedIn())
        {
            $this->redirect('');
        }
       
        $userId = $this->auth->getCurrentUser()->getid();

        $this->view->render("Myaccount/edit", [
            'users' => User::getOne('id', $userId)
        ]);
    }

    public function updatePasswordSubmitAction($id)
    {
        if($this->auth->getCurrentUser() === null || !$this->auth->isLoggedIn())
        {
            $this->redirect('');
        }

        $validator = new MyaccountValidator();
        $post = Input::validatePost();

        $this->session->resetFormInput();

        //if($validator->validateUpdatedPassword($post))
        //{
            $password = $post['password'];
            User::update(['password' => $password], 'id', $id);
            $this->redirect('Myaccount'); 
        //}
        //else
        //{
            $this->session->setFormData($validator->getData());
            $this->session->setFormErrors($validator->getErrors());

            //$this->redirect('Myaccount/edit');
        //}
    }
}