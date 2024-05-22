CREATE DATABASE SistemaSwc;
USE SistemaSwc;

CREATE TABLE medicoes (
    id_medicao INT AUTO_INCREMENT,
    litroMinuto DECIMAL(4,2),
    data_hora DATETIME,
    PRIMARY KEY (id_medicao)
);

CREATE TABLE usuarios (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Nome VARCHAR(100),
    Email VARCHAR(100) UNIQUE,
    Senha VARCHAR(255)
);