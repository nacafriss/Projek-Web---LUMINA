<?php
require "../config/koneksi.php";
include "../components/components.php";
require "../components/session_protect.php";

// Check if user is logged in
if (!isset($_SESSION['logined'])) {
    header("location: ../auth.php?action=login&status=forbidden");
    exit;
}

// $destination_id = isset($_GET['destination_id']) ? $_GET['destination_id'] : '';

$destinations_query = "SELECT id, title, price FROM destinations ORDER BY title ASC";
$destinations_result = mysqli_query($koneksi, $destinations_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?= head("Booking Wisata");  ?>
  <link rel="stylesheet" href="../css/form.booking.css"> 
  <link rel="stylesheet" href="../css/footer.css">
</head>

<body>
   <main class="container my-5"> 
    <div class="page-header">
      <nav aria-label="breadcrumb" class="breadcrumb-custom">
        <ol class="breadcrumb mb-2">
          <li class="breadcrumb-item"><a href="../index.php" style="color: black; text-decoration: none;">Home</a></li>
          <li class="breadcrumb-item"><a href="dashboard.php" style="color: black; text-decoration: none;">Dashboard</a></li>
          <li class="breadcrumb-item active" aria-current="page">Booking</li>
        </ol>
      </nav>
      <h2>Form Booking Wisata</h2>
      <p style="margin: 0.5rem 0 0 0; opacity: 0.9; font-size: 0.95rem;">Lengkapi formulir berikut untuk melakukan booking destinasi wisata</p>
    </div>

    <div class="form-card"> 
      <form action="../logic/booking.logic.php" method="post" id="bookingForm"> 
        
        <!-- Hidden field for user_id -->
        <input type="hidden" name="uuid" value="<?= $_SESSION['uuid'] ?>">
        <input type="hidden" name="user_id" value="<?= $_SESSION['id'] ?>">
        
        <!-- Destination Selection -->
        <div class="form-section">
          <h5 class="section-title">Pilih Destinasi</h5>
          
          <div class="mb-4"> 
            <label for="destination_id" class="form-label">Destinasi Wisata</label> 
            <select name="destination_id" id="destination_id" class="form-select" required>
              <option value="" selected disabled>Pilih destinasi wisata</option>
              <?php while($dest = mysqli_fetch_assoc($destinations_result)): ?>
                <option value="<?= $dest['id'] ?>" 
                        data-price="<?= $dest['price'] ?>"
                        <?= ($destination_id == $dest['id']) ? 'selected' : '' ?>>
                  <?= htmlspecialchars($dest['title']) ?> - Rp <?= number_format($dest['price'], 0, ',', '.') ?>
                </option>
              <?php endwhile; ?>
            </select> 
          </div>
          
          <div class="mb-4"> 
            <label for="booking_date" class="form-label">Tanggal Booking</label> 
            <input name="booking_date" type="date" class="form-control" id="booking_date" required
                   min="<?= date('Y-m-d', strtotime('+1 day')) ?>"> 
            <small class="text-muted">Pilih tanggal keberangkatan wisata Anda</small>
          </div>

          <div class="mb-4"> 
            <label for="pax" class="form-label">Jumlah Peserta (Pax)</label> 
            <input name="pax" type="number" class="form-control" id="pax" placeholder="Contoh: 2" min="1" max="50" required> 
            <small class="text-muted">Masukkan jumlah orang yang akan ikut</small>
          </div>
        </div>

        <!-- Contact Information -->
        <div class="form-section">
          <h5 class="section-title">Informasi Kontak</h5>
          
          <div class="mb-4"> 
            <label for="contact_name" class="form-label">Nama Lengkap</label> 
            <input name="contact_name" type="text" class="form-control" id="contact_name" 
                   placeholder="Contoh: John Doe" 
                   value="<?= htmlspecialchars($_SESSION['name']) ?>" required> 
          </div>
          
          <div class="mb-4"> 
            <label for="contact_email" class="form-label">Email</label> 
            <input name="contact_email" type="email" class="form-control" id="contact_email" 
                   placeholder="Contoh: john@example.com" 
                   value="<?= isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : '' ?>" required> 
          </div>

          <div class="mb-4"> 
            <label for="contact_phone" class="form-label">Nomor Telepon</label> 
            <input name="contact_phone" type="tel" class="form-control" id="contact_phone" 
                   placeholder="Contoh: 081234567890" 
                   pattern="[0-9]{10,13}" required> 
            <small class="text-muted">Format: 081234567890 (10-13 digit)</small>
          </div>
        </div>

        <!-- Additional Notes -->
        <div class="form-section">
          <h5 class="section-title">Catatan Tambahan</h5>
          
          <div class="mb-4"> 
            <label for="notes" class="form-label">Catatan (Opsional)</label> 
            <textarea name="notes" class="form-control" id="notes" rows="4" 
                      placeholder="Tambahkan catatan khusus, permintaan makanan, alergi, atau informasi penting lainnya..."></textarea> 
          </div>
        </div>

        <!-- Total Amount Display -->
        <div class="form-section">
          <div class="total-amount-box">
            <div class="total-label">Total Pembayaran:</div>
            <div class="total-price" id="totalAmount">Rp 0</div>
            <input type="hidden" name="total_amount" id="total_amount_hidden" value="0">
          </div>
        </div>

        <!-- Submit Buttons -->
        <div class="d-flex gap-3 mt-4"> 
          <button type="submit" class="btn btn-primary flex-grow-1">
            Submit Booking
          </button> 
          <button type="reset" class="btn btn-outline-primary" style="flex: 0 0 auto; min-width: 120px;">
            Reset
          </button> 
        </div> 
      </form> 
    </div> 
  </main> 
  
  <?php footer() ?>

  <script>
    // Calculate total amount automatically
    const destinationSelect = document.getElementById('destination_id');
    const paxInput = document.getElementById('pax');
    const totalAmountDisplay = document.getElementById('totalAmount');
    const totalAmountHidden = document.getElementById('total_amount_hidden');

    function calculateTotal() {
      const selectedOption = destinationSelect.options[destinationSelect.selectedIndex];
      const price = selectedOption.getAttribute('data-price') || 0;
      const pax = paxInput.value || 0;
      const total = price * pax;
      
      totalAmountDisplay.textContent = 'Rp ' + total.toLocaleString('id-ID');
      totalAmountHidden.value = total;
    }

    destinationSelect.addEventListener('change', calculateTotal);
    paxInput.addEventListener('input', calculateTotal);

    // Form validation
    document.getElementById('bookingForm').addEventListener('submit', function(e) {
      const pax = parseInt(paxInput.value);
      if (pax < 1) {
        e.preventDefault();
        alert('Jumlah peserta minimal 1 orang');
        return false;
      }
      
      const total = parseInt(totalAmountHidden.value);
      if (total <= 0) {
        e.preventDefault();
        alert('Silakan pilih destinasi dan jumlah peserta');
        return false;
      }
    });

    // Reset form handler
    document.querySelector('button[type="reset"]').addEventListener('click', function() {
      setTimeout(calculateTotal, 100);
    });
  </script>
</body>
</html>