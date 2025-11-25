<?php
session_start();
if (!isset($_SESSION['logined']) || $_SESSION['role'] !== "admin") {
    header("location: ../auth.php?action=login&status=forbidden");
    exit;
}

require "../config/koneksi.php";
include "../components/components.php";
?>

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users & Bookings</title>
    <link rel="stylesheet" href="../css/admin.dashboard.css">
    <link rel="stylesheet" href="../css/usersbook.css">
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="sidebar-title">Admin Panel</div>

        <a href="dashboard.php" class="side-link">Dashboard</a>
        <a href="usersbook.php" class="side-link">Bookings</a>
        <a href="users.php" class="side-link active">Users</a>

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
        <h2>Daftar User & Booking</h2>

        <?php
        $sql = "
            SELECT 
                bookings.id AS booking_id,
                bookings.status,
                bookings.created_at,
                users.id AS user_id,
                users.name AS user_name,
                users.email,
                destinations.title AS destination_name
            FROM bookings
            JOIN users ON bookings.user_id = users.id
            JOIN destinations ON bookings.destination_id = destinations.id
            ORDER BY bookings.created_at DESC
        ";

        $result = mysqli_query($koneksi, $sql);

        if (mysqli_num_rows($result) == 0) { ?>
            <p style="color: black">Belum ada pesanan</p>
        <?php
        } else {
        ?>

            <table class="table-custom">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Email</th>
                        <th>Destinasi</th>
                        <th>Tanggal Booking</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?= htmlspecialchars($row['user_name']) ?></td>
                            <td><?= htmlspecialchars($row['email']) ?></td>
                            <td><?= htmlspecialchars($row['destination_name']) ?></td>
                            <td><?= $row['created_at'] ?></td>

                            <td>
                                <span class="status-badge status-<?= $row['status'] ?>">
                                    <?= ucfirst($row['status']) ?>
                                </span>
                            </td>

                            <td>
                                <form action="../logic/update.status.php" method="post" class="d-flex" style="gap: 8px;">
                                    <input type="hidden" name="booking_id" value="<?= $row['booking_id'] ?>">

                                    <select name="status" class="form-select">
                                        <option value="pending" <?= $row['status'] == "pending" ? "selected" : "" ?>>Pending</option>
                                        <option value="approved" <?= $row['status'] == "approved" ? "selected" : "" ?>>Approved</option>
                                        <option value="declined" <?= $row['status'] == "declined" ? "selected" : "" ?>>Declined</option>
                                    </select>

                                    <button type="submit" class="btn btn-primary btn-sm" name="update">Update</button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        <?php } ?>

    </main>

    <?php footer() ?>
</body>

</html>