<?php
session_start();
require __DIR__ . '/includes/functions.php';

$basePath = '';
$pageTitle = 'Pameran';

$events = db()->prepare("SELECT * FROM events WHERE status = 'active' AND deleted_at IS NULL AND type = 'Pameran' ORDER BY start_date ASC");
$events->execute();
$items = $events->fetchAll();

require __DIR__ . '/includes/header.php';
?>
<section class="page-header">
    <div class="container">
        <h1>Pameran</h1>
        <p class="muted">Kumpulan pameran seni dan budaya yang berlangsung di Surabaya.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <?php if ($items): ?>
            <div class="card-grid">
                <?php foreach ($items as $event): ?>
                    <article class="card">
                        <img src="<?= e($event['image'] ?: 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=900&q=80') ?>" alt="<?= e($event['title']) ?>">
                        <div class="card-body">
                            <div class="card-meta">
                                <span class="badge"><?= e($event['type']) ?></span>
                                <span><?= formatDateRange($event['start_date'], $event['end_date']) ?></span>
                            </div>
                            <h3><?= e($event['title']) ?></h3>
                            <p><?= e(substr($event['description'], 0, 110)) ?>...</p>
                            <a href="event-detail.php?id=<?= (int) $event['id'] ?>" class="card-link">Lihat pameran</a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <h3>Belum ada pameran yang ditampilkan.</h3>
                <p>Silakan cek kembali nanti untuk informasi pameran terbaru.</p>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
