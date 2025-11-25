<?php
require "../config/koneksi.php";
include "../components/components.php";
require "../components/session_protect.php";

if (!isset($_SESSION['logined']) || $_SESSION['role'] !== "admin") {
    header("location: ../auth.php?action=login&status=forbidden");
    exit;
}

if (!isset($_GET['id'])) {
    header("location: dashboard.php?status=error&message=ID tidak ditemukan");
    exit;
}

$id = intval($_GET['id']);
$query = mysqli_query($koneksi, "SELECT * FROM destinations WHERE id = $id");

if (mysqli_num_rows($query) == 0) {
    header("location: dashboard.php?status=error&message=Data tidak ditemukan");
    exit;
}

$data = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?= head("Edit Destination"); ?>
  <link rel="stylesheet" href="../css/add.des.css"> 
  <link rel="stylesheet" href="../css/footer.css">
</head>

<body>
  <main class="container my-5">
    <div class="page-header">
      <h2>Edit Destinasi Wisata</h2>
      <p>Perbarui data destinasi berikut</p>
    </div>

    <div class="form-card">
      <form action="../logic/update.logic.php" method="post">

        <input type="hidden" name="id" value="<?= $data['id'] ?>">

        <div class="form-section">
          <div class="mb-4">
            <label for="title" class="form-label">Nama Destinasi</label>
            <input name="title" type="text" class="form-control" id="title"
                   value="<?= htmlspecialchars($data['title']) ?>" required>
          </div>

          <div class="mb-4">
            <label for="location" class="form-label">Lokasi</label>
            <input name="location" type="text" class="form-control" id="location"
                   value="<?= htmlspecialchars($data['location']) ?>" required>
          </div>
        </div>

        <div class="form-section">
          <div class="mb-4">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control" id="description" required><?= htmlspecialchars($data['description']) ?></textarea>
          </div>
        </div>

        <div class="form-section">
          <div class="mb-4">
            <label for="category" class="form-label">Kategori Wisata</label>
            <select name="category" id="category" class="form-select" required>
              <option value="pantai"   <?= $data['category']=="pantai"?"selected":"" ?>>Wisata Pantai</option>
              <option value="gunung"   <?= $data['category']=="gunung"?"selected":"" ?>>Wisata Gunung</option>
              <option value="budaya"   <?= $data['category']=="budaya"?"selected":"" ?>>Wisata Budaya</option>
              <option value="kuliner"  <?= $data['category']=="kuliner"?"selected":"" ?>>Wisata Kuliner</option>
              <option value="sejarah"  <?= $data['category']=="sejarah"?"selected":"" ?>>Wisata Sejarah</option>
              <option value="alam"     <?= $data['category']=="alam"?"selected":"" ?>>Wisata Alam</option>
            </select>
          </div>

          <div class="mb-4">
            <label for="price" class="form-label">Harga Paket (Rp)</label>
            <input name="price" type="number" class="form-control" id="price"
                   value="<?= $data['price'] ?>" min="0" required>
          </div>
        </div>

        <div class="form-section">
          <div class="mb-4">
            <label for="maps_embed" class="form-label">Maps Embed</label>
            <input name="maps_embed" type="text" class="form-control" id="maps_embed"
                   value="<?= htmlspecialchars($data['maps_embed']) ?>" required>
          </div>

          <div class="mb-4">
            <label for="cover_image" class="form-label">URL Gambar</label>
            <input name="cover_image" type="url" class="form-control" id="cover_image"
                   value="<?= htmlspecialchars($data['cover_image']) ?>">
          </div>
        </div>

        <div class="d-flex gap-3 mt-4">
          <button type="submit" class="btn btn-primary flex-grow-1">Perbarui</button>
          <a href="dashboard.php" class="btn btn-outline-primary">Batal</a>
        </div>

      </form>
    </div>
  </main>

  <?php footer() ?>
</body>
</html>
