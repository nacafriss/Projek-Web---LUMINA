<?php 
session_start();
if (!isset($_SESSION['logined']) || $_SESSION['role'] !== "user") {
    header("location: ../auth.php?action=login&status=forbidden");
    exit;
}

include "../config/koneksi.php";
include "../components/components.php";

$uuid = $_SESSION['uuid'];

$sql = "
    SELECT b.*
    FROM bookings b
    JOIN users u ON b.user_id = u.id
    WHERE u.uuid = '$uuid'
";

$result = mysqli_query($koneksi, $sql);

if (!$result) {
    echo "Query error: " . mysqli_error($koneksi);
} elseif (mysqli_num_rows($result) == 0) {
    echo "<p>Belum ada destinasi</p>";
} else {
    while ($row = mysqli_fetch_assoc($result)) {
        cardDestination($row); // memanggil fungsi untuk menampilkan card
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?= head("User Dashboard");  ?>
    <link rel="stylesheet" href="../css/user.dashboard.css">
    <link rel="stylesheet" href="../css/footer.css">
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="sidebar-title">User Panel</div>
        
        <a href="dashboard.php" class="side-link">Dashboard</a>
        <a href="../index.php" class="side-link">Home</a>

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
            <h2>Dashboard User</h2>

            <a href="form.booking.php" class="add-btn">+ Tambah Booking</a>
        </div>

        <section class="menu-grid">
            <?php

            if (mysqli_num_rows($result) == 0) {
                echo "<p>Belum ada destinasi</p>";
            }

            while ($row = mysqli_fetch_assoc($result)) {
                cardDestination($row);
            }
            ?>
        </section>
    </main>
</body>

</html>