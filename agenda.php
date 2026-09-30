<?php
session_start();
require __DIR__ . '/includes/functions.php';

$basePath = '';
$pageTitle = 'Agenda';

$sql = "SELECT * FROM events WHERE status = 'active' AND deleted_at IS NULL ORDER BY start_date ASC";
$events = db()->query($sql)->fetchAll();

require __DIR__ . '/includes/header.php';
?>
<section class="page-header">
    <div class="container">
        <h1>Agenda</h1>
        <p class="muted">Daftar kegiatan, pertunjukan, dan aktivitas kreatif yang sedang atau akan berlangsung.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <?php if ($events): ?>
            <div class="card-grid">
                <?php foreach ($events as $event): ?>
                    <article class="card">
                        <img src="<?= e($event['image'] ?: 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=900&q=80') ?>" alt="<?= e($event['title']) ?>">
                        <div class="card-body">
                            <div class="card-meta">
                                <span class="badge"><?= e($event['type']) ?></span>
                                <span><?= formatDateRange($event['start_date'], $event['end_date']) ?></span>
                            </div>
                            <h3><?= e($event['title']) ?></h3>
                            <p><?= e(substr($event['description'], 0, 110)) ?>...</p>
                            <a href="event-detail.php?id=<?= (int) $event['id'] ?>" class="card-link">Detail kegiatan</a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <h3>Tidak ada agenda yang cocok.</h3>
                <p>Silakan cek kembali nanti untuk kegiatan terbaru di Surabaya.</p>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
