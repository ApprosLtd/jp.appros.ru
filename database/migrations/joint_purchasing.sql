--
-- Скрипт сгенерирован Devart dbForge Studio for MySQL, Версия 6.3.341.0
-- Домашняя страница продукта: http://www.devart.com/ru/dbforge/mysql/studio
-- Дата скрипта: 26.02.2015 8:30:33
-- Версия сервера: 5.5.41-0ubuntu0.14.04.1
-- Версия клиента: 4.1
--


--
-- Описание для базы данных joint_purchasing
--
DROP DATABASE IF EXISTS joint_purchasing;
CREATE DATABASE joint_purchasing
	CHARACTER SET utf8
	COLLATE utf8_general_ci;

-- 
-- Отключение внешних ключей
-- 
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;

-- 
-- Установить режим SQL (SQL mode)
-- 
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- 
-- Установка кодировки, с использованием которой клиент будет посылать запросы на сервер
--
SET NAMES 'utf8';

-- 
-- Установка базы данных по умолчанию
--
USE joint_purchasing;

--
-- Описание для таблицы migrations
--
CREATE TABLE migrations (
  migration VARCHAR(255) NOT NULL,
  batch INT(11) NOT NULL
)
ENGINE = INNODB
AVG_ROW_LENGTH = 8192
CHARACTER SET utf8
COLLATE utf8_unicode_ci;

--
-- Описание для таблицы password_resets
--
CREATE TABLE password_resets (
  email VARCHAR(255) NOT NULL,
  token VARCHAR(255) NOT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
  INDEX password_resets_email_index (email),
  INDEX password_resets_token_index (token)
)
ENGINE = INNODB
CHARACTER SET utf8
COLLATE utf8_unicode_ci;

--
-- Описание для таблицы prices
--
CREATE TABLE prices (
  product_id INT(11) NOT NULL,
  column_id INT(11) NOT NULL,
  price DECIMAL(19, 2) NOT NULL DEFAULT 0.00,
  INDEX product_id (product_id)
)
ENGINE = INNODB
CHARACTER SET utf8
COLLATE utf8_general_ci;

--
-- Описание для таблицы pricing_grids
--
CREATE TABLE pricing_grids (
  id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(50) NOT NULL,
  description VARCHAR(500) NOT NULL DEFAULT '',
  user_id INT(11) NOT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
  updated_at TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 3
AVG_ROW_LENGTH = 8192
CHARACTER SET utf8
COLLATE utf8_general_ci
COMMENT = 'Ценовые сетки';

--
-- Описание для таблицы pricing_grids_columns
--
CREATE TABLE pricing_grids_columns (
  id INT(11) NOT NULL AUTO_INCREMENT,
  pricing_grid_id INT(11) NOT NULL,
  column_number INT(11) NOT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 1
CHARACTER SET utf8
COLLATE utf8_general_ci
COMMENT = 'Колонки ценовых сеток';

--
-- Описание для таблицы product_purchase
--
CREATE TABLE product_purchase (
  purchase_id INT(11) NOT NULL,
  product_id INT(11) NOT NULL
)
ENGINE = INNODB
CHARACTER SET utf8
COLLATE utf8_general_ci
COMMENT = 'Промежуточная таблица "Закупки - продукты"';

--
-- Описание для таблицы products
--
CREATE TABLE products (
  id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  description VARCHAR(5000) NOT NULL DEFAULT '',
  user_id INT(11) NOT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
  updated_at TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 7
AVG_ROW_LENGTH = 2730
CHARACTER SET utf8
COLLATE utf8_general_ci
COMMENT = 'Продукты';

--
-- Описание для таблицы purchases
--
CREATE TABLE purchases (
  id INT(11) NOT NULL AUTO_INCREMENT,
  user_id INT(11) NOT NULL,
  pricing_grid_id INT(11) NOT NULL,
  pricing_grid_column INT(11) NOT NULL DEFAULT 1,
  expiration_time TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
  description VARCHAR(255) NOT NULL DEFAULT '',
  created_at TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
  updated_at TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 5
AVG_ROW_LENGTH = 4096
CHARACTER SET utf8
COLLATE utf8_general_ci
COMMENT = 'Закупки';

--
-- Описание для таблицы users
--
CREATE TABLE users (
  id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(60) NOT NULL,
  remember_token VARCHAR(100) DEFAULT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
  updated_at TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (id),
  UNIQUE INDEX users_email_unique (email)
)
ENGINE = INNODB
AUTO_INCREMENT = 2
AVG_ROW_LENGTH = 16384
CHARACTER SET utf8
COLLATE utf8_unicode_ci;

--
-- Описание для таблицы widgets
--
CREATE TABLE widgets (
  id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(100) NOT NULL,
  description VARCHAR(255) DEFAULT NULL,
  handler VARCHAR(255) DEFAULT NULL,
  layouts VARCHAR(20) DEFAULT NULL,
  region VARCHAR(50) DEFAULT NULL,
  `position` INT(11) NOT NULL DEFAULT 0,
  status TINYINT(1) NOT NULL DEFAULT 1,
  created_at TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
  updated_at TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 4
AVG_ROW_LENGTH = 8192
CHARACTER SET utf8
COLLATE utf8_general_ci
COMMENT = 'Виджеты';

-- 
-- Вывод данных для таблицы migrations
--
INSERT INTO migrations VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1);

-- 
-- Вывод данных для таблицы password_resets
--

-- Таблица joint_purchasing.password_resets не содержит данных

-- 
-- Вывод данных для таблицы prices
--

-- Таблица joint_purchasing.prices не содержит данных

-- 
-- Вывод данных для таблицы pricing_grids
--
INSERT INTO pricing_grids VALUES
(1, 'Тхэквондо23', '', 1, '2015-02-25 20:39:47', '2015-02-25 20:39:47'),
(2, 'По категориям', '', 1, '2015-02-25 20:40:06', '2015-02-25 20:40:06');

-- 
-- Вывод данных для таблицы pricing_grids_columns
--

-- Таблица joint_purchasing.pricing_grids_columns не содержит данных

-- 
-- Вывод данных для таблицы product_purchase
--

-- Таблица joint_purchasing.product_purchase не содержит данных

-- 
-- Вывод данных для таблицы products
--
INSERT INTO products VALUES
(1, 'Виталий', '', 0, '2015-02-25 19:51:43', '2015-02-25 19:51:43'),
(2, 'asdfasdgasgh', 'иваирварв', 0, '2015-02-25 19:51:48', '2015-02-25 19:51:48'),
(3, 'Стул упорный', 'Предмет обихода для молодой семья', 0, '2015-02-25 19:52:14', '2015-02-25 19:52:14'),
(4, 'asetaryh', '', 0, '2015-02-25 20:26:14', '2015-02-25 20:26:14'),
(5, 'Виталий', '', 0, '2015-02-25 20:31:17', '2015-02-25 20:31:17'),
(6, 'Тхэквондо23', '', 0, '2015-02-25 20:33:48', '2015-02-25 20:33:48');

-- 
-- Вывод данных для таблицы purchases
--
INSERT INTO purchases VALUES
(1, 1, 1, 1, '2015-03-05 04:29:39', 'первая закупка', '2015-02-26 04:30:03', '2015-02-26 04:30:03'),
(2, 1, 2, 1, '2015-03-05 04:30:03', 'новая закупка', '2015-02-26 04:33:41', '2015-02-26 04:33:41'),
(3, 1, 2, 1, '2015-03-05 04:33:58', 'уфа', '2015-02-26 04:34:02', '2015-02-26 04:34:02'),
(4, 1, 1, 1, '2015-03-05 04:34:03', 'вамви', '2015-02-26 04:34:22', '2015-02-26 04:34:22');

-- 
-- Вывод данных для таблицы users
--
INSERT INTO users VALUES
(1, 'Виталий', 'serovvitaly@gmail.com', '$2y$10$B9utwkSzweDFIzTsSJa3oOq5slqDE85Ow1KK8n2tzoTb69PFbKQ9W', 'bexQ97ucY6jVk64elmhCtWIzVlFbxvtWg0gng3Nf3vGFMRGfDCIPIvsV3NOR', '2015-02-24 13:20:58', '2015-02-25 10:35:35');

-- 
-- Вывод данных для таблицы widgets
--
INSERT INTO widgets VALUES
(1, 'Каталог товаров', 'Основной блок каталога товаров на главной', '\\App\\Widgets\\BaseCatalog', NULL, 'center_1', 2, 1, '2015-02-24 16:50:50', '2015-02-24 16:50:50'),
(2, 'Навигационное меню "Seller"', 'Верхнее навигационное меню для раздела "Продавцы"', '\\App\\Widgets\\SellerBaseNav', 'seller', 'top', 0, 1, '2015-02-25 11:45:15', '2015-02-25 11:45:15'),
(3, 'Навигационное меню "Admin"', 'Верхнее навигационное меню Админки', '\\App\\Widgets\\AdminBaseNav', 'admin', 'top', 0, 1, '2015-02-25 20:21:00', '2015-02-25 20:21:00');

-- 
-- Восстановить предыдущий режим SQL (SQL mode)
-- 
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;

-- 
-- Включение внешних ключей
-- 
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;