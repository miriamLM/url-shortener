<?php

declare(strict_types=1);

namespace LaSalle\UrlShortener\MiriamLopez\Shared\Infrastructure;

use Dotenv;
use PDO;

final class UrlShortenerDBConnection
{
    private PDO $pdo;

    public function __construct()
    {
        $dotEnv = Dotenv\Dotenv::createImmutable('../', '.env');
        $dotEnv->load();
        $db = getenv('DATABASE');
        $host = getenv('DATABASE_HOST');
        $name = getenv('DATABASE_NAME');
        $user = getenv('DATABASE_USER');
        $password = getenv('DATABASE_PASSWORD');
        $this->pdo = new PDO("{$db}:dbname={$name};host={$host};charset=utf8mb4", $user, $password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function pdo(): PDO
    {
        return $this->pdo;
    }
}
