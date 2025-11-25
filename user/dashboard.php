<?php
session_start();
if (!isset($_SESSION['logined']) || $_SESSION['role'] !== "user") {
    header("location: ../auth.php?action=login&status=forbidden");
    exit;
}

include "../config/koneksi.php";
include "../components/components.php";

// Ambil UUID user
$uuid = $_SESSION['uuid'];

// Ambil user_id dari tabel users
$qUser = mysqli_query($koneksi, "SELECT id FROM users WHERE uuid = '$uuid'");
$user = mysqli_fetch_assoc($qUser);
$user_id = $user['id'];  

$q = "
    SELECT b.*, d.title AS destination_name 
    FROM bookings b
    JOIN destinations d ON b.destination_id = d.id
    WHERE b.user_id = $user_id
    ORDER BY b.booking_date DESC
";
$hasil = mysqli_query($koneksi, $q);
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
        <div class="sidebar-title">LUMINA</div>
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
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Booking Kamu</h2>
            <a href="form.booking.php" class="add-btn">+ Buat Booking</a>
        </div>

        <div class="booking-grid">

            <?php if (mysqli_num_rows($hasil) == 0): ?>
                <p>Belum ada booking...</p>
            <?php else: ?>
                <?php while ($row = mysqli_fetch_assoc($hasil)): ?>
                    <div class="booking-card">
                        <div class="booking-header">
                            <h4><?= htmlspecialchars($row['destination_name']) ?></h4>
                            <span class="booking-date">
                                <?= date("d M Y", strtotime($row['booking_date'])) ?>
                            </span>
                        </div>

                        <div class="booking-body">
                            <p>Pax: <?= $row['pax'] ?></p>
                            <p>Total: Rp <?= number_format($row['total_amount'], 0, ',', '.') ?></p>

                            <p class="status 
            <?= $row['status'] == 'pending' ? 'pending' : ($row['status'] == 'confirmed' ? 'confirmed' : 'cancelled') ?>">
                                <?= ucfirst($row['status']) ?>
                            </p>
                        </div>
                    </div>

                <?php endwhile; ?>
            <?php endif; ?>

        </div>
    </main>

</body>

</html>