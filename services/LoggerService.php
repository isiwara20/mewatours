<?php
declare(strict_types=1);

/**
 * Mewa Tours - Centralized Application Logger Service
 */
class LoggerService
{
    private string $logFile;

    public function __construct(?string $customPath = null)
    {
        $this->logFile = $customPath ?? (ROOT_PATH . '/storage/logs/app.log');
        $this->ensureDirectoryExists();
    }

    private function ensureDirectoryExists(): void
    {
        $dir = dirname($this->logFile);
        if (!is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }
    }

    public function log(string $level, string $message, array $context = []): void
    {
        $timestamp = date('Y-m-d H:i:s');
        $contextString = !empty($context) ? ' ' . json_encode($context) : '';
        $formattedMessage = sprintf("[%s] [%s]: %s%s%s", $timestamp, strtoupper($level), $message, $contextString, PHP_EOL);

        @file_put_contents($this->logFile, $formattedMessage, FILE_APPEND | LOCK_EX);
    }

    public function info(string $message, array $context = []): void
    {
        $this->log('INFO', $message, $context);
    }

    public function warning(string $message, array $context = []): void
    {
        $this->log('WARNING', $message, $context);
    }

    public function error(string $message, array $context = []): void
    {
        $this->log('ERROR', $message, $context);
    }
}
