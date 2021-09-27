

/*
    USERS DATA

*/
-- users (main registre)
CREATE TABLE IF NOT EXISTS users (
    `id` INT(32) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `login` VARCHAR(50) UNIQUE,         -- hidden
    `password` VARCHAR(150),
    `status` VARCHAR(250) NOT NULL DEFAULT 'guest'
    `groups` VARCHAR(250) NOT NULL DEFAULT 'guest'
) COLLATE utf8mb4_general_ci CHARACTER SET utf8mb4;;

-- user leta data
CREATE TABLE IF NOT EXISTS users_metas (
    `id` INT(32) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `usersid` INT(32) NOT NULL UNIQUE KEY,
    `pseudo` VARCHAR(50) UNIQUE,        -- visible for all
    `email` VARCHAR(250),
    `avatar` VARCHAR(250),
    FOREIGN KEY (usersid) REFERENCES users(id)
    ON UPDATE CASCADE
    ON DELETE CASCADE
) COLLATE utf8mb4_general_ci CHARACTER SET utf8mb4;

-- user token
CREATE TABLE IF NOT EXISTS users_tokens (
    `id` INT(32) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `usersid` INT(32) NOT NULL UNIQUE,
    `token` VARCHAR(250) NOT NULL,
    `expire` DATETIME NOT NULL,
    FOREIGN KEY (usersid) REFERENCES users(id)
    ON UPDATE CASCADE
    ON DELETE CASCADE
) COLLATE utf8mb4_general_ci CHARACTER SET utf8mb4;;


/*
    Grants
*/
-- CREATE TABLE IF NOT EXISTS grants (
--     `id` INT(32) NOT NULL PRIMARY KEY AUTO_INCREMENT,
--     `name` VARCHAR(50) NOT NULL,
--     `rights` JSON
--     FOREIGN KEY (ownerid) REFERENCES users(id)
--         ON UPDATE CASCADE
--         ON DELETE CASCADE
-- ) COLLATE utf8mb4_general_ci CHARACTER SET utf8mb4;

/*
    Group ID
*/
-- CREATE TABLE IF NOT EXISTS groups (
--     `id` INT(32) NOT NULL PRIMARY KEY AUTO_INCREMENT,
--     `ownerid` INT(32) NOT NULL UNIQUE KEY,
--     `name` VARCHAR(50) NOT NULL,
--     FOREIGN KEY (ownerid) REFERENCES users(id)
--         ON UPDATE CASCADE
--         ON DELETE CASCADE
-- ) COLLATE utf8mb4_general_ci CHARACTER SET utf8mb4;


/*
    PAGES DATA

*/
-- pages (main registre)
CREATE TABLE IF NOT EXISTS pages (
    `id` INT(32) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `filename` VARCHAR(255) NOT NULL,
    `title` VARCHAR(250),
    `content` TEXT,
    `baneer` INT(32) NOT NULL,
    FOREIGN KEY (baneer) REFERENCES medias(id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) COLLATE utf8mb4_general_ci CHARACTER SET utf8mb4;

-- pages metas data
CREATE TABLE IF NOT EXISTS pages_metas (
    `id` INT(32) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `pagesid` INT(32) NOT NULL UNIQUE KEY,
    `ownerid` INT(32) NOT NULL UNIQUE KEY,
    `groupid` INT(32) NOT NULL UNIQUE KEY,
    `keywords` TEXT,
    `creation` DATETIME,
    `modification` DATETIME,
    FOREIGN KEY (pagesid) REFERENCES pages(id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
    FOREIGN KEY (ownerid) REFERENCES users(id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) COLLATE utf8mb4_general_ci CHARACTER SET utf8mb4;

--
CREATE TABLE IF NOT EXISTS medias (
    `id` INT(32) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `ownerid` INT(32) NOT NULL UNIQUE KEY,
    `filename` varchar(500),
) COLLATE utf8mb4_general_ci CHARACTER SET utf8mb4;


-- CREATE PROCEDURE
-- BEGIN users_get_list_users()
--     SELECT login, email, FROM users_metas 
--         LEFT JOIN users ON
--     WHERE ;
-- END

-- CREATE PROCEDURE
-- BEGIN get_public_page(name)
--     SELECT login, email, FROM users_metas 
--         LEFT JOIN users ON
--     WHERE ;
-- END

// 4YjYePmjCud5V9u3kY