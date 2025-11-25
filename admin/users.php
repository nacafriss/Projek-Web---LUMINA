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
    <title>Users Management</title>
    <link rel="stylesheet" href="../css/admin.dashboard.css">
    <link rel="stylesheet" href="../css/users.css">
</head>

<body class="users">

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

    <!-- CONTENT -->
    <main class="content">
        <h2>Daftar User</h2>

        <?php  
        $q = "
            SELECT 
                u.id, u.name, u.email, u.phone, u.role,
                (SELECT COUNT(*) FROM bookings WHERE user_id = u.id) AS total_booking
            FROM users u
            ORDER BY u.name ASC
        ";
        $result = mysqli_query($koneksi, $q);
        ?>

        <table class="user-table">
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Telepon</th>
                <th>Total Booking</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['phone'] ?: "-") ?></td>

                <td><b><?= $row['total_booking'] ?></b></td>

                <td>
                    <span class="badge-role 
                        <?= $row['role'] === 'admin' ? 'role-admin' : 'role-user' ?>
                    ">
                        <?= ucfirst($row['role']) ?>
                    </span>
                </td>

                <td>
                    <!-- Lihat booking user -->
                    <a href="bookings.php?user=<?= $row['id'] ?>" class="btn-small btn-view">
                        Lihat Booking
                    </a>

                    <!-- Ubah role -->
                    <a 
                        href="../logic/user.toggle.role.php?id=<?= $row['id'] ?>" 
                        class="btn-small btn-toggle"
                        onclick="return confirm('Ubah role user ini?')"
                    >
                        Ubah Role
                    </a>

                    <!-- Hapus user -->
                    <a 
                        href="../logic/user.delete.php?id=<?= $row['id'] ?>"
                        class="btn-small btn-delete"
                        onclick="return confirm('Hapus user ini beserta bookingnya?')"
                    >
                        Hapus
                    </a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>

    </main>

</body>
</html>
