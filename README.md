# tmp-rest

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/ce754d5a-2cd4-4edc-a658-a47edbe1310c/big.png)](https://insight.sensiolabs.com/projects/ce754d5a-2cd4-4edc-a658-a47edbe1310c)
[![Build Status](https://travis-ci.org/angelk/tmp-rest.svg?branch=master)](https://travis-ci.org/angelk/tmp-rest)

Database settings are in `config/db.php`. See `config/db.php.dist` for example

Database init
```
CREATE TABLE `news` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `date` date NOT NULL,
  `text` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
ALTER TABLE `news`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
```
