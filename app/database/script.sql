CREATE TABLE `articles` (
  `id_article` int(11) NOT NULL AUTO_INCREMENT,
  `id_blog_fk` int(11) NOT NULL,
  `id_user_fk` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `contenu` text NOT NULL,
  `images` text DEFAULT NULL,
  `videos` text DEFAULT NULL,
  `statut` enum('en_attente','approuve','rejete') DEFAULT 'en_attente',
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_publication` timestamp NULL DEFAULT NULL,   
  PRIMARY KEY (`id_article`),
  KEY `id_blog_fk` (`id_blog_fk`),
  KEY `id_user_fk` (`id_user_fk`),
  CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`id_blog_fk`) REFERENCES `blogs` (`id_blog`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `articles_ibfk_2` FOREIGN KEY (`id_user_fk`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `article_tags` (
  `id_article` int(11) NOT NULL,
  `id_tag` int(11) NOT NULL,
  PRIMARY KEY (`id_article`,`id_tag`),
  KEY `id_tag` (`id_tag`),
  CONSTRAINT `article_tags_ibfk_1` FOREIGN KEY (`id_article`) REFERENCES `articles` (`id_article`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `article_tags_ibfk_2` FOREIGN KEY (`id_tag`) REFERENCES `tags` (`id_tag`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `blogs` (
  `id_blog` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp(),
  `blog_img` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_blog`)
);

CREATE TABLE `categories` (
  `id_categorie` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_categorie`)
);

CREATE TABLE `commentaires` (
  `id_commentaire` int(11) NOT NULL AUTO_INCREMENT,
  `id_article_fk` int(11) NOT NULL,
  `id_user_fk` int(11) NOT NULL,
  `contenu` text NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_commentaire`),
  KEY `id_article_fk` (`id_article_fk`),
  KEY `id_user_fk` (`id_user_fk`),
  CONSTRAINT `commentaires_ibfk_1` FOREIGN KEY (`id_article_fk`) REFERENCES `articles` (`id_article`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `commentaires_ibfk_2` FOREIGN KEY (`id_user_fk`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `favoris` (
  `id_favori` int(11) NOT NULL AUTO_INCREMENT,
  `id_user_fk` int(11) NOT NULL,
  `id_article_fk` int(11) NOT NULL,
  `date_ajout` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_favori`),
  KEY `id_user_fk` (`id_user_fk`),
  KEY `id_article_fk` (`id_article_fk`),
  CONSTRAINT `favoris_ibfk_1` FOREIGN KEY (`id_user_fk`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `favoris_ibfk_2` FOREIGN KEY (`id_article_fk`) REFERENCES `articles` (`id_article`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `reservations` (
  `id_reservation` int(11) NOT NULL AUTO_INCREMENT,
  `id_user_fk` int(11) NOT NULL,
  `id_vehicule_fk` int(11) NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_reservation`),
  KEY `id_user_fk` (`id_user_fk`),
  KEY `id_vehicule_fk` (`id_vehicule_fk`),
  CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`id_user_fk`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`id_vehicule_fk`) REFERENCES `vehicules` (`id_vehicule`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user_fk` int(11) NOT NULL,
  `id_vehicule_fk` int(11) NOT NULL,
  `comment` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user_fk` (`id_user_fk`),
  KEY `id_vehicule_fk` (`id_vehicule_fk`),
  CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`id_user_fk`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`id_vehicule_fk`) REFERENCES `vehicules` (`id_vehicule`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `roles` (
  `id_role` int(11) NOT NULL AUTO_INCREMENT,
  `role` enum('admin','user') DEFAULT 'user',
  PRIMARY KEY (`id_role`)
);

CREATE TABLE `statistiques` (
  `id_statistique` int(11) NOT NULL AUTO_INCREMENT,
  `total_clients` int(11) DEFAULT 0,
  `total_categories` int(11) DEFAULT 0,
  `total_vehicules` int(11) DEFAULT 0,
  `total_reservations` int(11) DEFAULT 0,
  `reservations_terminee` int(11) DEFAULT 0,
  PRIMARY KEY (`id_statistique`)
);

CREATE TABLE `tags` (
  `id_tag` int(11) NOT NULL AUTO_INCREMENT,
  `nom_tag` varchar(255) NOT NULL,
  PRIMARY KEY (`id_tag`)
);

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `id_role_fk` int(11) NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `email` (`email`),
  KEY `id_role_fk` (`id_role_fk`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_role_fk`) REFERENCES `roles` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `vehicules` (
  `id_vehicule` int(11) NOT NULL AUTO_INCREMENT,
  `nom_vehicule` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `fuel_economy` varchar(45) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `features` varchar(100) DEFAULT NULL,
  `vehicule_image` varchar(255) DEFAULT NULL,
  `id_categorie_fk` int(11) NOT NULL,
  PRIMARY KEY (`id_vehicule`),
  KEY `id_categorie_fk` (`id_categorie_fk`),
  CONSTRAINT `vehicules_ibfk_1` FOREIGN KEY (`id_categorie_fk`) REFERENCES `categories` (`id_categorie`) ON DELETE CASCADE ON UPDATE CASCADE
);
