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
  <link rel="stylesheet" href="../css/add.des.css"> 
  <link rel="stylesheet" href="../css/footer.css">
</head>

<body>
   <main class="container my-5"> 
    <div class="page-header">
      <nav aria-label="breadcrumb" class="breadcrumb-custom">
        <ol class="breadcrumb mb-2">
          <li class="breadcrumb-item"><a href="dashboard.php" style="color: white; text-decoration: none;">Dashboard</a></li>
          <li class="breadcrumb-item active" aria-current="page">Tambah Data</li>
        </ol>
      </nav>
      <h2>Tambah Destinasi Wisata</h2>
      <p style="margin: 0.5rem 0 0 0; opacity: 0.9; font-size: 0.95rem;">Lengkapi formulir berikut untuk menambahkan destinasi wisata baru</p>
    </div>

    <div class="form-card"> 
      <form action="../logic/add.logic.php" method="post"> 
        <div class="form-section">
          <div class="mb-4"> 
            <label for="title" class="form-label">Nama Destinasi</label> 
            <input name="title" type="text" class="form-control" id="title" placeholder="Contoh: Raja Ampat, Pulau Komodo" required> 
          </div> 
          
          <div class="mb-4"> 
            <label for="location" class="form-label">Lokasi</label> 
            <input name="location" type="text" class="form-control" id="location" placeholder="Contoh: Papua Barat, Nusa Tenggara Timur" required> 
          </div> 
        </div>

        <div class="form-section">
          <div class="mb-4"> 
            <label for="description" class="form-label">Deskripsi</label> 
            <textarea name="description" class="form-control" id="description" placeholder="Deskripsikan keunikan dan daya tarik destinasi wisata ini..." required></textarea> 
          </div> 
        </div>

        <div class="form-section">
          <div class="mb-4"> 
            <label for="category" class="form-label">Kategori Wisata</label> 
            <select name="category" id="category" class="form-select" required> 
              <option selected disabled>Pilih kategori destinasi</option> 
              <option value="pantai">Wisata Pantai</option> 
              <option value="gunung">Wisata Gunung</option> 
              <option value="budaya">Wisata Budaya</option> 
              <option value="kuliner">Wisata Kuliner</option>
              <option value="sejarah">Wisata Sejarah</option>
              <option value="alam">Wisata Alam</option>
            </select> 
          </div> 
          
          <div class="mb-4"> 
            <label for="price" class="form-label">Harga Paket (Rp)</label> 
            <input name="price" type="number" class="form-control" id="price" placeholder="Contoh: 1500000" min="0" required> 
            <small class="text-muted">Harga paket wisata per orang</small>
          </div> 
        </div>

        <div class="form-section">
          <div class="mb-4"> 
            <label for="maps_embed" class="form-label">Maps Embed</label> 
            <input name="maps_embed" type="text" class="form-control" id="maps_embed" placeholder="" required> 
            <small class="text-muted">Link lokasi</small>
          </div>

          <div class="mb-4"> 
            <label for="cover_image" class="form-label">URL Gambar</label> 
            <input name="cover_image" type="url" class="form-control" id="cover_image" placeholder="https://example.com/image.jpg"> 
            <small class="text-muted">Link gambar destinasi dari internet (opsional)</small>
          </div> 
        </div>

        <div class="d-flex gap-3 mt-4"> 
          <button type="submit" class="btn btn-primary flex-grow-1">
            Simpan Destinasi
          </button> 
          <button type="reset" class="btn btn-outline-primary" style="flex: 0 0 auto; min-width: 120px;">
            Reset
          </button> 
        </div> 
      </form> 
    </div> 
  </main> 
  <?php footer() ?>
</body>

</html>