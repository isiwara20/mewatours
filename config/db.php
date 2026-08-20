<?php
declare(strict_types=1);

/**
 * Mewa Tours - Secure PDO Database Connection Class
 * With auto-creation & auto-seeding capabilities if database is missing
 */
class Database
{
    private static ?PDO $instance = null;

    private const HOST = 'localhost';
    private const PORT = '3306';
    private const DB_NAME = 'mewa_tours';
    private const USER = 'root';
    private const PASS = '';
    private const CHARSET = 'utf8mb4';

    /**
     * Private constructor to prevent direct instantiation
     */
    private function __construct()
    {
    }

    /**
     * Private clone method to prevent cloning singleton instance
     */
    private function __clone()
    {
    }

    /**
     * Get active PDO Connection
     */
    public static function getConnection(): PDO
    {
        if (self::$instance === null) {
            $dsn = sprintf(
                'mysql:host=%s;port=%s;dbname=%s;charset=%s',
                self::HOST,
                self::PORT,
                self::DB_NAME,
                self::CHARSET
            );

            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci"
            ];

            try {
                self::$instance = new PDO($dsn, self::USER, self::PASS, $options);
            } catch (PDOException $e) {
                // If database does not exist yet (Error 1049), auto-create and seed database automatically
                if ($e->getCode() === 1049 || strpos($e->getMessage(), 'Unknown database') !== false) {
                    self::autoCreateAndSeedDatabase($options);
                    self::$instance = new PDO($dsn, self::USER, self::PASS, $options);
                } else {
                    error_log('Database Connection Error: ' . $e->getMessage());
                    throw new Exception('Database connection failed. Please ensure MySQL is running in XAMPP control panel.');
                }
            }
        }

        return self::$instance;
    }

    /**
     * Auto-create database 'mewa_tours' and import schema.sql + seed.sql
     */
    private static function autoCreateAndSeedDatabase(array $options): void
    {
        try {
            $serverDsn = sprintf('mysql:host=%s;port=%s;charset=%s', self::HOST, self::PORT, self::CHARSET);
            $pdo = new PDO($serverDsn, self::USER, self::PASS, $options);

            // Create database
            $pdo->exec("CREATE DATABASE IF NOT EXISTS `" . self::DB_NAME . "` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
            $pdo->exec("USE `" . self::DB_NAME . "`;");

            // Import schema
            $schemaFile = (defined('ROOT_PATH') ? ROOT_PATH : dirname(__DIR__)) . '/database/schema.sql';
            if (file_exists($schemaFile)) {
                $sql = file_get_contents($schemaFile);
                if (!empty($sql)) {
                    $pdo->exec($sql);
                }
            }

            // Import seed
            $seedFile = (defined('ROOT_PATH') ? ROOT_PATH : dirname(__DIR__)) . '/database/seed.sql';
            if (file_exists($seedFile)) {
                $seedSql = file_get_contents($seedFile);
                if (!empty($seedSql)) {
                    $pdo->exec($seedSql);
                }
            }
        } catch (Exception $ex) {
            error_log('Auto database creation error: ' . $ex->getMessage());
            throw new Exception('Failed to auto-create database. Please create database [mewa_tours] manually in phpMyAdmin.');
        }
    }
}
