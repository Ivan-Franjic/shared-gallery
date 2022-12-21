<?php

declare(strict_types = 1);

namespace App\Model;

use Core\Connection;

class User extends AbstractModel
{
    protected static $tableName = 'users';

    public static function isEmailAvailable($email): bool
    {
        $user = self::getOne('email', $email);

        return $user->getemail() ? true : false;
    }
}