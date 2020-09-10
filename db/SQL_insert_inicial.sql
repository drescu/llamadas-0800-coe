-- -----------------------------------------------------
-- Table `dbconsultas`.`usuarios`
-- -----------------------------------------------------
INSERT INTO dbconsultas.usuarios(idusuario,user,clave,nombre,apellido,email,telefono,tipo_doc,numero_doc,turno,condicion) VALUES (1,'diego','123','Diego','Escudero','drescu@gmail.com','3804496215','DNI','27451387','M',1);



-- -----------------------------------------------------
-- Table `dbconsultas`.`permisos`
-- -----------------------------------------------------

INSERT INTO dbconsultas.permisos(idpermiso,nombre) VALUES (1,'Escritorio');
INSERT INTO dbconsultas.permisos(idpermiso,nombre) VALUES (2,'Salud');
INSERT INTO dbconsultas.permisos(idpermiso,nombre) VALUES (3,'Asistencia');
INSERT INTO dbconsultas.permisos(idpermiso,nombre) VALUES (4,'Asesoramiento Legal');
INSERT INTO dbconsultas.permisos(idpermiso,nombre) VALUES (5,'Transporte');
INSERT INTO dbconsultas.permisos(idpermiso,nombre) VALUES (6,'Información General');
INSERT INTO dbconsultas.permisos(idpermiso,nombre) VALUES (7,'Accesos');


-- -----------------------------------------------------
-- Table `dbconsultas`.`tipos_consultas`
-- -----------------------------------------------------

INSERT INTO dbconsultas.tipos_consultas(idtipoconsulta,idpermiso,nombre) VALUES (1,2,'Certificado alta');
INSERT INTO dbconsultas.tipos_consultas(idtipoconsulta,idpermiso,nombre) VALUES (2,2,'Certificado Sisa');
INSERT INTO dbconsultas.tipos_consultas(idtipoconsulta,idpermiso,nombre) VALUES (3,2,'Certificado aislamiento');
INSERT INTO dbconsultas.tipos_consultas(idtipoconsulta,idpermiso,nombre) VALUES (4,2,'Certificado cumplimiento de cuarentena');
INSERT INTO dbconsultas.tipos_consultas(idtipoconsulta,idpermiso,nombre) VALUES (5,2,'Solicita hisopado');
INSERT INTO dbconsultas.tipos_consultas(idtipoconsulta,idpermiso,nombre) VALUES (6,2,'Derivación a 107');
INSERT INTO dbconsultas.tipos_consultas(idtipoconsulta,idpermiso,nombre) VALUES (7,2,'Seguimiento médico');
INSERT INTO dbconsultas.tipos_consultas(idtipoconsulta,idpermiso,nombre) VALUES (8,2,'Donación de plasma');
INSERT INTO dbconsultas.tipos_consultas(idtipoconsulta,idpermiso,nombre) VALUES (9,2,'Falta de atención nosocomial');
INSERT INTO dbconsultas.tipos_consultas(idtipoconsulta,idpermiso,nombre) VALUES (10,2,'Otras');
INSERT INTO dbconsultas.tipos_consultas(idtipoconsulta,idpermiso,nombre) VALUES (11,3,'Primera asistencia');
INSERT INTO dbconsultas.tipos_consultas(idtipoconsulta,idpermiso,nombre) VALUES (12,3,'Alimentos');
INSERT INTO dbconsultas.tipos_consultas(idtipoconsulta,idpermiso,nombre) VALUES (13,3,'Medicación');
INSERT INTO dbconsultas.tipos_consultas(idtipoconsulta,idpermiso,nombre) VALUES (14,3,'Limpieza');
INSERT INTO dbconsultas.tipos_consultas(idtipoconsulta,idpermiso,nombre) VALUES (15,3,'Gas');
INSERT INTO dbconsultas.tipos_consultas(idtipoconsulta,idpermiso,nombre) VALUES (16,3,'Otras');
INSERT INTO dbconsultas.tipos_consultas(idtipoconsulta,idpermiso,nombre) VALUES (17,4,'Familiar');
INSERT INTO dbconsultas.tipos_consultas(idtipoconsulta,idpermiso,nombre) VALUES (18,4,'Laboral');
INSERT INTO dbconsultas.tipos_consultas(idtipoconsulta,idpermiso,nombre) VALUES (19,4,'Otras');
INSERT INTO dbconsultas.tipos_consultas(idtipoconsulta,idpermiso,nombre) VALUES (20,5,'1-Requisitos y permisos de ingreso/egreso a la provincia de vehículos particulares');
INSERT INTO dbconsultas.tipos_consultas(idtipoconsulta,idpermiso,nombre) VALUES (21,5,'2-Permisos para transportes de carga');
INSERT INTO dbconsultas.tipos_consultas(idtipoconsulta,idpermiso,nombre) VALUES (22,5,'3-Empadronamiento de transportes de cargas provinciales');
INSERT INTO dbconsultas.tipos_consultas(idtipoconsulta,idpermiso,nombre) VALUES (23,5,'4-Requisitos y permisos de ingreso para empresas subcontratistas que deben realizar trabajos en la provincia');
INSERT INTO dbconsultas.tipos_consultas(idtipoconsulta,idpermiso,nombre) VALUES (24,5,'5-Permisos de circulación interdepartamental');
INSERT INTO dbconsultas.tipos_consultas(idtipoconsulta,idpermiso,nombre) VALUES (25,5,'6-Números de contacto de empresas de transporte habilitadas para servicios de paquetería/encomienda');
INSERT INTO dbconsultas.tipos_consultas(idtipoconsulta,idpermiso,nombre) VALUES (26,5,'7-Horario de atención de la Oficina de Informes');
INSERT INTO dbconsultas.tipos_consultas(idtipoconsulta,idpermiso,nombre) VALUES (27,5,'8-Permiso de circulación para caminos rurales dentro del departamento capital');
