<?php
// LAKUKAN REQUIRE DULU
require "../config/koneksi.php";
include "../components/components.php";
require "../components/session_protect.php";
if (!isset($_SESSION['logined']) || $_SESSION['role'] !== "admin") {
    header("location: ../auth.php?action=login&status=forbidden");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?= head("Tambah Destination");  ?>
</head>
<body>
  <main class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2>Tambah Data Destination</h2>
    </div>
    <div class="card p-4 shadow-sm">
      <form action="../logic/add.logic.php" method="post">
        <div class="mb-3">
          <label for="title" class="form-label fw-bold">Title</label>
          <input name="title" type="text" class="form-control" id="nama" placeholder="Contoh: Raja Ampat" required>
        </div>
        <div class="mb-3">
          <label for="location" class="form-label fw-bold">Location</label>
          <input name="location" type="text" class="form-control" id="location" placeholder="Contoh: Papua" required>
        </div>
        <div class="mb-3">
          <label for="description" class="form-label fw-bold">Description</label>
          <textarea name="description" type="text" class="form-control" id="description" placeholder="" required>
       </textarea> </div>
        <div class="mb-3">
          <label for="category" class="form-label fw-bold">Category</label>
          <select name="category" id="category" class="form-select" aria-label="Default select example" required>
            <option selected disabled>Pilih jenis roti</option>
                <option value="manis">Roti Manis</option>
                <option value="tawar">Roti Tawar</option>
                <option value="sobek">Roti Sobek</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="price" class="form-label fw-bold">Harga (Rp)</label>
          <input name="price" type="number" class="form-control" id="harga" placeholder="Harga, Contoh: 1000000" min="0" required>
        </div>
        <div class="mb-4">
          <label for="cover_image" class="form-label fw-bold">Gambar</label>
          <input name="cover_image" type="text" class="form-control" id="gambar" placeholder="http://unsplash"">
        </div>
        <div class="d-flex gap-2">
          <button type="submit" class="btn btn-primary w-75 shadow-sm">Simpan Data</button>
          <button type="reset" class="btn btn-outline-primary w-25">Reset Form</button>
        </div>
      </form>
    </div>
  </main>
  <?php footer() ?>
</body>

</html>