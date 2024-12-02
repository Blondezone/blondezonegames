CREATE DATABASE blondezone;
USE blondezone;

CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
);

CREATE TABLE admins (
    id_admin INT AUTO_INCREMENT PRIMARY KEY,
    adm VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
);


CREATE TABLE jogos (
    id_jogo INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    link varchar(255) not null,
    descricao TEXT NOT NULL,
    id_admin int,
    foreign key (id_admin) references admins(id_admin)
);