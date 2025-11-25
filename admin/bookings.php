<?php 
session_start();
if (!isset($_SESSION['logined']) || $_SESSION['role'] !== "admin") {
    header("location: ../auth.php?action=login&status=forbidden");
    exit;
}

include "../config/koneksi.php";
include "../components/components.php";

$q = "
    SELECT b.*, 
           u.name AS user_name, 
           u.email AS user_email,
           d.title AS destination_name,
           d.price AS destination_price
    FROM bookings b
    JOIN users u ON b.user_id = u.id
    JOIN destinations d ON b.destination_id = d.id
    ORDER BY b.created_at DESC
";
$hasil = mysqli_query($koneksi, $q);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin - Bookings</title>
    <link rel="stylesheet" href="../css/admin.dashboard.css">
    <link rel="stylesheet" href="../css/admin.bookings.css">
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <div class="sidebar-title">Admin Panel</div>

    <a href="dashboard.php" class="side-link">Dashboard</a>
    <a href="bookings.php" class="side-link active">Bookings</a>
    <a href="users.php" class="side-link">Users</a>

    <form action="../logic/auth.logic.php?action=logout" method="post">
        <button class="logout-btn">Logout</button>
    </form>
</div>

<!-- TOPBAR -->
<div class="topbar">
    Halo, <?= htmlspecialchars($_SESSION['name']) ?> 👋
</div>

<main class="content">

    <h2 class="mb-4">Semua Booking</h2>

    <div class="booking-grid">
        <?php if (mysqli_num_rows($hasil) == 0): ?>
            <p>Belum ada booking dibuat</p>
        <?php else: ?>
            <?php while ($row = mysqli_fetch_assoc($hasil)): ?>
                
                <div class="booking-card">

                    <div class="header">
                        <h3><?= $row['destination_name'] ?></h3>
                        <span class="status <?= $row['status'] ?>"><?= ucfirst($row['status']) ?></span>
                    </div>

                    <div class="body">
                        <p><strong>User:</strong> <?= $row['user_name'] ?> (<?= $row['user_email'] ?>)</p>
                        <p><strong>Tanggal Booking:</strong> <?= date("d M Y", strtotime($row['booking_date'])) ?></p>
                        <p><strong>Harga per Pax:</strong> Rp <?= number_format($row['destination_price'], 0, ',', '.') ?></p>
                        <p><strong>Pax:</strong> <?= $row['pax'] ?></p>
                        <p><strong>Total:</strong> Rp <?= number_format($row['total_amount'], 0, ',', '.') ?></p>
                    </div>

                    <div class="actions">
                        <form action="../logic/booking.status.php" method="post">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">

                            <select name="status" class="status-select">
                                <option value="pending"    <?= $row['status']=='pending'?'selected':'' ?>>Pending</option>
                                <option value="confirmed"  <?= $row['status']=='confirmed'?'selected':'' ?>>Confirmed</option>
                                <option value="completed"  <?= $row['status']=='completed'?'selected':'' ?>>Completed</option>
                                <option value="rejected"   <?= $row['status']=='rejected'?'selected':'' ?>>Rejected</option>
                                <option value="cancelled"  <?= $row['status']=='cancelled'?'selected':'' ?>>Cancelled</option>
                            </select>

                            <button type="submit" class="btn-update">Update</button>
                        </form>
                    </div>

                </div>

            <?php endwhile; ?>
        <?php endif; ?>
    </div>

</main>

</body>
</html>
