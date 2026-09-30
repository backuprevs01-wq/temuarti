<?php
require __DIR__ . '/../includes/functions.php';
require __DIR__ . '/includes/auth.php';

$basePath = '../';
$pageTitle = 'Kelola Tempat';

$places = db()->query("SELECT * FROM places WHERE deleted_at IS NULL ORDER BY created_at DESC")->fetchAll();

require __DIR__ . '/../includes/header.php';
?>
<div class="container" style="padding-top: 32px;">
    <div class="admin-shell">
        <div class="admin-topbar">
            <div>
                <div class="brand">temu.art</div>
                <div class="muted">Kelola tempat</div>
            </div>
            <div class="actions">
                <a href="place-form.php" class="button button-primary">Tambah tempat</a>
                <a href="logout.php" class="small-button danger">Keluar</a>
            </div>
        </div>
        <div class="admin-grid" style="margin-top: 26px;">
            <aside class="admin-sidebar">
                <a href="index.php">Dashboard</a>
                <a href="places.php" class="active">Tempat</a>
                <a href="events.php">Event</a>
                <a href="trash.php">Tong Sampah</a>
            </aside>
            <section class="admin-panel">
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Wilayah</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($places as $place): ?>
                                <tr>
                                    <td><?= e($place['name']) ?></td>
                                    <td><?= e($place['category']) ?></td>
                                    <td><?= e($place['district']) ?></td>
                                    <td><?= e($place['status']) ?></td>
                                    <td>
                                        <div class="actions">
                                            <a href="place-form.php?id=<?= (int) $place['id'] ?>" class="small-button primary">Edit</a>
                                            <form method="post" action="place-delete.php" onsubmit="return confirm('Hapus tempat ini ke tong sampah?');">
                                                <input type="hidden" name="csrf_token" value="<?= e($_SESSION['csrf_token'] ?? '') ?>">
                                                <input type="hidden" name="id" value="<?= (int) $place['id'] ?>">
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
