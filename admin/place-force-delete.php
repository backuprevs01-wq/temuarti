<?php
require __DIR__ . '/../includes/functions.php';
require __DIR__ . '/includes/auth.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('trash.php');
}

if (!verifyCsrf()) {
    die('CSRF token tidak valid.');
}

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT) ?: 0;
if ($id > 0) {
    db()->prepare('DELETE FROM places WHERE id = :id')->execute([':id' => $id]);
}

redirect('trash.php');
