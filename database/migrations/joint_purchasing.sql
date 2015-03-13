--
-- Скрипт сгенерирован Devart dbForge Studio for MySQL, Версия 6.3.341.0
-- Домашняя страница продукта: http://www.devart.com/ru/dbforge/mysql/studio
-- Дата скрипта: 13.03.2015 10:38:55
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
AUTO_INCREMENT = 56
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
AUTO_INCREMENT = 2
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
AUTO_INCREMENT = 12
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
(36, 8, 1, '200 мл'),
(37, 8, 2, 'Корея'),
(38, 8, 3, 'Holika Holika'),
(39, 8, 4, '8806334344467'),
(40, 8, 5, 'http://www.citynature.ru/catalog/dlya-volos/vosstanavlivayushchaya-maska-dlya-volos'),
(41, 9, 1, '70 мл'),
(42, 9, 2, 'Корея'),
(43, 9, 3, 'Holika Holika'),
(44, 9, 4, '8806334345082'),
(45, 9, 5, 'http://www.citynature.ru/catalog/dlya-volos/vosk-dlya-volos-dlya-muzhchin-super-silnaya-fiksatsiya'),
(46, 10, 1, '100 мл'),
(47, 10, 2, 'Корея'),
(48, 10, 3, 'Holika Holika'),
(49, 10, 4, '8806334344450'),
(50, 10, 5, 'http://www.citynature.ru/catalog/dlya-volos/sprej-ukhazhivayushchij-dlya-volos-angelskie-kudri'),
(51, 11, 1, '50 мл'),
(52, 11, 2, 'Корея'),
(53, 11, 3, 'Holika Holika'),
(54, 11, 4, '8806334344474'),
(55, 11, 5, 'http://www.citynature.ru/catalog/dlya-volos/penka-kraska-dlya-volos-penka-kraska-dlya-volos-ton-01-chernyj');

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
INSERT INTO prices VALUES
(8, 11, 505.00),
(8, 12, 480.00),
(8, 13, 470.00),
(8, 14, 460.00),
(8, 15, 449.00),
(8, 16, 439.00),
(8, 17, 434.00),
(9, 11, 550.00),
(9, 12, 523.00),
(9, 13, 512.00),
(9, 14, 501.00),
(9, 15, 490.00),
(9, 16, 479.00),
(9, 17, 479.00),
(10, 11, 451.00),
(10, 12, 428.00),
(10, 13, 419.00),
(10, 14, 410.00),
(10, 15, 401.00),
(10, 16, 392.00),
(10, 17, 388.00),
(11, 11, 533.00),
(11, 12, 506.00),
(11, 13, 496.00),
(11, 14, 485.00),
(11, 15, 474.00),
(11, 16, 464.00),
(11, 17, 458.00);

-- 
-- Вывод данных для таблицы pricing_grids
--
INSERT INTO pricing_grids VALUES
(1, 'Основная колонка', '', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

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
(8, 'Восстанавливающая маска для волос', 'Интенсивно восстанавливающая и питательная маска для волос с маслом Арганы, для любого типа волос, обеспечивает бережный и максимальный уход поврежденных волос. Аргановое дерево, или, как его еще называют – железное дерево, произрастает только на территории Марокко, ааргановое масло считается одним из самых редких и дорогих растительных масел в мире. Масло Арганы, входящее в состав маски, обогащенное жирными, растительными кислотами, антиоксидантами, которые обновляют клетки волос и делают структуру более эластичной. Маска также включает в себя натуральные цветочные экстракты, которые бережно ухаживают за кожей головы. А нежнейший аромат превратит процедуру в настоящее удовольствие. В результате Ваши волосы выглядят идеально ухоженными, мягкими, объемными, легко расчесываются. Маска, обогащенная мягкими цитрусовыми ароматами, пробуждает чувства, дарит ощущение свежести. Holika Holika Angels Ring Argan Hair Treatment превосходное лечебное средство для еженедельного употребления в современной окружающей среде, пагубно воздействующей на волосы. Способ применения: Используйте средство как обычную маску для волос. Нанесите на чистые волосы на 10-15 минут. Если захотите использовать в качестве кондиционера, то наносите всего на 1-3 минуты, затем смойте водой.', 1, '2015-03-12 21:39:36', '2015-03-12 21:39:36'),
(9, 'Воск для волос для мужчин супер-сильная фиксация', 'Воск для укладки экстра сильной фиксации для активных и спортивных мужчин, нуждающихся в супер фиксации при повышенной активности. Воск позволяет легко создать прическу, не перегружая ее, надолго фиксирует и создает неповторимый стиль. Воск имеет форму легкой молочной консистенции, что позволяет легко его использовать, пластифицировать и наносить. Не оставляет чешуек на поверхности волос. Экстракты морских водорослей питают структуру волоса изнутри, делают их более здоровыми и блестящими.', 1, '2015-03-12 21:41:19', '2015-03-12 21:41:19'),
(10, 'Мист ухаживающий для волос', 'Освежающий спрей Angel’s Ring Aqua Hair Mist Holika Holika делает волосы послушными и эластичными. Подходит для использования и зимой (предотвращает образование статического электричества на волосах, освежает укладку), и летом (увлажняет, предотвращает ломкость). Очень легкий, не утяжеляет волосы. Применение: небольшое количество спрея распылите на волосы по всей длине с расстояния примерно 15-20 см. Расчешите волосы.', 1, '2015-03-12 21:43:23', '2015-03-12 21:43:23'),
(11, 'Пенка-краска для волос', 'Использование пенки для окрашивания волос превратит процесс окраски в настоящее удовольствие. Пенная текстура позволит сделать процесс окрашивания столь же легким, как и обычное мытье волос. При этом новинка надолго сохраняет интенсивность цвета, до 100% закрашивает седину и дарит волосам силу и здоровый блеск.', 1, '2015-03-12 21:45:07', '2015-03-12 21:45:07');

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