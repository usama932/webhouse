-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2022 at 11:07 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `artist_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Mr Andreson', 'admin@domain.com', '$2y$10$qjKjrzmHYfIUPxADUiEk9ezZ8G5MTjUeyHH8uVPVTtEUs9Mt/2Csi', 's1QSCharmuXuf85eGbHCH3HwhfNCu8Z2CJRQOVP2gF1HhGICuVK4GnfcGOW2', '2019-12-17 01:45:10', '2019-12-17 14:13:41');

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `artist_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `artists`
--

CREATE TABLE `artists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 0,
  `gender` int(11) NOT NULL DEFAULT 1,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fb_token` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `shopify` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ecwid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `artists`
--

INSERT INTO `artists` (`id`, `name`, `phone`, `facebook_link`, `youtube_link`, `instagram_link`, `twitter_link`, `active`, `gender`, `email`, `password`, `image`, `remember_token`, `cover_photo`, `description`, `fb_token`, `created_at`, `updated_at`, `deleted_at`, `shopify`, `ecwid`) VALUES
(3, 'test', '24134124', '#1', '#2', '#3', '#4', 1, 0, 'test13@gmail.com', '$2y$10$AoFxI54LweUKRdxLIggIAeu2E0VSmrYzEyPvfrZbykKWFazy6uZ5m', '1965852170a2b ad.png', NULL, '396578590a2b.png', NULL, NULL, '2021-03-10 19:13:01', '2021-03-10 19:13:25', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `artist_subscribes`
--

CREATE TABLE `artist_subscribes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `artist_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `audio`
--

CREATE TABLE `audio` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `composer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `audio` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` bigint(20) DEFAULT NULL,
  `artist_id` bigint(20) UNSIGNED DEFAULT NULL,
  `album_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `image`, `created_at`, `updated_at`) VALUES
(1, 'test', 'test', '113350675770.jpg', '2021-03-24 15:17:02', '2021-04-06 18:50:36'),
(2, 'Bed Room', 'bed-room', NULL, '2021-04-06 18:51:32', '2021-04-06 18:51:32'),
(3, 'Bed Room', 'bed-room-1', '1170663492770.jpg', '2021-04-06 18:52:45', '2021-04-06 18:52:45'),
(4, 'test', 'test-1', '1676572111770.jpg', '2021-04-07 18:40:31', '2021-04-07 18:40:31');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` float DEFAULT NULL,
  `venue` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  `artist_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `image`, `venue`, `name`, `date_time`, `artist_id`, `status`, `description`, `created_at`, `updated_at`) VALUES
(3, NULL, 'test', 'test n', '2021-03-09 02:01:00', 3, 1, 'test d', '2021-03-16 07:00:00', '2021-03-16 07:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faverate_events`
--

CREATE TABLE `faverate_events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `event_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favrate_audio`
--

CREATE TABLE `favrate_audio` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `audio_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favrate_videos`
--

CREATE TABLE `favrate_videos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `video_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `firebase_notifications`
--

CREATE TABLE `firebase_notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `artist_id` bigint(20) DEFAULT NULL,
  `sent` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `artist_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `subject`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Order Ready', 'Order Ready', '2020-01-20 05:20:16', '2020-01-20 05:20:16'),
(2, 'Take it', 'Take it. Its ready', '2020-01-20 05:21:15', '2020-01-20 05:21:15'),
(4, 'In Progress', 'In Progress', '2020-01-20 05:24:40', '2020-01-20 05:24:40');

-- --------------------------------------------------------

--
-- Table structure for table `message_user`
--

CREATE TABLE `message_user` (
  `id` bigint(20) NOT NULL,
  `message_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message_user`
--

INSERT INTO `message_user` (`id`, `message_id`, `user_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(4, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_17_070606_create_admins_table', 2),
(5, '2019_12_17_114716_create_settings_table', 3),
(6, '2019_12_18_074846_create_notifications_table', 4),
(7, '2019_12_18_080355_create_messages_table', 5),
(11, '2016_06_01_000001_create_oauth_auth_codes_table', 6),
(12, '2016_06_01_000002_create_oauth_access_tokens_table', 6),
(13, '2016_06_01_000003_create_oauth_refresh_tokens_table', 6),
(14, '2016_06_01_000004_create_oauth_clients_table', 6),
(15, '2016_06_01_000005_create_oauth_personal_access_clients_table', 6),
(16, '2021_01_03_055708_create_artists_table', 7),
(17, '2021_02_03_055523_create_albums_table', 7),
(18, '2021_02_03_055539_create_videos_table', 7),
(19, '2021_02_03_055558_create_audio_table', 7),
(20, '2021_02_03_055613_create_images_table', 7),
(21, '2021_03_03_055613_create_images_table', 8),
(22, '2021_02_23_070520_create_favrate_audio_table', 9),
(23, '2021_02_23_070543_create_favrate_videos_table', 9),
(24, '2021_02_23_070648_create_artist_subscribes_table', 9),
(25, '2021_03_09_051634_create_events_table', 10),
(26, '2021_03_16_075821_create_faverate_events_table', 11),
(27, '2020_03_11_060728_create_categories_table', 12),
(28, '2021_05_20_065109_create_rooms_table', 13),
(29, '2021_05_24_071534_create_firebase_notifications_table', 14);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('36b40c28-a265-4ffb-b1c3-3a462beaf4ed', 'App\\Notifications\\NewMessage', 'App\\User', 1, '{\"user_id\":1,\"user_name\":\"John Smit\",\"message_id\":4,\"subject\":\"In Progress\"}', NULL, '2020-01-20 05:24:41', '2020-01-20 05:24:41'),
('583c2ba3-7398-45ac-8d0a-26282f3426e3', 'App\\Notifications\\NewMessage', 'App\\User', 1, '{\"user_id\":1,\"user_name\":\"John Smit\",\"message_id\":1,\"subject\":\"Order Ready\"}', NULL, '2020-01-20 05:20:16', '2020-01-20 05:20:16'),
('5920fc2d-ddfd-4d92-8218-9042d12eb05a', 'App\\Notifications\\NewMessage', 'App\\User', 13, '{\"user_id\":13,\"user_name\":\"Jacob\",\"message_id\":3,\"subject\":\"In Progress\"}', NULL, '2020-01-20 05:23:52', '2020-01-20 05:23:52'),
('c9f4555d-00b4-4390-a314-e9810d8e8016', 'App\\Notifications\\NewMessage', 'App\\User', 1, '{\"user_id\":1,\"user_name\":\"John Smit\",\"message_id\":2,\"subject\":\"Take it\"}', NULL, '2020-01-20 05:21:15', '2020-01-20 05:21:15');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('03491141d20225e3c9e615ecae1f526804dcd8ddb63792bf96d8bad3f85b1ed17c851845fa015161', 1, 1, 'Artist', '[]', 0, '2021-03-10 17:29:15', '2021-03-10 17:29:15', '2022-03-10 09:29:15'),
('036f8d4de6019ae2a18179b93ee151f5cd1768c7cfb5bee20a03d689407cdf985ce195f72b709213', 1, 1, 'Artist', '[]', 0, '2021-03-10 17:23:15', '2021-03-10 17:23:15', '2022-03-10 09:23:15'),
('1bc79f7eabc5e1926afb4d859e459a8e4501c908e6315b1e10408c728dd97f1e3b464a23b8febdc9', 1, 1, 'Artist', '[]', 0, '2021-03-10 17:27:15', '2021-03-10 17:27:15', '2022-03-10 09:27:15'),
('49194bae5faaa003d3ecf63ea87f7c5446acde34b3e1919d7d4c61600e63140938403e1dd5969b05', 14, 1, 'authToken', '[]', 0, '2021-01-20 15:30:46', '2021-01-20 15:30:46', '2022-01-20 07:30:46'),
('59fe7c02eb609b887328d3745616acb9dd9655451146718e4952ba0a5fa7cad6bd2a08b92579c38b', 1, 1, 'Artist', '[]', 0, '2021-03-10 17:21:05', '2021-03-10 17:21:05', '2022-03-10 09:21:05'),
('63fe5b4b8bf3e670436e52e93341b8e3d09e785842d9d5ab5e4a1b47b2bae9a3a8002a1029c1ca7b', 1, 1, 'Artist', '[]', 0, '2021-02-08 19:14:49', '2021-02-08 19:14:49', '2022-02-08 11:14:49'),
('8675e67217f806c80f73652f944b64d7fe5ba61fbfcc5776366010139ade14daecfd1f92e2897d5d', 1, 1, 'Artist', '[]', 0, '2021-03-10 17:31:33', '2021-03-10 17:31:33', '2022-03-10 09:31:33'),
('8eb8d52bf8c0b42d045a8e15721f81341fe21e71dbe56b789ea9de3d9b61287071196971df155334', 15, 1, 'authToken', '[]', 0, '2021-02-18 14:42:05', '2021-02-18 14:42:05', '2022-02-18 06:42:05'),
('8fd9c6cc10fa24a410f0e95a072d6b7b052153d5be9112247268bf503a6dd02cb206c54679d40ab9', 16, 1, 'authToken', '[]', 0, '2021-03-05 19:15:43', '2021-03-05 19:15:43', '2022-03-05 11:15:43'),
('922fc7769426bb72d8ae13481e520b2295af4508e338fb7afd3976229cca63dbb66bef099f93d19e', 1, 1, 'Artist', '[]', 0, '2021-02-23 16:02:24', '2021-02-23 16:02:24', '2022-02-23 08:02:24'),
('ae981f25fcfced139b0fa3c71070f23fe93e209d31419c66a7adc338d7e661805ed2ab318c8667dc', 1, 1, 'Artist', '[]', 0, '2021-03-10 17:31:09', '2021-03-10 17:31:09', '2022-03-10 09:31:09'),
('b570c9606f02531cfe126bcafdfa94631a2683e83d2737f89d45febd93e9a06f03ee3a1cc84fe61e', 1, 1, 'Artist', '[]', 0, '2021-03-09 13:32:27', '2021-03-09 13:32:27', '2022-03-09 05:32:27'),
('b5c19e8c13821b655da653dcbd1aad800942820d29c265f48d5ee4806704336544e2a4379475c42e', 1, 1, 'authToken', '[]', 0, '2021-02-03 15:10:20', '2021-02-03 15:10:20', '2022-02-03 07:10:20'),
('d026f6dad226a220e8e479cff37d29185536eb21c9439f63ca052b3c370cbdf0d869c39c2b991d03', 2, 1, 'authToken', '[]', 0, '2021-03-05 19:13:18', '2021-03-05 19:13:18', '2022-03-05 11:13:18'),
('d3c6b6eb9c8c0a3134500c1e1fe8346192cbe32249f25ec1a9669c2d3ac2726125785d80a6fb70c8', 1, 1, 'Artist', '[]', 0, '2021-03-09 13:33:24', '2021-03-09 13:33:24', '2022-03-09 05:33:24'),
('d7c23c82a159688da3f09d14456832dd9672793f8328db8845a1ffba4079809e1760c2813763ac58', 1, 1, 'Artist', '[]', 0, '2021-02-03 15:21:59', '2021-02-03 15:21:59', '2022-02-03 07:21:59'),
('f1899eff44ca524f0d122e88279be3c79a5ba96aaff006c833c0ad0516a8ce0ff876bc1424cc79b4', 1, 1, 'Artist', '[]', 0, '2021-02-08 19:10:19', '2021-02-08 19:10:19', '2022-02-08 11:10:19'),
('f5242dec0b779610c58e121ae8eca27822d746e1bf183af42b65ae472caa2509b393bc70218c75e6', 1, 1, 'Artist', '[]', 0, '2021-03-10 17:33:21', '2021-03-10 17:33:21', '2022-03-10 09:33:21'),
('f82fe7c509b6041f6ec9719e99cf8a59d313ea081f201696f3cb66640b565aa0dda326682cb744ed', 1, 1, 'Artist', '[]', 0, '2021-03-10 17:32:10', '2021-03-10 17:32:10', '2022-03-10 09:32:10'),
('fb3d2da5a8b2c2040ce0c1ddb42320fdadd2ea1eac81b95c1e719c0475155f44587f1ae2ccc66826', 15, 1, 'User', '[]', 0, '2021-02-18 14:48:48', '2021-02-18 14:48:48', '2022-02-18 06:48:48');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Admin Panel Personal Access Client', 'x6TlTXJpzdp9EDAMIieNqKOvPJ63hgT2qZyiDpmH', 'http://localhost', 1, 0, 0, '2021-01-19 18:06:12', '2021-01-19 18:06:12'),
(2, NULL, 'Admin Panel Password Grant Client', 'WNiCxykZKxK7TrRGRIaVssEFGouvdnJSmdh8hZ5o', 'http://localhost', 0, 1, 0, '2021-01-19 18:06:12', '2021-01-19 18:06:12');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2021-01-19 18:06:12', '2021-01-19 18:06:12');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('myitupdate@gmail.com', '$2y$10$lYmb.tIxesswtkfzd85GI.1cRjj/PVjXEhNqJ1mw56r8l89vQ1aGy', '2019-12-18 01:58:46');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 1,
  `artist_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`name`, `value`, `created_at`, `updated_at`) VALUES
('site_title', 'WEBEXERT', '2019-12-17 13:38:37', '2019-12-17 13:38:37'),
('meta_keywords', 'WEBEXERT', '2019-12-17 13:38:37', '2019-12-17 13:38:37'),
('meta_desc', 'WEBEXERT', '2019-12-17 13:38:37', '2019-12-17 13:38:37'),
('favicon', '52244224admin-logo-dark.png', '2019-12-17 13:38:37', '2019-12-17 13:38:37'),
('logo', '880540736logo-4.png', '2019-12-17 13:38:37', '2019-12-17 13:38:37'),
('admin_logo', '1906437243admin-text-dark.png', '2019-12-17 13:38:37', '2019-12-17 13:38:37'),
('email', NULL, '2019-12-17 13:38:37', '2019-12-17 13:38:37'),
('facebook', NULL, '2019-12-17 13:38:37', '2019-12-17 13:38:37'),
('instagram', NULL, '2019-12-17 13:38:37', '2019-12-17 13:38:37'),
('twitter', NULL, '2019-12-17 13:38:37', '2019-12-17 13:38:37'),
('copy_right', 'WEBEXERT.COM', '2019-12-17 13:38:37', '2019-12-17 13:38:37'),
('auth_page_heading', 'ADMIN PORTAL OF 2019', '2019-12-17 13:38:37', '2019-12-17 13:38:37'),
('auth_page_desc', 'with this admin you can get 2000+ pages, 500+ ui component, 2000+ icons, different demos and many more...', '2019-12-17 13:38:37', '2019-12-17 13:38:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 1,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` int(11) DEFAULT 1,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fb_token` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `active`, `email_verified_at`, `password`, `gender`, `phone`, `fb_token`, `remember_token`, `created_at`, `updated_at`, `image`) VALUES
(1, 'John Smit', 'user@domain.com', 1, NULL, '$2y$10$38qt0zg.gB89W9urF2XDHe2hagAj8K7CgS0/sCSjBU/w/A4YTg/Je', 1, NULL, NULL, 'VFhwiGlDTnE3ndcQiSQ9RUg0XeIyAP8UGPeY9xgzeFw5t4aMwGmVjLD44oYJ', '2019-12-17 01:45:10', '2019-12-19 04:51:12', NULL),
(2, 'User', 'admin@domain.com', 0, NULL, '$2y$10$19s.t4YLbcZftvQqEZxIre7SBd/YYGE2xb/diT5yJBWYGGeI56na.', 1, NULL, NULL, NULL, '2019-12-17 01:45:10', '2019-12-17 01:45:10', NULL),
(3, 'wdd', 'myitupdate@gmail.com', 1, NULL, '$2y$10$yKHhaLglsfX67pe1Y03sUOw7tSZwavs5DqrsalOVLCDBpWZKFVoe2', 1, NULL, NULL, NULL, '2019-12-17 13:12:02', '2019-12-17 13:12:02', NULL),
(5, 'User', 'aadmin@domain.com', 0, NULL, '$2y$10$19s.t4YLbcZftvQqEZxIre7SBd/YYGE2xb/diT5yJBWYGGeI56na.', 1, NULL, NULL, NULL, '2019-12-17 01:45:10', '2019-12-17 01:45:10', NULL),
(8, 'User', 'baadmin@domain.com', 1, NULL, '$2y$10$19s.t4YLbcZftvQqEZxIre7SBd/YYGE2xb/diT5yJBWYGGeI56na.', 1, NULL, NULL, NULL, '2019-12-17 01:45:10', '2019-12-17 01:45:10', NULL),
(9, 'demo5', 'bamyitupdate@gmail.com', 1, NULL, '$2y$10$yKHhaLglsfX67pe1Y03sUOw7tSZwavs5DqrsalOVLCDBpWZKFVoe2', 1, NULL, NULL, NULL, '2019-12-17 13:12:02', '2019-12-17 13:12:02', NULL),
(11, 'User', 'dbaadmin@domain.com', 0, NULL, '$2y$10$19s.t4YLbcZftvQqEZxIre7SBd/YYGE2xb/diT5yJBWYGGeI56na.', 1, NULL, NULL, NULL, '2019-12-17 01:45:10', '2019-12-17 01:45:10', NULL),
(12, 'demo6', 'dbamyitupdate@gmail.com', 1, NULL, '$2y$10$yKHhaLglsfX67pe1Y03sUOw7tSZwavs5DqrsalOVLCDBpWZKFVoe2', 1, NULL, NULL, NULL, '2019-12-17 13:12:02', '2019-12-17 13:12:02', NULL),
(13, 'Jacob', 'jacob@gmail.com', 1, NULL, '$2y$10$Pm9z0/bAiYzN8k8wnxOhgOAWLfAADfUJS.4OyEyVdJyOdAtR7DgW.', 1, NULL, NULL, NULL, '2019-12-18 01:26:42', '2019-12-18 01:57:48', NULL),
(14, 'test', 'test@gmail.com', 1, NULL, '$2y$10$D9EqeLWcRPWGhJQPqdrJU.jkPfA0kNtxU9dmOBJ7XvAlYDOP5h9kK', 1, NULL, NULL, NULL, '2021-01-20 15:30:46', '2021-01-20 15:30:46', NULL),
(15, 'abc', 'abc@gmail.com', 1, NULL, '$2y$10$40Yg2Dw7oVLPSnB6TdQX7e99Jiv7sgLulj.b/8P6OGUFgfdvldab2', 1, NULL, NULL, NULL, '2021-02-18 14:42:05', '2021-02-18 14:42:05', NULL),
(16, 'abc', 'abc1@gmail.com', 1, NULL, '$2y$10$PBWEdq8/O1QnB7/6qUBbEukwfX075MFWG1VVB1UeNPudUQPxieKXG', 1, NULL, NULL, NULL, '2021-03-05 19:15:43', '2021-03-05 19:15:43', '786427341139596428_445633953228184_8957330813370154198_n.jpg'),
(17, 'test', 'test12@gmail.com', 1, NULL, '$2y$10$J.ZPvlsxmqU3ljud8XuSOeQMdaSya3HclWa5exME23TPuVmot3SIu', 0, '2413412444', NULL, NULL, '2021-03-10 12:20:33', '2021-03-10 12:33:57', '1681183027a2b.png');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `composer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` bigint(20) DEFAULT NULL,
  `artist_id` bigint(20) UNSIGNED DEFAULT NULL,
  `album_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`),
  ADD KEY `albums_artist_id_foreign` (`artist_id`);

--
-- Indexes for table `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `artists_email_unique` (`email`);

--
-- Indexes for table `artist_subscribes`
--
ALTER TABLE `artist_subscribes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `artist_subscribes_artist_id_foreign` (`artist_id`),
  ADD KEY `artist_subscribes_user_id_foreign` (`user_id`);

--
-- Indexes for table `audio`
--
ALTER TABLE `audio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `audio_album_id_foreign` (`album_id`),
  ADD KEY `audio_artist_id_foreign` (`artist_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `events_artist_id_foreign` (`artist_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faverate_events`
--
ALTER TABLE `faverate_events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `faverate_events_user_id_foreign` (`user_id`),
  ADD KEY `faverate_events_event_id_foreign` (`event_id`);

--
-- Indexes for table `favrate_audio`
--
ALTER TABLE `favrate_audio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `favrate_audio_user_id_foreign` (`user_id`),
  ADD KEY `favrate_audio_audio_id_foreign` (`audio_id`);

--
-- Indexes for table `favrate_videos`
--
ALTER TABLE `favrate_videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `favrate_videos_user_id_foreign` (`user_id`),
  ADD KEY `favrate_videos_video_id_foreign` (`video_id`);

--
-- Indexes for table `firebase_notifications`
--
ALTER TABLE `firebase_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `images_artist_id_foreign` (`artist_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message_user`
--
ALTER TABLE `message_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_message_user_messages` (`message_id`),
  ADD KEY `FK_message_user_users` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rooms_artist_id_foreign` (`artist_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `videos_artist_id_foreign` (`artist_id`),
  ADD KEY `videos_album_id_foreign` (`album_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `artists`
--
ALTER TABLE `artists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `artist_subscribes`
--
ALTER TABLE `artist_subscribes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `audio`
--
ALTER TABLE `audio`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faverate_events`
--
ALTER TABLE `faverate_events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favrate_audio`
--
ALTER TABLE `favrate_audio`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `favrate_videos`
--
ALTER TABLE `favrate_videos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `firebase_notifications`
--
ALTER TABLE `firebase_notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `message_user`
--
ALTER TABLE `message_user`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `albums`
--
ALTER TABLE `albums`
  ADD CONSTRAINT `albums_artist_id_foreign` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`id`);

--
-- Constraints for table `artist_subscribes`
--
ALTER TABLE `artist_subscribes`
  ADD CONSTRAINT `artist_subscribes_artist_id_foreign` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`id`),
  ADD CONSTRAINT `artist_subscribes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `audio`
--
ALTER TABLE `audio`
  ADD CONSTRAINT `audio_album_id_foreign` FOREIGN KEY (`album_id`) REFERENCES `albums` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `audio_artist_id_foreign` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_artist_id_foreign` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`id`);

--
-- Constraints for table `faverate_events`
--
ALTER TABLE `faverate_events`
  ADD CONSTRAINT `faverate_events_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`),
  ADD CONSTRAINT `faverate_events_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `favrate_audio`
--
ALTER TABLE `favrate_audio`
  ADD CONSTRAINT `favrate_audio_audio_id_foreign` FOREIGN KEY (`audio_id`) REFERENCES `audio` (`id`),
  ADD CONSTRAINT `favrate_audio_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `favrate_videos`
--
ALTER TABLE `favrate_videos`
  ADD CONSTRAINT `favrate_videos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `favrate_videos_video_id_foreign` FOREIGN KEY (`video_id`) REFERENCES `videos` (`id`);

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_artist_id_foreign` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`id`);

--
-- Constraints for table `message_user`
--
ALTER TABLE `message_user`
  ADD CONSTRAINT `FK_message_user_messages` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_message_user_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_artist_id_foreign` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`id`);

--
-- Constraints for table `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `videos_album_id_foreign` FOREIGN KEY (`album_id`) REFERENCES `albums` (`id`),
  ADD CONSTRAINT `videos_artist_id_foreign` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
