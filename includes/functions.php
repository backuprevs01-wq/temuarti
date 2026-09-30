<?php

define('APP_NAME', 'temu.art');

define('APP_SITE_URL', 'http://127.0.0.1:8000');

function db(): PDO
{
    static $pdo = null;

    if ($pdo === null) {
        $config = require __DIR__ . '/../config/database.php';
        $dsn = sprintf(
            'mysql:host=%s;port=%d;dbname=%s;charset=%s',
            $config['host'],
            $config['port'],
            $config['dbname'],
            $config['charset']
        );

        $pdo = new PDO(
            $dsn,
            $config['username'],
            $config['password'],
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]
        );
    }

    return $pdo;
}

function e(?string $value): string
{
    return htmlspecialchars((string) ($value ?? ''), ENT_QUOTES, 'UTF-8');
}

function redirect(string $url): void
{
    header('Location: ' . $url);
    exit;
}

function formatDate(?string $date, string $format = 'd M Y'): string
{
    if (empty($date)) {
        return 'Tanggal belum tersedia';
    }

    $timestamp = strtotime($date);
    if ($timestamp === false) {
        return 'Tanggal belum tersedia';
    }

    return date($format, $timestamp);
}

function formatDateRange(?string $startDate, ?string $endDate): string
{
    if (empty($startDate) && empty($endDate)) {
        return 'Tanggal belum tersedia';
    }

    if ($startDate === $endDate || empty($endDate)) {
        return formatDate($startDate);
    }

    return formatDate($startDate, 'd M Y') . ' – ' . formatDate($endDate, 'd M Y');
}

function csrfToken(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf_token'];
}

function verifyCsrf(): bool
{
    $token = $_POST['csrf_token'] ?? '';
    return hash_equals($_SESSION['csrf_token'] ?? '', $token);
}

function isActivePage(string $page, string $current): bool
{
    return $page === $current;
}
