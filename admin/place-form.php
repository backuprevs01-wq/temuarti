<?php
require __DIR__ . '/../includes/functions.php';
require __DIR__ . '/includes/auth.php';
require __DIR__ . '/includes/csrf.php';

$basePath = '../';
$pageTitle = 'Form Tempat';
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$record = null;

if ($id) {
    $stmt = db()->prepare('SELECT * FROM places WHERE id = :id LIMIT 1');
    $stmt->execute([':id' => $id]);
    $record = $stmt->fetch();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verifyCsrf()) {
        die('CSRF token tidak valid.');
    }

    $name = trim((string) ($_POST['name'] ?? ''));
    $category = trim((string) ($_POST['category'] ?? ''));
    $description = trim((string) ($_POST['description'] ?? ''));
    $address = trim((string) ($_POST['address'] ?? ''));
    $district = trim((string) ($_POST['district'] ?? ''));
    $openingHours = trim((string) ($_POST['opening_hours'] ?? ''));
    $ticketInfo = trim((string) ($_POST['ticket_info'] ?? ''));
    $phone = trim((string) ($_POST['phone'] ?? ''));
    $website = trim((string) ($_POST['website'] ?? ''));
    $instagram = trim((string) ($_POST['instagram'] ?? ''));
    $status = in_array($_POST['status'] ?? 'active', ['active', 'draft'], true) ? $_POST['status'] : 'active';
    $image = trim((string) ($_POST['image'] ?? ''));
    $latitude = trim((string) ($_POST['latitude'] ?? ''));
    $longitude = trim((string) ($_POST['longitude'] ?? ''));

    if ($name === '' || $category === '' || $description === '' || $address === '' || $district === '') {
        $formError = 'Nama, kategori, deskripsi, alamat, dan wilayah wajib diisi.';
    } else {
        $data = [
            ':name' => $name,
            ':category' => $category,
            ':description' => $description,
            ':address' => $address,
            ':district' => $district,
            ':opening_hours' => $openingHours,
            ':ticket_info' => $ticketInfo,
            ':phone' => $phone,
            ':website' => $website,
            ':instagram' => $instagram,
            ':status' => $status,
            ':image' => $image,
            ':latitude' => $latitude === '' ? null : $latitude,
            ':longitude' => $longitude === '' ? null : $longitude,
        ];

        if ($id) {
            db()->prepare('UPDATE places SET name=:name, category=:category, description=:description, address=:address, district=:district, opening_hours=:opening_hours, ticket_info=:ticket_info, phone=:phone, website=:website, instagram=:instagram, latitude=:latitude, longitude=:longitude, image=:image, status=:status WHERE id=:id')->execute(array_merge($data, [':id' => $id]));
        } else {
            db()->prepare('INSERT INTO places (name, category, description, address, district, opening_hours, ticket_info, phone, website, instagram, latitude, longitude, image, status) VALUES (:name, :category, :description, :address, :district, :opening_hours, :ticket_info, :phone, :website, :instagram, :latitude, :longitude, :image, :status)')->execute($data);
        }

        redirect('places.php');
    }
}

require __DIR__ . '/../includes/header.php';
?>
<div class="container" style="padding-top: 32px;">
    <div class="admin-shell">
        <div class="admin-topbar">
            <div>
                <div class="brand">temu.art</div>
                <div class="muted"><?= $id ? 'Edit tempat' : 'Tambah tempat' ?></div>
            </div>
            <div class="actions">
                <a href="places.php" class="small-button primary">Kembali</a>
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
                <?php if (!empty($formError)): ?>
                    <p style="color:#991b1b; font-weight:600; margin-bottom:16px;"><?= e($formError) ?></p>
                <?php endif; ?>
                <form method="post" class="form-grid">
                    <?= csrfField() ?>
                    <div class="full">
                        <label>Nama tempat</label>
                        <input type="text" name="name" value="<?= e($record['name'] ?? '') ?>" required>
                    </div>
                    <div>
                        <label>Kategori</label>
                        <input type="text" name="category" value="<?= e($record['category'] ?? '') ?>" required>
                    </div>
                    <div>
                        <label>Wilayah / Kecamatan</label>
                        <input type="text" name="district" value="<?= e($record['district'] ?? '') ?>" required>
                    </div>
                    <div class="full">
                        <label>Alamat</label>
                        <textarea name="address" rows="3" required><?= e($record['address'] ?? '') ?></textarea>
                    </div>
                    <div class="full">
                        <label>Deskripsi</label>
                        <textarea name="description" rows="5" required><?= e($record['description'] ?? '') ?></textarea>
                    </div>
                    <div>
                        <label>Jam buka</label>
                        <input type="text" name="opening_hours" value="<?= e($record['opening_hours'] ?? '') ?>">
                    </div>
                    <div>
                        <label>Tiket / akses</label>
                        <input type="text" name="ticket_info" value="<?= e($record['ticket_info'] ?? '') ?>">
                    </div>
                    <div>
                        <label>Telepon</label>
                        <input type="text" name="phone" value="<?= e($record['phone'] ?? '') ?>">
                    </div>
                    <div>
                        <label>Status</label>
                        <select name="status">
                            <option value="active" <?= (($record['status'] ?? 'active') === 'active') ? 'selected' : '' ?>>active</option>
                            <option value="draft" <?= (($record['status'] ?? 'active') === 'draft') ? 'selected' : '' ?>>draft</option>
                        </select>
                    </div>
                    <div>
                        <label>Website</label>
                        <input type="url" name="website" value="<?= e($record['website'] ?? '') ?>">
                    </div>
                    <div>
                        <label>Instagram</label>
                        <input type="text" name="instagram" value="<?= e($record['instagram'] ?? '') ?>">
                    </div>
                    <div>
                        <label>Latitude</label>
                        <input type="text" name="latitude" value="<?= e($record['latitude'] ?? '') ?>">
                    </div>
                    <div>
                        <label>Longitude</label>
                        <input type="text" name="longitude" value="<?= e($record['longitude'] ?? '') ?>">
                    </div>
                    <div class="full">
                        <label>Image URL</label>
                        <input type="url" name="image" value="<?= e($record['image'] ?? '') ?>">
                    </div>
                    <div class="full">
                        <button type="submit">Simpan</button>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
<?php require __DIR__ . '/../includes/footer.php'; ?>
