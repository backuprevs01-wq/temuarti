<?php
session_start();
require __DIR__ . '/includes/functions.php';

$basePath = '';
$pageTitle = 'Tempat';

$search = trim((string) ($_GET['search'] ?? ''));
$category = trim((string) ($_GET['category'] ?? ''));
$district = trim((string) ($_GET['district'] ?? ''));

$sql = "SELECT * FROM places WHERE status = 'active' AND deleted_at IS NULL";
$params = [];

if ($search !== '') {
    $sql .= " AND (name LIKE :search OR category LIKE :search OR description LIKE :search OR district LIKE :search OR address LIKE :search)";
    $params[':search'] = '%' . $search . '%';
}

if ($category !== '') {
    $sql .= " AND category = :category";
    $params[':category'] = $category;
}

if ($district !== '') {
    $sql .= " AND district = :district";
    $params[':district'] = $district;
}

$sql .= " ORDER BY name ASC";

$stmt = db()->prepare($sql);
$stmt->execute($params);
$places = $stmt->fetchAll();

$categories = db()->query("SELECT DISTINCT category FROM places WHERE status='active' AND deleted_at IS NULL ORDER BY category ASC")->fetchAll();
$districts = db()->query("SELECT DISTINCT district FROM places WHERE status='active' AND deleted_at IS NULL ORDER BY district ASC")->fetchAll();

require __DIR__ . '/includes/header.php';
?>
<section class="page-header">
    <div class="container">
        <h1>Tempat</h1>
        <p class="muted">Jelajahi tempat seni, budaya, literasi, dan ruang komunitas di Surabaya.</p>
    </div>
</section>

<section class="section">
    <div class="container content-grid">
        <aside class="sidebar">
            <div class="filter-panel">
                <h3>Filter</h3>
                <form method="get" class="filter-form">
                    <input type="text" name="search" placeholder="Cari nama atau kata kunci" value="<?= e($search) ?>">
                    <select name="category">
                        <option value="">Semua kategori</option>
                        <?php foreach ($categories as $option): ?>
                            <option value="<?= e($option['category']) ?>" <?= $option['category'] === $category ? 'selected' : '' ?>><?= e($option['category']) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <select name="district">
                        <option value="">Semua wilayah</option>
                        <?php foreach ($districts as $option): ?>
                            <option value="<?= e($option['district']) ?>" <?= $option['district'] === $district ? 'selected' : '' ?>><?= e($option['district']) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit">Terapkan filter</button>
                    <a href="tempat.php" class="button button-ghost" style="display: inline-flex;">Reset</a>
                </form>
            </div>
        </aside>

        <div>
            <?php if ($places): ?>
                <div class="card-grid">
                    <?php foreach ($places as $place): ?>
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
            <?php else: ?>
                <div class="empty-state">
                    <h3>Belum menemukan tempat yang cocok.</h3>
                    <p>Coba gunakan kata pencarian lain atau hapus filter yang sedang digunakan.</p>
                    <a href="tempat.php" class="button button-primary">Tampilkan semua tempat</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
