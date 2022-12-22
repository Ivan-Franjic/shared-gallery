<?php

declare(strict_types = 1);

namespace App\Model;

use Core\Connection;

class Management extends AbstractModel
 {
    protected static $tableName = 'gallery';

    public static function getPhotos()
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

    public static function getPhotosNbr()
    {
        $ssql = "SELECT g.user_id, COUNT(*) FROM gallery g GROUP BY g.user_id";
        
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

}

