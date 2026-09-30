<?php
require __DIR__ . '/../includes/functions.php';
require __DIR__ . '/includes/auth.php';

$basePath = '../';
$pageTitle = 'Tong Sampah';

$deletedPlaces = db()->query("SELECT * FROM places WHERE deleted_at IS NOT NULL ORDER BY deleted_at DESC")->fetchAll();
$deletedEvents = db()->query("SELECT * FROM events WHERE deleted_at IS NOT NULL ORDER BY deleted_at DESC")->fetchAll();

require __DIR__ . '/../includes/header.php';
?>
<div class="container" style="padding-top: 32px;">
    <div class="admin-shell">
        <div class="admin-topbar">
            <div>
                <div class="brand">temu.art</div>
                <div class="muted">Tong sampah</div>
            </div>
            <div class="actions">
                <a href="logout.php" class="small-button danger">Keluar</a>
            </div>
        </div>
        <div class="admin-grid" style="margin-top: 26px;">
            <aside class="admin-sidebar">
                <a href="index.php">Dashboard</a>
                <a href="places.php">Tempat</a>
                <a href="events.php">Event</a>
                <a href="trash.php" class="active">Tong Sampah</a>
            </aside>
            <section class="admin-panel">
                <h3>Tempat yang dihapus</h3>
                <div class="table-wrap" style="margin-top: 14px;">
                    <table>
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Dihapus Pada</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($deletedPlaces as $place): ?>
                                <tr>
                                    <td><?= e($place['name']) ?></td>
                                    <td><?= e($place['deleted_at']) ?></td>
                                    <td>
                                        <div class="actions">
                                            <form method="post" action="place-restore.php">
                                                <input type="hidden" name="csrf_token" value="<?= e($_SESSION['csrf_token'] ?? '') ?>">
                                                <input type="hidden" name="id" value="<?= (int) $place['id'] ?>">
                                                <button class="small-button primary" type="submit">Restore</button>
                                            </form>
                                            <form method="post" action="place-force-delete.php" onsubmit="return confirm('Hapus permanen tempat ini?');">
                                                <input type="hidden" name="csrf_token" value="<?= e($_SESSION['csrf_token'] ?? '') ?>">
                                                <input type="hidden" name="id" value="<?= (int) $place['id'] ?>">
                                                <button class="small-button danger" type="submit">Force delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <h3 style="margin-top: 30px;">Event yang dihapus</h3>
                <div class="table-wrap" style="margin-top: 14px;">
                    <table>
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Dihapus Pada</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($deletedEvents as $event): ?>
                                <tr>
                                    <td><?= e($event['title']) ?></td>
                                    <td><?= e($event['deleted_at']) ?></td>
                                    <td>
                                        <div class="actions">
                                            <form method="post" action="event-restore.php">
                                                <input type="hidden" name="csrf_token" value="<?= e($_SESSION['csrf_token'] ?? '') ?>">
                                                <input type="hidden" name="id" value="<?= (int) $event['id'] ?>">
                                                <button class="small-button primary" type="submit">Restore</button>
                                            </form>
                                            <form method="post" action="event-force-delete.php" onsubmit="return confirm('Hapus permanen event ini?');">
                                                <input type="hidden" name="csrf_token" value="<?= e($_SESSION['csrf_token'] ?? '') ?>">
                                                <input type="hidden" name="id" value="<?= (int) $event['id'] ?>">
                                                <button class="small-button danger" type="submit">Force delete</button>
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
