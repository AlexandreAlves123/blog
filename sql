DROP DATABASE IF exists blog;
create database if not exists blog;
use blog;

CREATE TABLE usuario (
    id INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(50) NOT NULL,
    email VARCHAR(255) NOT NULL,
    senha VARCHAR(60) NOT NULL,
    data_criacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    ativo TINYINT NOT NULL DEFAULT '0',
    adm TINYINT NOT NULL DEFAULT '0',
    PRIMARY KEY (id)
);

CREATE TABLE post (
    id INT NOT NULL AUTO_INCREMENT,
    titulo VARCHAR(255) NOT NULL,
    texto TEXT NOT NULL,
    usuario_id INT NOT NULL,
    data_criacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    data_postagem DATETIME NOT NULL,
    PRIMARY KEY (id),
    KEY fk_post_usuario_idx (usuario_id),
    CONSTRAINT fk_post_usuario FOREIGN KEY (usuario_id) REFERENCES usuario (id)
);