<?php
require __DIR__ . '/../includes/functions.php';
require __DIR__ . '/includes/auth.php';

$basePath = '../';
$pageTitle = 'Dashboard';

$stats = [
    'places' => db()->query("SELECT COUNT(*) FROM places WHERE deleted_at IS NULL")->fetchColumn(),
    'events' => db()->query("SELECT COUNT(*) FROM events WHERE deleted_at IS NULL")->fetchColumn(),
    'admins' => db()->query("SELECT COUNT(*) FROM admins")->fetchColumn(),
];

require __DIR__ . '/../includes/header.php';
?>
<div class="container" style="padding-top: 32px;">
    <div class="admin-shell">
        <div class="admin-topbar">
            <div>
                <div class="brand">temu.art</div>
                <div class="muted">Dashboard admin</div>
            </div>
            <div class="actions">
                <a href="logout.php" class="small-button danger">Keluar</a>
            </div>
        </div>
        <div class="admin-grid" style="margin-top: 26px;">
            <aside class="admin-sidebar">
                <a href="index.php" class="active">Dashboard</a>
                <a href="places.php">Tempat</a>
                <a href="events.php">Event</a>
                <a href="trash.php">Tong Sampah</a>
            </aside>
            <section class="admin-panel">
                <h2>Ringkasan</h2>
                <div class="stats-grid" style="margin-top: 12px;">
                    <div class="stat-box">
                        <strong><?= e((string) $stats['places']) ?></strong>
                        <span>Total tempat</span>
                    </div>
                    <div class="stat-box">
                        <strong><?= e((string) $stats['events']) ?></strong>
                        <span>Total event</span>
                    </div>
                    <div class="stat-box">
                        <strong><?= e((string) $stats['admins']) ?></strong>
                        <span>Total admin</span>
                    </div>
                </div>
                <div style="margin-top: 22px;" class="hero-actions">
                    <a href="places.php" class="button button-primary">Kelola tempat</a>
                    <a href="events.php" class="button button-ghost">Kelola event</a>
                </div>
            </section>
        </div>
    </div>
</div>
<?php require __DIR__ . '/../includes/footer.php'; ?>
