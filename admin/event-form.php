<?php
require __DIR__ . '/../includes/functions.php';
require __DIR__ . '/includes/auth.php';
require __DIR__ . '/includes/csrf.php';

$basePath = '../';
$pageTitle = 'Form Event';
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$record = null;

if ($id) {
    $stmt = db()->prepare('SELECT * FROM events WHERE id = :id LIMIT 1');
    $stmt->execute([':id' => $id]);
    $record = $stmt->fetch();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verifyCsrf()) {
        die('CSRF token tidak valid.');
    }

    $title = trim((string) ($_POST['title'] ?? ''));
    $type = trim((string) ($_POST['type'] ?? ''));
    $description = trim((string) ($_POST['description'] ?? ''));
    $location = trim((string) ($_POST['location'] ?? ''));
    $placeId = filter_input(INPUT_POST, 'place_id', FILTER_VALIDATE_INT) ?: null;
    $startDate = trim((string) ($_POST['start_date'] ?? ''));
    $endDate = trim((string) ($_POST['end_date'] ?? ''));
    $ticketInfo = trim((string) ($_POST['ticket_info'] ?? ''));
    $website = trim((string) ($_POST['website'] ?? ''));
    $instagram = trim((string) ($_POST['instagram'] ?? ''));
    $mapUrl = trim((string) ($_POST['map_url'] ?? ''));
    $status = in_array($_POST['status'] ?? 'active', ['active', 'draft'], true) ? $_POST['status'] : 'active';
    $image = trim((string) ($_POST['image'] ?? ''));

    if ($title === '' || $type === '' || $description === '' || $startDate === '' || $endDate === '') {
        $formError = 'Judul, tipe, deskripsi, serta tanggal mulai dan selesai wajib diisi.';
    } else {
        $data = [
            ':title' => $title,
            ':type' => $type,
            ':description' => $description,
            ':location' => $location,
            ':place_id' => $placeId,
            ':start_date' => $startDate,
            ':end_date' => $endDate,
            ':ticket_info' => $ticketInfo,
            ':website' => $website,
            ':instagram' => $instagram,
            ':map_url' => $mapUrl,
            ':status' => $status,
            ':image' => $image,
        ];

        if ($id) {
            db()->prepare('UPDATE events SET title=:title, type=:type, description=:description, location=:location, place_id=:place_id, start_date=:start_date, end_date=:end_date, ticket_info=:ticket_info, website=:website, instagram=:instagram, map_url=:map_url, status=:status, image=:image WHERE id=:id')->execute(array_merge($data, [':id' => $id]));
        } else {
            db()->prepare('INSERT INTO events (title, type, description, location, place_id, start_date, end_date, ticket_info, website, instagram, map_url, status, image) VALUES (:title, :type, :description, :location, :place_id, :start_date, :end_date, :ticket_info, :website, :instagram, :map_url, :status, :image)')->execute($data);
        }

        redirect('events.php');
    }
}

require __DIR__ . '/../includes/header.php';
?>
<div class="container" style="padding-top: 32px;">
    <div class="admin-shell">
        <div class="admin-topbar">
            <div>
                <div class="brand">temu.art</div>
                <div class="muted"><?= $id ? 'Edit event' : 'Tambah event' ?></div>
            </div>
            <div class="actions">
                <a href="events.php" class="small-button primary">Kembali</a>
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
                <?php if (!empty($formError)): ?>
                    <p style="color:#991b1b; font-weight:600; margin-bottom:16px;"><?= e($formError) ?></p>
                <?php endif; ?>
                <form method="post" class="form-grid">
                    <?= csrfField() ?>
                    <div class="full">
                        <label>Judul event</label>
                        <input type="text" name="title" value="<?= e($record['title'] ?? '') ?>" required>
                    </div>
                    <div>
                        <label>Tipe</label>
                        <input type="text" name="type" value="<?= e($record['type'] ?? '') ?>" required>
                    </div>
                    <div>
                        <label>Place ID</label>
                        <input type="number" name="place_id" value="<?= e((string) ($record['place_id'] ?? '')) ?>">
                    </div>
                    <div>
                        <label>Lokasi</label>
                        <input type="text" name="location" value="<?= e($record['location'] ?? '') ?>">
                    </div>
                    <div>
                        <label>Tanggal mulai</label>
                        <input type="date" name="start_date" value="<?= e($record['start_date'] ?? '') ?>" required>
                    </div>
                    <div>
                        <label>Tanggal selesai</label>
                        <input type="date" name="end_date" value="<?= e($record['end_date'] ?? '') ?>" required>
                    </div>
                    <div>
                        <label>Ticket / informasi</label>
                        <input type="text" name="ticket_info" value="<?= e($record['ticket_info'] ?? '') ?>">
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
                        <label>Map URL</label>
                        <input type="url" name="map_url" value="<?= e($record['map_url'] ?? '') ?>">
                    </div>
                    <div>
                        <label>Image URL</label>
                        <input type="url" name="image" value="<?= e($record['image'] ?? '') ?>">
                    </div>
                    <div class="full">
                        <label>Deskripsi</label>
                        <textarea name="description" rows="5" required><?= e($record['description'] ?? '') ?></textarea>
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
