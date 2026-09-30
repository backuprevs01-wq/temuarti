<?php
session_start();
require __DIR__ . '/includes/functions.php';

$basePath = '';
$pageTitle = 'Beranda';

$featuredPlaces = db()->query(
    "SELECT * FROM places WHERE status = 'active' AND deleted_at IS NULL ORDER BY created_at DESC LIMIT 6"
)->fetchAll();

$upcomingEvents = db()->query(
    "SELECT * FROM events WHERE status = 'active' AND deleted_at IS NULL ORDER BY start_date ASC LIMIT 4"
)->fetchAll();

require __DIR__ . '/includes/header.php';
?>
<section class="hero">
    <div class="container hero-grid">
        <div class="hero-copy">
            <span class="kicker">Surabaya culture map</span>
            <h1>Temukan ruang dan kegiatan budaya di Surabaya.</h1>
            <p>temu.art membantu Anda menemukan tempat seni, ruang literasi, pameran, dan kegiatan komunitas dengan informasi yang mudah dipahami dan sumber yang jelas.</p>
            <div class="hero-actions">
                <a href="tempat.php" class="button button-primary">Jelajahi tempat</a>
                <a href="agenda.php" class="button button-ghost">Lihat agenda</a>
            </div>
        </div>
        <div class="hero-card">
            <span class="kicker">Hari ini</span>
            <h2>Belum tahu mau ke mana?</h2>
            <p>Mulai dari jelajahi. Temukan tempat yang tepat, cek detail rencana kunjungan, dan arahkan diri ke sumber resmi sebelum datang.</p>
            <div class="stats-grid" style="margin-top: 20px;">
                <div class="stat-box">
                    <strong><?= e((string) db()->query("SELECT COUNT(*) FROM places WHERE status='active' AND deleted_at IS NULL")->fetchColumn()); ?></strong>
                    <span>Tempat</span>
                </div>
                <div class="stat-box">
                    <strong><?= e((string) db()->query("SELECT COUNT(*) FROM events WHERE status='active' AND deleted_at IS NULL")->fetchColumn()); ?></strong>
                    <span>Event</span>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-head">
            <h2>Ruang yang bisa Anda jelajahi</h2>
            <a href="tempat.php" class="button button-ghost">Lihat semua</a>
        </div>
        <div class="card-grid">
            <?php foreach ($featuredPlaces as $place): ?>
                <article class="card">
                    <img src="<?= e($place['image'] ?: 'https://images.unsplash.com/photo-1517048676732-d65bc937f952?auto=format&fit=crop&w=900&q=80') ?>" alt="<?= e($place['name']) ?>">
                    <div class="card-body">
                        <div class="card-meta">
                            <span class="badge"><?= e($place['category']) ?></span>
                            <span><?= e($place['district']) ?></span>
                        </div>
                        <h3><?= e($place['name']) ?></h3>
                        <p><?= e(substr($place['description'], 0, 120)) ?>...</p>
                        <a href="detail.php?id=<?= (int) $place['id'] ?>" class="card-link">Lihat detail</a>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-head">
            <h2>Agenda terbaru</h2>
            <a href="agenda.php" class="button button-ghost">Semua agenda</a>
        </div>
        <div class="card-grid">
            <?php foreach ($upcomingEvents as $event): ?>
                <article class="card">
                    <img src="<?= e($event['image'] ?: 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=900&q=80') ?>" alt="<?= e($event['title']) ?>">
                    <div class="card-body">
                        <div class="card-meta">
                            <span class="badge"><?= e($event['type']) ?></span>
                            <span><?= formatDate($event['start_date']) ?></span>
                        </div>
                        <h3><?= e($event['title']) ?></h3>
                        <p><?= e(substr($event['description'], 0, 110)) ?>...</p>
                        <a href="event-detail.php?id=<?= (int) $event['id'] ?>" class="card-link">Baca detail</a>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
