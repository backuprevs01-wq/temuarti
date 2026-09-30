<?php
require __DIR__ . '/../includes/functions.php';
require __DIR__ . '/includes/auth.php';

$basePath = '../';
$pageTitle = 'Kelola Event';

$events = db()->query("SELECT * FROM events WHERE deleted_at IS NULL ORDER BY start_date DESC")->fetchAll();

require __DIR__ . '/../includes/header.php';
?>
<div class="container" style="padding-top: 32px;">
    <div class="admin-shell">
        <div class="admin-topbar">
            <div>
                <div class="brand">temu.art</div>
                <div class="muted">Kelola event</div>
            </div>
            <div class="actions">
                <a href="event-form.php" class="button button-primary">Tambah event</a>
                <a href="logout.php" class="small-button danger">Keluar</a>
            </div>
        </div>
        <div class="admin-grid" style="margin-top: 26px;">
            <aside class="admin-sidebar">
                <a href="index.php">Dashboard</a>
                <a href="places.php">Tempat</a>
                <a href="events.php" class="active">Event</a>
                <a href="trash.php">Tong Sampah</a>
            </aside>
            <section class="admin-panel">
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Tipe</th>
                                <th>Mulai</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($events as $event): ?>
                                <tr>
                                    <td><?= e($event['title']) ?></td>
                                    <td><?= e($event['type']) ?></td>
                                    <td><?= e($event['start_date']) ?></td>
                                    <td><?= e($event['status']) ?></td>
                                    <td>
                                        <div class="actions">
                                            <a href="event-form.php?id=<?= (int) $event['id'] ?>" class="small-button primary">Edit</a>
                                            <form method="post" action="event-delete.php" onsubmit="return confirm('Hapus event ini ke tong sampah?');">
                                                <input type="hidden" name="csrf_token" value="<?= e($_SESSION['csrf_token'] ?? '') ?>">
                                                <input type="hidden" name="id" value="<?= (int) $event['id'] ?>">
                                                <button class="small-button danger" type="submit">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</div>
<?php require __DIR__ . '/../includes/footer.php'; ?>
