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
    <link rel="stylesheet" href="../css/admin.dashboard.css">
    
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="sidebar-title">Admin Panel</div>

        <a href="dashboard.php" class="side-link">Dashboard</a>
        <a href="bookings.php" class="side-link">Bookings</a>    
        <a href="users.php" class="side-link">Users</a>

        <form action="../logic/auth.logic.php?action=logout" method="post">
            <button class="logout-btn">Logout</button>
        </form>
    </div>

    <!-- TOPBAR -->
    <div class="topbar">
        Halo, <?= htmlspecialchars($_SESSION['name']) ?> 👋
    </div>

    <!-- MAIN CONTENT -->
    <main class="content">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Dashboard Admin</h2>

            <a href="add.destination.php" class="add-btn">+ Tambah Destination</a>
        </div>

        <section class="menu-grid">
            <?php
            $sql = "SELECT * FROM destinations";
            $result = mysqli_query($koneksi, $sql);

            if (mysqli_num_rows($result) == 0) {
                echo "<p>Belum ada destinasi</p>";
            }

            while ($row = mysqli_fetch_assoc($result)) {
                cardDestinationAdmin($row);
            }
            ?>
        </section>
    </main>
<?php footer()?>
</body>
</html>
