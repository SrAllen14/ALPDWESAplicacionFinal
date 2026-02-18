-- Seleccionamos la base de datos en la que queremos trabajar --
USE DBALPDWESAplicacionFinal;


INSERT INTO T01_Usuario (T01_CodUsuario,T01_Password,T01_DescUsuario, T01_FechaHoraUltimaConexion, T01_Perfil, T01_ImagenUsuario) VALUES
('alvaroa',SHA2('alvaroapaso', 256),'Alvaro Allen',null,"usuario",null),
('alvarog',SHA2('alvarogpaso', 256),'Alvaro Garcia',null,"usuario",null),
('alejandro',SHA2('alejandropaso', 256),'Alejandro de la Huerga',null,"usuario",null),
('alberto',SHA2('albertopaso', 256),'Alberto Mendez',null,"usuario",null),
('cristian',SHA2('cristianpaso', 256),'Cristian Mateos',null,"usuario",null),
('jesus',SHA2('jesuspaso', 256), 'Jesus Temprano',null,"usuario",null),
('enrique',SHA2('enriquepaso', 256), 'Enrique Nieto',null,"usuario",null),
('gonzalo',SHA2('gonzalopaso', 256),'Gonzalo Junquera',null,"usuario",null),
('vero',SHA2('veropaso', 256),'Veronique Grue',null,"usuario",null),
('oscar',SHA2('oscarpaso',256),'Oscar Pozuelo',null,"usuario",null),
('amor',SHA2('amorpaso', 256),'Amor Rodriguez',null,"usuario",null),
('heraclio',SHA2('heracliopaso', 256),'Heraclio Borbujo',null,"usuario",null),
('antonio',SHA2('antoniopaso', 256),'Antonio Jañez',null,"usuario",null),
('jorge',SHA2('jorgepaso', 256),'Jorge Corral',null,"usuario",null),
('claudio',SHA2('claudiopaso', 256),'Claudio Lozano',null,"usuario",null),
('gisela',SHA2('giselapaso', 256),'Gisela Folgueral',null,"usuario",null),
('admin',SHA2('adminpaso', 256),'Administrador',null,"administrador",null);

-- Insertamos en la tabla correspondiente cada uno de los valores por cada columna --
INSERT INTO T02_Departamento VALUES
('DWE',NOW(), NULL,'Departamento Web Extinta',50.4),
('DWA',NOW(), NULL,'Departamento Web Americano',48.3),
('IPE',NOW(), NULL,'Itinerario Profesional Empleabilidad',78.0),
('DIW',NOW(), NULL,'Diseño Interno Wow',150.21),
('DAW',NOW(), NULL,'Dinosaurio Animal Wolframio',65.7);