<?php

declare(strict_types = 1);

namespace App\Validation;

use App\Model\User;

class MyaccountValidator extends AbstractValidator
{
    public function validate(array $data): bool
    {

        return empty($this->getErrors());
    }

    public function validateUpdatedPassword(array $data): bool
    {
        $this->validatePassword($data['password'], $data['old-password']);

        return empty($this->getErrors());
    }

    private function validatePassword(string $password, string $oldpassword): void
    {
        $hashedPassword=\Core\Auth::getInstance()->getCurrentUser()->getpassword();
        
        if(!empty($oldpassword))
        {
            if(!password_verify($oldpassword, $hashedPassword))
            {
                $this->errors['old-password'] = "Old password does not match.";
            }
            else
            {
                if(!empty($password))
                {
                    if (strlen($password) < 8)
                    {
                        $this->errors['password'] = "Password must be at least 8 characters long.";
                    }
                    if (strlen($password) > 50)
                    {
                        $this->errors['password'] = "Password must be less than 50 characters long.";
                    }
                    if (!preg_match("#[0-9]+#", $password))
                    {
                        $this->errors['password'] = "Password must have at least 1 number.";
                    }
                    if (!preg_match("#[A-Z]+#", $password))
                    {
                        $this->errors['password'] = "Password must have at least 1 uppercase character.";
                    }
                    if (!preg_match("#[a-z]+#", $password))
                    {
                        $this->errors['password'] = "Password must have at least 1 lowercase character.";
                    }
                }
                else
                {
                    $this->errors['password'] = "You must enter a password.";
                }
            }
        }
        else
        {
            $this->errors['old-password'] = "You must enter an old password.";
        }
    }

}