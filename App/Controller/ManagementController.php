<?php

declare(strict_types = 1);

namespace App\Controller;

use App\Model\Management;
use Core\Input;

class ManagementController extends AbstractController
{

    public function __construct()
    {
        parent::__construct();
    }
   
    public function managementAction():void
    {
        if ($this->auth->getCurrentUser() === null || !$this->auth->isLoggedIn())
            {
                $this->redirect('');
            }
        $this->view->render('Management/management', [
            'gallery'  => Management::getUsers(),

        ]);
        
    }

    public function albumAction($user_id)
    {
        if ($this->auth->getCurrentUser() === null || !$this->auth->isLoggedIn())
            {
                $this->redirect('');
            }
        $this->view->render('Management/album', [
            'gallery2'  => Management::getImages($user_id),

        ]);
        
    }

    public function showimagesAction():void
    {
        $res=Management::getImagesNbr();
        
        echo json_encode($res);
        
    }

    public function removeImgAction($id)
    {
        if ($this->auth->getCurrentUser() === null || !$this->auth->isLoggedIn())
            {
                $this->redirect('');
            }
        $current_album=\Core\Auth::getInstance()->getCurrentUser()->getid();
        Management::delete('id', $id);
        $this->redirect('management/album/'. $current_album);
    }

    public function addImgAction(){
        if(isset($_FILES['new-image']) 
          && $_FILES['new-image']['error'] == UPLOAD_ERR_OK){
          $info = getimagesize($_FILES['new-image']['tmp_name']);
          $allowedTypes = [IMAGETYPE_JPEG=>'.jpg',
                           IMAGETYPE_PNG=>'.png'];
          if($info === false){ // no go
            echo "<script>alert('Bad file format!'); 
            location.href = 'http://localhost/shared-gallery/management';</script>";
          }else if(!array_key_exists($info[2], $allowedTypes)){ // no go
            echo "<script>alert('Not an accepted file type!'); 
            location.href = 'http://localhost/shared-gallery/management';</script>";
          }else{
            //save the picture in the images folder
            $path = getcwd().DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR;
            $filename = uniqid().$allowedTypes[$info[2]];
            move_uploaded_file($_FILES['new-image']['tmp_name'], $path.$filename);
            
            $user_id=\Core\Auth::getInstance()->getCurrentUser()->getid();

            Management::insert([
                'user_id' => $user_id,
                'image' => $filename
            ]);
            $this->redirect('management');
         }
        }else{
            echo "<script>alert('No file chosen!'); 
            location.href = 'http://localhost/shared-gallery/management';</script>";
        }
      }
       
}