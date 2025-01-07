CREATE DATABASE vroom;

USE vroom;


CREATE TABLE `categories` (
    `id_categorie` INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,  
    `nom` VARCHAR(255) NOT NULL,                                
    `description` TEXT DEFAULT NULL,                                                     
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,             
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP 
);


CREATE TABLE `vehicules` (
    `id_vehicule` INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `nom_vehicule` VARCHAR(255) NOT NULL,                             
    `description` TEXT DEFAULT NULL,
    `fuel_economy` VARCHAR(45) NOT NULL,               
    `price` VARCHAR(35) NOT NULL,
    `features` VARCHAR(100) DEFAULT NULL,            
    `vehicule_image` VARCHAR(255) DEFAULT NULL,
    FOREIGN KEY (`id_categorie_fk`) REFERENCES `categories`(`id_categorie`) ON DELETE CASCADE ON UPDATE CASCADE 
);


CREATE TABLE `roles` (
    `id_role` INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,     
    `role` ENUM('admin', 'user') DEFAULT 'user', 
);


CREATE TABLE `users` (    
    `id_user` INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `fullname` VARCHAR(255) NOT NULL,                         
    `email` VARCHAR(255) NOT NULL UNIQUE,                   
    `mot_de_passe` VARCHAR(255) NOT NULL,                                                                    
    `id_role_fk` INT(11) NOT NULL,
    FOREIGN KEY (`id_role_fk`) REFERENCES `roles`(`id_role`) ON DELETE CASCADE ON UPDATE CASCADE 
);


CREATE TABLE `reservations` (
    `id_reservation` INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,  
    `id_user_fk` INT(11) NOT NULL,                                 
    `id_vehicule_fk` INT(11) NOT NULL,                                                                                                                          
    `date_creation` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,                                                                  
    FOREIGN KEY (`id_user_fk`) REFERENCES `users`(`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,  
    FOREIGN KEY (`id_vehicule_fk`) REFERENCES `vehicules`(`id_vehicule`) ON DELETE CASCADE ON UPDATE CASCADE 
);


CREATE TABLE `reviews` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,                
    `id_user_fk` INT NOT NULL,                              
    `id_vehicule_fk` INT NOT NULL,                               
    `comment` TEXT,                                      
    FOREIGN KEY (`id_user_fk`) REFERENCES `users`(`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,  
    FOREIGN KEY (`id_vehicule_fk`) REFERENCES `vehicules`(`id_vehicule`) ON DELETE CASCADE ON UPDATE CASCADE 
);


CREATE TABLE `statistiques` (
    `id_statistique` INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL, 
    `total_clients` INT(11) DEFAULT 0,
    `total_categories` INT(11) DEFAULT 0,               
    `total_vehicules` INT(11) DEFAULT 0,               
    `total_reservations` INT(11) DEFAULT 0,                             
    `reservations_terminee` INT(11) DEFAULT 0,                             
);



CREATE TABLE `articles` (
    `id_article` INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `id_user_fk` INT(11) NOT NULL,
    `titre` VARCHAR(255) NOT NULL,
    `contenu` TEXT NOT NULL,
    `images` TEXT DEFAULT NULL,
    `videos` TEXT DEFAULT NULL, 
    `statut` ENUM('en_attente', 'approuve', 'rejete') DEFAULT 'en_attente', 
    `date_creation` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `date_publication` TIMESTAMP NULL DEFAULT NULL,
    FOREIGN KEY (`id_user_fk`) REFERENCES `users`(`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE `tags` (
    `id_tag` INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `nom_tag` VARCHAR(255) NOT NULL
);



CREATE TABLE `article_tags` (
    `id_article` INT(11) NOT NULL,
    `id_tag` INT(11) NOT NULL,
    PRIMARY KEY (`id_article`, `id_tag`),
    FOREIGN KEY (`id_article`) REFERENCES `articles`(`id_article`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`id_tag`) REFERENCES `tags`(`id_tag`) ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE `commentaires` (
    `id_commentaire` INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `id_article_fk` INT(11) NOT NULL,
    `id_user_fk` INT(11) NOT NULL,
    `contenu` TEXT NOT NULL,
    `date_creation` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`id_article_fk`) REFERENCES `articles`(`id_article`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`id_user_fk`) REFERENCES `users`(`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE `favoris` (
    `id_favori` INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `id_user_fk` INT(11) NOT NULL,
    `id_article_fk` INT(11) NOT NULL,
    `date_ajout` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`id_user_fk`) REFERENCES `users`(`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`id_article_fk`) REFERENCES `articles`(`id_article`) ON DELETE CASCADE ON UPDATE CASCADE
);







