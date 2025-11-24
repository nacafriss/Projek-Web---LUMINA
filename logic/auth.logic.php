<?php 
session_start();
include "../config/koneksi.php";
include "../components/components.php";
$action = $_GET['action'];

function generate_uuid_v4() {   
    $data = random_bytes(16);
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}


// REGISTER
if ($action == "register") {
    $name = $_POST['name'] ?? "kosong";
    $email = $_POST['email'] ?? "kosong";
    $phone = $_POST['phone'];
    $password = $_POST['password'] ?? "kosong";
    $confirm = $_POST['re-password'] ?? "kosong";
    if ($password != $confirm) {
        header("location:../auth.php?status=gagal_password");
        exit;
    }
    $uuid = generate_uuid_v4(); 
    $check = mysqli_query($koneksi, "SELECT * FROM users where email = '$email'");
    if (mysqli_num_rows($check) > 0) {
        header("location:../auth.php?status=duplikat");
        exit;
    }

    $sql = "INSERT INTO users(uuid,name, email, phone, password, role) VALUES ('$uuid','$name', '$email', '$phone', '$password', 'admin')";
    $result = mysqli_query($koneksi, $sql);

    if ($result) {
        header("location:../auth.php?status=berhasil"); //arahkan ke index
    } else {
        header("location:../auth.php?status=gagal"); //kalo gagal, kembali ke register. ? = get
    }
}

// LOGIN
if ($action == "login") {
    $email = $_POST['email'] ?? "kosong";
    $password = $_POST['password'] ?? "kosong";
    $check = mysqli_query($koneksi, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($check) == 0) {
        header("location:../auth.php?action=login&status=email_tidak_ditemukan");
        exit;
    }
    $user = mysqli_fetch_assoc($check);
    if ($user['password'] !== $password) {
        header("location:../auth.php?action=login&status=password_salah");
        exit;
    }
     $_SESSION['logined'] = true;
    $_SESSION['uuid'] = $user['uuid'];
    $_SESSION['name'] = $user['name'];
    $_SESSION['role'] = $user['role'];
 if ($_SESSION['role'] === "admin") {
    header("location: ../admin/dashboard.php");
} else {
    header("location: ../user/dashboard.php");
}
exit;

    exit;
}
// LOGOUT
if ($action == "logout") {
    session_destroy();
    header("location:../index.php");
    exit;
}
mysqli_close($koneksi);
?>