<?php

namespace App\Models;

use App\Core\Model;

class Drink extends Model
{
    protected static string $table = 'drinks';

    public static function featured(int $limit = 10): array
    {
        $stmt = self::db()->prepare('SELECT * FROM drinks ORDER BY display_order ASC LIMIT :limit');
        $stmt->bindValue('limit', $limit, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
