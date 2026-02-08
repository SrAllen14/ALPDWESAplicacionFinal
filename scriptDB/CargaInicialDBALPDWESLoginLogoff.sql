-- Seleccionamos la base de datos en la que queremos trabajar --
USE DBALPDWESAplicacionFinal;


INSERT INTO T01_Usuario (T01_CodUsuario,T01_Password,T01_DescUsuario, T01_FechaHoraUltimaConexion, T01_FechaHoraUltimaConexionAnterior, T01_Perfil, T01_ImagenUsuario) VALUES
('alvaroa',SHA2('alvaroapaso', 256),'Alvaro Allen',null,null,"usuario",null),
('alvarog',SHA2('alvarogpaso', 256),'Alvaro Garcia',null,null,"usuario",null),
('alejandro',SHA2('alejandropaso', 256),'Alejandro de la Huerga',null,null,"usuario",null),
('alberto',SHA2('albertopaso', 256),'Alberto Mendez',null,null,"usuario",null),
('cristian',SHA2('cristianpaso', 256),'Cristian Mateos',null,null,"usuario",null),
('jesus',SHA2('jesuspaso', 256), 'Jesus Temprano',null,null,"usuario",null),
('enrique',SHA2('enriquepaso', 256), 'Enrique Nieto',null,null,"usuario",null),
('gonzalo',SHA2('gonzalopaso', 256),'Gonzalo Junquera',null,null,"usuario",null),
('vero',SHA2('veropaso', 256),'Veronique Grue',null,null,"usuario",null),
('oscar',SHA2('oscarpaso',256),'Oscar Pozuelo',null,null,"usuario",null),
('amor',SHA2('amorpaso', 256),'Amor Rodriguez',null,null,"usuario",null),
('heraclio',SHA2('heracliopaso', 256),'Heraclio Borbujo',null,null,"usuario",null),
('antonio',SHA2('antoniopaso', 256),'Antonio Jañez',null,null,"usuario",null),
('jorge',SHA2('jorgepaso', 256),'Jorge Corral',null,null,"usuario",null),
('claudio',SHA2('claudiopaso', 256),'Claudio Lozano',null,null,"usuario",null),
('gisela',SHA2('giselapaso', 256),'Gisela Folgueral',null,null,"usuario",null),
('admin',SHA2('adminpaso', 256),'Administrador',null,null,"administrador",null);

-- Insertamos en la tabla correspondiente cada uno de los valores por cada columna --
INSERT INTO T02_Departamento VALUES
('DWE',NOW(), NULL,'Departamento Web Extinta',50.4),
('DWA',NOW(), NULL,'Departamento Web Americano',48.3),
('IPE',NOW(), NULL,'Itinerario Profesional Empleabilidad',78.0),
('DIW',NOW(), NULL,'Diseño Interno Wow',150.21),
('DAW',NOW(), NULL,'Dinosaurio Animal Wolframio',65.7);