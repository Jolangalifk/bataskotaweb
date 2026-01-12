-- Database Backup for bataskota
-- Generated: 2026-01-12 11:24:00
-- Laravel Project: BatasKota Coffee

DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('owner','kasir') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'kasir',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES ('1', 'Owner BatasKota', 'owner@bataskota.com', '$2y$12$QVew5a9CLG5YJ/qkUsuxie9IrmTkSi3WUJzPGdrU/oKSZf3nhOVrG', 'owner', NULL, '2025-12-31 09:34:06', '2025-12-31 09:34:06');
INSERT INTO `admins` (`id`, `name`, `email`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES ('2', 'Kasir BatasKota', 'kasir@bataskota.com', '$2y$12$Pje0QVQdseNuq1kDlMl6x.0bcbbI0vJU3E53Lk/sXw6XgjTYafNHG', 'kasir', NULL, '2025-12-31 09:34:06', '2025-12-31 09:34:06');

DROP TABLE IF EXISTS `cart_items`;
CREATE TABLE `cart_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `cart_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `strength` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shot` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extra_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `quantity` int NOT NULL DEFAULT '1',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cart_items_cart_id_foreign` (`cart_id`),
  KEY `cart_items_product_id_foreign` (`product_id`),
  CONSTRAINT `cart_items_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `cart_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `cart_items` (`id`, `cart_id`, `product_id`, `strength`, `size`, `shot`, `extra_price`, `quantity`, `notes`, `created_at`, `updated_at`) VALUES ('1', '1', '1', NULL, 'Small', '2 Shot', '2000.00', '1', NULL, '2025-12-31 09:36:13', '2025-12-31 09:36:13');
INSERT INTO `cart_items` (`id`, `cart_id`, `product_id`, `strength`, `size`, `shot`, `extra_price`, `quantity`, `notes`, `created_at`, `updated_at`) VALUES ('2', '2', '2', 'Strong', 'Medium', NULL, '4000.00', '1', NULL, '2025-12-31 14:07:53', '2025-12-31 14:20:39');
INSERT INTO `cart_items` (`id`, `cart_id`, `product_id`, `strength`, `size`, `shot`, `extra_price`, `quantity`, `notes`, `created_at`, `updated_at`) VALUES ('3', '2', '3', NULL, 'Medium', NULL, '2000.00', '1', 'kurangi es', '2025-12-31 15:51:23', '2025-12-31 15:51:23');
INSERT INTO `cart_items` (`id`, `cart_id`, `product_id`, `strength`, `size`, `shot`, `extra_price`, `quantity`, `notes`, `created_at`, `updated_at`) VALUES ('4', '3', '3', NULL, 'Medium', NULL, '2000.00', '1', 'kurangi es nya ya kak', '2025-12-31 15:56:46', '2025-12-31 15:56:46');
INSERT INTO `cart_items` (`id`, `cart_id`, `product_id`, `strength`, `size`, `shot`, `extra_price`, `quantity`, `notes`, `created_at`, `updated_at`) VALUES ('5', '4', '7', NULL, 'Medium', NULL, '2000.00', '1', NULL, '2025-12-31 16:07:40', '2025-12-31 16:07:40');
INSERT INTO `cart_items` (`id`, `cart_id`, `product_id`, `strength`, `size`, `shot`, `extra_price`, `quantity`, `notes`, `created_at`, `updated_at`) VALUES ('6', '5', '4', NULL, 'Medium', NULL, '2000.00', '1', NULL, '2025-12-31 16:47:59', '2025-12-31 16:47:59');
INSERT INTO `cart_items` (`id`, `cart_id`, `product_id`, `strength`, `size`, `shot`, `extra_price`, `quantity`, `notes`, `created_at`, `updated_at`) VALUES ('8', '5', '2', 'Strong', 'Medium', NULL, '4000.00', '1', NULL, '2026-01-09 08:14:43', '2026-01-09 08:14:43');
INSERT INTO `cart_items` (`id`, `cart_id`, `product_id`, `strength`, `size`, `shot`, `extra_price`, `quantity`, `notes`, `created_at`, `updated_at`) VALUES ('10', '5', '12', NULL, 'Small', NULL, '0.00', '1', NULL, '2026-01-09 08:15:50', '2026-01-09 08:15:50');
INSERT INTO `cart_items` (`id`, `cart_id`, `product_id`, `strength`, `size`, `shot`, `extra_price`, `quantity`, `notes`, `created_at`, `updated_at`) VALUES ('11', '6', '5', NULL, 'Medium', NULL, '2000.00', '1', NULL, '2026-01-09 08:33:40', '2026-01-09 08:33:40');
INSERT INTO `cart_items` (`id`, `cart_id`, `product_id`, `strength`, `size`, `shot`, `extra_price`, `quantity`, `notes`, `created_at`, `updated_at`) VALUES ('12', '6', '4', NULL, 'Small', NULL, '0.00', '1', NULL, '2026-01-09 08:33:50', '2026-01-09 08:33:50');
INSERT INTO `cart_items` (`id`, `cart_id`, `product_id`, `strength`, `size`, `shot`, `extra_price`, `quantity`, `notes`, `created_at`, `updated_at`) VALUES ('15', '7', '1', NULL, 'Small', '1 Shot', '0.00', '1', NULL, '2026-01-09 11:15:04', '2026-01-09 11:15:04');
INSERT INTO `cart_items` (`id`, `cart_id`, `product_id`, `strength`, `size`, `shot`, `extra_price`, `quantity`, `notes`, `created_at`, `updated_at`) VALUES ('16', '7', '1', NULL, 'Medium', '1 Shot', '2000.00', '1', NULL, '2026-01-09 11:15:18', '2026-01-09 11:15:18');
INSERT INTO `cart_items` (`id`, `cart_id`, `product_id`, `strength`, `size`, `shot`, `extra_price`, `quantity`, `notes`, `created_at`, `updated_at`) VALUES ('17', '8', '1', NULL, 'Small', '1 Shot', '0.00', '1', NULL, '2026-01-09 11:24:21', '2026-01-09 11:24:21');

DROP TABLE IF EXISTS `carts`;
CREATE TABLE `carts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `status` enum('active','checked_out') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `carts_user_id_foreign` (`user_id`),
  CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `carts` (`id`, `user_id`, `status`, `created_at`, `updated_at`) VALUES ('1', '1', 'checked_out', '2025-12-31 09:36:13', '2025-12-31 09:36:33');
INSERT INTO `carts` (`id`, `user_id`, `status`, `created_at`, `updated_at`) VALUES ('2', '1', 'checked_out', '2025-12-31 14:07:53', '2025-12-31 15:52:10');
INSERT INTO `carts` (`id`, `user_id`, `status`, `created_at`, `updated_at`) VALUES ('3', '1', 'checked_out', '2025-12-31 15:56:46', '2025-12-31 15:57:57');
INSERT INTO `carts` (`id`, `user_id`, `status`, `created_at`, `updated_at`) VALUES ('4', '1', 'checked_out', '2025-12-31 16:07:40', '2025-12-31 16:10:32');
INSERT INTO `carts` (`id`, `user_id`, `status`, `created_at`, `updated_at`) VALUES ('5', '2', 'checked_out', '2025-12-31 16:47:59', '2026-01-09 08:31:36');
INSERT INTO `carts` (`id`, `user_id`, `status`, `created_at`, `updated_at`) VALUES ('6', '2', 'checked_out', '2026-01-09 08:33:40', '2026-01-09 08:40:57');
INSERT INTO `carts` (`id`, `user_id`, `status`, `created_at`, `updated_at`) VALUES ('7', '2', 'checked_out', '2026-01-09 09:26:37', '2026-01-09 11:16:06');
INSERT INTO `carts` (`id`, `user_id`, `status`, `created_at`, `updated_at`) VALUES ('8', '2', 'active', '2026-01-09 11:24:21', '2026-01-09 11:24:21');

DROP TABLE IF EXISTS `company_profiles`;
CREATE TABLE `company_profiles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `address` text COLLATE utf8mb4_unicode_ci,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `open_time` time DEFAULT NULL,
  `close_time` time DEFAULT NULL,
  `is_open` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `company_profiles` (`id`, `name`, `description`, `address`, `phone`, `email`, `instagram`, `whatsapp`, `open_time`, `close_time`, `is_open`, `created_at`, `updated_at`) VALUES ('1', 'BatasKota Coffee', 'Kedai kopi lokal dengan cita rasa premium. Kami menyajikan kopi berkualitas dengan harga terjangkau untuk menemani aktivitas harianmu.', 'Yomani, Yamansari, Kec. Lebaksiu, Kabupaten Tegal, Jawa Tengah 52461', '08123456789', 'hello@bataskota.coffee', '@bataskotacoffee', '628123456789', '07:00:00', '22:00:00', '0', '2025-12-31 09:34:06', '2026-01-09 11:23:55');

DROP TABLE IF EXISTS `expenses`;
CREATE TABLE `expenses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'other',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `expense_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `expenses` (`id`, `category`, `description`, `amount`, `expense_date`, `created_at`, `updated_at`) VALUES ('1', 'stock', 'Pembelian Biji Kopi Arabica (3000 gram)', '450000.00', '2025-12-31', '2025-12-31 09:35:09', '2025-12-31 09:35:09');
INSERT INTO `expenses` (`id`, `category`, `description`, `amount`, `expense_date`, `created_at`, `updated_at`) VALUES ('2', 'stock', 'Pembelian Biji Kopi Robusta (4000 gram)', '600000.00', '2025-12-31', '2025-12-31 16:20:48', '2025-12-31 16:20:48');
INSERT INTO `expenses` (`id`, `category`, `description`, `amount`, `expense_date`, `created_at`, `updated_at`) VALUES ('3', 'stock', 'Pembelian Biji Kopi Arabica (2000 gram)', '600000.00', '2026-01-09', '2026-01-09 08:42:42', '2026-01-09 08:42:42');
INSERT INTO `expenses` (`id`, `category`, `description`, `amount`, `expense_date`, `created_at`, `updated_at`) VALUES ('4', 'stock', 'Pembelian Gula Aren (1000 gram)', '20000.00', '2026-01-09', '2026-01-09 11:23:10', '2026-01-09 11:23:10');

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('1', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('2', '2014_10_12_100000_create_password_reset_tokens_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('3', '2019_08_19_000000_create_failed_jobs_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('4', '2019_12_14_000001_create_personal_access_tokens_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('5', '2025_12_30_140001_create_admins_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('6', '2025_12_30_140002_create_products_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('7', '2025_12_30_140003_create_product_variants_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('8', '2025_12_30_140004_create_carts_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('9', '2025_12_30_140005_create_cart_items_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('10', '2025_12_30_140006_create_orders_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('11', '2025_12_30_140007_create_order_items_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('12', '2025_12_30_140008_create_payments_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('13', '2025_12_30_140009_create_stocks_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('14', '2025_12_30_140010_create_stock_histories_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('15', '2025_12_30_140011_create_expenses_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('16', '2025_12_30_140012_create_company_profiles_table', '1');

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE `order_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `strength` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shot` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `extra_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `subtotal` decimal(10,2) NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_items_order_id_foreign` (`order_id`),
  KEY `order_items_product_id_foreign` (`product_id`),
  CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_name`, `strength`, `size`, `shot`, `quantity`, `price`, `extra_price`, `subtotal`, `notes`, `created_at`, `updated_at`) VALUES ('1', '1', '1', 'Americano', NULL, 'Small', '2 Shot', '1', '4500.00', '2000.00', '6500.00', NULL, '2025-12-31 09:36:33', '2025-12-31 09:36:33');
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_name`, `strength`, `size`, `shot`, `quantity`, `price`, `extra_price`, `subtotal`, `notes`, `created_at`, `updated_at`) VALUES ('2', '2', '2', 'Kopi Susu Batas Kota', 'Strong', 'Medium', NULL, '1', '8000.00', '4000.00', '12000.00', NULL, '2025-12-31 15:52:10', '2025-12-31 15:52:10');
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_name`, `strength`, `size`, `shot`, `quantity`, `price`, `extra_price`, `subtotal`, `notes`, `created_at`, `updated_at`) VALUES ('3', '2', '3', 'Kopi Susu Gula Aren', NULL, 'Medium', NULL, '1', '12000.00', '2000.00', '14000.00', 'kurangi es', '2025-12-31 15:52:10', '2025-12-31 15:52:10');
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_name`, `strength`, `size`, `shot`, `quantity`, `price`, `extra_price`, `subtotal`, `notes`, `created_at`, `updated_at`) VALUES ('4', '3', '3', 'Kopi Susu Gula Aren', NULL, 'Medium', NULL, '1', '12000.00', '2000.00', '14000.00', 'kurangi es nya ya kak', '2025-12-31 15:57:57', '2025-12-31 15:57:57');
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_name`, `strength`, `size`, `shot`, `quantity`, `price`, `extra_price`, `subtotal`, `notes`, `created_at`, `updated_at`) VALUES ('5', '4', '7', 'Kopi Susu Hazelnut', NULL, 'Medium', NULL, '1', '12000.00', '2000.00', '14000.00', NULL, '2025-12-31 16:10:32', '2025-12-31 16:10:32');
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_name`, `strength`, `size`, `shot`, `quantity`, `price`, `extra_price`, `subtotal`, `notes`, `created_at`, `updated_at`) VALUES ('6', '5', '4', 'Kopi Susu Vanilla', NULL, 'Medium', NULL, '1', '11000.00', '2000.00', '13000.00', NULL, '2026-01-09 08:31:36', '2026-01-09 08:31:36');
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_name`, `strength`, `size`, `shot`, `quantity`, `price`, `extra_price`, `subtotal`, `notes`, `created_at`, `updated_at`) VALUES ('7', '5', '2', 'Kopi Susu Batas Kota', 'Strong', 'Medium', NULL, '1', '8000.00', '4000.00', '12000.00', NULL, '2026-01-09 08:31:36', '2026-01-09 08:31:36');
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_name`, `strength`, `size`, `shot`, `quantity`, `price`, `extra_price`, `subtotal`, `notes`, `created_at`, `updated_at`) VALUES ('8', '5', '12', 'Red Velvet', NULL, 'Small', NULL, '1', '10000.00', '0.00', '10000.00', NULL, '2026-01-09 08:31:36', '2026-01-09 08:31:36');
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_name`, `strength`, `size`, `shot`, `quantity`, `price`, `extra_price`, `subtotal`, `notes`, `created_at`, `updated_at`) VALUES ('9', '6', '5', 'Kopi Susu Caramel', NULL, 'Medium', NULL, '1', '12000.00', '2000.00', '14000.00', NULL, '2026-01-09 08:40:57', '2026-01-09 08:40:57');
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_name`, `strength`, `size`, `shot`, `quantity`, `price`, `extra_price`, `subtotal`, `notes`, `created_at`, `updated_at`) VALUES ('10', '6', '4', 'Kopi Susu Vanilla', NULL, 'Small', NULL, '1', '11000.00', '0.00', '11000.00', NULL, '2026-01-09 08:40:57', '2026-01-09 08:40:57');
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_name`, `strength`, `size`, `shot`, `quantity`, `price`, `extra_price`, `subtotal`, `notes`, `created_at`, `updated_at`) VALUES ('11', '7', '1', 'Americano', NULL, 'Small', '1 Shot', '1', '5000.00', '0.00', '5000.00', NULL, '2026-01-09 11:16:06', '2026-01-09 11:16:06');
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_name`, `strength`, `size`, `shot`, `quantity`, `price`, `extra_price`, `subtotal`, `notes`, `created_at`, `updated_at`) VALUES ('12', '7', '1', 'Americano', NULL, 'Medium', '1 Shot', '1', '5000.00', '2000.00', '7000.00', NULL, '2026-01-09 11:16:06', '2026-01-09 11:16:06');

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `order_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'qris',
  `total_price` decimal(10,2) NOT NULL,
  `status` enum('pending','paid','process','ready','done','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orders_order_number_unique` (`order_number`),
  KEY `orders_user_id_foreign` (`user_id`),
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `orders` (`id`, `user_id`, `order_number`, `customer_name`, `customer_phone`, `notes`, `payment_method`, `total_price`, `status`, `created_at`, `updated_at`) VALUES ('1', '1', 'BK202512310001', 'nasihuy', '081234567890', NULL, 'qris', '6500.00', 'done', '2025-12-31 09:36:33', '2025-12-31 09:37:01');
INSERT INTO `orders` (`id`, `user_id`, `order_number`, `customer_name`, `customer_phone`, `notes`, `payment_method`, `total_price`, `status`, `created_at`, `updated_at`) VALUES ('2', '1', 'BK202512310002', 'nasihuybigmo', '081234567890', NULL, 'qris', '26000.00', 'done', '2025-12-31 15:52:10', '2025-12-31 16:03:23');
INSERT INTO `orders` (`id`, `user_id`, `order_number`, `customer_name`, `customer_phone`, `notes`, `payment_method`, `total_price`, `status`, `created_at`, `updated_at`) VALUES ('3', '1', 'BK202512310003', 'nasihuybigmo', '081234567890', NULL, 'qris', '14000.00', 'done', '2025-12-31 15:57:57', '2025-12-31 16:03:08');
INSERT INTO `orders` (`id`, `user_id`, `order_number`, `customer_name`, `customer_phone`, `notes`, `payment_method`, `total_price`, `status`, `created_at`, `updated_at`) VALUES ('4', '1', 'BK202512310004', 'nasihuyyy', '081234567811', 'es nya dikit aja ya', 'qris', '14000.00', 'done', '2025-12-31 16:10:32', '2025-12-31 16:19:52');
INSERT INTO `orders` (`id`, `user_id`, `order_number`, `customer_name`, `customer_phone`, `notes`, `payment_method`, `total_price`, `status`, `created_at`, `updated_at`) VALUES ('5', '2', 'BK202601090001', 'bigmo', '0882006787460', 'es nya dikit aja ya', 'qris', '35000.00', 'done', '2026-01-09 08:31:36', '2026-01-09 08:32:57');
INSERT INTO `orders` (`id`, `user_id`, `order_number`, `customer_name`, `customer_phone`, `notes`, `payment_method`, `total_price`, `status`, `created_at`, `updated_at`) VALUES ('6', '2', 'BK202601090002', 'bigmo', '0882006787460', NULL, 'qris', '25000.00', 'done', '2026-01-09 08:40:57', '2026-01-09 08:41:20');
INSERT INTO `orders` (`id`, `user_id`, `order_number`, `customer_name`, `customer_phone`, `notes`, `payment_method`, `total_price`, `status`, `created_at`, `updated_at`) VALUES ('7', '2', 'BK202601090003', 'bigmo', '0882006787460', NULL, 'qris', '12000.00', 'done', '2026-01-09 11:16:06', '2026-01-09 11:21:01');

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint unsigned NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` enum('pending','success','failed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payments_order_id_foreign` (`order_id`),
  CONSTRAINT `payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `payments` (`id`, `order_id`, `payment_method`, `payment_status`, `transaction_id`, `created_at`, `updated_at`) VALUES ('1', '1', 'qris', 'success', 'TXN-69548C3EF262E', '2025-12-31 09:36:46', '2025-12-31 09:36:46');
INSERT INTO `payments` (`id`, `order_id`, `payment_method`, `payment_status`, `transaction_id`, `created_at`, `updated_at`) VALUES ('2', '2', 'qris', 'success', 'TXN-6954E5DC60A63', '2025-12-31 15:59:08', '2025-12-31 15:59:08');
INSERT INTO `payments` (`id`, `order_id`, `payment_method`, `payment_status`, `transaction_id`, `created_at`, `updated_at`) VALUES ('3', '4', 'qris', 'success', 'TXN-6954E8C246562', '2025-12-31 16:11:30', '2025-12-31 16:11:30');
INSERT INTO `payments` (`id`, `order_id`, `payment_method`, `payment_status`, `transaction_id`, `created_at`, `updated_at`) VALUES ('4', '5', 'qris', 'success', 'TXN-69605A8C9D3A7', '2026-01-09 08:31:56', '2026-01-09 08:31:56');
INSERT INTO `payments` (`id`, `order_id`, `payment_method`, `payment_status`, `transaction_id`, `created_at`, `updated_at`) VALUES ('5', '6', 'qris', 'success', 'TXN-69605CB258EB4', '2026-01-09 08:41:06', '2026-01-09 08:41:06');
INSERT INTO `payments` (`id`, `order_id`, `payment_method`, `payment_status`, `transaction_id`, `created_at`, `updated_at`) VALUES ('6', '7', 'qris', 'success', 'TXN-696081B0E6FE3', '2026-01-09 11:18:56', '2026-01-09 11:18:56');

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `product_variants`;
CREATE TABLE `product_variants` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `extra_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `product_variants` (`id`, `type`, `name`, `extra_price`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES ('1', 'strength', 'Normal', '0.00', '1', '1', '2025-12-31 09:34:06', '2025-12-31 09:34:06');
INSERT INTO `product_variants` (`id`, `type`, `name`, `extra_price`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES ('2', 'strength', 'Strong', '2000.00', '2', '1', '2025-12-31 09:34:06', '2025-12-31 09:34:06');
INSERT INTO `product_variants` (`id`, `type`, `name`, `extra_price`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES ('3', 'size', 'Small', '0.00', '1', '1', '2025-12-31 09:34:06', '2025-12-31 09:34:06');
INSERT INTO `product_variants` (`id`, `type`, `name`, `extra_price`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES ('4', 'size', 'Medium', '2000.00', '2', '1', '2025-12-31 09:34:06', '2025-12-31 09:34:06');
INSERT INTO `product_variants` (`id`, `type`, `name`, `extra_price`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES ('5', 'size', 'Large', '4000.00', '3', '1', '2025-12-31 09:34:06', '2025-12-31 09:34:06');
INSERT INTO `product_variants` (`id`, `type`, `name`, `extra_price`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES ('6', 'shot', '1 Shot', '0.00', '1', '1', '2025-12-31 09:34:06', '2025-12-31 09:34:06');
INSERT INTO `product_variants` (`id`, `type`, `name`, `extra_price`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES ('7', 'shot', '2 Shot', '2000.00', '2', '1', '2025-12-31 09:34:06', '2025-12-31 09:34:06');
INSERT INTO `product_variants` (`id`, `type`, `name`, `extra_price`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES ('8', 'shot', '3 Shot', '3500.00', '3', '1', '2025-12-31 09:34:06', '2025-12-31 09:34:06');

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'coffee',
  `price` decimal(10,2) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `has_strength` tinyint(1) NOT NULL DEFAULT '0',
  `has_size` tinyint(1) NOT NULL DEFAULT '0',
  `has_shot` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `products` (`id`, `name`, `category`, `price`, `description`, `image`, `is_active`, `has_strength`, `has_size`, `has_shot`, `created_at`, `updated_at`) VALUES ('1', 'Americano', 'coffee', '5000.00', 'Kopi hitam dengan rasa smooth dan aroma lembut. Tersedia pilihan 1–3 shot espresso.', 'products/fndrkUFLg063NhNN6fAjrRNmbvFbOWikuxAmh1R3.png', '1', '0', '1', '1', '2025-12-31 09:34:06', '2025-12-31 16:16:11');
INSERT INTO `products` (`id`, `name`, `category`, `price`, `description`, `image`, `is_active`, `has_strength`, `has_size`, `has_shot`, `created_at`, `updated_at`) VALUES ('2', 'Kopi Susu Batas Kota', 'coffee', '8000.00', 'Perpaduan kopi dan susu yang creamy dan seimbang. Pilihan Normal atau Strong.', 'products/TMxa4GOui2zZZXnsOe9FWlKG7UxIcmmueTRIAyQk.png', '1', '1', '1', '0', '2025-12-31 09:34:06', '2025-12-31 14:03:01');
INSERT INTO `products` (`id`, `name`, `category`, `price`, `description`, `image`, `is_active`, `has_strength`, `has_size`, `has_shot`, `created_at`, `updated_at`) VALUES ('3', 'Kopi Susu Gula Aren', 'coffee', '12000.00', 'Kopi susu dengan manis alami dari gula aren pilihan.', 'products/abw3ZQP5pNHXSdWilZIaDkdFyODbHj9KxCRENSrg.png', '1', '0', '1', '0', '2025-12-31 09:34:06', '2025-12-31 14:03:40');
INSERT INTO `products` (`id`, `name`, `category`, `price`, `description`, `image`, `is_active`, `has_strength`, `has_size`, `has_shot`, `created_at`, `updated_at`) VALUES ('4', 'Kopi Susu Vanilla', 'coffee', '11000.00', 'Kombinasi kopi susu dengan sentuhan vanilla yang wangi dan lembut.', 'products/29fWK7i7msjKL2bLuNzfno0weGZjpEb2hUGruPBN.png', '1', '0', '1', '0', '2025-12-31 09:34:06', '2025-12-31 14:04:00');
INSERT INTO `products` (`id`, `name`, `category`, `price`, `description`, `image`, `is_active`, `has_strength`, `has_size`, `has_shot`, `created_at`, `updated_at`) VALUES ('5', 'Kopi Susu Caramel', 'coffee', '12000.00', 'Perpaduan kopi, susu, dan caramel yang creamy dengan rasa manis yang pas.', 'products/LqTU8f0pzorjVBXzIkgSp6tpdUa9iM2v7yOPrzGC.png', '1', '0', '1', '0', '2025-12-31 09:34:06', '2025-12-31 14:03:24');
INSERT INTO `products` (`id`, `name`, `category`, `price`, `description`, `image`, `is_active`, `has_strength`, `has_size`, `has_shot`, `created_at`, `updated_at`) VALUES ('6', 'Kopi Susu Butterscotch', 'coffee', '12000.00', 'Rasa khas butterscotch yang creamy berpadu dengan kopi.', 'products/vW8A7gi9pLshBw4l7n9dRdukJhErpB8gZ1sFq6Vm.png', '1', '0', '1', '0', '2025-12-31 09:34:06', '2025-12-31 14:03:13');
INSERT INTO `products` (`id`, `name`, `category`, `price`, `description`, `image`, `is_active`, `has_strength`, `has_size`, `has_shot`, `created_at`, `updated_at`) VALUES ('7', 'Kopi Susu Hazelnut', 'coffee', '12000.00', 'Kopi susu dengan aroma kacang hazelnut yang harum dan khas.', 'products/pxXhGODzr54Es1F82AulWMGLuakJpJ4eUxXtFM21.png', '1', '0', '1', '0', '2025-12-31 09:34:06', '2025-12-31 14:03:50');
INSERT INTO `products` (`id`, `name`, `category`, `price`, `description`, `image`, `is_active`, `has_strength`, `has_size`, `has_shot`, `created_at`, `updated_at`) VALUES ('8', 'Lemon Tea', 'non-coffee', '5000.00', 'Perpaduan Teh dengan perasan lemon yang segar.', 'products/vpNpBD6oO103R9FajJCy4cEYR88OU9rGVwS1edY8.png', '0', '0', '1', '0', '2025-12-31 09:34:06', '2025-12-31 16:14:54');
INSERT INTO `products` (`id`, `name`, `category`, `price`, `description`, `image`, `is_active`, `has_strength`, `has_size`, `has_shot`, `created_at`, `updated_at`) VALUES ('9', 'Lemonade', 'non-coffee', '5000.00', 'Minuman lemon segar dengan rasa manis dan asam seimbang.', 'products/uTRn0WFpsS1kn06vjucvpkIQfI9NLCneW1AbSsDi.png', '1', '0', '1', '0', '2025-12-31 09:34:06', '2025-12-31 14:04:35');
INSERT INTO `products` (`id`, `name`, `category`, `price`, `description`, `image`, `is_active`, `has_strength`, `has_size`, `has_shot`, `created_at`, `updated_at`) VALUES ('11', 'Matcha', 'non-coffee', '10000.00', 'Minuman teh hijau matcha dengan rasa lembut dan creamy.', 'products/83CPQULmxiN4iIfSmjG7azLMbU3gWHaWDRtJpmEt.png', '1', '0', '1', '0', '2025-12-31 09:34:06', '2025-12-31 14:04:51');
INSERT INTO `products` (`id`, `name`, `category`, `price`, `description`, `image`, `is_active`, `has_strength`, `has_size`, `has_shot`, `created_at`, `updated_at`) VALUES ('12', 'Red Velvet', 'non-coffee', '10000.00', 'Minuman manis dengan rasa khas red velvet yang creamy.', 'products/hJ0o5wo6NcBskdXo1itQqOg9cNh811qDV69peQju.png', '1', '0', '1', '0', '2025-12-31 09:34:06', '2025-12-31 14:05:14');
INSERT INTO `products` (`id`, `name`, `category`, `price`, `description`, `image`, `is_active`, `has_strength`, `has_size`, `has_shot`, `created_at`, `updated_at`) VALUES ('13', 'Toast Chocolate', 'toast', '8000.00', 'Toast dengan isian cokelat leleh yang manis dan creamy.', NULL, '1', '0', '0', '0', '2025-12-31 09:34:06', '2025-12-31 09:34:06');
INSERT INTO `products` (`id`, `name`, `category`, `price`, `description`, `image`, `is_active`, `has_strength`, `has_size`, `has_shot`, `created_at`, `updated_at`) VALUES ('14', 'Toast Choco Crunchy', 'toast', '8000.00', 'Toast dengan perpaduan cokelat manis dan topping crunchy.', NULL, '1', '0', '0', '0', '2025-12-31 09:34:06', '2025-12-31 09:34:06');
INSERT INTO `products` (`id`, `name`, `category`, `price`, `description`, `image`, `is_active`, `has_strength`, `has_size`, `has_shot`, `created_at`, `updated_at`) VALUES ('15', 'Toast Tiramisu', 'toast', '8000.00', 'Toast dengan isian khas tiramisu.', NULL, '1', '0', '0', '0', '2025-12-31 09:34:06', '2025-12-31 09:34:06');
INSERT INTO `products` (`id`, `name`, `category`, `price`, `description`, `image`, `is_active`, `has_strength`, `has_size`, `has_shot`, `created_at`, `updated_at`) VALUES ('16', 'Toast Strawberry', 'toast', '8000.00', 'Toast dengan isian selai stroberi.', NULL, '1', '0', '0', '0', '2025-12-31 09:34:06', '2025-12-31 09:34:06');
INSERT INTO `products` (`id`, `name`, `category`, `price`, `description`, `image`, `is_active`, `has_strength`, `has_size`, `has_shot`, `created_at`, `updated_at`) VALUES ('17', 'Toast Blueberry', 'toast', '8000.00', 'Toast dengan isian selai blueberry.', NULL, '1', '0', '0', '0', '2025-12-31 09:34:06', '2025-12-31 09:34:06');
INSERT INTO `products` (`id`, `name`, `category`, `price`, `description`, `image`, `is_active`, `has_strength`, `has_size`, `has_shot`, `created_at`, `updated_at`) VALUES ('18', 'Toast Matcha', 'toast', '8000.00', 'Toast dengan isian selai matcha.', NULL, '1', '0', '0', '0', '2025-12-31 09:34:06', '2025-12-31 09:34:06');
INSERT INTO `products` (`id`, `name`, `category`, `price`, `description`, `image`, `is_active`, `has_strength`, `has_size`, `has_shot`, `created_at`, `updated_at`) VALUES ('19', 'Toast Beef BBQ', 'toast', '10000.00', 'Toast dengan isian daging sapi dan saus BBQ.', NULL, '1', '0', '0', '0', '2025-12-31 09:34:06', '2025-12-31 09:34:06');
INSERT INTO `products` (`id`, `name`, `category`, `price`, `description`, `image`, `is_active`, `has_strength`, `has_size`, `has_shot`, `created_at`, `updated_at`) VALUES ('20', 'Toast Beef and Cheese', 'toast', '12000.00', 'Toast dengan daging sapi dan keju leleh.', NULL, '1', '0', '0', '0', '2025-12-31 09:34:06', '2025-12-31 09:34:06');
INSERT INTO `products` (`id`, `name`, `category`, `price`, `description`, `image`, `is_active`, `has_strength`, `has_size`, `has_shot`, `created_at`, `updated_at`) VALUES ('21', 'Extra Toast', 'toast', '15000.00', 'Tambahan porsi roti.', NULL, '1', '0', '0', '0', '2025-12-31 09:34:06', '2025-12-31 09:34:06');
INSERT INTO `products` (`id`, `name`, `category`, `price`, `description`, `image`, `is_active`, `has_strength`, `has_size`, `has_shot`, `created_at`, `updated_at`) VALUES ('22', 'Extra Topping Oreo', 'topping', '3000.00', 'Tambahan remahan biskuit oreo.', NULL, '1', '0', '0', '0', '2025-12-31 09:34:06', '2025-12-31 09:34:06');
INSERT INTO `products` (`id`, `name`, `category`, `price`, `description`, `image`, `is_active`, `has_strength`, `has_size`, `has_shot`, `created_at`, `updated_at`) VALUES ('23', 'Extra Topping Keju', 'topping', '3000.00', 'Ekstra keju parut.', NULL, '1', '0', '0', '0', '2025-12-31 09:34:06', '2025-12-31 09:34:06');
INSERT INTO `products` (`id`, `name`, `category`, `price`, `description`, `image`, `is_active`, `has_strength`, `has_size`, `has_shot`, `created_at`, `updated_at`) VALUES ('24', 'Extra Topping Egg', 'topping', '4000.00', 'Tambahan telur.', NULL, '1', '0', '0', '0', '2025-12-31 09:34:06', '2025-12-31 09:34:06');
INSERT INTO `products` (`id`, `name`, `category`, `price`, `description`, `image`, `is_active`, `has_strength`, `has_size`, `has_shot`, `created_at`, `updated_at`) VALUES ('25', 'Extra Topping Kombinasi', 'topping', '5000.00', 'Kombinasi topping pilihan.', NULL, '1', '0', '0', '0', '2025-12-31 09:34:06', '2025-12-31 09:34:06');
INSERT INTO `products` (`id`, `name`, `category`, `price`, `description`, `image`, `is_active`, `has_strength`, `has_size`, `has_shot`, `created_at`, `updated_at`) VALUES ('26', 'Milo', 'non-coffee', '6000.00', 'milo enak tau', 'products/5FAD6fTAVrW1fD6HimtUeEL9eFaZirGGMt60c8r3.png', '1', '0', '1', '0', '2025-12-31 16:18:34', '2025-12-31 16:18:34');

DROP TABLE IF EXISTS `stock_histories`;
CREATE TABLE `stock_histories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `stock_id` bigint unsigned NOT NULL,
  `change` int NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `stock_histories_stock_id_foreign` (`stock_id`),
  CONSTRAINT `stock_histories_stock_id_foreign` FOREIGN KEY (`stock_id`) REFERENCES `stocks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `stock_histories` (`id`, `stock_id`, `change`, `description`, `created_at`, `updated_at`) VALUES ('1', '1', '3000', 'pembelian biji kopi arabica', '2025-12-31 09:35:09', '2025-12-31 09:35:09');
INSERT INTO `stock_histories` (`id`, `stock_id`, `change`, `description`, `created_at`, `updated_at`) VALUES ('2', '2', '4000', 'pembelian biji kopi robusta', '2025-12-31 16:20:48', '2025-12-31 16:20:48');
INSERT INTO `stock_histories` (`id`, `stock_id`, `change`, `description`, `created_at`, `updated_at`) VALUES ('3', '1', '2000', 'pembelian biji kopi robusta', '2026-01-09 08:42:42', '2026-01-09 08:42:42');
INSERT INTO `stock_histories` (`id`, `stock_id`, `change`, `description`, `created_at`, `updated_at`) VALUES ('4', '3', '1000', 'beli gula aren', '2026-01-09 11:23:10', '2026-01-09 11:23:10');

DROP TABLE IF EXISTS `stocks`;
CREATE TABLE `stocks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `material_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int NOT NULL DEFAULT '0',
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `stocks` (`id`, `material_name`, `quantity`, `unit`, `created_at`, `updated_at`) VALUES ('1', 'Biji Kopi Arabica', '5000', 'gram', '2025-12-31 09:34:06', '2026-01-09 08:42:42');
INSERT INTO `stocks` (`id`, `material_name`, `quantity`, `unit`, `created_at`, `updated_at`) VALUES ('2', 'Biji Kopi Robusta', '4000', 'gram', '2025-12-31 09:34:06', '2025-12-31 16:20:48');
INSERT INTO `stocks` (`id`, `material_name`, `quantity`, `unit`, `created_at`, `updated_at`) VALUES ('3', 'Gula Aren', '1000', 'gram', '2025-12-31 09:34:06', '2026-01-09 11:23:10');
INSERT INTO `stocks` (`id`, `material_name`, `quantity`, `unit`, `created_at`, `updated_at`) VALUES ('4', 'Susu Fresh Milk', '0', 'ml', '2025-12-31 09:34:06', '2025-12-31 09:34:06');
INSERT INTO `stocks` (`id`, `material_name`, `quantity`, `unit`, `created_at`, `updated_at`) VALUES ('5', 'Matcha Powder', '0', 'gram', '2025-12-31 09:34:06', '2025-12-31 09:34:06');
INSERT INTO `stocks` (`id`, `material_name`, `quantity`, `unit`, `created_at`, `updated_at`) VALUES ('6', 'Roti Tawar', '0', 'lembar', '2025-12-31 09:34:06', '2025-12-31 09:34:06');
INSERT INTO `stocks` (`id`, `material_name`, `quantity`, `unit`, `created_at`, `updated_at`) VALUES ('7', 'Keju Slice', '0', 'lembar', '2025-12-31 09:34:06', '2025-12-31 09:34:06');
INSERT INTO `stocks` (`id`, `material_name`, `quantity`, `unit`, `created_at`, `updated_at`) VALUES ('8', 'Selai Kaya', '0', 'gram', '2025-12-31 09:34:06', '2025-12-31 09:34:06');
INSERT INTO `stocks` (`id`, `material_name`, `quantity`, `unit`, `created_at`, `updated_at`) VALUES ('9', 'Es Batu', '0', 'pack', '2025-12-31 09:34:06', '2025-12-31 09:34:06');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `username`, `email`, `phone`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES ('1', 'nasihuyyy', 'nasihuyyy@gmail.com', '081234567811', NULL, '$2y$12$HHo809GKv9vFcxEyvgYKp.XNH7/YayH3hCoIDgd4lvfXEAvkVE12q', NULL, '2025-12-31 09:36:04', '2025-12-31 16:08:45');
INSERT INTO `users` (`id`, `username`, `email`, `phone`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES ('2', 'bigmo', 'bigmohuy@gmail.com', '0882006787460', NULL, '$2y$12$vEJ0oT.grQkikEA6kz7OheRZc13wqbUm2o80xtzkH8qalv/uuBlN2', NULL, '2025-12-31 16:43:12', '2026-01-09 08:13:10');

