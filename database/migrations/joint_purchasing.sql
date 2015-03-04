--
-- Скрипт сгенерирован Devart dbForge Studio for MySQL, Версия 6.3.341.0
-- Домашняя страница продукта: http://www.devart.com/ru/dbforge/mysql/studio
-- Дата скрипта: 04.03.2015 9:47:13
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
-- Описание для таблицы attribute_values
--
CREATE TABLE attribute_values (
  id INT(11) NOT NULL AUTO_INCREMENT,
  product_id INT(11) NOT NULL,
  name VARCHAR(50) NOT NULL,
  value VARCHAR(255) NOT NULL DEFAULT '',
  PRIMARY KEY (id),
  UNIQUE INDEX UK_attribute_values (product_id, name)
)
ENGINE = INNODB
AUTO_INCREMENT = 29
AVG_ROW_LENGTH = 1024
CHARACTER SET utf8
COLLATE utf8_general_ci;

--
-- Описание для таблицы attributes
--
CREATE TABLE attributes (
  id INT(11) NOT NULL AUTO_INCREMENT,
  title VARCHAR(255) NOT NULL,
  name VARCHAR(50) NOT NULL,
  attribute_group_id INT(11) NOT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
  updated_at TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (id),
  UNIQUE INDEX name (name)
)
ENGINE = INNODB
AUTO_INCREMENT = 5
AVG_ROW_LENGTH = 4096
CHARACTER SET utf8
COLLATE utf8_general_ci;

--
-- Описание для таблицы attributes_groups
--
CREATE TABLE attributes_groups (
  id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(50) NOT NULL,
  user_id INT(11) NOT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
  updated_at TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 2
AVG_ROW_LENGTH = 8192
CHARACTER SET utf8
COLLATE utf8_general_ci;

--
-- Описание для таблицы categories
--
CREATE TABLE categories (
  id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(50) NOT NULL,
  parent_id INT(11) NOT NULL,
  project_id INT(11) NOT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
  updated_at TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 4
AVG_ROW_LENGTH = 5461
CHARACTER SET utf8
COLLATE utf8_general_ci;

--
-- Описание для таблицы category_product
--
CREATE TABLE category_product (
  category_id INT(11) DEFAULT NULL,
  product_id INT(11) DEFAULT NULL
)
ENGINE = INNODB
AVG_ROW_LENGTH = 2340
CHARACTER SET utf8
COLLATE utf8_general_ci;

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
  project_id INT(11) NOT NULL,
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
  column_title VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 8
AVG_ROW_LENGTH = 2340
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
AUTO_INCREMENT = 11
AVG_ROW_LENGTH = 2730
CHARACTER SET utf8
COLLATE utf8_general_ci
COMMENT = 'Продукты';

--
-- Описание для таблицы projects
--
CREATE TABLE projects (
  id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(50) NOT NULL,
  user_id INT(11) NOT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
  updated_at TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 2
AVG_ROW_LENGTH = 16384
CHARACTER SET utf8
COLLATE utf8_general_ci;

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
-- Вывод данных для таблицы attribute_values
--
INSERT INTO attribute_values VALUES
(1, 5, 'article', '4'),
(2, 5, 'brand', '3'),
(3, 5, 'country', '2'),
(4, 5, 'weight', '1**'),
(5, 6, 'article', '4'),
(6, 6, 'brand', '3'),
(7, 6, 'country', '2'),
(8, 6, 'weight', '1'),
(9, 7, 'article', '4'),
(10, 7, 'brand', '3'),
(11, 7, 'country', '2'),
(12, 7, 'weight', '1'),
(13, 8, 'article', '33'),
(14, 8, 'brand', 'hello'),
(15, 8, 'country', 'hrllo'),
(16, 8, 'weight', 'yjdsq'),
(17, 9, 'article', '4-'),
(18, 9, 'brand', '3-'),
(19, 9, 'country', '2-'),
(20, 9, 'weight', '1-'),
(21, 10, 'article', '4=='),
(22, 10, 'brand', '3=='),
(23, 10, 'country', '2=='),
(24, 10, 'weight', '1=='),
(25, 1, 'weight', '119'),
(26, 1, 'country', ''),
(27, 1, 'brand', ''),
(28, 1, 'article', '');

-- 
-- Вывод данных для таблицы attributes
--
INSERT INTO attributes VALUES
(1, 'Вес', 'weight', 1, '2015-03-03 09:55:29', '2015-03-03 09:55:29'),
(2, 'Страна производителя', 'country', 1, '2015-03-03 10:24:50', '2015-03-03 10:24:50'),
(3, 'Бренд', 'brand', 1, '2015-03-03 10:25:24', '2015-03-03 10:25:24'),
(4, 'Артикул', 'article', 1, '2015-03-03 10:34:45', '2015-03-03 10:34:45');

-- 
-- Вывод данных для таблицы attributes_groups
--
INSERT INTO attributes_groups VALUES
(1, 'Атрибуты товаров citynature.ru', 1, '2015-03-03 09:12:06', '2015-03-03 09:12:06');

-- 
-- Вывод данных для таблицы categories
--
INSERT INTO categories VALUES
(1, 'Косметика', 0, 1, '2015-03-03 03:29:35', '2015-03-03 03:29:35'),
(2, 'Для волос', 1, 1, '2015-03-03 04:26:28', '2015-03-03 04:26:28'),
(3, 'Для лица', 1, 1, '2015-03-03 04:27:30', '2015-03-03 04:27:30');

-- 
-- Вывод данных для таблицы category_product
--
INSERT INTO category_product VALUES
(1, 3),
(2, 3),
(1, 7),
(2, 7),
(3, 7),
(1, 8),
(3, 8);

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
(1, 'Основная колонка', '', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'weight', '', 0, 0, '2015-03-03 09:54:15', '2015-03-03 09:54:15');

-- 
-- Вывод данных для таблицы pricing_grids_columns
--
INSERT INTO pricing_grids_columns VALUES
(1, 1, 1, 'до 15 т.р.'),
(2, 1, 2, '15 т.р - 30 т.р'),
(3, 1, 3, '30 т.р - 50 т.р'),
(4, 1, 4, '50 т.р - 70 т.р'),
(5, 1, 5, '70 т.р - 100 т.р'),
(6, 1, 6, '100 т.р - 300 т.р'),
(7, 1, 7, 'от 300 т.р.');

-- 
-- Вывод данных для таблицы product_purchase
--

-- Таблица joint_purchasing.product_purchase не содержит данных

-- 
-- Вывод данных для таблицы products
--
INSERT INTO products VALUES
(1, 'Сухие духи Ваниль', 'Твердый парфюмированный тин для тела с нежным и ненавязчивым ароматом ванили. Способ применения. Небольшое количество парфюма нанести на участки с активной циркуляцией крови (за ушами, в ложбинке груди, внутренней части на сгибе рук)', 1, '2015-03-03 10:44:11', '2015-03-03 10:44:11'),
(2, 'Тхэквондо23', 'фыупрвп', 1, '2015-03-03 11:26:52', '2015-03-03 11:26:52'),
(3, 'sgg', 'dfhg', 1, '2015-03-03 12:03:10', '2015-03-03 12:03:10'),
(4, 'вфуыпа', '', 1, '2015-03-03 13:03:25', '2015-03-03 13:03:25'),
(5, 'вфуыпа', '', 1, '2015-03-03 13:04:22', '2015-03-03 13:04:22'),
(6, 'вфуыпа', '', 1, '2015-03-03 13:05:04', '2015-03-03 13:05:04'),
(7, 'вфуыпа', '', 1, '2015-03-03 13:05:32', '2015-03-03 13:05:32'),
(8, 'sdfgdshf', 'sdgjsfjg', 1, '2015-03-03 13:08:11', '2015-03-03 13:08:11'),
(9, 'вфуыпа', '', 1, '2015-03-03 17:37:26', '2015-03-03 17:37:26'),
(10, 'вфуыпа', '', 1, '2015-03-03 17:38:11', '2015-03-03 17:38:11');

-- 
-- Вывод данных для таблицы projects
--
INSERT INTO projects VALUES
(1, 'Первый проект', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

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
(1, 'Виталий Серов', 'serovvitaly@gmail.com', '$2y$10$B9utwkSzweDFIzTsSJa3oOq5slqDE85Ow1KK8n2tzoTb69PFbKQ9W', 'bexQ97ucY6jVk64elmhCtWIzVlFbxvtWg0gng3Nf3vGFMRGfDCIPIvsV3NOR', '2015-02-24 13:20:58', '2015-02-25 10:35:35');

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