<?php 
session_start();
if (!isset($_SESSION['logined']) || $_SESSION['role'] !== "admin") {
    header("location: ../auth.php?action=login&status=forbidden");
    exit;
}

require "../config/koneksi.php";
include "../components/components.php";

if (!isset($_GET['id'])) {
    header("location: bookings.php");
    exit;
}

$booking_id = intval($_GET['id']);

$sql = "
    SELECT 
        bookings.*,
        users.name AS user_name,
        users.email AS user_email,
        destinations.title AS dest_name,
        destinations.location AS dest_location,
        destinations.price AS dest_price
    FROM bookings
    JOIN users ON bookings.user_id = users.id
    JOIN destinations ON bookings.destination_id = destinations.id
    WHERE bookings.id = $booking_id
";

$result = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "Booking tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Booking</title>
    <link rel="stylesheet" href="../css/admin.dashboard.css">
</head>
<body>

<div class="sidebar">
    <div class="sidebar-title">Admin Panel</div>
    <a href="dashboard.php" class="side-link">Dashboard</a>
    <a href="bookings.php" class="side-link">Bookings</a>
    <a href="users.php" class="side-link">Users</a>
</div>

<div class="topbar">
    Halo, <?= htmlspecialchars($_SESSION['name']) ?> 👋
</div>

<main class="content">
    <h2>Detail Booking #<?= $booking_id ?></h2>

    <div class="detail-card">

        <h3>Informasi Pemesan</h3>
        <p><strong>Nama:</strong> <?= htmlspecialchars($data['user_name']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($data['user_email']) ?></p>

        <hr>

        <h3>Destinasi Wisata</h3>
        <p><strong>Nama:</strong> <?= htmlspecialchars($data['dest_name']) ?></p>
        <p><strong>Lokasi:</strong> <?= htmlspecialchars($data['dest_location']) ?></p>
        <p><strong>Harga:</strong> Rp <?= number_format($data['dest_price'], 0, ',', '.') ?></p>

        <hr>

        <h3>Detail Booking</h3>
        <p><strong>Tanggal Booking:</strong> <?= $data['created_at'] ?></p>
        <p><strong>Status:</strong>
            <span class="status-badge status-<?= $data['status'] ?>">
                <?= ucfirst($data['status']) ?>
            </span>
        </p>

        <form action="../logic/update.booking.status.php" method="post" class="mt-3">
            <input type="hidden" name="booking_id" value="<?= $booking_id ?>">

            <label>Status Baru</label>
            <select name="status" class="form-select">
                <option value="pending" <?= $data['status']=="pending"?"selected":"" ?>>Pending</option>
                <option value="approved" <?= $data['status']=="approved"?"selected":"" ?>>Approved</option>
                <option value="declined" <?= $data['status']=="declined"?"selected":"" ?>>Declined</option>
            </select>

            <button type="submit" class="btn btn-primary mt-2">Update Status</button>
        </form>

        <a href="users.php" class="btn btn-outline-primary mt-3">← Kembali</a>

    </div>

</main>

<?php footer()?>
</body>
</html>
