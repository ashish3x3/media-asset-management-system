

CREATE TABLE IF NOT EXISTS `tag` (
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `tag` (`name`, `url`) VALUES
('yii-cuulus', 'http://code.google.com/p/yii-cumulus/'),
('wp-cumulus',  'http://wordpress.org/extend/plugins/wp-cumulus/');
