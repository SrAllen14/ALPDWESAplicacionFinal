
/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Other/SQLTemplate.sql to edit this template
 */
/**
 * Author:  alvaro.allper.1
 * Created: 30 oct. 2025
 */


-- Creación de la base de datos en caso de que no exista --
CREATE DATABASE IF NOT EXISTS DBALPDWESLoginLogoff;

-- Seleccionamos la base de datos para poder trabajar en ella --
USE DBALPDWESLoginLogoff;

--Creamos, en caso de que no exista, la tabla y dentro cada campo con el tipo de valor correspondiente --
CREATE TABLE IF NOT EXISTS T01_Usuario(
    T01_CodUsuario VARCHAR(16) PRIMARY KEY,
    T01_Password VARCHAR(255),
    T01_DescUsuario VARCHAR(255),
    T01_NumConexiones INT DEFAULT 0,
    T01_FechaHoraUltimaConexion DATETIME,
    T01_Perfil VARCHAR(10) DEFAULT "usuario",
    T01_ImagenUsuario VARCHAR(255)
) engine=innodb;


--Creamos, en caso de que no exista, la tabla y dentro cada campo con el tipo de valor correspondiente --
CREATE TABLE IF NOT EXISTS T02_Departamento(
    T02_CodDepartamento VARCHAR(3) PRIMARY KEY,         /* Primary key: (varchar(3)) Codigo de cada departamento en mayúscula */
    T02_FechaCreacionDepartamento DATETIME,             /* (DateTime) Fecha de creación del departamento */
    T02_FechaBajaDepartamento DATETIME,                 /* (DateTime) Fecha de baja del departamento */
    T02_DescDepartamento VARCHAR(255),                  /* (varchar(255)) Descripción breve de cada departamento */
    T02_VolumenDeNegocio FLOAT                          /* (float) Volumen que ocupa cada departamento */
) engine = innodb;


-- Creamos el usuario que se va a encargar de gestionar toda la base de datos --
CREATE USER IF NOT EXISTS 'userALPDWESLoginLogoff'@'%' IDENTIFIED BY 'paso';

-- Le damos privilegios completos para poder crear, insertar, borrar y modificar tablas y datos --
GRANT ALL ON DBALPDWESLoginLogoff.* TO 'userALPDWESLoginLogoff'@'%';
