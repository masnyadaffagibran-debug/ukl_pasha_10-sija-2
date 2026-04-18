CREATE DATABASE museum;
USE museum;

CREATE TABLE user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(100) NOT NULL,
    profile_picture VARCHAR(100) DEFAULT 'default.png',
    bio TEXT
);

CREATE TABLE budaya (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT,
    judul VARCHAR(100),
    deskripsi TEXT,
    gambar_url VARCHAR(100),
    FOREIGN KEY (id_user) REFERENCES user(id)
    ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE likes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT,
    id_budaya INT,
    FOREIGN KEY (id_user) REFERENCES user(id)
    ON DELETE CASCADE,
    FOREIGN KEY (id_budaya) REFERENCES budaya(id)
    ON DELETE CASCADE
);

-- biar gak double like
ALTER TABLE likes ADD UNIQUE (id_user, id_budaya);

CREATE TABLE komentar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT,
    id_budaya INT,
    isi TEXT,
    waktu DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_user) REFERENCES user(id)
    ON DELETE CASCADE,
    FOREIGN KEY (id_budaya) REFERENCES budaya(id)
    ON DELETE CASCADE
);

CREATE TABLE follow (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT,
    id_follower INT,
    waktu DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_user) REFERENCES user(id)
    ON DELETE CASCADE,
    FOREIGN KEY (id_follower) REFERENCES user(id)
    ON DELETE CASCADE
);