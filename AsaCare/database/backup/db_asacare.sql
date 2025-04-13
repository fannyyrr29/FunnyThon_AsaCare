-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2025 at 03:36 PM
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
-- Database: `db_asacare`
--

-- --------------------------------------------------------

--
-- Table structure for table `actions`
--

CREATE TABLE `actions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `type` enum('Homecare','Hospitalcare') NOT NULL,
  `price` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `actions`
--

INSERT INTO `actions` (`id`, `name`, `description`, `image`, `type`, `price`, `created_at`, `updated_at`) VALUES
(1, 'Konsultasi Medis Online', 'Konsultasi medis online', 'konsultasi.jpg', 'Homecare', 0, NULL, NULL),
(2, 'Pemeriksaan Kesehatan Rutin', 'Cek tekanan darah, gula darah, kolesterol', 'pemeriksaan.jpg', 'Homecare', 100000, NULL, NULL),
(3, 'Perawatan Luka', 'Perawatan luka diabetes, luka pasca operasi', 'luka.jpg', 'Homecare', 400000, NULL, NULL),
(4, 'Fisioterapi di Rumah', 'Pemulihan pasca stroke, terapi sendi', 'fisioterapi.jpg', 'Homecare', 300000, NULL, NULL),
(5, 'Pendampingan Lansia', 'Perawatan harian, bantuan aktivitas', 'pendampingan.jpg', 'Homecare', 300000, NULL, NULL),
(6, 'Pemberian Obat dan Infus di Rumah', 'Pemberian obat dan infus', 'infus.jpg', 'Homecare', 400000, NULL, NULL),
(7, 'Booking Janji Temu dengan Dokter Umum', 'Booking janji temu dengan dokter umum', 'booking.jpg', 'Hospitalcare', 0, NULL, NULL),
(8, 'Booking Janji Temu dengan Dokter Spesialis', 'Booking janji temu dengan dokter spesialis', 'booking.jpg', 'Hospitalcare', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `conditions`
--

CREATE TABLE `conditions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `condition` enum('Sehat','Kurang Sehat','Sakit') NOT NULL,
  `date` date NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `conditions`
--

INSERT INTO `conditions` (`id`, `condition`, `date`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Kurang Sehat', '2025-04-13', 1, '2025-04-13 06:34:13', NULL),
(2, 'Sehat', '2025-04-13', 2, '2025-04-13 06:34:13', NULL),
(3, 'Sakit', '2025-04-13', 3, '2025-04-13 06:34:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `consultations`
--

CREATE TABLE `consultations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `medical_record_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `consultations`
--

INSERT INTO `consultations` (`id`, `medical_record_id`, `user_id`, `doctor_id`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 1, NULL, NULL),
(2, 2, 3, 2, NULL, NULL),
(3, 3, 4, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(45) NOT NULL,
  `license_number` varchar(45) NOT NULL,
  `experience_year` int(11) NOT NULL,
  `rating` double DEFAULT NULL,
  `specialization_id` bigint(20) UNSIGNED NOT NULL,
  `hospital_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `name`, `license_number`, `experience_year`, `rating`, `specialization_id`, `hospital_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Dr. Ahmad Fauzi', 'L123456', 10, 4.5, 1, 1, 13, NULL, NULL),
(2, 'Dr. Budi Santoso', 'L234567', 8, 4.7, 1, 2, 14, NULL, NULL),
(3, 'Dr. Cinta Dewi', 'L345678', 12, 4.8, 1, 1, 15, NULL, NULL),
(4, 'Dr. Juni Ersawati', 'L456789', 5, 4.3, 4, 3, 16, NULL, NULL),
(5, 'Dr. Eka Putri', 'L567890', 7, 4.6, 5, 2, 17, NULL, NULL),
(6, 'Dr. Fajar Setiawan', 'L678901', 9, 4.4, 6, 1, 18, NULL, NULL),
(7, 'Dr. Gita Sari', 'L789012', 6, 4.2, 7, 3, 19, NULL, NULL),
(8, 'Dr. Hadi Pratama', 'L890123', 11, 4.9, 8, 1, 20, NULL, NULL),
(9, 'Dr. Ika Lestari', 'L901234', 4, 4.1, 9, 2, 21, NULL, NULL),
(10, 'Dr. Kiki Suryadi', 'L123456', 3, 4, 10, 1, 22, NULL, NULL),
(11, 'Dr. Lina Wati', 'L234567', 10, 4.5, 11, 2, 23, NULL, NULL),
(12, 'Dr. Mira Sari', 'L345678', 7, 4.6, 12, 1, 24, NULL, NULL),
(13, 'Dr. Oki Prasetyo', 'L567890', 6, 4.3, 13, 2, 25, NULL, NULL),
(14, 'Dr. Nani Lestari', 'L456789', 8, 4.4, 14, 3, 26, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `doctor_has_actions`
--

CREATE TABLE `doctor_has_actions` (
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `action_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doctor_has_actions`
--

INSERT INTO `doctor_has_actions` (`doctor_id`, `action_id`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL),
(1, 7, NULL, NULL),
(1, 1, NULL, NULL),
(1, 7, NULL, NULL),
(2, 5, NULL, NULL),
(3, 4, NULL, NULL),
(4, 1, NULL, NULL),
(4, 7, NULL, NULL),
(5, 1, NULL, NULL),
(5, 7, NULL, NULL),
(5, 5, NULL, NULL),
(7, 4, NULL, NULL),
(8, 1, NULL, NULL),
(8, 7, NULL, NULL),
(8, 5, NULL, NULL),
(9, 1, NULL, NULL),
(9, 7, NULL, NULL),
(10, 4, NULL, NULL),
(11, 1, NULL, NULL),
(11, 7, NULL, NULL),
(12, 1, NULL, NULL),
(12, 7, NULL, NULL),
(13, 5, NULL, NULL),
(14, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `drugs`
--

CREATE TABLE `drugs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(45) NOT NULL,
  `price` double NOT NULL,
  `quantity` double NOT NULL,
  `dosis` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `type` enum('tablet','sirup') NOT NULL,
  `periode` enum('Setiap Hari','Hari Tertentu') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `drugs`
--

INSERT INTO `drugs` (`id`, `name`, `price`, `quantity`, `dosis`, `image`, `type`, `periode`, `created_at`, `updated_at`) VALUES
(1, 'Paracetamol (500 mg)', 5000, 12, 1, 'paracetamol.png', 'tablet', 'Hari Tertentu', NULL, NULL),
(2, 'Amoxicillin (500 mg)', 15000, 12, 2, 'amoxilin.png', 'tablet', 'Setiap Hari', NULL, NULL),
(3, 'Cetirizine (10 mg)', 8000, 12, 1, 'cetirizine.jpeg', 'tablet', 'Hari Tertentu', NULL, NULL),
(4, 'Ranitidine (150 mg)', 12000, 12, 1, 'ranitidine.png', 'tablet', 'Setiap Hari', NULL, NULL),
(5, 'Metformin (500 mg)', 20000, 12, 1, 'metformin.jpg', 'tablet', 'Hari Tertentu', NULL, NULL),
(6, 'Aspirin (80 mg)', 5000, 10, 1, 'aspirin.jpeg', 'tablet', 'Setiap Hari', NULL, NULL),
(7, 'Mylanta Sirup (150 ml)', 48900, 150, 3, 'mylanta.png', 'sirup', 'Hari Tertentu', NULL, NULL),
(8, 'Neurobion Forte', 53000, 10, 1, 'neurobion.png', 'tablet', 'Hari Tertentu', NULL, NULL),
(9, 'Surbex-Z 6 Tablet', 39400, 6, 1, 'surbex.jpeg', 'tablet', 'Setiap Hari', NULL, NULL),
(10, 'Sangobion 10 Kapsul', 24000, 10, 1, 'sangobion.png', 'tablet', 'Hari Tertentu', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `drug_records`
--

CREATE TABLE `drug_records` (
  `medical_record_id` bigint(20) UNSIGNED NOT NULL,
  `drug_id` bigint(20) UNSIGNED NOT NULL,
  `amount` int(11) NOT NULL,
  `subtotal` double NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `drug_records`
--

INSERT INTO `drug_records` (`medical_record_id`, `drug_id`, `amount`, `subtotal`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 5000, 1, NULL, NULL),
(1, 2, 2, 30000, 1, NULL, NULL),
(1, 3, 1, 8000, 1, NULL, NULL),
(2, 4, 1, 12000, 1, NULL, NULL),
(2, 5, 1, 20000, 1, NULL, NULL),
(2, 6, 1, 5000, 1, NULL, NULL),
(3, 7, 3, 146700, 0, NULL, NULL),
(3, 8, 1, 53000, 0, NULL, NULL),
(3, 9, 1, 39400, 0, NULL, NULL),
(3, 10, 1, 24000, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `emergencycall`
--

CREATE TABLE `emergencycall` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(45) NOT NULL,
  `phone_number` varchar(45) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `emergencycall`
--

INSERT INTO `emergencycall` (`id`, `name`, `phone_number`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Andi Setiawan', '081234567890', 2, NULL, NULL),
(2, 'Budi Santoso', '081234567891', 2, NULL, NULL),
(3, 'Budi Santoso', '081234567891', 3, NULL, NULL),
(4, 'Citra Dewi', '081234567892', 4, NULL, NULL),
(5, 'Dedi Prasetyo', '081234567893', 5, NULL, NULL),
(6, 'Eka Putri', '081234567894', 6, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `families`
--

CREATE TABLE `families` (
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `receiver_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `families`
--

INSERT INTO `families` (`sender_id`, `receiver_id`, `status`, `created_at`, `updated_at`) VALUES
(3, 4, 1, NULL, NULL),
(3, 5, 1, NULL, NULL),
(4, 6, 1, NULL, NULL),
(5, 6, 0, NULL, NULL),
(3, 7, 1, NULL, NULL),
(4, 8, 1, NULL, NULL),
(5, 9, 1, NULL, NULL),
(6, 10, 0, NULL, NULL),
(7, 8, 1, NULL, NULL),
(8, 9, 1, NULL, NULL),
(9, 10, 1, NULL, NULL),
(3, 6, 1, NULL, NULL),
(4, 5, 0, NULL, NULL),
(5, 7, 1, NULL, NULL),
(6, 8, 1, NULL, NULL),
(7, 9, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hospitals`
--

CREATE TABLE `hospitals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(45) NOT NULL,
  `address` varchar(500) NOT NULL,
  `phone_number` varchar(16) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hospitals`
--

INSERT INTO `hospitals` (`id`, `name`, `address`, `phone_number`, `created_at`, `updated_at`) VALUES
(1, 'RSUD Dr. Soetomo', 'Jl. Mayjen Prof. Dr. Moestopo No. 6-8, Surabaya', '031-550-1000', NULL, NULL),
(2, 'RS Siloam Surabaya', 'Jl. Raya Ngagel No. 123, Surabaya', '031-9900-8888', NULL, NULL),
(3, 'RS Mitra Keluarga Surabaya', 'Jl. Raya Darmo No. 30, Surabaya', '031-567-7777', NULL, NULL),
(4, 'RS Al-Ihsan', 'Jl. Raya Kertajaya No. 1, Surabaya', '031-501-1111', NULL, NULL),
(5, 'RS Bhakti Rahayu', 'Jl. Raya Kalisari No. 10, Surabaya', '031-828-8888', NULL, NULL),
(6, 'RS Islam Surabaya', 'Jl. Raya Gubeng No. 10, Surabaya', '031-501-2222', NULL, NULL),
(7, 'RS Premier Bintaro', 'Jl. Raya Bintaro No. 1, Surabaya', '031-9999-0000', NULL, NULL),
(8, 'RS Haji Surabaya', 'Jl. Raya Haji No. 5, Surabaya', '031-567-8888', NULL, NULL),
(9, 'RS Pusat Pertamina', 'Jl. Raya Pertamina No. 2, Surabaya', '031-567-9999', NULL, NULL),
(10, 'RSUD Dr. Soewandi', 'Jl. Soewandi No. 1, Surabaya', '031-531-1111', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `medical_actions`
--

CREATE TABLE `medical_actions` (
  `medical_record_id` bigint(20) UNSIGNED NOT NULL,
  `action_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `medical_actions`
--

INSERT INTO `medical_actions` (`medical_record_id`, `action_id`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL),
(1, 3, NULL, NULL),
(2, 2, NULL, NULL),
(3, 3, NULL, NULL),
(3, 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `medical_records`
--

CREATE TABLE `medical_records` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `diagnose` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `date` datetime NOT NULL,
  `rating` int(11) DEFAULT NULL,
  `total` double NOT NULL DEFAULT 0,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `medical_records`
--

INSERT INTO `medical_records` (`id`, `diagnose`, `description`, `date`, `rating`, `total`, `user_id`, `doctor_id`, `created_at`, `updated_at`) VALUES
(1, 'Diabetes Tipe 2', 'Pasien mengalami gejala diabetes.', '2023-01-10 09:00:00', 5, 400000, 5, 1, NULL, NULL),
(2, 'Hipertensi', 'Pasien mengalami tekanan darah tinggi.', '2023-01-15 10:00:00', 4, 100000, 3, 2, NULL, NULL),
(3, 'Luka Pasca Operasi', 'Perawatan luka setelah operasi.', '2023-01-20 11:00:00', 5, 400000, 4, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `consultation_id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `consultation_id`, `sender_id`, `message`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 'Halo dokk', NULL, NULL),
(2, 1, 13, 'Ada yang bisa saya bantu?', NULL, NULL),
(3, 1, 5, 'Dok, bokong saya bisulan', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_03_30_150528_create_specializations_table', 1),
(6, '2025_03_31_150225_create_hospitals_table', 1),
(7, '2025_03_31_150555_create_doctors_table', 1),
(8, '2025_04_01_150217_create_medicalrecords_table', 1),
(9, '2025_04_01_150353_create_times_table', 1),
(10, '2025_04_02_150017_create_emergenycall_table', 1),
(11, '2025_04_02_150110_create_drugs_table', 1),
(12, '2025_04_02_150118_create_reminders_table', 1),
(13, '2025_04_02_150325_create_drugrecords_table', 1),
(14, '2025_04_02_150417_create_actions_table', 1),
(15, '2025_04_02_150446_create_medicalactions_table', 1),
(16, '2025_04_02_150708_create_doctors_has_specializations_table', 1),
(17, '2025_04_03_064746_create_families_table', 1),
(18, '2025_04_03_102705_create_conditions_table', 1),
(19, '2025_04_06_154334_create_reminder_times_table', 1),
(20, '2025_04_10_130922_create_consultations_table', 1),
(21, '2025_04_10_131110_create_messages_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reminders`
--

CREATE TABLE `reminders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `medical_record_id` bigint(20) UNSIGNED NOT NULL,
  `drug_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL,
  `start_date` date NOT NULL,
  `duration_day` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reminders`
--

INSERT INTO `reminders` (`id`, `user_id`, `medical_record_id`, `drug_id`, `status`, `start_date`, `duration_day`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 1, 1, '2023-01-10', 3, NULL, NULL),
(2, 3, 2, 4, 0, '2023-01-10', 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reminder_times`
--

CREATE TABLE `reminder_times` (
  `reminder_id` bigint(20) UNSIGNED NOT NULL,
  `time_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reminder_times`
--

INSERT INTO `reminder_times` (`reminder_id`, `time_id`, `date`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, '2023-01-10', 1, NULL, NULL),
(1, 7, '2023-01-10', 1, NULL, NULL),
(1, 11, '2023-01-10', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `specializations`
--

CREATE TABLE `specializations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `specializations`
--

INSERT INTO `specializations` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Dokter Umum', NULL, NULL),
(2, 'Dokter Spesialis Anak', NULL, NULL),
(3, 'Dokter Spesialis Bedah', NULL, NULL),
(4, 'Dokter Spesialis Penyakit Dalam', NULL, NULL),
(5, 'Dokter Spesialis Jantung', NULL, NULL),
(6, 'Dokter Spesialis Kulit dan Kelamin', NULL, NULL),
(7, 'Dokter Spesialis THT (Telinga, Hidung, Tenggorokan)', NULL, NULL),
(8, 'Dokter Spesialis Mata', NULL, NULL),
(9, 'Dokter Spesialis Gigi dan Mulut', NULL, NULL),
(10, 'Dokter Spesialis Kebidanan dan Kandungan', NULL, NULL),
(11, 'Dokter Spesialis Psikiatri', NULL, NULL),
(12, 'Dokter Spesialis Rehabilitasi Medik', NULL, NULL),
(13, 'Dokter Spesialis Anestesi', NULL, NULL),
(14, 'Dokter Spesialis Radiologi', NULL, NULL),
(15, 'Dokter Spesialis Patologi Klinik', NULL, NULL),
(16, 'Dokter Spesialis Orthopedi', NULL, NULL),
(17, 'Dokter Spesialis Urologi', NULL, NULL),
(18, 'Dokter Spesialis Gastroenterologi', NULL, NULL),
(19, 'Dokter Spesialis Endokrinologi', NULL, NULL),
(20, 'Dokter Spesialis Hematologi', NULL, NULL),
(21, 'Dokter Spesialis Onkologi', NULL, NULL),
(22, 'Dokter Spesialis Pulmonologi', NULL, NULL),
(23, 'Dokter Spesialis Neurologi', NULL, NULL),
(24, 'Dokter Spesialis Geriatri', NULL, NULL),
(25, 'Dokter Spesialis Kardiologi', NULL, NULL),
(26, 'Dokter Spesialis Infeksi', NULL, NULL),
(27, 'Dokter Spesialis Kesehatan Masyarakat', NULL, NULL),
(28, 'Dokter Spesialis Bedah Saraf', NULL, NULL),
(29, 'Dokter Spesialis Bedah Plastik', NULL, NULL),
(30, 'Dokter Spesialis Fertilitas', NULL, NULL),
(31, 'Dokter Spesialis Penyakit Tropis', NULL, NULL),
(32, 'Dokter Spesialis Penyakit Dalam Anak', NULL, NULL),
(33, 'Dokter Spesialis Kesehatan Mental', NULL, NULL),
(34, 'Dokter Spesialis Olahraga', NULL, NULL),
(35, 'Dokter Spesialis Perawatan Paliatif', NULL, NULL),
(36, 'Dokter Spesialis Kesehatan Reproduksi', NULL, NULL),
(37, 'Dokter Spesialis Kesehatan Anak', NULL, NULL),
(38, 'Dokter Spesialis Kesehatan Lingkungan', NULL, NULL),
(39, 'Dokter Spesialis Kesehatan Kerja', NULL, NULL),
(40, 'Dokter Spesialis Kesehatan Gigi', NULL, NULL),
(41, 'Dokter Spesialis Kesehatan Masyarakat Anak', NULL, NULL),
(42, 'Dokter Spesialis Kesehatan Masyarakat Dewasa', NULL, NULL),
(43, 'Dokter Spesialis Kesehatan Masyarakat Lansia', NULL, NULL),
(44, 'Dokter Spesialis Kesehatan Masyarakat Wanita', NULL, NULL),
(45, 'Dokter Spesialis Kesehatan Masyarakat Pria', NULL, NULL),
(46, 'Dokter Spesialis Kesehatan Masyarakat Remaja', NULL, NULL),
(47, 'Dokter Spesialis Kesehatan Masyarakat Anak-Anak', NULL, NULL),
(48, 'Dokter Spesialis Kesehatan Masyarakat Keluarga', NULL, NULL),
(49, 'Dokter Spesialis Kesehatan Masyarakat Global', NULL, NULL),
(50, 'Dokter Spesialis Kesehatan Masyarakat Internasional', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `times`
--

CREATE TABLE `times` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `time` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `times`
--

INSERT INTO `times` (`id`, `time`, `created_at`, `updated_at`) VALUES
(1, '05:00:00', NULL, NULL),
(2, '06:00:00', NULL, NULL),
(3, '07:30:00', NULL, NULL),
(4, '08:00:00', NULL, NULL),
(5, '09:00:00', NULL, NULL),
(6, '10:00:00', NULL, NULL),
(7, '11:30:00', NULL, NULL),
(8, '12:00:00', NULL, NULL),
(9, '12:30:00', NULL, NULL),
(10, '13:00:00', NULL, NULL),
(11, '14:00:00', NULL, NULL),
(12, '15:30:00', NULL, NULL),
(13, '16:00:00', NULL, NULL),
(14, '17:00:00', NULL, NULL),
(15, '18:00:00', NULL, NULL),
(16, '19:30:00', NULL, NULL),
(17, '20:00:00', NULL, NULL),
(18, '21:00:00', NULL, NULL),
(19, '22:00:00', NULL, NULL),
(20, '22:30:00', NULL, NULL),
(21, '23:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `NIK` varchar(16) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `phone_number` varchar(16) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `role` enum('Admin','User','Dokter') NOT NULL,
  `gender` enum('L','P') DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `profile` varchar(45) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `google_token` varchar(255) DEFAULT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  `google_refresh_token` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `NIK`, `name`, `phone_number`, `address`, `role`, `gender`, `birthdate`, `profile`, `email`, `email_verified_at`, `password`, `google_token`, `google_id`, `google_refresh_token`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '1234567890123456', 'Admin1', '+6281234567890', 'Jl. Merdeka No. 1, Surabaya', 'Admin', 'L', '2000-03-20', 'profile1.jpg', 'admin1@example.com', '2023-01-02 05:00:00', '$2y$10$zzjReL4Im2MTPWeKGN6lsOI9j6WDllGv3G6xMEDm42eJpyZ7kR0Uu', 'google_token_1', 'google_id_1', 'google_refresh_token_1', 'remember_token_1', '2023-01-01 03:00:00', '2023-01-01 03:00:00'),
(2, '1234567890123456', 'Admin2', '+6281234567890', 'Jl. Merdeka No. 1, Surabaya', 'Admin', 'L', NULL, 'profile1.jpg', 'admin2@example.com', '2023-01-02 05:00:00', '$2y$10$vXRaH4L9HmThaFrWqxGi7ukDwNIvnZoBIb/zL/5cQl9kFLTNCkmyW', 'google_token_1', 'google_id_1', 'google_refresh_token_1', 'remember_token_1', '2023-01-01 03:00:00', '2023-01-01 03:00:00'),
(3, '1234567890123456', 'Andi Setiawan', '+6281234567890', 'Jl. Merdeka No. 1, Surabaya', 'Admin', 'L', NULL, 'profile1.jpg', 'andi.setiawan@example.com', '2023-01-02 05:00:00', '$2y$10$P27jkZNoRIUe9mpvGrnLzelOSLcV5MOWkfLr7qfZwnhk4vLFriS1q', 'google_token_1', 'google_id_1', 'google_refresh_token_1', 'remember_token_1', '2023-01-01 03:00:00', '2023-01-01 03:00:00'),
(4, '1234567890123457', 'Budi Santoso', '+6281234567891', 'Jl. Pahlawan No. 2, Surabaya', 'User', 'L', NULL, 'profile2.jpg', 'budi.santoso@example.com', '2023-01-02 05:00:00', '$2y$10$I6Lo0Kvwtpr0rSSdZ3.fTevV6rj9qTtnLbtA.P3Ta0GOAXn46gWXS', 'google_token_2', 'google_id_2', 'google_refresh_token_2', 'remember_token_2', '2023-01-02 03:00:00', '2023-01-02 03:00:00'),
(5, '1234567890123458', 'Citra Dewi', '+6281234567892', 'Jl. Cinta No. 3, Surabaya', 'User', 'P', NULL, 'profile3.jpg', 'citra.dewi@example.com', '2023-01-03 07:00:00', '$2y$10$pmycb.k9ArOD8WZ.sfjy8.Ai0SRlHY5GEupZzPXbL7I60OuNMtYJy', 'google_token_3', 'google_id_3', 'google_refresh_token_3', 'remember_token_3', '2023-01-03 03:00:00', '2023-01-03 03:00:00'),
(6, '1234567890123459', 'Dedi Prasetyo', '+6281234567893', 'Jl. Kebangsaan No. 4, Surabaya', 'User', 'L', NULL, 'profile4.jpg', 'dedi.prasetyo@example.com', '2025-04-13 06:34:11', '$2y$10$1Wm//UN8Kak.hBatvUZP7.inHdBQLQN1O.CHwW4Px1CgVeiUH6Tcy', 'google_token_4', 'google_id_4', 'google_refresh_token_4', 'remember_token_4', '2023-01-04 03:00:00', '2023-01-04 03:00:00'),
(7, '1234567890123460', 'Eka Putri', '+6281234567894', 'Jl. Harapan No. 5, Surabaya', 'User', 'P', NULL, 'profile5.jpg', 'eka.putri@example.com', '2023-01-05 09:00:00', '$2y$10$6ioacNQDV//g2aHuHiGCJOfssfpwGrG5nDXrFdWfbk1z4tzQlBTgW', 'google_token_5', 'google_id_5', 'google_refresh_token_5', 'remember_token_5', '2023-01-05 03:00:00', '2023-01-05 03:00:00'),
(8, '1234567890123461', 'Fajar Setiawan', '+6281234567895', 'Jl. Bunga No. 6, Surabaya', 'User', 'L', NULL, 'profile6.jpg', 'fajar.setiawan@example.com', '2025-04-13 06:34:12', '$2y$10$iruWAa8vPb.jxSPsPay/oeE5MJ/IJiP3TZqm38U.55DUxkPg2sT6G', 'google_token_6', 'google_id_6', 'google_refresh_token_6', 'remember_token_6', '2023-01-06 03:00:00', '2023-01-06 03:00:00'),
(9, '1234567890123462', 'Gita Sari', '+6281234567896', 'Jl. Cendana No. 7, Surabaya', 'User', 'P', NULL, 'profile7.jpg', 'gita.sari@example.com', '2023-01-07 05:00:00', '$2y$10$kJpaL/k4d19iBcZF0ljEdeyIVN7DXoDDyIKYbxSI2RCUFA01Dta5K', 'google_token_7', 'google_id_7', 'google_refresh_token_7', 'remember_token_7', '2023-01-07 03:00:00', '2023-01-07 03:00:00'),
(10, '1234567890123463', 'Hadi Pratama', '+6281234567897', 'Jl. Anggrek No. 8, Surabaya', 'User', 'L', NULL, 'profile8.jpg', 'hadi.pratama@example.com', '2025-04-13 06:34:12', '$2y$10$o.f1S5JZ96On.sv/d4RrL.kL5hMvp/2HYIMkDzocK7xDZRDmLPBKW', 'google_token_8', 'google_id_8', 'google_refresh_token_8', 'remember_token_8', '2023-01-08 03:00:00', '2023-01-08 03:00:00'),
(11, '1234567890123464', 'Ika Lestari', '+6281234567898', 'Jl. Melati No. 9, Surabaya', 'User', 'P', NULL, 'profile9.jpg', 'ika.lestari@example.com', '2023-01-09 07:00:00', '$2y$10$e7q71ehpqgWOVUIx5ASlX.5Lv1hxrFhx2lz9vZ0QPC.xOs2N.r6x6', 'google_token_9', 'google_id_9', 'google_refresh_token_9', 'remember_token_9', '2023-01-09 03:00:00', '2023-01-09 03:00:00'),
(12, '1234567890123465', 'Ian Budi', '+6281234567899', 'Jl. Kenanga No. 10, Surabaya', 'User', 'L', NULL, 'profile10.jpg', 'ian.budi@example.com', '2025-04-13 06:34:12', '$2y$10$X/7sQZAItX7f1jr8KNbq5eMV8ZJLSjSYJ1DZJce8iJKn1.mKfkAym', 'google_token_10', 'google_id_10', 'google_refresh_token_10', 'remember_token_10', '2023-01-10 03:00:00', '2023-01-10 03:00:00'),
(13, '3578900000000013', 'Dr. Ahmad Fauzi', '+6281210000001', 'Jl. Kesehatan No. 1', 'Dokter', 'L', '1980-01-15', 'dr_ahmad.jpg', 'dr.ahmad@example.com', '2025-04-13 06:34:12', '$2y$10$1eFbeuP3QeW3mRDQLL1hMOji7RiOneMDs0zaIf0Dqyo0ijWQF2C4q', NULL, NULL, NULL, '52wkimmHsKxa0YMVKrlb', '2025-04-13 06:34:12', '2025-04-13 06:34:12'),
(14, '3578900000000014', 'Dr. Budi Santoso', '+6281210000002', 'Jl. Sehat Selalu No. 2', 'Dokter', 'L', '1979-06-12', 'dr_budi.jpg', 'dr.budi@example.com', '2025-04-13 06:34:12', '$2y$10$snHNkDZnTxXKzbAKWGi8xuE2jkqV2qDcuHwRUakb6E0sDN6DvkB3W', NULL, NULL, NULL, 'ukXvVJ9CxfA4KFX4Wo2t', '2025-04-13 06:34:12', '2025-04-13 06:34:12'),
(15, '3578900000000015', 'Dr. Cinta Dewi', '+6281210000003', 'Jl. Kasih Sayang No. 3', 'Dokter', 'P', '1983-04-10', 'dr_cinta.jpg', 'dr.cinta@example.com', '2025-04-13 06:34:12', '$2y$10$NHVZi6migygSY9F.dhB7LebQFyr6Z3ATI9y6vS4tXTqk.fqWhkKlu', NULL, NULL, NULL, '2aPDIwByW96zghgFSY3N', '2025-04-13 06:34:12', '2025-04-13 06:34:12'),
(16, '3578900000000016', 'Dr. Dedi Prasetyo', '+6281210000016', 'Jl. Medika No. 16', 'Dokter', 'L', '1985-03-21', 'dr_dedi.jpg', 'dr.dedi@example.com', '2025-04-13 06:34:12', '$2y$10$WHL5.Ym.i1dWyP1QYvd8VuFbVZD8v8Wn3lSmAm0fLlN2nkffVsywy', NULL, NULL, NULL, 'CZ41EicS6QNA2GzBJXnD', '2025-04-13 06:34:12', '2025-04-13 06:34:12'),
(17, '3578900000000017', 'Dr. Eka Putri', '+6281210000017', 'Jl. Pertiwi No. 17', 'Dokter', 'P', '1986-07-10', 'dr_eka.jpg', 'dr.eka@example.com', '2025-04-13 06:34:12', '$2y$10$4FgzP135MiWeYMtfZiOMAumZs5J9mOjO9O8TCTcrPVQYjO2fmewU6', NULL, NULL, NULL, '5nGUH4tXGDDjdsmsMQ49', '2025-04-13 06:34:12', '2025-04-13 06:34:12'),
(18, '3578900000000018', 'Dr. Fajar Setiawan', '+6281210000018', 'Jl. Mentari No. 18', 'Dokter', 'L', '1982-11-25', 'dr_fajar.jpg', 'dr.fajar@example.com', '2025-04-13 06:34:12', '$2y$10$yumz49ET06t9vNo6OcBvIuKmOXpmk8C4NY3/p9GHO2LpTD4XD3o7e', NULL, NULL, NULL, 'HUSCi3X13FR5vhKgMsdf', '2025-04-13 06:34:12', '2025-04-13 06:34:12'),
(19, '3578900000000019', 'Dr. Gita Sari', '+6281210000019', 'Jl. Mawar Putih No. 19', 'Dokter', 'P', '1987-05-14', 'dr_gita.jpg', 'dr.gita@example.com', '2025-04-13 06:34:12', '$2y$10$YACljeMTXuRkiaKzpsqoY.LjGInC5HJccQ5WGeBQMr6xINbeiSFuG', NULL, NULL, NULL, 'lpANbgKXBxjL7M6Pl8W4', '2025-04-13 06:34:12', '2025-04-13 06:34:12'),
(20, '3578900000000020', 'Dr. Hadi Pratama', '+6281210000020', 'Jl. Surya Harapan No. 20', 'Dokter', 'L', '1980-10-22', 'dr_hadi.jpg', 'dr.hadi@example.com', '2025-04-13 06:34:12', '$2y$10$u0Nr4Y2fq/V49ZeckT697es4xbdFHDmXxtElPg0g1B7s9fPLiXjqS', NULL, NULL, NULL, 'swFFlLP9ODz52SzeSIB2', '2025-04-13 06:34:13', '2025-04-13 06:34:13'),
(21, '3578900000000021', 'Dr. Ika Lestari', '+6281210000021', 'Jl. Anggrek Indah No. 21', 'Dokter', 'P', '1990-01-05', 'dr_ika.jpg', 'dr.ika@example.com', '2025-04-13 06:34:13', '$2y$10$YhvEYZFSjg5RNJ/v02UdQeosFPdARUwocOU956kOqaY5B2Q8qPE7W', NULL, NULL, NULL, 'B1W2RTWxJxgjWv3zGIvy', '2025-04-13 06:34:13', '2025-04-13 06:34:13'),
(22, '3578900000000023', 'Dr. Kiki Suryadi', '+6281210000023', 'Jl. Damai No. 23', 'Dokter', 'L', '1991-06-30', 'dr_kiki.jpg', 'dr.kiki@example.com', '2025-04-13 06:34:13', '$2y$10$grVN7pZ9o/g0cfxMo7ppPual9XGGCFwVlrwzKpFXJDhDBpPrh7zbO', NULL, NULL, NULL, 'sAMrMgewiaSvbXY5uII0', '2025-04-13 06:34:13', '2025-04-13 06:34:13'),
(23, '3578900000000024', 'Dr. Lina Wati', '+6281210000024', 'Jl. Sehat Sentosa No. 24', 'Dokter', 'P', '1984-04-18', 'dr_lina.jpg', 'dr.lina@example.com', '2025-04-13 06:34:13', '$2y$10$oQJEq9lsEFUPYa8ZA5GGLetqJgzLw6RDAk8viUyGf1BWaNKRhByby', NULL, NULL, NULL, 'ZMQ7LJUkyvjdyqvHelJ3', '2025-04-13 06:34:13', '2025-04-13 06:34:13'),
(24, '3578900000000025', 'Dr. Mira Sari', '+6281210000025', 'Jl. Kesehatan No. 25', 'Dokter', 'P', '1988-12-07', 'dr_mira.jpg', 'dr.mira@example.com', '2025-04-13 06:34:13', '$2y$10$sNGtapjdtkoQI/cVrCZa5OV3Q8y57mcxLhpbvxUStkOBS92YRYsCm', NULL, NULL, NULL, 'XM3U6ZVqmp7mK7PWsF6W', '2025-04-13 06:34:13', '2025-04-13 06:34:13'),
(25, '3578900000000026', 'Dr. Oki Prasetyo', '+6281210000026', 'Jl. Damai Lestari No. 27', 'Dokter', 'L', '1985-06-12', 'dr_oki.jpg', 'dr.oki@example.com', '2025-04-13 06:34:13', '$2y$10$9iLLpfSo.lfo0tkmSuWjhe94E9YOuk2fVJOnySjLFgcCcbjY7G01u', NULL, NULL, NULL, 'ihUAuDNndALvD2E18dAh', '2025-04-13 06:34:13', '2025-04-13 06:34:13'),
(26, '3578900000000027', 'Dr. Nani Lestari', '+6281210000027', 'Jl. Teratai No. 26', 'Dokter', 'P', '1986-08-30', 'dr_nani.jpg', 'dr.nani@example.com', '2025-04-13 06:34:13', '$2y$10$cUzUyeOO0jy/j/ZLKlzax.EBsrNjohAikn8L3x5Z2o7TKYHnbrjca', NULL, NULL, NULL, 'X8rWMHtvLUpGbDSbdN9H', '2025-04-13 06:34:13', '2025-04-13 06:34:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actions`
--
ALTER TABLE `actions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conditions`
--
ALTER TABLE `conditions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `conditions_user_id_foreign` (`user_id`);

--
-- Indexes for table `consultations`
--
ALTER TABLE `consultations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `consultations_medical_record_id_foreign` (`medical_record_id`),
  ADD KEY `consultations_user_id_foreign` (`user_id`),
  ADD KEY `consultations_doctor_id_foreign` (`doctor_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctors_specialization_id_foreign` (`specialization_id`),
  ADD KEY `doctors_hospital_id_foreign` (`hospital_id`),
  ADD KEY `doctors_user_id_foreign` (`user_id`);

--
-- Indexes for table `doctor_has_actions`
--
ALTER TABLE `doctor_has_actions`
  ADD KEY `doctor_has_actions_doctor_id_foreign` (`doctor_id`),
  ADD KEY `doctor_has_actions_action_id_foreign` (`action_id`);

--
-- Indexes for table `drugs`
--
ALTER TABLE `drugs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drug_records`
--
ALTER TABLE `drug_records`
  ADD KEY `drug_records_medical_record_id_foreign` (`medical_record_id`),
  ADD KEY `drug_records_drug_id_foreign` (`drug_id`);

--
-- Indexes for table `emergencycall`
--
ALTER TABLE `emergencycall`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emergencycall_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `families`
--
ALTER TABLE `families`
  ADD KEY `families_sender_id_foreign` (`sender_id`),
  ADD KEY `families_receiver_id_foreign` (`receiver_id`);

--
-- Indexes for table `hospitals`
--
ALTER TABLE `hospitals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medical_actions`
--
ALTER TABLE `medical_actions`
  ADD KEY `medical_actions_medical_record_id_foreign` (`medical_record_id`),
  ADD KEY `medical_actions_action_id_foreign` (`action_id`);

--
-- Indexes for table `medical_records`
--
ALTER TABLE `medical_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `medical_records_user_id_foreign` (`user_id`),
  ADD KEY `medical_records_doctor_id_foreign` (`doctor_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_consultation_id_foreign` (`consultation_id`),
  ADD KEY `messages_sender_id_foreign` (`sender_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `reminders`
--
ALTER TABLE `reminders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reminders_user_id_foreign` (`user_id`),
  ADD KEY `reminders_medical_record_id_foreign` (`medical_record_id`),
  ADD KEY `reminders_drug_id_foreign` (`drug_id`);

--
-- Indexes for table `reminder_times`
--
ALTER TABLE `reminder_times`
  ADD KEY `reminder_times_reminder_id_foreign` (`reminder_id`),
  ADD KEY `reminder_times_time_id_foreign` (`time_id`);

--
-- Indexes for table `specializations`
--
ALTER TABLE `specializations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `times`
--
ALTER TABLE `times`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actions`
--
ALTER TABLE `actions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `conditions`
--
ALTER TABLE `conditions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `consultations`
--
ALTER TABLE `consultations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `drugs`
--
ALTER TABLE `drugs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `emergencycall`
--
ALTER TABLE `emergencycall`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hospitals`
--
ALTER TABLE `hospitals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `medical_records`
--
ALTER TABLE `medical_records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reminders`
--
ALTER TABLE `reminders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `specializations`
--
ALTER TABLE `specializations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `times`
--
ALTER TABLE `times`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `conditions`
--
ALTER TABLE `conditions`
  ADD CONSTRAINT `conditions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `consultations`
--
ALTER TABLE `consultations`
  ADD CONSTRAINT `consultations_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `consultations_medical_record_id_foreign` FOREIGN KEY (`medical_record_id`) REFERENCES `medical_records` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `consultations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_hospital_id_foreign` FOREIGN KEY (`hospital_id`) REFERENCES `hospitals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `doctors_specialization_id_foreign` FOREIGN KEY (`specialization_id`) REFERENCES `specializations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `doctors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `doctor_has_actions`
--
ALTER TABLE `doctor_has_actions`
  ADD CONSTRAINT `doctor_has_actions_action_id_foreign` FOREIGN KEY (`action_id`) REFERENCES `actions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `doctor_has_actions_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `drug_records`
--
ALTER TABLE `drug_records`
  ADD CONSTRAINT `drug_records_drug_id_foreign` FOREIGN KEY (`drug_id`) REFERENCES `drugs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `drug_records_medical_record_id_foreign` FOREIGN KEY (`medical_record_id`) REFERENCES `medical_records` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `emergencycall`
--
ALTER TABLE `emergencycall`
  ADD CONSTRAINT `emergencycall_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `families`
--
ALTER TABLE `families`
  ADD CONSTRAINT `families_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `families_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `medical_actions`
--
ALTER TABLE `medical_actions`
  ADD CONSTRAINT `medical_actions_action_id_foreign` FOREIGN KEY (`action_id`) REFERENCES `actions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `medical_actions_medical_record_id_foreign` FOREIGN KEY (`medical_record_id`) REFERENCES `medical_records` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `medical_records`
--
ALTER TABLE `medical_records`
  ADD CONSTRAINT `medical_records_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `medical_records_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_consultation_id_foreign` FOREIGN KEY (`consultation_id`) REFERENCES `consultations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messages_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reminders`
--
ALTER TABLE `reminders`
  ADD CONSTRAINT `reminders_drug_id_foreign` FOREIGN KEY (`drug_id`) REFERENCES `drugs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reminders_medical_record_id_foreign` FOREIGN KEY (`medical_record_id`) REFERENCES `medical_records` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reminders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reminder_times`
--
ALTER TABLE `reminder_times`
  ADD CONSTRAINT `reminder_times_reminder_id_foreign` FOREIGN KEY (`reminder_id`) REFERENCES `reminders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reminder_times_time_id_foreign` FOREIGN KEY (`time_id`) REFERENCES `times` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
