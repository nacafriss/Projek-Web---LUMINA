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
  <?= head("Dashboard Admin");  ?>
  <link rel="stylesheet" href="../css/admin.dashboard.css">
</head>

<body>

  <div class="admin-wrapper">
    <header class="admin-header">
      <h2>Dashboard Admin</h2>
      <div class="header-right">
        <span class="admin-name">Halo, <?= htmlspecialchars($_SESSION['name']) ?> 👋</span>

        <a href="add.destination.php" class="btn-main">+ Tambah Destination</a>

        <form action="../logic/auth.logic.php?action=logout" method="post">
          <button class="btn-logout" type="submit">Logout</button>
        </form>
      </div>
    </header>

    <main class="content-area">
      <h3 class="section-title">Daftar Destination</h3>

      <section class="d-flex flex-wrap gap-4 mt-4 justify-content-start">
        <?php
        $sql = "SELECT id, title, location, cover_image FROM destinations";
        $result = mysqli_query($koneksi, $sql);
        if (mysqli_num_rows($result) == 0) {
          echo "<p>Belum ada destination </p>";
        }
        while ($row = mysqli_fetch_assoc($result)) {
          cardDestinationAdmin($row);  // Menggunakan komponen cardMenu()
        }
        ?>
      </section>
    </main>
  </div>

  <?php footer(); ?>

</body>

</html>