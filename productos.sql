CREATE DATABASE IF NOT EXISTS mercado;
USE mercado;

CREATE TABLE producto (
    id_producto INT PRIMARY KEY AUTO_INCREMENT,
    producto VARCHAR(255),
    categoria Varchar(255),
    precio INT,
    stock INT
);