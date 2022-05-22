-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Мар 15 2021 г., 20:22
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
-- CREATE DATABASE `vitalaqw_book_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `vitalaqw_vitalaqw_book_db`;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `vitalaqw_book_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `author`
--

CREATE TABLE IF NOT EXISTS `author` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Fname` varchar(50) NOT NULL,
  `Sname` varchar(50) NOT NULL,
  `birthday` date DEFAULT NULL,
  `url_photo` varchar(50) DEFAULT NULL,
  `origin` enum('native','foreign') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Дамп данных таблицы `author`
--

INSERT INTO `author` (`id`, `Fname`, `Sname`, `birthday`, `url_photo`, `origin`) VALUES
(1, 'Шерм', 'Коэн', '1965-01-19', NULL, 'foreign'),
(2, 'Бенедикт', 'Камбербэтч', '1976-07-19', NULL, 'native'),
(3, 'Мартин', 'Фримен', '1971-09-08', NULL, 'native'),
(4, 'Пол', 'Макгиган', '1963-09-19', NULL, 'foreign'),
(5, 'Эндрю', 'Адамсон', '1966-11-01', NULL, 'foreign'),
(6, 'Шон', 'Бин', '1959-04-17', NULL, 'native'),
(7, 'Софи', 'Тёрнер', '1996-02-21', NULL, 'native'),
(8, 'Питер', 'Динклэйдж', '1969-06-11', NULL, 'native'),
(9, 'Дженнифер', 'Энистон', '1969-02-11', NULL, 'native'),
(10, 'Дэвид', 'Швиммер', '1966-05-02', NULL, 'native'),
(11, 'Джеймс', 'Кэмерон', '1954-08-16', NULL, 'foreign'),
(12, 'Арнольд', 'Шварценеггер', '1947-07-30', NULL, 'native'),
(13, 'Гор', 'Вербински', '1964-03-16', NULL, 'foreign'),
(14, 'Джонни', 'Депп', '1963-06-09', NULL, 'native'),
(15, 'Орландо', 'Блум', '1977-01-13', NULL, 'native'),
(16, 'Кира', 'Найтли', '1985-03-26', NULL, 'native'),
(17, 'Скотт', 'Мосье', '1971-03-05', NULL, 'foreign'),
(18, 'Иван', 'Насыров', '1978-04-16', NULL, 'native');

-- --------------------------------------------------------

--
-- Структура таблицы `book`
--

CREATE TABLE IF NOT EXISTS `book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `year` year(4) DEFAULT NULL,
  `description` text,
  `cover` varchar(50) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Дамп данных таблицы `book`
--

INSERT INTO `book` (`id`, `title`, `year`, `description`, `cover`, `category_id`) VALUES
(1, 'У водопада. Гарри Гаррисон', 1999, 'описание У водопада. Гарри Гаррисон', '1_cover', 4),
(2, 'И дольше века длится день, Чингиз Айтматов', 2010, 'описание', '2_cover', 2),
(3, 'Спасите ректора! Ольга Валентеева', 2001, 'описание', '3_cover', 3),
(4, 'Игра престолов', 2011, 'описание', '4_cover', 2),
(5, 'Хроники Нарнии. Клайв С. Льюис', 1994, 'описание', '5_cover', 2),
(6, 'Туарег. Альберто Васкес-Фигероа', 1984, 'описание', '6_cover', 1),
(7, 'Семь подземных королей. Александр Волков', 1991, 'описание ', '7_cover', 1),
(8, 'Пираты Карибского моря: На краю света', 2007, 'описание', '8_cover', 1),
(9, 'Беги. Мучители. Манипуляторы. Екатерина Безымянная', 2018, 'описание', '9_cover', 3),
(10, 'Пираты Карибского моря: Сундук мертвеца', 2006, 'описание', '10_cover', 1),
(11, 'Моцарт среди карманников', 2006, 'описание', '11_cover', 5),
(12, 'Шестизарядный', 2014, 'описание', '12_cover', 5),
(13, 'На пьедестале народной любви', 2019, 'описание', '13_cover', 7),
(14, 'Panini Jurassic World - Мир Юрского Периода 2020', 2012, 'описание название', '14_cover', 6),
(15, 'Слишком много женщин. Рекс Стаут', 2018, 'описание', '15_cover', 8);

-- --------------------------------------------------------

--
-- Структура таблицы `book_author`
--

CREATE TABLE IF NOT EXISTS `book_author` (
  `author_id` int(11) NOT NULL DEFAULT '0',
  `book_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`author_id`,`book_id`),
  KEY `book_id` (`book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `book_author`
--

INSERT INTO `book_author` (`author_id`, `book_id`) VALUES
(1, 1),
(4, 1),
(5, 1),
(2, 2),
(3, 2),
(9, 2),
(18, 2),
(5, 3),
(6, 3),
(9, 3),
(14, 3),
(6, 4),
(7, 4),
(8, 4),
(11, 4),
(13, 4),
(2, 5),
(9, 5),
(10, 5),
(17, 5),
(4, 6),
(7, 6),
(11, 6),
(12, 6),
(18, 6),
(1, 7),
(7, 7),
(11, 7),
(12, 7),
(13, 8),
(14, 8),
(15, 8),
(16, 8),
(2, 9),
(3, 9),
(12, 9),
(17, 9),
(13, 10),
(14, 10),
(15, 10),
(16, 10),
(3, 11),
(4, 11),
(5, 11),
(8, 11),
(5, 12),
(6, 12),
(12, 12),
(16, 12),
(1, 13),
(4, 13),
(7, 13),
(8, 13),
(10, 13),
(3, 14),
(6, 14),
(9, 14),
(11, 14),
(12, 14),
(14, 14),
(17, 14),
(2, 15),
(12, 15),
(14, 15),
(18, 15);

-- --------------------------------------------------------

--
-- Структура таблицы `book_genre`
--

CREATE TABLE IF NOT EXISTS `book_genre` (
  `genre_id` int(11) NOT NULL DEFAULT '0',
  `book_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`genre_id`,`book_id`),
  KEY `book_id` (`book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `book_genre`
--

INSERT INTO `book_genre` (`genre_id`, `book_id`) VALUES
(2, 1),
(3, 1),
(5, 1),
(9, 1),
(2, 2),
(4, 2),
(9, 2),
(10, 2),
(2, 3),
(3, 3),
(5, 3),
(2, 4),
(3, 4),
(5, 5),
(7, 5),
(10, 5),
(1, 6),
(2, 6),
(3, 6),
(1, 7),
(2, 7),
(3, 7),
(1, 8),
(2, 8),
(3, 8),
(5, 8),
(3, 9),
(5, 9),
(1, 10),
(2, 10),
(3, 10),
(5, 10),
(2, 11),
(8, 11),
(10, 11),
(1, 12),
(6, 12),
(5, 13),
(7, 13),
(8, 13),
(3, 14),
(6, 14),
(2, 15),
(6, 15),
(9, 15);

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `title`, `description`) VALUES
(1, 'Детективы', 'описание  детективов'),
(2, 'Фэнтези', 'описание  фэнтези'),
(3, 'Юмористическая литература', 'описание юмористической литературы'),
(4, 'Современная проза', 'описание современной прозы'),
(5, 'История', 'описание история'),
(6, 'Классическая литература', 'описание'),
(7, 'Детские книги', 'описание детских книг'),
(8, 'Спорт', 'описание спортивных книг'),
(9, 'Психология, мотивация', 'описание психологии'),
(10, 'Бизнес-книги', 'описание бизнес-книги');

-- --------------------------------------------------------

--
-- Структура таблицы `genre`
--

CREATE TABLE IF NOT EXISTS `genre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `genre`
--

INSERT INTO `genre` (`id`, `title`, `description`) VALUES
(1, 'Боевик', ' жанр кинематографа, в котором основное внимание уделяется перестрелкам, дракам, погоням и т. д.'),
(2, 'Приключение', 'захватывающее происшествие, неожиданное событие или случай в жизни, цепь нечаянных событий и непредвиденных случаев'),
(3, 'Фэнтези', 'жанр современного искусства, разновидность фантастики.'),
(4, 'Вестерн', 'Действие в вестернах в основном происходит во второй половине XIX века на Диком Западе '),
(5, 'Драма', 'воспроизводит прежде всего внешний мир — взаимоотношения между людьми, их поступки, возникающие конфликты.'),
(6, 'Сказка', 'Эпическое, преимущественно прозаическое произведение волшебного, героического или бытового характера'),
(7, 'Трагедия', 'произведение, изображающее напряжённую борьбу, личную или общественную катастрофу и обычно оканчивающееся гибелью героя.'),
(8, 'Нуар', ' термин, применяемый к голливудским криминальным драмам 1940-х — 1950-х годов, в которых запечатлена атмосфера пессимизма, недоверия, разочарования и цинизма, характерная для американского общества во время Второй мировой войны и в первые годы холодной войны.'),
(9, 'Детектив', ' жанр, произведения которого описывают процесс исследования загадочного происшествия с целью выяснения его обстоятельств и раскрытия загадки.'),
(10, 'Комедия', 'жанр художественного произведения, характеризующийся юмористическим или сатирическим подходами, и также вид драмы, в котором специфически разрешается момент действенного конфликта или борьбы.');

-- --------------------------------------------------------

--
-- Структура таблицы `review`
--

CREATE TABLE IF NOT EXISTS `review` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `text` text,
  `date` date DEFAULT NULL,
  `book_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `book_id` (`book_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=46 ;

--
-- Дамп данных таблицы `review`
--

INSERT INTO `review` (`id`, `name`, `email`, `text`, `date`, `book_id`) VALUES
(1, 'User3', 'user3@mail.ru', 'Worthy of an Oscar!', '2020-12-19', 1),
(2, 'User6', 'user6@mail.ru', 'It bugs me', '2021-03-18', 1),
(3, 'User7', 'user7@mail.ru', 'You’ve got it!', '2021-03-20', 1),
(4, 'User2', 'user2@mail.ru', 'I can’t stand it!', '2020-12-19', 2),
(5, 'User7', 'user7@mail.ru', 'Not my favorite', '2021-03-06', 2),
(6, 'User7', 'user7@mail.ru', 'You’ve got it!', '2021-03-18', 3),
(7, 'User4', 'user4@mail.ru', 'So boring', '2021-03-02', 3),
(8, 'User1', 'user1@mail.ru', 'Well done!', '2020-12-16', 3),
(9, 'User3', 'user3@mail.ru', 'Достойно Оскара!', '2020-12-06', 3),
(10, 'User3', 'user3@mail.ru', 'Это шедевр!', '2020-12-18', 4),
(11, 'User7', 'user7@mail.ru', 'Awful', '2021-03-20', 4),
(12, 'User1', 'user1@mail.ru', 'Bravo!', '2021-03-09', 4),
(13, 'User2', 'user2@mail.ru', 'Awful', '2020-12-24', 4),
(14, 'User5', 'user5@mail.ru', 'Worthy of an Oscar!', '2020-12-23', 5),
(15, 'User4', 'user4@mail.ru', 'It bugs me', '2021-03-07', 6),
(16, 'User4', 'user4@mail.ru', 'Keep it up!', '2021-03-16', 6),
(17, 'User1', 'user1@mail.ru', 'Очень смело!', '2021-03-12', 6),
(18, 'User5', 'user5@mail.ru', 'You’ve got it!', '2021-03-01', 6),
(19, 'User6', 'user6@mail.ru', 'I can’t stand it!', '2021-03-06', 6),
(20, 'User8', 'user8@mail.ru', 'Right On!', '2021-03-07', 7),
(21, 'User2', 'user2@mail.ru', 'So boring', '2021-03-04', 7),
(22, 'User5', 'user5@mail.ru', 'Not my favorite', '2020-12-11', 8),
(23, 'User7', 'user7@mail.ru', 'Worthy of an Oscar!', '2021-03-04', 8),
(24, 'User1', 'user1@mail.ru', 'I can’t stand it!', '2021-03-17', 8),
(25, 'User5', 'user5@mail.ru', 'Awful', '2021-03-13', 9),
(26, 'User8', 'user8@mail.ru', 'That’s perfect!', '2020-12-16', 9),
(27, 'User7', 'user7@mail.ru', 'Not my favorite', '2021-03-04', 9),
(28, 'User3', 'user3@mail.ru', 'You’ve got it!', '2020-12-17', 10),
(29, 'User4', 'user4@mail.ru', 'It bugs me', '2020-12-31', 10),
(30, 'User3', 'user3@mail.ru', 'Это идеально!', '2020-12-25', 11),
(31, 'User6', 'user6@mail.ru', 'Not my favorite', '2020-12-21', 11),
(32, 'User5', 'user5@mail.ru', 'So boring', '2020-12-10', 11),
(33, 'User5', 'user5@mail.ru', 'Достойно Оскара!', '2021-03-05', 11),
(34, 'User3', 'user3@mail.ru', 'Not my favorite', '2020-12-26', 12),
(35, 'User6', 'user6@mail.ru', 'You’ve got it!', '2020-12-11', 12),
(36, 'User8', 'user8@mail.ru', 'So boring', '2021-03-16', 13),
(37, 'User8', 'user8@mail.ru', 'Достойно Оскара!', '2021-03-20', 13),
(38, 'User7', 'user7@mail.ru', 'I can’t stand it!', '2021-03-04', 13),
(39, 'User7', 'user7@mail.ru', 'It bugs me', '2020-12-24', 13),
(40, 'User8', 'user8@mail.ru', 'That’s perfect!', '2021-03-20', 14),
(41, 'User6', 'user6@mail.ru', 'I can’t stand it!', '2020-12-31', 14),
(42, 'User4', 'user4@mail.ru', 'Worthy of an Oscar!', '2021-03-09', 14),
(43, 'User8', 'user8@mail.ru', 'It bugs me', '2020-12-13', 14),
(44, 'User3', 'user3@mail.ru', 'Это идеально!', '2020-12-10', 15),
(45, 'User6', 'user6@mail.ru', 'Достойно Оскара!', '2020-12-27', 15);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Ограничения внешнего ключа таблицы `book_author`
--
ALTER TABLE `book_author`
  ADD CONSTRAINT `book_author_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `book_author_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `author` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `book_genre`
--
ALTER TABLE `book_genre`
  ADD CONSTRAINT `book_genre_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `book_genre_ibfk_2` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
