-- Seleccionamos la base de datos en la que queremos trabajar --
USE DBALPDWESLoginLogoff;


INSERT INTO T01_Usuario (T01_CodUsuario,T01_Password,T01_DescUsuario, T01_FechaHoraUltimaConexion, T01_ImagenUsuario) VALUES
('alvaroa',SHA2('alvaroapaso', 256),'Alvaro Allen',null,null),
('alvarog',SHA2('alvarogpaso', 256),'Alvaro Garcia',null,null),
('alejandro',SHA2('alejandropaso', 256),'Alejandro de la Huerga',null,null),
('alberto',SHA2('albertopaso', 256),'Alberto Mendez',null,null),
('cristian',SHA2('cristianpaso', 256),'Cristian Mateos',null,null),
('jesus',SHA2('jesuspaso', 256), 'Jesus Temprano',null,null),
('enrique',SHA2('enriquepaso', 256), 'Enrique Nieto',null,null),
('gonzalo',SHA2('gonzalopaso', 256),'Gonzalo Junquera',null,null),
('vero',SHA2('veropaso', 256),'Veronique Grue',null,null),
('oscar',SHA2('oscarpaso',256),'Oscar Pozuelo',null,null),
('amor',SHA2('amorpaso', 256),'Amor Rodriguez',null,null),
('heraclio',SHA2('heracliopaso', 256),'Heraclio Borbujo',null,null),
('antonio',SHA2('antoniopaso', 256),'Antonio Jañez',null,null),
('jorge',SHA2('jorgepaso', 256),'Jorge Corral',null,null),
('claudio',SHA2('claudiopaso', 256),'Claudio Lozano',null,null),
('gisela',SHA2('giselapaso', 256),'Gisela Folgueral',null,null),
('admin',SHA2('adminpaso', 256),'Administrador',null,null);

-- Insertamos en la tabla correspondiente cada uno de los valores por cada columna --
INSERT INTO T02_Departamento VALUES
('DWE',NOW(), NULL,'Departamento Web Extinta',50.4),
('DWA',NOW(), NULL,'Departamento Web Americano',48.3),
('IPE',NOW(), NULL,'Itinerario Profesional Empleabilidad',78.0),
('DIW',NOW(), NULL,'Diseño Interno Wow',150.21),
('DAW',NOW(), NULL,'Dinosaurio Animal Wolframio',65.7);