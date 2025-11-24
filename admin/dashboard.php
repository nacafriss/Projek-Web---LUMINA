<?php 
session_start();
if (!isset($_SESSION['logined']) || $_SESSION['role'] !== "admin") {
    header("location: ../auth.php?action=login&status=forbidden");
    exit;
}

include "../config/koneksi.php";
include "../components/components.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
</head>
<body>
 <main class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2>Selamat Datang, <?= htmlspecialchars($_SESSION['name']) ?></h2>
      <a href="add.destination.php"><button type="button" class="btn btn-primary shadow-sm">Tambah Destination</button></a>
    </div>

    <section class="d-flex flex-wrap gap-4 mt-4 justify-content-start">
      <?php
      $sql = "SELECT * FROM destinations";
      $result = mysqli_query($koneksi, $sql);
      if (mysqli_num_rows($result) == 0) {
        echo "<p>Belum ada menu roti </p>";
      }
      while ($row = mysqli_fetch_assoc($result)) {
        cardMenu($row);  // Menggunakan komponen cardMenu()
      }
      ?>
    </section>
  </main>

  <?php footer() ?>
</body>

</html>