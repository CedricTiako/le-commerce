<?php

namespace App\Models;

use App\Core\Model;

class WhatsappMessage extends Model
{
    protected static string $table = 'whatsapp_messages';

    public static function countByDirection(string $direction): int
    {
        $stmt = self::db()->prepare('SELECT COUNT(*) FROM whatsapp_messages WHERE direction = :direction');
        $stmt->execute(['direction' => $direction]);
        return (int) $stmt->fetchColumn();
    }

    public static function latest(int $limit = 5): array
    {
        $stmt = self::db()->prepare(
            'SELECT * FROM whatsapp_messages ORDER BY sent_at DESC LIMIT :limit'
        );
        $stmt->bindValue('limit', $limit, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
