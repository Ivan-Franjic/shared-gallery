<?php

declare(strict_types = 1);

namespace App\Controller;

use App\Model\Management;
//use App\Validation\MValidator;
use Core\Input;

class ManagementController extends AbstractController
{

    public function __construct()
    {
        parent::__construct();
    }
   
    public function managementAction():void
    {
        $this->view->render('Management/Management', [
            'gallery'  => Management::getPhotos(),

        ]);
        
    }

    

   
    
}