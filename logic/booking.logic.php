<?php
session_start();
require "../config/koneksi.php";

// Check if user is logged in
if (!isset($_SESSION['logined'])) {
    header("location: ../auth.php?action=login&status=forbidden");
    exit;
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $uuid = mysqli_real_escape_string($koneksi, $_POST['id']);
    $destination_id = mysqli_real_escape_string($koneksi, $_POST['destination_id']);
    $booking_date = mysqli_real_escape_string($koneksi, $_POST['booking_date']);
    $pax = mysqli_real_escape_string($koneksi, $_POST['pax']);
    $contact_name = mysqli_real_escape_string($koneksi, $_POST['contact_name']);
    $contact_email = mysqli_real_escape_string($koneksi, $_POST['contact_email']);
    $contact_phone = mysqli_real_escape_string($koneksi, $_POST['contact_phone']);
    $total_amount = mysqli_real_escape_string($koneksi, $_POST['total_amount']);
    $notes = mysqli_real_escape_string($koneksi, $_POST['notes']);
    
    // Validate data
    if (empty($destination_id) || empty($booking_date) || empty($pax) || empty($contact_name) || empty($contact_email) || empty($contact_phone)) {
        header("location: ../user/form.booking.php?status=error&message=" . urlencode("Semua field wajib diisi"));
        exit;
    }
    
    // Validate pax
    if ($pax < 1) {
        header("location: ../user/form.booking.php?status=error&message=" . urlencode("Jumlah peserta minimal 1 orang"));
        exit;
    }
    
    // Validate booking date (must be in the future)
    $today = date('Y-m-d');
    if ($booking_date <= $today) {
        header("location: ../user/form.booking.php?status=error&message=" . urlencode("Tanggal booking harus di masa depan"));
        exit;
    }
    
    // Insert booking into database with status 'pending'
    $sql = "INSERT INTO bookings (user_id, destination_id, booking_date, created_at, pax, contact_name, contact_email, contact_phone, total_amount, status, notes) 
            VALUES ('$uuid', '$destination_id', '$booking_date', NOW(), '$pax', '$contact_name', '$contact_email', '$contact_phone', '$total_amount', 'pending', '$notes')";
    
    if (mysqli_query($koneksi, $sql)) {
        // Get the booking ID
        $booking_id = mysqli_insert_id($koneksi);
        
        // Redirect to success page or index
        header("location: ../index.php?status=success&message=" . urlencode("Booking berhasil! Menunggu konfirmasi admin"));
        exit;
    } else {
        header("location: ../user/form.booking.php?status=error&message=" . urlencode("Gagal melakukan booking: " . mysqli_error($koneksi)));
        exit;
    }
} else {
    header("location: ../user/form.booking.php");
    exit;
}
?>