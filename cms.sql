-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 05 Nis 2019, 15:34:40
-- Sunucu sürümü: 10.1.38-MariaDB
-- PHP Sürümü: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `cms`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `categories`
--

CREATE TABLE `categories` (
  `category_id` int(3) NOT NULL,
  `category_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, 'Html'),
(2, 'Css'),
(3, 'Php');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_post_id` int(3) NOT NULL,
  `comment_date` date NOT NULL,
  `comment_author` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment_email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment_text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment_status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_date`, `comment_author`, `comment_email`, `comment_text`, `comment_status`) VALUES
(4, 2, '2019-04-05', 'Tom', 'tom@mail.com', 'Faydalı bir yazı beğendim.', 'approved'),
(5, 2, '2019-04-05', 'Jerry', 'jerry@mail.com', 'İçerik çok kısıtlı genişletilmesi lazım.', 'unapproved'),
(6, 3, '2019-04-05', 'Lance', 'lance@mail.com', 'Süper bir yazı adamım.', 'approved'),
(7, 3, '2019-04-05', 'Diaz', 'diaz@mail.com', 'Bana hemen o Tommy denen adamı getirin.', 'unapproved'),
(8, 4, '2019-04-05', 'Jack', 'jack@mail.com', 'Border yapısının anlatıldığı güzel bir yapı olmuş.', 'approved');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `portfolios`
--

CREATE TABLE `portfolios` (
  `portfolio_id` int(5) NOT NULL,
  `portfolio_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `portfolio_category` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `portfolio_img_sm` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `portfolio_img_bg` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `portfolios`
--

INSERT INTO `portfolios` (`portfolio_id`, `portfolio_name`, `portfolio_category`, `portfolio_img_sm`, `portfolio_img_bg`) VALUES
(1, 'Şablon', 'Html', '05-thumbnail.jpg', '05-full.jpg'),
(2, 'Tasarım', 'Css', '02-thumbnail.jpg', '02-full.jpg'),
(3, 'Dinamiklik', 'Php', '03-thumbnail.jpg', '03-full.jpg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `post_category` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_author` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_date` date NOT NULL,
  `post_comment_number` int(10) NOT NULL,
  `post_image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_tags` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_hits` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `posts`
--

INSERT INTO `posts` (`post_id`, `post_category`, `post_title`, `post_author`, `post_date`, `post_comment_number`, `post_image`, `post_text`, `post_tags`, `post_hits`) VALUES
(2, 'Html', 'Html Classes', 'Mehmet Kaba', '2019-04-05', 8, 'blog1.jpg', 'Cras scelerisque malesuada nisi et molestie. Nam quis orci at ante suscipit maximus laoreet et quam. Aenean et felis sed erat rutrum efficitur. Praesent eget erat sit amet diam maximus posuere sed tempor augue. In hac habitasse platea dictumst. Donec auctor vehicula tristique. Aliquam orci nulla, pellentesque condimentum leo dapibus, pretium pretium felis. Donec sed ullamcorper purus. Integer venenatis, nisl quis pharetra fringilla, mi nibh blandit ipsum, sed auctor lectus sapien non nibh.', 'html, class', 4),
(3, 'Html', 'Html Tables', 'Mehmet Kaba', '2019-04-05', 8, 'blog1.jpg', 'Nulla placerat accumsan elit, vitae aliquam tellus laoreet et. Phasellus pharetra sapien eu lectus feugiat ornare. Donec ac scelerisque ex. Etiam ultrices varius lectus id elementum. Praesent velit velit, elementum et facilisis quis, pellentesque nec elit. Sed porta porta tempus. Mauris a consequat felis. Nunc vestibulum felis sed libero volutpat sagittis. Suspendisse tempus quis urna in aliquam. Cras commodo vestibulum lacus vitae tempor.', 'html, table', 6),
(4, 'Css', 'Css Border', 'W3School', '2019-04-05', 8, 'blog1.jpg', 'Ut quis fringilla nulla, non consequat ante. Nunc iaculis, eros et elementum sodales, nisl elit bibendum nibh, eget commodo leo neque quis quam. Morbi lorem augue, mattis eu leo at, rhoncus consectetur mauris. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec finibus, metus a congue scelerisque, lorem turpis ultrices quam, iaculis tincidunt est mi et ligula. Duis gravida facilisis fermentum. Donec sit amet nibh eget purus euismod dignissim in et leo. Sed euismod metus non aliquam ornare. Curabitur posuere massa sed tempus fringilla. Quisque vulputate augue commodo risus hendrerit pellentesque. Fusce et lorem ligula. Vivamus iaculis congue tortor, eget vulputate nulla semper eu. Aliquam congue laoreet tortor, eget placerat augue interdum in.', 'css, border', 2),
(5, 'Css', 'Css Margin', 'W3School', '2019-04-05', 8, 'blog1.jpg', 'Aliquam lacus felis, molestie in semper et, sodales ac est. Sed pellentesque maximus scelerisque. Morbi vitae faucibus massa. Maecenas facilisis porta posuere. Proin congue turpis ac ultricies mollis. Aenean est turpis, eleifend vel urna vel, maximus eleifend metus. Cras neque lectus, mattis sed mauris ultricies, faucibus eleifend purus. Etiam consectetur quis metus eu tincidunt. Donec lacinia quis nisi eu rutrum. Proin vulputate, odio nec pretium eleifend, ante velit maximus elit, et pulvinar est nulla sed lorem. Vivamus et tortor ornare, fringilla quam ac, rhoncus lorem. Proin laoreet lobortis erat eu placerat. Fusce et erat commodo nunc egestas finibus. Sed sodales lorem sit amet rutrum rhoncus.', 'css, margin', 0),
(6, 'Php', 'Php Delete', 'Mehmet Kaba', '2019-04-05', 8, 'blog1.jpg', 'Phasellus convallis arcu ac augue elementum viverra. In vestibulum sapien id sollicitudin tincidunt. Integer efficitur ornare ex quis sagittis. Maecenas neque leo, lacinia vel tempor vitae, fringilla sit amet metus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Pellentesque eu sollicitudin tortor, vitae malesuada nisl. Donec non lorem in lectus vehicula ullamcorper. Cras sed imperdiet urna. Aenean a est tincidunt, vestibulum magna vitae, dictum mauris.', 'php, delete', 0),
(7, 'Php', 'Php Update', 'Mehmet Kaba', '2019-04-05', 8, 'blog1.jpg', 'Praesent pulvinar, ligula non luctus ullamcorper, diam augue tempor nisl, rutrum congue nunc nunc non leo. Aenean mollis nibh nec orci tempus aliquam. Duis neque mi, accumsan nec tellus sit amet, tempor hendrerit libero. Donec gravida condimentum posuere. Donec metus orci, viverra quis orci eget, molestie lacinia ipsum. Aliquam laoreet ultricies pellentesque. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aliquam ac quam ornare, laoreet lacus eu, lobortis tellus. Morbi pulvinar enim non porta auctor.', 'php, update', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `user_id` int(3) NOT NULL,
  `user_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_password` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_email` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_role` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_password`, `user_email`, `user_role`) VALUES
(1, 'root', '1234', 'root@mail.com', 'admin');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Tablo için indeksler `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Tablo için indeksler `portfolios`
--
ALTER TABLE `portfolios`
  ADD PRIMARY KEY (`portfolio_id`);

--
-- Tablo için indeksler `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `portfolios`
--
ALTER TABLE `portfolios`
  MODIFY `portfolio_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
