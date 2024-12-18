-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2024 at 01:15 AM
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
-- Database: `backend_pw`
--

-- --------------------------------------------------------

--
-- Table structure for table `akuns`
--

CREATE TABLE `akuns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `npm` int(11) NOT NULL,
  `nomor_rekening` varchar(255) NOT NULL,
  `nama_akun` varchar(255) NOT NULL,
  `saldo` double NOT NULL,
  `pin` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `akuns`
--

INSERT INTO `akuns` (`id`, `npm`, `nomor_rekening`, `nama_akun`, `saldo`, `pin`, `password`, `isAdmin`, `created_at`, `updated_at`) VALUES
(3, 12, 'NR676168F3370FE2218', 'znok', 0, 3, '$2y$12$AyvrxNicn55eDBpo9qRjYumRzTPL9VqoGrEUuPRff5rXHc0YUjwDy', 0, NULL, NULL),
(4, 313, 'NR6761695353DB33549', 'znok', 0, 3, '$2y$12$hbbfKe5SJWDE.cjPjfr5HewMKaVy.mWOenNyo18rbaetvSPUIilqy', 0, NULL, NULL),
(5, 7338, 'NR67616A98976A64503', 'znok', 0, 3, '$2y$12$tBSnk7glylS1Y.w5L0GbTetKhLbkJbCAYRSyiw7oyujUXOLKc06dm', 0, NULL, NULL),
(6, 7, 'NR6761715862D243876', '7', 0, 7, '$2y$12$tTUMBdfM0Ll3S4GrmuQmMe9qUftL8gLN01kRM6Ard6gCTpPww.S3m', 0, '2024-12-17 05:40:56', '2024-12-17 05:40:56'),
(7, 22, '3166417245', 'Raja koding', 11120, 22, '$2y$12$dk6Z5HtebgTN1k5AIu1PxuRFm/2CkeRz972PAs0z.kEmCVJ9jLJgu', 0, NULL, NULL),
(10, 22071, '7134754032', '22071', 0, 22071, '$2y$12$SyubH9sOEZlJeGG2DemjZuUYZZjCOjyeve2vfJVbGcIeQ7HtilVXS', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

CREATE TABLE `deposits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nomor_akun` bigint(20) UNSIGNED NOT NULL,
  `nominal_deposit` double NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deposits`
--

INSERT INTO `deposits` (`id`, `nomor_akun`, `nominal_deposit`, `tanggal_transaksi`, `created_at`, `updated_at`) VALUES
(1, 7, 10000, '2024-12-17', NULL, NULL),
(2, 7, 2221, '0000-00-00', '2024-12-17 15:33:30', '2024-12-17 15:33:30'),
(3, 7, 2221, '0000-00-00', '2024-12-17 15:34:56', '2024-12-17 15:34:56'),
(4, 7, 2221, '0000-00-00', '2024-12-17 15:35:12', '2024-12-17 15:35:12'),
(5, 7, 2221, '0000-00-00', '2024-12-17 15:35:52', '2024-12-17 15:35:52'),
(6, 7, 2221, '2024-12-17', '2024-12-17 15:38:05', '2024-12-17 15:38:05'),
(7, 7, 9, '2024-12-17', '2024-12-17 15:38:25', '2024-12-17 15:38:25'),
(8, 7, 6, '2024-12-17', '2024-12-17 15:38:55', '2024-12-17 15:38:55');

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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_12_17_073733_create_akuns_table', 1),
(5, '2024_12_17_073756_create_deposits_table', 1),
(6, '2024_12_17_073805_create_peminjamen_table', 1),
(7, '2024_12_17_073811_create_pembayarans_table', 1),
(8, '2024_12_17_073827_create_riwayats_table', 1),
(9, '2024_12_17_090931_create_personal_access_tokens_table', 1);

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
-- Table structure for table `pembayarans`
--

CREATE TABLE `pembayarans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nomor_akun` bigint(20) UNSIGNED NOT NULL,
  `id_peminjaman` bigint(20) UNSIGNED NOT NULL,
  `nominal_angsuran` double NOT NULL,
  `tanggal_pembayaran` date DEFAULT NULL,
  `tahapan_angsuran` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembayarans`
--

INSERT INTO `pembayarans` (`id`, `nomor_akun`, `id_peminjaman`, `nominal_angsuran`, `tanggal_pembayaran`, `tahapan_angsuran`, `created_at`, `updated_at`) VALUES
(23, 6, 15, 3000000, '0000-00-00', 23, '2024-12-17 11:49:46', '2024-12-17 15:04:29'),
(24, 6, 15, 3000000, '2024-12-19', 24, '2024-12-17 11:54:05', '2024-12-17 16:28:16'),
(25, 6, 15, 3000000, '2024-12-20', 25, '2024-12-17 11:54:35', '2024-12-17 16:33:25'),
(26, 3, 7, 12, '2024-12-20', 2, NULL, '2024-12-17 16:39:27'),
(27, 3, 7, 12, NULL, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `peminjamans`
--

CREATE TABLE `peminjamans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nominal_peminjaman` double NOT NULL,
  `tanggal_peminjaman` date DEFAULT NULL,
  `masa_peminjaman` int(11) NOT NULL,
  `deskripsi_peminjaman` varchar(255) NOT NULL,
  `nominal_fix` double NOT NULL,
  `nomor_akun` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peminjamans`
--

INSERT INTO `peminjamans` (`id`, `nominal_peminjaman`, `tanggal_peminjaman`, `masa_peminjaman`, `deskripsi_peminjaman`, `nominal_fix`, `nomor_akun`, `created_at`, `updated_at`) VALUES
(7, 1, NULL, 1, '12', 1, 6, '2024-12-17 09:17:09', '2024-12-17 09:17:09'),
(8, 3, NULL, 3, '3', 3, 6, '2024-12-17 09:20:22', '2024-12-17 09:20:22'),
(9, 4, NULL, 4, '4', 4, 6, '2024-12-17 09:22:48', '2024-12-17 09:22:48'),
(10, 5, NULL, 4, '4', 5, 6, '2024-12-17 09:23:18', '2024-12-17 09:23:18'),
(11, 6, NULL, 6, '6', 6, 6, '2024-12-17 09:23:28', '2024-12-17 09:23:28'),
(12, 12, NULL, 22, '22', 12, 6, '2024-12-17 09:24:48', '2024-12-17 09:24:48'),
(13, 1, NULL, 1, '1', 1, 6, '2024-12-17 09:26:15', '2024-12-17 09:26:15'),
(14, 4444, '2024-12-19', 4444, '77', 77, 6, '2024-12-17 09:28:56', '2024-12-17 14:51:19'),
(15, 69000000, '2024-12-17', 23, '69', 69000000, 6, '2024-12-17 09:29:37', '2024-12-17 09:29:37');

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

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(16, 'App\\Models\\Akun', 6, 'Personal Access Token', '794ca5956a75572625698050c6760fbd6b48ed8d65bae9f9b232a19d6b369d27', '[\"*\"]', NULL, NULL, '2024-12-17 06:53:54', '2024-12-17 06:53:54'),
(17, 'App\\Models\\Akun', 6, 'Personal Access Token', '29c76d8ca5e34e50ed0a7dd1a73bf6e3b74985a3fefe55b0aa532f4e9ff55532', '[\"*\"]', NULL, NULL, '2024-12-17 06:54:50', '2024-12-17 06:54:50'),
(18, 'App\\Models\\Akun', 6, 'Personal Access Token', 'f78876820e3dcedecfadee20aa5ffab3ca8f6ad637c1d53353970cfae3298267', '[\"*\"]', NULL, NULL, '2024-12-17 06:56:03', '2024-12-17 06:56:03'),
(19, 'App\\Models\\Akun', 6, 'Personal Access Token', '8c9cbe67066b054b54a442eefb95332d97f7a71eef11342b3839551e508875dc', '[\"*\"]', NULL, NULL, '2024-12-17 06:56:25', '2024-12-17 06:56:25'),
(20, 'App\\Models\\Akun', 6, 'Personal Access Token', '8c1c8fa952e2cf3a41632af30fe7edb4ca88e289815837266640def071ab87e0', '[\"*\"]', NULL, NULL, '2024-12-17 06:56:53', '2024-12-17 06:56:53'),
(21, 'App\\Models\\Akun', 6, 'Personal Access Token', '682f0e731b8aa147a17e57db7ad39776ae390ce874ebc02e222bc08e9f182eb2', '[\"*\"]', NULL, NULL, '2024-12-17 06:57:46', '2024-12-17 06:57:46'),
(22, 'App\\Models\\Akun', 6, 'Personal Access Token', '6e88808087734b63766a743f02bfa316009cd9c2ce6367fec6477fe311ea3be7', '[\"*\"]', NULL, NULL, '2024-12-17 06:57:54', '2024-12-17 06:57:54'),
(23, 'App\\Models\\Akun', 6, 'Personal Access Token', 'fceb39079a8b0e54d8fb08472866020e7c18abcc47343e54e174c9f3b2f57743', '[\"*\"]', NULL, NULL, '2024-12-17 06:58:07', '2024-12-17 06:58:07'),
(24, 'App\\Models\\Akun', 6, 'Personal Access Token', '18320f4b69e6d37bd9157c0f3109f8d358ef2bdc71d0069125ba5e0928cee928', '[\"*\"]', NULL, NULL, '2024-12-17 06:58:15', '2024-12-17 06:58:15'),
(25, 'App\\Models\\Akun', 6, 'Personal Access Token', 'e8546c2634e24ec1385a1dae7b5aa7aa82deb3840f21aa9cce8807b822afb419', '[\"*\"]', NULL, NULL, '2024-12-17 06:59:06', '2024-12-17 06:59:06'),
(26, 'App\\Models\\Akun', 6, 'Personal Access Token', 'f564dc8e2818f40ca992bf11d0e571a9b4232261c00ec2701dd50414935e064a', '[\"*\"]', NULL, NULL, '2024-12-17 07:00:20', '2024-12-17 07:00:20'),
(27, 'App\\Models\\Akun', 6, 'Personal Access Token', '495f7777f8af3e8c68fe3bda744093133a8d523503ebc37a1446a525e0bad9f1', '[\"*\"]', NULL, NULL, '2024-12-17 07:01:31', '2024-12-17 07:01:31'),
(28, 'App\\Models\\Akun', 6, 'Personal Access Token', '8566216e1f17c2c315042b5bd5dfa857b5293d72fe0b34d9e2ea7bac82cc58f6', '[\"*\"]', NULL, NULL, '2024-12-17 07:01:48', '2024-12-17 07:01:48'),
(29, 'App\\Models\\Akun', 6, 'Personal Access Token', 'bd55101b5835510daeeaf366a9ac32c431719bd6e7b5dbc09c9cb59df3e82efe', '[\"*\"]', NULL, NULL, '2024-12-17 07:02:06', '2024-12-17 07:02:06'),
(30, 'App\\Models\\Akun', 6, 'Personal Access Token', '9f882348b3d2ce075020353c5e28d44a84cf0313e6d00fb3387e7749255a3e63', '[\"*\"]', NULL, NULL, '2024-12-17 07:04:55', '2024-12-17 07:04:55'),
(31, 'App\\Models\\Akun', 6, 'Personal Access Token', 'ef4c4a57ce9ee107fd34d5a30badb9f4651b1d4ef88f6e1b7cbac3ecc724161d', '[\"*\"]', NULL, NULL, '2024-12-17 07:09:53', '2024-12-17 07:09:53'),
(32, 'App\\Models\\Akun', 6, 'Personal Access Token', 'cd911258fe5d3ba979db0504b2ffec0d4f0827ec214a52533749826abd2e4d04', '[\"*\"]', NULL, NULL, '2024-12-17 07:10:07', '2024-12-17 07:10:07'),
(33, 'App\\Models\\Akun', 6, 'Personal Access Token', '1b17bd78ff53ab6f59654eb4d1c19456aac1c18b7c8878acc35e53994cccc540', '[\"*\"]', NULL, NULL, '2024-12-17 07:10:34', '2024-12-17 07:10:34'),
(34, 'App\\Models\\Akun', 6, 'Personal Access Token', 'af302291b7d413963bae3791271bd04364b242323d55cd325ecf421e05b3889b', '[\"*\"]', NULL, NULL, '2024-12-17 07:12:28', '2024-12-17 07:12:28'),
(35, 'App\\Models\\Akun', 6, 'Personal Access Token', '5f800702285a4db7ab24e50619b2dda9417d6af8beaa1fa6293165d414516b46', '[\"*\"]', NULL, NULL, '2024-12-17 07:14:24', '2024-12-17 07:14:24'),
(36, 'App\\Models\\Akun', 6, 'Personal Access Token', '385f59068130d731bba1ffbdf2a160753fb84a59c69880166ce9f2f8b5dc974d', '[\"*\"]', NULL, NULL, '2024-12-17 07:14:29', '2024-12-17 07:14:29'),
(37, 'App\\Models\\Akun', 6, 'Personal Access Token', '7210015a72d67a5b2eadf12b633528080090c1eda382fbb2533ae89c94b5d8b5', '[\"*\"]', NULL, NULL, '2024-12-17 07:15:01', '2024-12-17 07:15:01'),
(38, 'App\\Models\\Akun', 6, 'Personal Access Token', '257df44c350c133bf5159fdc2c5b3067dcfdfee9e24a3c81755be187a7d9b262', '[\"*\"]', NULL, NULL, '2024-12-17 07:16:20', '2024-12-17 07:16:20'),
(39, 'App\\Models\\Akun', 6, 'Personal Access Token', 'b8421718ee5880c9a3ce004ac091625e14781e2836131bd5461d405b687b10e2', '[\"*\"]', NULL, NULL, '2024-12-17 07:16:47', '2024-12-17 07:16:47'),
(40, 'App\\Models\\Akun', 6, 'Personal Access Token', 'f48d3b9e02ed6ef3f36593aa6d0a239277a72f77695bfc28600da6ba899fa95a', '[\"*\"]', NULL, NULL, '2024-12-17 07:17:04', '2024-12-17 07:17:04'),
(41, 'App\\Models\\Akun', 6, 'Personal Access Token', '718945581a17f56e70af2c20d675dc1a72bf12390045aa8166321898b1858734', '[\"*\"]', NULL, NULL, '2024-12-17 07:17:12', '2024-12-17 07:17:12'),
(42, 'App\\Models\\Akun', 6, 'Personal Access Token', 'ba403f2bb4dacdbb8141082a9115bee5a0bfb70fbc3e18ade0057683673494d8', '[\"*\"]', NULL, NULL, '2024-12-17 07:17:43', '2024-12-17 07:17:43'),
(43, 'App\\Models\\Akun', 6, 'Personal Access Token', '4139d09daddb2cef93591e52e257dc4c248826d7d85f3c83e977d37f6dd516b5', '[\"*\"]', NULL, NULL, '2024-12-17 07:18:18', '2024-12-17 07:18:18'),
(44, 'App\\Models\\Akun', 6, 'Personal Access Token', 'cc9346c800627b92966749f7fd8250befe25a6a052a5f8139256fa89edebeeb7', '[\"*\"]', NULL, NULL, '2024-12-17 07:18:57', '2024-12-17 07:18:57'),
(45, 'App\\Models\\Akun', 6, 'Personal Access Token', 'bffcce0126428ec60fb7c18828d89ed13371e38173d0e187a061de2cc27c8982', '[\"*\"]', NULL, NULL, '2024-12-17 07:22:46', '2024-12-17 07:22:46'),
(46, 'App\\Models\\Akun', 6, 'Personal Access Token', '0fce036873a113e0e190ce4543e93c060048dc6b12b0698b0870d4ee99abedb4', '[\"*\"]', NULL, NULL, '2024-12-17 07:26:19', '2024-12-17 07:26:19'),
(47, 'App\\Models\\Akun', 6, 'Personal Access Token', '5c160dc9466221b16611229d5dc3254f0d82517a377d311d5f0abb88f23a6a4f', '[\"*\"]', NULL, NULL, '2024-12-17 07:27:51', '2024-12-17 07:27:51'),
(48, 'App\\Models\\Akun', 6, 'Personal Access Token', 'f5b9d9856a92737dc54e8cd868c71334255cc7d50f62418eeb9ebc95dd53c437', '[\"*\"]', NULL, NULL, '2024-12-17 07:38:29', '2024-12-17 07:38:29'),
(49, 'App\\Models\\Akun', 6, 'Personal Access Token', 'a741c19a7245ec9e5fd87513901bd02f12202affd8e15956affff440cc495385', '[\"*\"]', NULL, NULL, '2024-12-17 07:39:09', '2024-12-17 07:39:09'),
(50, 'App\\Models\\Akun', 6, 'Personal Access Token', '04ff8b3b1c8843c142f18246518fea606bd7850b19ab535239c52dfeae03bef2', '[\"*\"]', NULL, NULL, '2024-12-17 07:40:41', '2024-12-17 07:40:41'),
(51, 'App\\Models\\Akun', 6, 'Personal Access Token', '71a36318f2c51c149620b5d80ad848097051fb01c104d7d72d6e03d8f57f1c2d', '[\"*\"]', NULL, NULL, '2024-12-17 07:41:10', '2024-12-17 07:41:10'),
(52, 'App\\Models\\Akun', 6, 'Personal Access Token', '7574a699c16704ccc28c7d9eac3e3bf28b308cce8e7ea5d74d103b0e705a369c', '[\"*\"]', NULL, NULL, '2024-12-17 07:51:03', '2024-12-17 07:51:03'),
(53, 'App\\Models\\Akun', 6, 'Personal Access Token', '9b4aea7f7b1ca90da74f30ae8c27f1781085863f6757edbf4b46568f2d1ce34b', '[\"*\"]', NULL, NULL, '2024-12-17 07:55:15', '2024-12-17 07:55:15'),
(54, 'App\\Models\\Akun', 6, 'Personal Access Token', 'c5f727601b9b004b868e562a865686db870d31b809492e2ee02f544f331684d6', '[\"*\"]', '2024-12-17 08:10:24', NULL, '2024-12-17 07:56:25', '2024-12-17 08:10:24'),
(55, 'App\\Models\\Akun', 7, 'Personal Access Token', 'b820f9ac21aba9ad1cb4609db6de3c5f7b77c528e2b400b429b2564600125f36', '[\"*\"]', '2024-12-17 08:13:18', NULL, '2024-12-17 08:13:15', '2024-12-17 08:13:18'),
(56, 'App\\Models\\Akun', 7, 'Personal Access Token', '282820e39c81948cc0d25875dc1d1d19591289fe3928f84d09a8339f024b17ad', '[\"*\"]', '2024-12-17 09:08:05', NULL, '2024-12-17 08:14:04', '2024-12-17 09:08:05'),
(57, 'App\\Models\\Akun', 6, 'Personal Access Token', 'bb913909e3c69683ce8ab01cb28d9fdc6065038f90fea9281cce09d462a3325d', '[\"*\"]', '2024-12-17 09:02:29', NULL, '2024-12-17 08:48:33', '2024-12-17 09:02:29'),
(58, 'App\\Models\\Akun', 6, 'Personal Access Token', '32c082a37b31e30387af83430945b14858e369229f5975063e64d77485bdcb7f', '[\"*\"]', '2024-12-17 09:08:34', NULL, '2024-12-17 09:08:29', '2024-12-17 09:08:34'),
(59, 'App\\Models\\Akun', 6, 'Personal Access Token', 'ece09a30be1ba2f9c5f313702a05ccafa057382acf20315d50b034307f3aa7f5', '[\"*\"]', '2024-12-17 11:40:16', NULL, '2024-12-17 09:09:13', '2024-12-17 11:40:16'),
(60, 'App\\Models\\Akun', 6, 'Personal Access Token', '240c920e49dd5b1c144a70af36ebe5f36239212c3fb2c699bb3d9bf91f1e04da', '[\"*\"]', '2024-12-17 11:18:58', NULL, '2024-12-17 11:18:28', '2024-12-17 11:18:58'),
(61, 'App\\Models\\Akun', 6, 'Personal Access Token', '2b8ad9b9cf889364f1e7f40a6aba51e62ff8a7e3f7d18a6cfedf188bc9326f34', '[\"*\"]', '2024-12-17 11:54:50', NULL, '2024-12-17 11:41:07', '2024-12-17 11:54:50'),
(62, 'App\\Models\\Akun', 6, 'Personal Access Token', 'a5dc5c37c677ac7d164cbf4646d3744e9f821671d19e67eac65aaeb494945407', '[\"*\"]', '2024-12-17 12:05:00', NULL, '2024-12-17 12:04:59', '2024-12-17 12:05:00'),
(63, 'App\\Models\\Akun', 6, 'Personal Access Token', 'dab3373b37106379a6db97878560ee250225172a13fa131c30d1457b8b1727b4', '[\"*\"]', '2024-12-17 12:21:40', NULL, '2024-12-17 12:21:39', '2024-12-17 12:21:40'),
(64, 'App\\Models\\Akun', 6, 'Personal Access Token', '2f74f21b5d80fdcd16449862db2f976cc4fbda4b48c9d12663cd6a9258371bbd', '[\"*\"]', '2024-12-17 12:24:17', NULL, '2024-12-17 12:24:16', '2024-12-17 12:24:17'),
(65, 'App\\Models\\Akun', 10, 'Personal Access Token', '414075d8d71da20dcf26ad08bfb086af98d623a5893f43d433a99810e972e5c3', '[\"*\"]', NULL, NULL, '2024-12-17 12:32:30', '2024-12-17 12:32:30'),
(66, 'App\\Models\\Akun', 10, 'Personal Access Token', '8ee300134ff455369769c005fd6842eb6c14ab8c465cdd72dd182878f025b3cf', '[\"*\"]', '2024-12-17 12:32:44', NULL, '2024-12-17 12:32:43', '2024-12-17 12:32:44'),
(67, 'App\\Models\\Akun', 10, 'Personal Access Token', '1f2774e8a7d8e4893bdb944d13d94d71c1ae4885de7d94cc7c4205aa181dac50', '[\"*\"]', NULL, NULL, '2024-12-17 12:34:12', '2024-12-17 12:34:12'),
(68, 'App\\Models\\Akun', 10, 'Personal Access Token', '4cd47857d4f4da1a686fe8ccedd2d9496f7c69d54f921bcb905b0034c6e2aabc', '[\"*\"]', '2024-12-17 12:34:47', NULL, '2024-12-17 12:34:45', '2024-12-17 12:34:47'),
(69, 'App\\Models\\Akun', 10, 'Personal Access Token', '5da261b858e5cb129cf4acdb96e1e092f7c423487a11c07e8a17435b1c217756', '[\"*\"]', '2024-12-17 12:35:18', NULL, '2024-12-17 12:35:16', '2024-12-17 12:35:18'),
(70, 'App\\Models\\Akun', 10, 'Personal Access Token', '5188797a672012cc199c7a83882b5d2937344d59aedbdc2f67ec2e0a54277d97', '[\"*\"]', NULL, NULL, '2024-12-17 12:35:30', '2024-12-17 12:35:30'),
(71, 'App\\Models\\Akun', 6, 'Personal Access Token', 'c26015b9f3d6bf95b115d7b822a5aa4445129122af9a31f3f13df7934d272fd4', '[\"*\"]', NULL, NULL, '2024-12-17 12:36:57', '2024-12-17 12:36:57'),
(72, 'App\\Models\\Akun', 10, 'Personal Access Token', '896f7cb56f77e52e0c29386c46fa05c386fa35f104a24e56c1d418a4c62b3e3c', '[\"*\"]', NULL, NULL, '2024-12-17 12:37:13', '2024-12-17 12:37:13'),
(73, 'App\\Models\\Akun', 10, 'Personal Access Token', '6a7176881a3c89a50a573c8bdbf381769267db2b700e4ae0c1934479a9c1faa1', '[\"*\"]', '2024-12-17 12:37:39', NULL, '2024-12-17 12:37:38', '2024-12-17 12:37:39'),
(74, 'App\\Models\\Akun', 6, 'Personal Access Token', 'f37b1f105eb6c345ace24afdbbadb80c404eb6b127c452be1d5fbc7b9307b4b4', '[\"*\"]', '2024-12-17 12:37:48', NULL, '2024-12-17 12:37:47', '2024-12-17 12:37:48'),
(75, 'App\\Models\\Akun', 6, 'Personal Access Token', '7a29da46c35f553b4fe991be591d79e3a1e1701420b6dc6ee565c87d586cb586', '[\"*\"]', '2024-12-17 12:41:49', NULL, '2024-12-17 12:41:48', '2024-12-17 12:41:49'),
(76, 'App\\Models\\Akun', 6, 'Personal Access Token', '3ff9d5d0ccb008d02cd4b4de3315096a902f9b93922168db5c3510e9b0c6877a', '[\"*\"]', '2024-12-17 12:52:01', NULL, '2024-12-17 12:52:00', '2024-12-17 12:52:01');

-- --------------------------------------------------------

--
-- Table structure for table `riwayats`
--

CREATE TABLE `riwayats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nomor_akun` bigint(20) UNSIGNED NOT NULL,
  `jenis_transaksi` varchar(255) NOT NULL,
  `nominal_transaksi` double NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('qW32ppSyGkYStbRHfKszU2gcn5sN8vBVf5XlrZl6', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUk1VT2hsQ3ZVRmMzR1prdDd6Rk41Z0JiUjlsT2JkbGdxYzI1QW1WZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9saXN0ZGVwb3NpdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1734479643);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akuns`
--
ALTER TABLE `akuns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `deposits`
--
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deposits_nomor_akun_foreign` (`nomor_akun`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `pembayarans`
--
ALTER TABLE `pembayarans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembayarans_nomor_akun_foreign` (`nomor_akun`),
  ADD KEY `pembayarans_id_peminjaman_foreign` (`id_peminjaman`);

--
-- Indexes for table `peminjamans`
--
ALTER TABLE `peminjamans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `peminjamans_nomor_akun_foreign` (`nomor_akun`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `riwayats`
--
ALTER TABLE `riwayats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `riwayats_nomor_akun_foreign` (`nomor_akun`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
-- AUTO_INCREMENT for table `akuns`
--
ALTER TABLE `akuns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pembayarans`
--
ALTER TABLE `pembayarans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `peminjamans`
--
ALTER TABLE `peminjamans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `riwayats`
--
ALTER TABLE `riwayats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `deposits`
--
ALTER TABLE `deposits`
  ADD CONSTRAINT `deposits_nomor_akun_foreign` FOREIGN KEY (`nomor_akun`) REFERENCES `akuns` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pembayarans`
--
ALTER TABLE `pembayarans`
  ADD CONSTRAINT `pembayarans_id_peminjaman_foreign` FOREIGN KEY (`id_peminjaman`) REFERENCES `peminjamans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pembayarans_nomor_akun_foreign` FOREIGN KEY (`nomor_akun`) REFERENCES `akuns` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `peminjamans`
--
ALTER TABLE `peminjamans`
  ADD CONSTRAINT `peminjamans_nomor_akun_foreign` FOREIGN KEY (`nomor_akun`) REFERENCES `akuns` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `riwayats`
--
ALTER TABLE `riwayats`
  ADD CONSTRAINT `riwayats_nomor_akun_foreign` FOREIGN KEY (`nomor_akun`) REFERENCES `akuns` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
