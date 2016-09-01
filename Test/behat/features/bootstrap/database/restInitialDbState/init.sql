DROP TABLE IF EXISTS `news`;

CREATE TABLE `news` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `date` date NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `news` (`id`, `title`, `date`, `text`) VALUES
(1, 'title 1', '2016-08-31', 'testText');

ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `news`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
