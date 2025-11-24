<?php
function head($title)
{
?>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($title) ?></title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
    crossorigin="anonymous">

  <link rel="stylesheet" href="../css/style.css">
  
<?php
}
?>

<?php
function footer()
{ ?>
  <div class="footer">
    <div class="footer-content">
      <div class="footer-nav">
        <a href="index.php">Home</a>
        <a href="#about">About</a>
        <a href="#contact">Contact</a>
      </div>

      <div class="footer-social">
        <a href="#"><i class="fa-brands fa-instagram"></i></a>
        <a href="#"><i class="fa-brands fa-facebook"></i></a>
        <a href="#"><i class="fa-brands fa-twitter"></i></a>
      </div>

      <p class="footer-copy">© 2025 LUMINA. All Rights Reserved.</p>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  <!-- Untuk UX menghapus status urlnya || Silahkan uncomment kalo mau make, gak usah biarain juga boleh -->
  <script>
    if (window.location.search.includes("status=")) {
      window.history.replaceState({}, document.title, window.location.pathname);
    }
  </script>
<?php }
?>

<?php
function alert($type, $massage)
{ ?>
  <div class="px-2 pt-2">
    <div class="alert alert-<?= $type ?> m-0 shadow-sm" role="alert">
      <?= $massage ?>
    </div>
  </div>

<?php } ?>

<?php
function listAlert($status)
{
  // ALERT STATUS TAMPIl
  switch ($status) {
    case "berhasil":
      alert("success", "Register Berhasil! Silahkan login");
      break;
    case "gagal_password":
      alert("danger", "Error: Konfirmasi Password tidak sama");
      break;
    case "duplikat":
      alert("danger", "Error: Email sudah terdaftar");
      break;
    case "email_tidak_ditemukan":
      alert("danger", "Error: Akun email tidak ditemukan");
      break;
    case "password_salah":
      alert("danger", "Error: Password salah");
      break;
    case "gagal":
      alert("danger", "Error: Terjadi Kesalahan");
      break;
    case "harus_login":
      alert("danger", "Error: Anda perlu login!");
      break;
    case "berhasil_tambah":
      alert("success", "Berhasil menambah");
      break;
    default:
      break;
  }
}
?>

