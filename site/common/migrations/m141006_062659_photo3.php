<?php

class m141006_062659_photo3 extends CDbMigration
{
	public function up()
	{
        $this->execute("SET foreign_key_checks = 0;");

        $this->execute("DROP TABLE IF EXISTS `photo__attaches`;");
        $this->execute("DROP TABLE IF EXISTS `photo__collections`;");
        $this->execute("DROP TABLE IF EXISTS `photo__albums`;");
        $this->execute("DROP TABLE IF EXISTS `photo__photos`;");
        $this->execute("DROP TABLE IF EXISTS `photo__crops`;");

        $this->execute("CREATE TABLE `photo__photos` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `width` int(5) unsigned NOT NULL,
  `height` int(5) unsigned NOT NULL,
  `original_name` varchar(100) NOT NULL,
  `fs_name` varchar(100) NOT NULL DEFAULT '',
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `author_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`),
  CONSTRAINT `photo__photos_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
        $this->execute("CREATE TABLE `photo__albums` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `author_id` int(11) unsigned NOT NULL,
  `removed` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`),
  CONSTRAINT `photo__albums_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
        $this->execute("CREATE TABLE `photo__collections` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `entity` varchar(255) DEFAULT NULL,
  `entity_id` int(11) unsigned DEFAULT NULL,
  `key` varchar(255) DEFAULT '',
  `cover_id` int(11) unsigned DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `cover_id` (`cover_id`),
  CONSTRAINT `photo__collections_ibfk_1` FOREIGN KEY (`cover_id`) REFERENCES `photo__attaches` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
        $this->execute("CREATE TABLE `photo__attaches` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `photo_id` int(11) unsigned NOT NULL,
  `collection_id` int(11) unsigned NOT NULL,
  `position` int(11) unsigned NOT NULL DEFAULT '0',
  `data` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `removed` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `photo_id` (`photo_id`),
  KEY `collection_id` (`collection_id`),
  KEY `position` (`position`),
  CONSTRAINT `photo__attaches_ibfk_1` FOREIGN KEY (`photo_id`) REFERENCES `photo__photos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `photo__attaches_ibfk_2` FOREIGN KEY (`collection_id`) REFERENCES `photo__collections` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
        $this->execute("CREATE TABLE `photo__crops` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `x` smallint(5) unsigned NOT NULL,
  `y` smallint(5) unsigned NOT NULL,
  `w` smallint(5) unsigned NOT NULL,
  `h` smallint(5) unsigned NOT NULL,
  `photo_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `photo_id` (`photo_id`),
  CONSTRAINT `photo__crops_ibfk_1` FOREIGN KEY (`photo_id`) REFERENCES `photo__photos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
        $this->execute("SET foreign_key_checks = 1;");
	}

	public function down()
	{
		echo "m141006_062659_photo3 does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}