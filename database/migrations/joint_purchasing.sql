--
-- Скрипт сгенерирован Devart dbForge Studio for MySQL, Версия 6.3.341.0
-- Домашняя страница продукта: http://www.devart.com/ru/dbforge/mysql/studio
-- Дата скрипта: 12.03.2015 2:25:55
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
  attribute_id INT(11) NOT NULL,
  value VARCHAR(255) NOT NULL DEFAULT '',
  PRIMARY KEY (id),
  UNIQUE INDEX UK_attribute_values (product_id, attribute_id)
)
ENGINE = INNODB
AUTO_INCREMENT = 21
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
AUTO_INCREMENT = 6
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
-- Описание для таблицы media
--
CREATE TABLE media (
  id INT(11) NOT NULL AUTO_INCREMENT,
  product_id INT(11) NOT NULL,
  type VARCHAR(10) NOT NULL DEFAULT 'image',
  file_name VARCHAR(255) NOT NULL DEFAULT '',
  `position` INT(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 3
AVG_ROW_LENGTH = 8192
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
-- Описание для таблицы nested_sets
--
CREATE TABLE nested_sets (
  id INT(11) NOT NULL AUTO_INCREMENT,
  parent_id INT(11) NOT NULL DEFAULT 0,
  _lft INT(11) NOT NULL,
  _rgt INT(11) NOT NULL,
  name VARCHAR(50) DEFAULT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 61
AVG_ROW_LENGTH = 5461
CHARACTER SET utf8
COLLATE utf8_general_ci;

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
  UNIQUE INDEX product_id_column_id (product_id, column_id)
)
ENGINE = INNODB
AVG_ROW_LENGTH = 2340
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
  column_title VARCHAR(255) NOT NULL,
  min_sum DECIMAL(19, 2) NOT NULL COMMENT 'Минимальная сумма колонки',
  min_sum_inclusive TINYINT(1) NOT NULL DEFAULT 0 COMMENT 'Минимальная сумма колонки - включительно',
  max_sum DECIMAL(19, 2) NOT NULL COMMENT 'Максимальная сумма колонки',
  max_sum_inclusive TINYINT(1) NOT NULL DEFAULT 0 COMMENT 'Максимальная сумма колонки - включительно',
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 18
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
AUTO_INCREMENT = 5
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
-- Описание для таблицы projects_pricing_grids
--
CREATE TABLE projects_pricing_grids (
  project_id INT(11) NOT NULL,
  pricing_grid_id INT(11) NOT NULL
)
ENGINE = INNODB
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
(16, 4, 1, '200 мл'),
(17, 4, 2, 'Корея'),
(18, 4, 3, 'Holika Holika'),
(19, 4, 4, '8806334344467'),
(20, 4, 5, 'http://www.citynature.ru/catalog/dlya-volos/vosstanavlivayushchaya-maska-dlya-volos');

-- 
-- Вывод данных для таблицы attributes
--
INSERT INTO attributes VALUES
(1, 'Вес', 'weight', 1, '2015-03-03 09:55:29', '2015-03-03 09:55:29'),
(2, 'Страна производителя', 'country', 1, '2015-03-03 10:24:50', '2015-03-03 10:24:50'),
(3, 'Бренд', 'brand', 1, '2015-03-03 10:25:24', '2015-03-03 10:25:24'),
(4, 'Артикул', 'article', 1, '2015-03-03 10:34:45', '2015-03-03 10:34:45'),
(5, 'Ссылка на товар', 'cn_link', 1, '2015-03-05 18:31:52', '2015-03-05 18:31:52');

-- 
-- Вывод данных для таблицы attributes_groups
--
INSERT INTO attributes_groups VALUES
(1, 'Атрибуты товаров citynature.ru', 1, '2015-03-03 09:12:06', '2015-03-03 09:12:06');

-- 
-- Вывод данных для таблицы category_product
--

-- Таблица joint_purchasing.category_product не содержит данных

-- 
-- Вывод данных для таблицы media
--

-- Таблица joint_purchasing.media не содержит данных

-- 
-- Вывод данных для таблицы migrations
--
INSERT INTO migrations VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1);

-- 
-- Вывод данных для таблицы nested_sets
--
INSERT INTO nested_sets VALUES
(0, 0, 116, 116, 'ROOT'),
(1, 0, 0, 115, 'Каталог товаров'),
(2, 1, 69, 84, 'Косметика'),
(3, 1, 1, 18, 'Парфюмерия'),
(4, 1, 19, 28, 'Подарки'),
(5, 1, 85, 114, 'Макияж'),
(6, 1, 29, 42, 'Мама и малыш'),
(7, 1, 43, 68, 'Бытовая химия'),
(8, 2, 82, 83, 'Для волос'),
(9, 2, 70, 71, 'Для лица'),
(10, 2, 72, 73, 'Для тела'),
(11, 2, 74, 75, 'Для ногтей'),
(12, 2, 76, 77, 'Для ванны и душа'),
(13, 2, 78, 79, 'Депиляция'),
(14, 2, 80, 81, 'Аксессуары'),
(15, 3, 2, 3, 'Для женщин'),
(16, 3, 14, 15, 'Для мужчин'),
(17, 3, 16, 17, 'Для детей'),
(18, 3, 4, 5, 'Селективная парфюмерия'),
(19, 3, 6, 7, 'Брендовая парфюмерия'),
(20, 3, 8, 9, 'Недорогая парфюмерия'),
(21, 3, 10, 11, 'Арабская парфюмерия'),
(22, 3, 12, 13, 'Корейская парфюмерия'),
(23, 4, 26, 27, 'Для женщин'),
(24, 4, 20, 21, 'Для мужчин'),
(25, 4, 22, 23, 'Унисекс'),
(26, 4, 24, 25, 'Для детей'),
(27, 5, 112, 113, 'Тональные средства'),
(28, 5, 110, 111, 'Пудра'),
(29, 5, 108, 109, 'Блеск для губ'),
(30, 5, 104, 105, 'Тушь для ресниц'),
(31, 5, 106, 107, 'Подводка'),
(32, 5, 102, 103, 'Карандаши'),
(33, 5, 98, 99, 'Помада'),
(34, 5, 100, 101, 'Тени для век'),
(35, 5, 96, 97, 'Румяна'),
(36, 5, 94, 95, 'Корректоры'),
(37, 5, 92, 93, 'База под макияж'),
(38, 5, 90, 91, 'Аксессуары'),
(39, 5, 88, 89, 'BB кремы'),
(40, 5, 86, 87, 'Тинты'),
(41, 6, 40, 41, 'Уход за кожей'),
(42, 6, 38, 39, 'Купание'),
(43, 6, 36, 37, 'Подгузники, салфетки, ватная продукция'),
(44, 6, 34, 35, 'Для мамы'),
(45, 6, 32, 33, 'Присыпки'),
(46, 6, 30, 31, 'Уход за полостью рта'),
(47, 7, 44, 45, 'Стиральные порошки'),
(48, 7, 46, 47, 'Средства для стирки'),
(49, 7, 50, 51, 'Для посудомоечных машин'),
(50, 7, 48, 49, 'Для мытья посуды'),
(51, 7, 52, 53, 'Для стекла'),
(52, 7, 54, 55, 'Освежители'),
(53, 7, 56, 57, 'Кондиционеры'),
(54, 7, 60, 61, 'Отбеливатели'),
(55, 7, 58, 59, 'Таблетки для стирки'),
(56, 7, 64, 65, 'Полироли'),
(57, 7, 62, 63, 'Пятновыводители'),
(58, 7, 66, 67, 'Чистящие средства');

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
(11, 1, 'до 15 т.р.', 0.00, 0, 15000.00, 1),
(12, 1, '15 т.р - 30 т.р', 15000.00, 0, 30000.00, 1),
(13, 1, '30 т.р - 50 т.р', 30000.00, 0, 50000.00, 1),
(14, 1, '50 т.р - 70 т.р', 50000.00, 0, 70000.00, 1),
(15, 1, '70 т.р - 100 т.р', 70000.00, 0, 100000.00, 1),
(16, 1, '100 т.р - 300 т.р', 100000.00, 0, 300000.00, 1),
(17, 1, 'от 300 т.р.', 300000.00, 0, 0.00, 0);

-- 
-- Вывод данных для таблицы product_purchase
--

-- Таблица joint_purchasing.product_purchase не содержит данных

-- 
-- Вывод данных для таблицы products
--
INSERT INTO products VALUES
(4, 'Восстанавливающая маска для волос', 'Интенсивно восстанавливающая и питательная маска для волос с маслом Арганы, для любого типа волос, обеспечивает бережный и максимальный уход поврежденных волос. Аргановое дерево, или, как его еще называют – железное дерево, произрастает только на территории Марокко, ааргановое масло считается одним из самых редких и дорогих растительных масел в мире. Масло Арганы, входящее в состав маски, обогащенное жирными, растительными кислотами, антиоксидантами, которые обновляют клетки волос и делают структуру более эластичной. Маска также включает в себя натуральные цветочные экстракты, которые бережно ухаживают за кожей головы. А нежнейший аромат превратит процедуру в настоящее удовольствие. В результате Ваши волосы выглядят идеально ухоженными, мягкими, объемными, легко расчесываются. Маска, обогащенная мягкими цитрусовыми ароматами, пробуждает чувства, дарит ощущение свежести. Holika Holika Angels Ring Argan Hair Treatment превосходное лечебное средство для еженедельного употребления в современной окружающей среде, пагубно воздействующей на волосы. Способ применения: Используйте средство как обычную маску для волос. Нанесите на чистые волосы на 10-15 минут. Если захотите использовать в качестве кондиционера, то наносите всего на 1-3 минуты, затем смойте водой.', 1, '2015-03-11 23:20:05', '2015-03-11 23:20:05');

-- 
-- Вывод данных для таблицы projects
--
INSERT INTO projects VALUES
(1, 'Проект citynature.ru', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- 
-- Вывод данных для таблицы projects_pricing_grids
--
INSERT INTO projects_pricing_grids VALUES
(1, 1);

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