CREATE TABLE IF NOT EXISTS `#__producthightlights_config` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `template` varchar(0) NOT NULL,
  `params` text NOT NULL,
  PRIMARY KEY (`id`)
) DEFAULT COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__producthightlights` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `position` text NOT NULL,
  `created` datetime NOT NULL,
  `popupinfo` text NOT NULL,
  `params` text NOT NULL,
  `state` tinyint(1) NOT NULL,
    PRIMARY KEY (`id`)
) DEFAULT COLLATE=utf8_general_ci;