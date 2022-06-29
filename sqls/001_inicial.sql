CREATE DATABASE fominha COLLATE 'utf8_unicode_ci';

USE fominha;

CREATE TABLE usuarios (
    id INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR (255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha VARCHAR(60) NOT NUll,
    PRIMARY KEY (id)
)
ENGINE = InnoDB;

CREATE TABLE receitas (
    id INT NOT NULL AUTO_INCREMENT,
    usuario_id INT NOT NULL,
    nome VARCHAR(255) NOT NULL,
    categoria VARCHAR (50) NOT NULL,
    ingredientes TEXT NOT NULL,
    modo_de_preparo TEXT NOT NULL,
    data_receita TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios (id) ON DELETE CASCADE
)
ENGINE = InnoDB;

CREATE TABLE comentarios (
    id INT NOT NULL AUTO_INCREMENT,
    usuario_id INT NOT NULL,
    receita_id INT NOT NULL,
    comentario TEXT NOT NULL,
    data_comentario TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios (id) ON DELETE CASCADE,
    FOREIGN KEY (receita_id) REFERENCES receitas (id) ON DELETE CASCADE
)
ENGINE = InnoDB;