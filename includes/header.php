<?php
$basePath = $basePath ?? '';
$pageTitle = $pageTitle ?? 'Temu.art';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle) ?> | temu.art</title>
    <meta name="description" content="Temu.art adalah direktori tempat dan kegiatan seni, budaya, dan literasi di Surabaya.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= $basePath ?>assets/css/style.css">
</head>
<body>
    <header class="site-header">
        <div class="container nav-wrap">
            <a href="<?= $basePath ?>index.php" class="brand">temu.art</a>
            <nav class="main-nav" aria-label="Navigasi utama">
                <a href="<?= $basePath ?>index.php">Beranda</a>
                <a href="<?= $basePath ?>tempat.php">Tempat</a>
                <a href="<?= $basePath ?>agenda.php">Agenda</a>
                <a href="<?= $basePath ?>pameran.php">Pameran</a>
            </nav>
            <a href="<?= $basePath ?>admin/login.php" class="button button-ghost">Admin</a>
        </div>
    </header>
    <main class="site-main">
