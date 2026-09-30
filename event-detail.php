<?php
session_start();
require __DIR__ . '/includes/functions.php';

$basePath = '';
$pageTitle = 'Detail Kegiatan';
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT) ?: 0;

$stmt = db()->prepare("SELECT * FROM events WHERE id = :id AND status = 'active' AND deleted_at IS NULL");
$stmt->execute([':id' => $id]);
$event = $stmt->fetch();

if (!$event) {
    http_response_code(404);
    require __DIR__ . '/includes/header.php';
    ?>
    <section class="page-header">
        <div class="container">
            <h1>Kegiatan tidak ditemukan</h1>
            <p class="muted">Informasi kegiatan yang Anda cari tidak tersedia atau sudah tidak aktif.</p>
            <a href="agenda.php" class="button button-primary">Kembali ke agenda</a>
        </div>
    </section>
    <?php require __DIR__ . '/includes/footer.php'; exit; }

$place = null;
if (!empty($event['place_id'])) {
    $placeStmt = db()->prepare("SELECT * FROM places WHERE id = :id AND status = 'active' AND deleted_at IS NULL");
    $placeStmt->execute([':id' => (int) $event['place_id']]);
    $place = $placeStmt->fetch();
}

require __DIR__ . '/includes/header.php';
?>
<section class="page-header">
    <div class="container">
        <h1><?= e($event['title']) ?></h1>
        <p class="muted"><?= e($event['type']) ?> • <?= formatDateRange($event['start_date'], $event['end_date']) ?></p>
    </div>
</section>

<section class="section">
    <div class="container detail-grid">
        <div class="detail-card">
            <img src="<?= e($event['image'] ?: 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=900&q=80') ?>" alt="<?= e($event['title']) ?>">
        </div>
        <div class="info-stack">
            <div class="info-box">
                <h3>Informasi kegiatan</h3>
                <div class="meta-list">
                    <div class="meta-item"><strong>Lokasi</strong><span><?= e($event['location'] ?: ($place['name'] ?? 'Lokasi belum tersedia')) ?></span></div>
                    <div class="meta-item"><strong>Mulai</strong><span><?= formatDate($event['start_date']) ?></span></div>
                    <div class="meta-item"><strong>Selesai</strong><span><?= formatDate($event['end_date']) ?></span></div>
                    <div class="meta-item"><strong>Harga / tiket</strong><span><?= e($event['ticket_info'] ?: 'Informasi belum tersedia') ?></span></div>
                    <div class="meta-item"><strong>Website</strong><span><?= !empty($event['website']) ? '<a href="' . e($event['website']) . '" target="_blank" rel="noreferrer">Buka situs</a>' : 'Belum tersedia' ?></span></div>
                    <div class="meta-item"><strong>Instagram</strong><span><?= !empty($event['instagram']) ? '<a href="' . e($event['instagram']) . '" target="_blank" rel="noreferrer">Kunjungi akun</a>' : 'Belum tersedia' ?></span></div>
                </div>
            </div>
            <div class="info-box">
                <h3>Aksi cepat</h3>
                <div class="hero-actions" style="justify-content:flex-start; margin-top:10px;">
                    <?php if (!empty($event['map_url'])): ?>
                        <a href="<?= e($event['map_url']) ?>" target="_blank" rel="noreferrer" class="button button-primary">Lihat lokasi</a>
                    <?php endif; ?>
                    <a href="agenda.php" class="button button-ghost">Kembali ke agenda</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="detail-panel">
            <h3>Deskripsi</h3>
            <p><?= nl2br(e($event['description'])) ?></p>
        </div>
    </div>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
