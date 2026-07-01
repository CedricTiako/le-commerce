<?php

namespace App\Core;

use PDO;

/**
 * Modèle de base : fournit un mini Active-Record (CRUD générique)
 * Chaque modèle métier étend cette classe et définit $table + $fillable
 */
abstract class Model
{
    protected static string $table = '';
    protected static string $primaryKey = 'id';

    protected static function db(): PDO
    {
        return Database::connection();
    }

    public static function all(string $orderBy = 'id DESC'): array
    {
        $stmt = self::db()->query('SELECT * FROM ' . static::$table . ' ORDER BY ' . $orderBy);
        return $stmt->fetchAll();
    }

    public static function find(int $id): ?array
    {
        $stmt = self::db()->prepare('SELECT * FROM ' . static::$table . ' WHERE ' . static::$primaryKey . ' = :id LIMIT 1');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public static function where(string $column, $value, string $operator = '='): array
    {
        $stmt = self::db()->prepare("SELECT * FROM " . static::$table . " WHERE {$column} {$operator} :value");
        $stmt->execute(['value' => $value]);
        return $stmt->fetchAll();
    }

    public static function create(array $data): int
    {
        $columns = array_keys($data);
        $placeholders = array_map(fn($c) => ':' . $c, $columns);

        $sql = sprintf(
            'INSERT INTO %s (%s) VALUES (%s)',
            static::$table,
            implode(', ', $columns),
            implode(', ', $placeholders)
        );

        $stmt = self::db()->prepare($sql);
        $stmt->execute($data);

        return (int) self::db()->lastInsertId();
    }

    public static function update(int $id, array $data): bool
    {
        $assignments = implode(', ', array_map(fn($c) => "{$c} = :{$c}", array_keys($data)));
        $sql = 'UPDATE ' . static::$table . " SET {$assignments} WHERE " . static::$primaryKey . ' = :id';

        $data['id'] = $id;
        $stmt = self::db()->prepare($sql);
        return $stmt->execute($data);
    }

    public static function delete(int $id): bool
    {
        $stmt = self::db()->prepare('DELETE FROM ' . static::$table . ' WHERE ' . static::$primaryKey . ' = :id');
        return $stmt->execute(['id' => $id]);
    }

    public static function count(): int
    {
        return (int) self::db()->query('SELECT COUNT(*) FROM ' . static::$table)->fetchColumn();
    }
}
