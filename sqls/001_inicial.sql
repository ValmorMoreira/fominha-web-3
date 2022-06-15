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

insert into usuarios (nome, email, senha) VALUES ('Valmor', 'valmor@teste.com','$2y$10$6TKtd8NwIExAIAS0vWIsUeKOP5Sr1zj0Fvt9DXYqgG2Wl8lXH8GOy');
insert into usuarios (nome, email, senha) VALUES ('Admin', 'admin@teste.com','$2y$10$6TKtd8NwIExAIAS0vWIsUeKOP5Sr1zj0Fvt9DXYqgG2Wl8lXH8GOy');

insert into receitas (nome,categoria,ingredientes,modo_de_preparo,data_receita,usuario_id) values ('carne de panela','carnes', 'Carne bovina em cubos', 'Cortar tudo e meter fogo na chapa', '2022-05-01', 1);
insert into receitas (nome,categoria,ingredientes,modo_de_preparo,data_receita,usuario_id) values ('buchada de bode','carnes', 'Carne de primeira essa', 'Cortar tudo e meter fogo na chapa', '2022-05-21', 1);
insert into receitas (nome,categoria,ingredientes,modo_de_preparo,data_receita,usuario_id) values ('sorvete','sobremesas', 'chocolate, leite em pó', 'bater tudo no liquidificador e beber gelado', '2022-04-20', 2);