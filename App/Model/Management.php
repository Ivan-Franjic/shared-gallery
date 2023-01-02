<?php

declare(strict_types = 1);

namespace App\Model;

use Core\Connection;

class Management extends AbstractModel
{
    protected static $tableName = 'gallery';

    public static function getUsers()
    {
        $ssql = "SELECT DISTINCT g.user_id, u.username, u.email FROM gallery g
        LEFT JOIN users u ON g.user_id = u.id";
        
        $db = Connection::getInstance();

        $stmt = $db->prepare($ssql);
        $stmt->execute();

        $models = [];
        while($row = $stmt->fetch())
        {
            $models[] = static::createObject($row);
        }
        return $models;
    }

    public static function getImages($user_id)
    {
        $ssql = "SELECT g.id, g.user_id, g.image, u.username, u.email FROM gallery g
        LEFT JOIN users u ON g.user_id = u.id WHERE g.user_id = $user_id";
        
        $db = Connection::getInstance();

        $stmt = $db->prepare($ssql);
        $stmt->execute();

        $models = [];
        while($row = $stmt->fetch())
        {
            $models[] = static::createObject($row);
        }
        return $models;
    }

    public static function getImagesNbr()
    {
        $ssql = "SELECT * FROM gallery";
        
        $db = Connection::getInstance();

        $stmt = $db->prepare($ssql);
        $stmt->execute();
        $count=$stmt->rowCount();

        return $count;
    }

}

