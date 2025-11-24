-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2025 at 05:29 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wisata_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `destination_id` int(11) NOT NULL,
  `booking_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `pax` int(11) NOT NULL DEFAULT 1,
  `contact_name` varchar(200) NOT NULL,
  `contact_email` varchar(200) NOT NULL,
  `contact_phone` varchar(50) DEFAULT NULL,
  `total_amount` decimal(12,2) DEFAULT 0.00,
  `status` enum('pending','confirmed','rejected','completed','cancelled') NOT NULL DEFAULT 'pending',
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `destinations`
--

CREATE TABLE `destinations` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `price` decimal(12,2) DEFAULT 0.00,
  `description` text DEFAULT NULL,
  `maps_embed` text DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `destinations`
--

INSERT INTO `destinations` (`id`, `title`, `location`, `price`, `description`, `maps_embed`, `cover_image`, `category`, `created_at`, `updated_at`) VALUES
(1, 'Candi Borobudur', 'Magelang Jawa Tengah', 50000.00, 'Candi Buddha terbesar di dunia dan situs warisan UNESCO. Dibangun pada abad ke-9 dengan arsitektur megah berbentuk mandala. Terdiri dari 504 arca Buddha dan 2672 panel relief yang menggambarkan ajaran Buddha.', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.7!2d110.203!3d-7.607', 'https://images.unsplash.com/photo-1591522811280-a8759970b03f?w=800', 'Sejarah', '2025-11-24 13:39:00', '2025-11-24 13:39:00'),
(2, 'Taman Nasional Komodo', 'Labuan Bajo Nusa Tenggara Timur', 50000.00, 'Habitat asli komodo, kadal terbesar di dunia. Taman nasional ini terdiri dari Pulau Komodo, Pulau Rinca, Pulau Padar dan pulau-pulau kecil lainnya. Menawarkan trekking melihat komodo, snorkeling di perairan jernih, dan pemandangan savana yang menakjubkan.', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3948.2!2d119.889!3d-8.545', 'https://images.unsplash.com/photo-1570789210967-2cac24afeb00?w=800', 'Alam', '2025-11-24 13:39:00', '2025-11-24 13:39:00'),
(3, 'Taman Nasional Bromo Tengger Semeru', 'Probolinggo Jawa Timur', 54000.00, 'Kawasan gunung berapi aktif dengan pemandangan sunrise spektakuler dari Penanjakan. Terdapat Gunung Bromo dengan kaldera luas, lautan pasir, dan Pura Luhur Poten. Pengalaman unik berjalan di lautan pasir dan menaiki kawah Bromo.', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.4!2d112.953!3d-7.942', 'https://images.unsplash.com/photo-1596422846543-75c6fc197f07?w=800', 'Alam', '2025-11-24 13:39:00', '2025-11-24 13:39:00'),
(4, 'Raja Ampat', 'Papua Barat', 500000.00, 'Surga bagi penyelam dengan keanekaragaman hayati laut terkaya di dunia. Terdiri dari 1500 pulau kecil dengan laguna biru, terumbu karang yang masih pristine, dan pemandangan karst yang ikonik. Rumah bagi 75 persen spesies karang dunia.', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4025.8!2d130.839!3d-0.238', 'https://images.unsplash.com/photo-1559628376-f3fe5f782a2e?w=800', 'Pantai', '2025-11-24 13:39:00', '2025-11-24 13:39:00'),
(5, 'Danau Toba', 'Sumatera Utara', 0.00, 'Danau vulkanik terbesar di Asia Tenggara dengan Pulau Samosir di tengahnya. Pemandangan danau yang luas dikelilingi pegunungan hijau. Pusat budaya Batak dengan desa tradisional, makam raja-raja, dan pertunjukan musik Batak.', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4048.9!2d98.876!3d2.685', 'https://images.unsplash.com/photo-1582719471384-894fbb16e074?w=800', 'Alam', '2025-11-24 13:39:00', '2025-11-24 13:39:00'),
(6, 'Tanah Lot', 'Tabanan Bali', 60000.00, 'Pura laut ikonik di atas batu karang yang dikelilingi ombak. Salah satu pura terpenting di Bali dan tempat terbaik untuk menikmati sunset. Arsitektur pura yang unik dengan latar belakang laut Hindia yang dramatis.', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3946.8!2d115.086!3d-8.621', 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=800', 'Budaya', '2025-11-24 13:39:00', '2025-11-24 13:39:00'),
(7, 'Taman Nasional Baluran', 'Situbondo Jawa Timur', 21000.00, 'Dijuluki Africa van Java karena memiliki savana luas menyerupai Afrika. Habitat banteng Jawa, rusa, merak, dan berbagai satwa liar lainnya. Terdapat Pantai Bama yang indah dan hutan mangrove. Spot fotografi wildlife terbaik di Jawa.', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3954.2!2d114.365!3d-7.851', 'https://images.unsplash.com/photo-1516426122078-c23e76319801?w=800', 'Alam', '2025-11-24 13:39:00', '2025-11-24 13:39:00'),
(8, 'Candi Prambanan', 'Sleman Yogyakarta', 50000.00, 'Kompleks candi Hindu terbesar di Indonesia dan situs warisan UNESCO. Dibangun pada abad ke-9 dengan tiga candi utama yang didedikasikan untuk Trimurti: Brahma, Wisnu, dan Siwa. Relief Ramayana yang megah menghiasi dinding candi.', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.1!2d110.491!3d-7.752', 'https://images.unsplash.com/photo-1580974852861-c381510bc98a?w=800', 'Sejarah', '2025-11-24 13:39:00', '2025-11-24 13:39:00'),
(9, 'Kawah Ijen', 'Banyuwangi Jawa Timur', 20000.00, 'Kawah vulkanik dengan fenomena blue fire yang langka di dunia. Trekking malam hari untuk melihat api biru belerang yang spektakuler. Danau kawah berwarna tosca dengan kadar keasaman tinggi. Pemandangan sunrise dari bibir kawah yang menakjubkan.', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3948.6!2d114.242!3d-8.058', 'https://images.unsplash.com/photo-1587331165931-863639364894?w=800', 'Alam', '2025-11-24 13:39:00', '2025-11-24 13:39:00'),
(10, 'Taman Nasional Way Kambas', 'Lampung', 20000.00, 'Pusat konservasi gajah Sumatera dengan Pusat Latihan Gajah. Wisatawan bisa melihat gajah di habitat aslinya, naik gajah, dan foto bersama. Juga rumah bagi badak Sumatera dan berbagai satwa langka lainnya. Program edukasi konservasi satwa.', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3977.2!2d105.768!3d-4.952', 'https://images.unsplash.com/photo-1564760055775-d63b17a55c44?w=800', 'Alam', '2025-11-24 13:39:00', '2025-11-24 13:39:00'),
(11, 'Nusa Penida', 'Klungkung Bali', 0.00, 'Pulau eksotis dengan tebing-tebing karst yang dramatis dan pantai tersembunyi. Kelingking Beach dengan formasi karang berbentuk T-Rex yang ikonik. Angel Billabong dan Broken Beach dengan kolam alami yang menakjubkan. Spot diving dan snorkeling terbaik di Bali.', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3945.3!2d115.544!3d-8.729', 'https://images.unsplash.com/photo-1570789210967-2cac24afeb00?w=800', 'Pantai', '2025-11-24 13:39:00', '2025-11-24 13:39:00'),
(12, 'Dieng Plateau', 'Wonosobo Jawa Tengah', 35000.00, 'Dataran tinggi vulkanik dengan kompleks candi Hindu tertua di Jawa. Kawah Sikidang yang aktif dengan mud pool mendidih. Telaga Warna yang berubah warna tergantung cuaca. Sunrise di Bukit Sikunir dengan pemandangan golden light di atas awan.', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.8!2d109.913!3d-7.204', 'https://images.unsplash.com/photo-1605640840605-14ac1855827b?w=800', 'Alam', '2025-11-24 13:39:00', '2025-11-24 13:39:00'),
(13, 'Pantai Pink Lombok', 'Lombok Nusa Tenggara Barat', 10000.00, 'Salah satu dari tujuh pantai berpasir merah muda di dunia. Warna pink berasal dari serpihan karang merah yang bercampur dengan pasir putih. Perairan jernih dengan terumbu karang yang indah untuk snorkeling. Suasana pantai yang tenang dan belum terlalu ramai.', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3945.9!2d116.561!3d-8.886', 'https://images.unsplash.com/photo-1559628376-f3fe5f782a2e?w=800', 'Pantai', '2025-11-24 13:39:00', '2025-11-24 13:39:00'),
(14, 'Bukit Tinggi', 'Sumatera Barat', 15000.00, 'Kota pegunungan sejuk dengan arsitektur kolonial Belanda. Jam Gadang yang ikonik di pusat kota. Ngarai Sianok dengan tebing curam dan pemandangan lembah hijau. Lobang Jepang sebagai situs sejarah Perang Dunia II. Pusat budaya Minangkabau.', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4009.1!2d100.369!3d-0.305', 'https://images.unsplash.com/photo-1551632811-561732d1e306?w=800', 'Budaya', '2025-11-24 13:39:00', '2025-11-24 13:39:00'),
(15, 'Tanjung Puting', 'Kalimantan Tengah', 50000.00, 'Taman nasional untuk melihat orangutan di habitat aslinya. Perjalanan dengan klotok (perahu kayu) menyusuri sungai di tengah hutan hujan tropis. Camp Leakey sebagai pusat penelitian orangutan. Pengalaman melihat feeding time orangutan dan proboscis monyet.', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4028.7!2d111.912!3d-2.746', 'https://images.unsplash.com/photo-1540206395-68808572332f?w=800', 'Alam', '2025-11-24 13:39:00', '2025-11-24 13:39:00');

-- --------------------------------------------------------

--
-- Table structure for table `destination_images`
--

CREATE TABLE `destination_images` (
  `id` int(11) NOT NULL,
  `destination_id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `destination_images`
--

INSERT INTO `destination_images` (`id`, `destination_id`, `image_path`, `caption`, `created_at`) VALUES
(1, 1, 'https://images.unsplash.com/photo-1591522811280-a8759970b03f?w=800', 'Stupa utama Candi Borobudur dengan Mount Merapi di latar belakang', '2025-11-24 13:39:00'),
(2, 1, 'https://images.unsplash.com/photo-1555400038-63f5ba517a47?w=800', 'Relief Buddha yang mendetail pada dinding candi', '2025-11-24 13:39:00'),
(3, 1, 'https://images.unsplash.com/photo-1596422846543-75c6fc197f07?w=800', 'Sunrise di Borobudur dengan kabut pagi yang mistis', '2025-11-24 13:39:00'),
(4, 2, 'https://images.unsplash.com/photo-1570789210967-2cac24afeb00?w=800', 'Komodo dragon di habitat aslinya di Pulau Rinca', '2025-11-24 13:39:00'),
(5, 2, 'https://images.unsplash.com/photo-1559628376-f3fe5f782a2e?w=800', 'Pemandangan Pulau Padar yang ikonik', '2025-11-24 13:39:00'),
(6, 2, 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=800', 'Pink Beach dengan pasir merah muda', '2025-11-24 13:39:00'),
(7, 3, 'https://images.unsplash.com/photo-1596422846543-75c6fc197f07?w=800', 'Sunrise spektakuler dari Penanjakan Bromo', '2025-11-24 13:39:00'),
(8, 3, 'https://images.unsplash.com/photo-1588668214407-6ea9a6d8c272?w=800', 'Kawah Bromo dengan asap belerang', '2025-11-24 13:39:00'),
(9, 3, 'https://images.unsplash.com/photo-1587331165931-863639364894?w=800', 'Lautan pasir dengan Gunung Batok', '2025-11-24 13:39:00'),
(10, 4, 'https://images.unsplash.com/photo-1559628376-f3fe5f782a2e?w=800', 'Formasi karst ikonik Raja Ampat dari udara', '2025-11-24 13:39:00'),
(11, 4, 'https://images.unsplash.com/photo-1583417319070-4a69db38a482?w=800', 'Terumbu karang berwarna-warni di perairan Raja Ampat', '2025-11-24 13:39:00'),
(12, 4, 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=800', 'Laguna tersembunyi dengan air biru kristal', '2025-11-24 13:39:00'),
(13, 5, 'https://images.unsplash.com/photo-1582719471384-894fbb16e074?w=800', 'Panorama Danau Toba dengan Pulau Samosir', '2025-11-24 13:39:00'),
(14, 5, 'https://images.unsplash.com/photo-1551632811-561632d1e306?w=800', 'Rumah adat Batak di tepi danau', '2025-11-24 13:39:00'),
(15, 5, 'https://images.unsplash.com/photo-1605640840605-14ac1855827b?w=800', 'Sunset di Danau Toba', '2025-11-24 13:39:00'),
(16, 6, 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=800', 'Pura Tanah Lot saat sunset dengan ombak', '2025-11-24 13:39:00'),
(17, 6, 'https://images.unsplash.com/photo-1555400038-63f5ba517a47?w=800', 'Detail arsitektur pura di atas batu karang', '2025-11-24 13:39:00'),
(18, 6, 'https://images.unsplash.com/photo-1580974852861-c381510bc98a?w=800', 'Golden hour di Tanah Lot', '2025-11-24 13:39:00'),
(19, 7, 'https://images.unsplash.com/photo-1516426122078-c23e76319801?w=800', 'Savana luas Bekol dengan banteng Jawa', '2025-11-24 13:39:00'),
(20, 7, 'https://images.unsplash.com/photo-1564760055775-d63b17a55c44?w=800', 'Merak di padang savana', '2025-11-24 13:39:00'),
(21, 7, 'https://images.unsplash.com/photo-1540206395-68808572332f?w=800', 'Pantai Bama dengan air jernih', '2025-11-24 13:39:00'),
(22, 8, 'https://images.unsplash.com/photo-1580974852861-c381510bc98a?w=800', 'Candi Siwa Prambanan megah di sore hari', '2025-11-24 13:39:00'),
(23, 8, 'https://images.unsplash.com/photo-1555400038-63f5ba517a47?w=800', 'Relief Ramayana pada dinding candi', '2025-11-24 13:39:00'),
(24, 8, 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=800', 'Kompleks candi Prambanan dari udara', '2025-11-24 13:39:00'),
(25, 9, 'https://images.unsplash.com/photo-1587331165931-863639364894?w=800', 'Blue fire phenomenon di Kawah Ijen', '2025-11-24 13:39:00'),
(26, 9, 'https://images.unsplash.com/photo-1588668214407-6ea9a6d8c272?w=800', 'Danau kawah tosca dengan kabut belerang', '2025-11-24 13:39:00'),
(27, 9, 'https://images.unsplash.com/photo-1596422846543-75c6fc197f07?w=800', 'Penambang belerang di Kawah Ijen', '2025-11-24 13:39:00'),
(28, 10, 'https://images.unsplash.com/photo-1564760055775-d63b17a55c44?w=800', 'Gajah Sumatera di Way Kambas', '2025-11-24 13:39:00'),
(29, 10, 'https://images.unsplash.com/photo-1540206395-68808572332f?w=800', 'Latihan gajah di pusat konservasi', '2025-11-24 13:39:00'),
(30, 10, 'https://images.unsplash.com/photo-1516426122078-c23e76319801?w=800', 'Wisatawan berinteraksi dengan gajah', '2025-11-24 13:39:00'),
(31, 11, 'https://images.unsplash.com/photo-1570789210967-2cac24afeb00?w=800', 'Kelingking Beach dengan formasi T-Rex', '2025-11-24 13:39:00'),
(32, 11, 'https://images.unsplash.com/photo-1559628376-f3fe5f782a2e?w=800', 'Angel Billabong kolam alami', '2025-11-24 13:39:00'),
(33, 11, 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=800', 'Broken Beach dengan lengkungan batu alami', '2025-11-24 13:39:00'),
(34, 12, 'https://images.unsplash.com/photo-1605640840605-14ac1855827b?w=800', 'Sunrise di Bukit Sikunir', '2025-11-24 13:39:00'),
(35, 12, 'https://images.unsplash.com/photo-1588668214407-6ea9a6d8c272?w=800', 'Kawah Sikidang yang berasap', '2025-11-24 13:39:00'),
(36, 12, 'https://images.unsplash.com/photo-1551632811-561632d1e306?w=800', 'Candi Arjuna kompleks di Dieng', '2025-11-24 13:39:00'),
(37, 13, 'https://images.unsplash.com/photo-1559628376-f3fe5f782a2e?w=800', 'Pasir pink yang unik', '2025-11-24 13:39:00'),
(38, 13, 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=800', 'Snorkeling di Pantai Pink', '2025-11-24 13:39:00'),
(39, 13, 'https://images.unsplash.com/photo-1583417319070-4a69db38a482?w=800', 'Pemandangan pantai dari bukit', '2025-11-24 13:39:00'),
(40, 14, 'https://images.unsplash.com/photo-1551632811-561632d1e306?w=800', 'Jam Gadang landmark Bukit Tinggi', '2025-11-24 13:39:00'),
(41, 14, 'https://images.unsplash.com/photo-1605640840605-14ac1855827b?w=800', 'Ngarai Sianok yang dramatis', '2025-11-24 13:39:00'),
(42, 14, 'https://images.unsplash.com/photo-1580974852861-c381510bc98a?w=800', 'Arsitektur kolonial Belanda', '2025-11-24 13:39:00'),
(43, 15, 'https://images.unsplash.com/photo-1540206395-68808572332f?w=800', 'Orangutan di pohon', '2025-11-24 13:39:00'),
(44, 15, 'https://images.unsplash.com/photo-1564760055775-d63b17a55c44?w=800', 'Klotok menyusuri sungai', '2025-11-24 13:39:00'),
(45, 15, 'https://images.unsplash.com/photo-1516426122078-c23e76319801?w=800', 'Feeding time orangutan di Camp Leakey', '2025-11-24 13:39:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `uuid` char(36) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uuid`, `name`, `email`, `phone`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'f1c901d0-167d-4ccf-ad73-0275dd059a2d', 'Friska', 'rima@gmail.com', '', '123', 'admin', '2025-11-24 15:54:26', '2025-11-24 15:54:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `destination_id` (`destination_id`),
  ADD KEY `idx_user` (`user_id`,`status`);

--
-- Indexes for table `destinations`
--
ALTER TABLE `destinations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `destination_images`
--
ALTER TABLE `destination_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `destination_id` (`destination_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `destinations`
--
ALTER TABLE `destinations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `destination_images`
--
ALTER TABLE `destination_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `destination_images`
--
ALTER TABLE `destination_images`
  ADD CONSTRAINT `destination_images_ibfk_1` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
