<?php
session_start();
require __DIR__ . '/includes/functions.php';

$basePath = '';
$pageTitle = 'Detail Tempat';
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT) ?: 0;

$stmt = db()->prepare("SELECT * FROM places WHERE id = :id AND status = 'active' AND deleted_at IS NULL");
$stmt->execute([':id' => $id]);
$place = $stmt->fetch();

if (!$place) {
    http_response_code(404);
    require __DIR__ . '/includes/header.php';
    ?>
    <section class="page-header">
        <div class="container">
            <h1>Tempat tidak ditemukan</h1>
            <p class="muted">Data yang Anda cari tidak tersedia atau sudah tidak aktif.</p>
            <a href="tempat.php" class="button button-primary">Kembali ke direktori</a>
        </div>
    </section>
    <?php require __DIR__ . '/includes/footer.php'; exit; }

require __DIR__ . '/includes/header.php';
?>
<section class="page-header">
    <div class="container">
        <h1><?= e($place['name']) ?></h1>
        <p class="muted"><?= e($place['category']) ?> • <?= e($place['district']) ?></p>
    </div>
</section>

<section class="section">
    <div class="container detail-grid">
        <div class="detail-card">
            <img src="<?= e($place['image'] ?: 'https://images.unsplash.com/photo-1517048676732-d65bc937f952?auto=format&fit=crop&w=900&q=80') ?>" alt="<?= e($place['name']) ?>">
        </div>
        <div class="info-stack">
            <div class="info-box">
                <h3>Informasi utama</h3>
                <div class="meta-list">
                    <div class="meta-item"><strong>Alamat</strong><span><?= e($place['address']) ?></span></div>
                    <div class="meta-item"><strong>Jam buka</strong><span><?= e($place['opening_hours'] ?: 'Belum tersedia') ?></span></div>
                    <div class="meta-item"><strong>Tiket / akses</strong><span><?= e($place['ticket_info'] ?: 'Informasi belum tersedia') ?></span></div>
                    <div class="meta-item"><strong>Telepon</strong><span><?= e($place['phone'] ?: '-') ?></span></div>
                    <div class="meta-item"><strong>Website</strong><span><?= !empty($place['website']) ? '<a href="' . e($place['website']) . '" target="_blank" rel="noreferrer">Buka situs</a>' : 'Tidak tersedia' ?></span></div>
                    <div class="meta-item"><strong>Instagram</strong><span><?= !empty($place['instagram']) ? '<a href="' . e($place['instagram']) . '" target="_blank" rel="noreferrer">Kunjungi akun</a>' : 'Tidak tersedia' ?></span></div>
                </div>
            </div>
            <div class="info-box">
                <h3>Aksi cepat</h3>
                <div class="hero-actions" style="justify-content:flex-start; margin-top:10px;">
                    <?php if (!empty($place['latitude']) && !empty($place['longitude'])): ?>
                        <a href="https://maps.google.com/?q=<?= e($place['latitude']) ?>,<?= e($place['longitude']) ?>" target="_blank" rel="noreferrer" class="button button-primary">Lihat di Maps</a>
                    <?php endif; ?>
                    <a href="tempat.php" class="button button-ghost">Kembali ke direktori</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="detail-panel">
            <h3>Deskripsi</h3>
            <p><?= nl2br(e($place['description'])) ?></p>
        </div>
    </div>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
