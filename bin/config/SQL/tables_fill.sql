-- INSERTA LOS NIVELES DE USUARIO
INSERT INTO rol(nombre, status) VALUES ('Administrador', '1'), ('Gerente', '1'), ('Empleado', '1'), ('Cliente', '1');


-- INSERTA USUARIO ADMIN

INSERT INTO usuario (cedula, nombre, apellido, correo, password, rol, img, status) VALUES
('O9OnH0ox4pHUYNZMrowa2Q==', 'Admin', 'Admin', 'mE/+zG67/LRq502a/iv4tA==', '$2y$10$Vt8b5Zt/dgSIUliGJjavhOry4AHII29ercr1UYgGKDRUXz9P8SN8G', 1, NULL, 1);

-- INSERTA LOS CLIENTES
INSERT INTO `cliente` (`cedula`, `nombre`, `apellido`, `direccion`, `status`) VALUES
('TBaiIL0EALWh6IxCa82CfA==', 'Enmanuel', 'Torres', 'rzArk3I23XwqgwUDHhzexA==', 1),
('Wc5p28Squ4mTK6V8vwTR9g==', 'Victor', 'Aparicio', 'clrTuFnbO7r7OLQDgf6Bh6xsSCMrUioDnfusyjtP+UQ=', 1);

INSERT INTO `contacto_cliente` (`id_contacto`, `celular`, `correo`, `cedula`) VALUES
(8, '2aSsphNvB36CGNEcGt/5cQ==', '9DZpftZ41fxUgRZVogn2rnkPBx0BRoCbT6A+OyvHkM4=', 'TBaiIL0EALWh6IxCa82CfA=='),
(12, 'a8P9MkPxm5RswuoG5BSKgA==', 'J11iIVTypBDoUXCxXxoSDPiwFZrX61qgWWc/WykJFKM=', 'Wc5p28Squ4mTK6V8vwTR9g==');


-- INSERTA LOS LABORATORIOS
INSERT INTO laboratorio(cod_lab, rif, direccion, razon_social, status) VALUES 
('4f6190a911', 0000000,'ninguno','NO ASIGNADO',1),
('8fcfd29ec4', 1234567,'Av. Venezuela','MedicalCare',1),
('8b30f37b1e', 7788564,'Pueblo Nuevo','Bayer',1),
('f4babfcd83', 2394739,'Pueblo Nuevo','Geven',1);

INSERT INTO contacto_lab (telefono, contacto, cod_lab) VALUES 
('0251939333', NULL, '8fcfd29ec4'), ('04128883131', NULL, '8b30f37b1e'), ('02510503132', NULL, 'f4babfcd83');

-- INSERTA LAS PROVEEDOR
INSERT INTO proveedor(rif, direccion, razon_social, status) VALUES 
(12345678,'Av.Venezuela','DroNena',1),
(34534565,'Pueblo Nuevo','DroAra',1),
(12232432,'Centro','DroNose',1);

INSERT INTO contacto_prove (telefono, contacto, cod_prove) VALUES 
('02513993323', NULL, '1'), ('0412949331', NULL, '2'), ('02519393888', 'drogueriaAra.com', '3');

-- INSERTA LAS PRECENTACIONES
INSERT INTO presentacion (cod_pres, cantidad, medida, peso, status) VALUES
(1,'','NO ASIGNADO',0,1),
(2, 30, 'mg', '250.00', 1),
(3, 50, 'mg', '500.00', 1),
(4, 20, 'lts', '1.00', 1),
(5, 100, 'mg', '20.00', 1);
-- INSERTA LAS TIPO
INSERT INTO tipo(des_tipo, status) VALUES 
('NO ASIGNADO',1),
('Adulto',1),
('Pediatrico',1);
-- INSERTA LAS CLASE
INSERT INTO clase (cod_clase, des_clase, status) VALUES
(1, 'NO ASIGNADO', 1),
(2, 'Analgesico', 1),
(3, 'Antialergicos', 1),
(4, 'Antidiarreicos', 1),
(5, 'Antimicoticos', 1),
(6, 'Antipireticos', 1);



-- INSERT INTO producto (cod_producto, nombre, descripcion, ubicacion, composicion, contraindicaciones, posologia, vencimiento, p_venta, stock, img, cod_lab, cod_tipo, cod_clase, cod_pres, status) VALUES 
-- ('1', 'Acetaminofén', 'Medicamento que reduce el dolor y la fiebre (pero no la inflamacion).', 'Pasillo 2', 'C8H9NO2', 'Los efectos secundarios mas comunes son nauseas y salpullido. Las dosis altas de acetaminofén pueden causar daños hepáticos y renales.', 'Adultos: La dosis habitual es de 325 mg a 650 mg. Tomelo con una frecuencia de 4 a 6 horas, segun sea necesario, hasta 4 veces en un periodo de 24 horas. La dosis máxima puede variar entre 3,000 mg y 4,000 mg, pero no tome más de 4,000 mg en un periodo de 24 horas. Siga todas las instrucciones de la etiqueta.', '2023-10-17', '12', '25', "https://farmaclickadonay.com/wp-content/uploads/2022/05/acetaminofen-650mg-x10.png", NULL, '1', '1', '1', '1'),
-- ('2', 'Ibuprofeno', 'Su accion consiste en detener la produccion del cuerpo de una sustancia que causa dolor, fiebre e inflamacion.', 'Pasillo 1', 'C13H18O2', 'Historia de asma grave, urticaria o reaccion alérgica a ácido acetilsalicilico u otros AINE. Pacientes con la triada asma/rinitis con o sin poliposis nasal e intolerancia al ácido acetilsalicílico.', 'En adultos y adolescentes de 14 a 18 años se toma un comprimido (600 mg) cada 6 a 8 horas, dependiendo de la intensidad del cuadro y de la respuesta al tratamiento. En adultos la dosis máxima diaria es de 2.400 mg mientras que en adolescentes de 12 a 18 años es de 1.600 mg.', '2023-10-17', '12', '25', "https://www.belgochilena.cl/wp-content/uploads/2023/05/ibuprofeno600mgx20com1494.png", NULL, '1', '1', '1', '1'),
-- ('3', 'Omeprazol', 'Medicamento que impide la secrecion de ácido del estomago.', 'Pasillo 3', 'C17H19N3O3S', 'sarpullido, urticaria, picazón, hinchazón de los ojos, cara, labios, boca, garganta o lengua; dificultad para respirar o tragar o ronquera. ritmo cardíaco irregular, rápido o fuerte; espasmos musculares; temblores incontrolables de una parte del cuerpo; cansancio excesivo; aturdimiento; mareos; o convulsiones.', 'En algunos pacientes puede ser suficiente una dosis diaria de 10 mg. En caso de fracaso del tratamiento, se puede aumentar la dosis a 40 mg. La dosis recomendada es de 20 mg de omeprazol una vez al día.', '2023-10-17', '12', '25', "https://www.farmatotal.cl/wp-content/uploads/2022/07/Omeprazol_20_mg_30_capsulas.png", NULL, '1', '1', '1', '1'),
-- ('4', 'Cetirizina', 'Su función consiste en bloquear la acción de la histamina, una sustancia en el cuerpo que causa los síntomas de la alergia.', 'Pasillo 5', 'C21H25N2ClO', 'Hipersensibilidad a la cetirizina, hidroxicina u otro derivado piperazínico.\r\nPacientes con insuficiencia renal grave con un aclaramiento renal inferior a 10 ml/min.\r\n', 'Niños de 6 a 12 años: 5 mg dos veces al día (medio comprimido dos veces al día). Adultos y adolescentes mayores de 12 años: 10 mg una vez al día (un comprimido). Pacientes de edad avanzada: Los datos no sugieren que se necesite reducir la dosis en pacientes de edad avanzada en los que la función renal es normal.', '2023-11-24', '13.00', '423', 'https://farmaclickadonay.com/wp-content/uploads/2023/02/Cetirizina-10mg-X10-Tab-Caplin.png', NULL, '2', '1', '5', '1');
INSERT INTO producto (cod_producto, codigo, descripcion, ubicacion, composicion, contraindicaciones, posologia, vencimiento, p_venta, stock, img, cod_lab, cod_tipo, cod_clase, cod_pres, status) VALUES
(5, 'cf26435eddb5f155c4ffb98a6d3b16', 'Acetaminofen', 'Pasillo 2', 'C8H9NO2', 'Los efectos secundarios mas comunes son nauseas y salpullido. Las dosis altas de acetaminofén pueden causar danos hepaticos y renales.', 'Adultos: La dosis habitual es de 325 mg a 650 mg. Tomelo con una frecuencia de 4 a 6 horas, segun sea necesario, hasta 4 veces en un periodo de 24 horas. La dosis maxima puede variar entre 3,000 mg y 4,000 mg, pero no tome mas de 4,000 mg en un periodo de 24 horas. Siga todas las instrucciones de la etiqueta.', '2023-10-17', '12', '25', 'https://farmaclickadonay.com/wp-content/uploads/2022/05/acetaminofen-650mg-x10.png', NULL, 1, 2, 1, 1),
(6, '70358dc12f776d3002fd58d597edc7', 'Ibuprofeno', 'Pasillo 1', 'C13H18O2', 'Historia de asma grave, urticaria o reaccion alérgica a acido acetilsalicilico u otros AINE. Pacientes con la triada asma/rinitis con o sin poliposis nasal e intolerancia al acido acetilsalicilico.', 'En adultos y adolescentes de 14 a 18 años se toma un comprimido (600 mg) cada 6 a 8 horas, dependiendo de la intensidad del cuadro y de la respuesta al tratamiento. En adultos la dosis maxima diaria es de 2.400 mg mientras que en adolescentes de 12 a 18 años es de 1.600 mg.', '2023-10-17', '12', '25', 'https://www.belgochilena.cl/wp-content/uploads/2023/05/ibuprofeno600mgx20com1494.png', NULL, 1, 6, 1, 1),
(7, 'ee0924ba25a9bb177ed8780b50387c', 'Omeprazol', 'Pasillo 3', 'C17H19N3O3S', 'sarpullido, urticaria, picazon, hinchazon de los ojos, cara, labios, boca, garganta o lengua; dificultad para respirar o tragar o ronquera. ritmo cardiaco irregular, rapido o fuerte; espasmos musculares; temblores incontrolables de una parte del cuerpo; cansancio excesivo; aturdimiento; mareos; o convulsiones.', 'En algunos pacientes puede ser suficiente una dosis diaria de 10 mg. En caso de fracaso del tratamiento, se puede aumentar la dosis a 40 mg. La dosis recomendada es de 20 mg de omeprazol una vez al dia.', '2023-10-17', '12', '25', 'https://www.farmatotal.cl/wp-content/uploads/2022/07/Omeprazol_20_mg_30_capsulas.png', NULL, 1, 3, 1, 1),
(8, 'dbed602052b50ea8c0bcaf14a49fb9', 'Cetirizina', 'Pasillo 5', 'C21H25N2ClO', 'Hipersensibilidad a la cetirizina, hidroxicina u otro derivado piperazinico.\r\nPacientes con insuficiencia renal grave con un aclaramiento renal inferior a 10 ml/min.\r\n', 'Niños de 6 a 12 años: 5 mg dos veces al dia (medio comprimido dos veces al dia). Adultos y adolescentes mayores de 12 años: 10 mg una vez al dia (un comprimido). Pacientes de edad avanzada: Los datos no sugieren que se necesite reducir la dosis en pacientes de edad avanzada en los que la funcion renal es normal.', '2023-11-24', '13.00', '423', 'https://farmaclickadonay.com/wp-content/uploads/2023/02/Cetirizina-10mg-X10-Tab-Caplin.png', NULL, 2, 4, 5, 1),
(9, '09c62ef19306d693e660fe08fb6aac', 'Fortasec', 'Pasillo 5', 'loperamida hidrocloruro', 'Si es alérgico al hidrocloruro de loperamida o a cualquiera de los demas componentes de este medicamento (incluidos en la seccion 6). Si aparece sangre en heces o tiene fiebre elevada (superior a 38ºC). Si sufre colitis ulcerosa (inflamacion del intestino).', '2 capsulas (4 mg) como dosis inicial seguida de 1 capsula (2 mg) tras cada deposicion diarreica. La dosis maxima para adultos es de 8 capsulas (16 mg) al dia. ', '2023-11-24', '33.00', '423', 'https://academyplus.es/sites/spain/files/2022-11/Fortasec%C2%AE%202%20mg%20C%C3%A1psulas%20Duras.png', NULL, 2, 4, 5, 1),
(10,'267932bfed87383d3b480106bc646e', 'Fluconazol', 'Pasillo 5', 'C13H12N6F2O', 'Nunca debe administrase a pacientes con hipersensibilidad a los compuestos azolicos o a alguno de los excipientes.', 'No se debera sobrepasar la dosis maxima diaria de adultos (800 mg/dia), aunque la ficha tecnica en Pediatria no recomienda superar los 400-600 mg/dia.', '2023-11-24', '14.00', '423', 'https://www.lasanteca.com/userfiles/2018/12/FLUCONAZOL-150MG-CAJA-POR-1-CAPSULA-INCLINADO.jpg', NULL, 2, 5, 5, 1);



INSERT INTO tipo_pago(id_tipo_pago, des_tipo_pago, online, status) VALUES 
(1,'Tarjeta de credito',0,1),
(2,'Efectivo',0,1),
(3,'Divisa',0,1),
(4,'Pago movil',1,1),
(5,'Transferencia',1,1);

INSERT INTO moneda(id_moneda, nombre, status) VALUES(1, 'Dolar', 1), (2, 'Euro', 1);

INSERT INTO cambio(id_cambio, cambio, fecha, moneda, status) VALUES(1, '35', DEFAULT, 1, 1), (2, '40', DEFAULT, 2, 1);

INSERT INTO estados_venezuela (id_estado, nombre) VALUES
(1, 'Distrito Capital'),(2, 'Amazonas'),(3, 'Anzoategui'),(4, 'Apure'),(5, 'Aragua'),(6, 'Barinas'),
(7, 'Bolivar'),(8, 'Carabobo'),(9, 'Cojedes'),(10, 'Falcon'),(11, 'Guarico'),(12, 'Lara'),
(13, 'Merida'),(14, 'Monagas'),(15, 'Nueva Esparta'),(16, 'Portuguesa'),(17, 'Sucre'),(18, 'Tachira'),
(19, 'Trujillo'),(20, 'Yaracuy'),(21, 'Zulia'),(22, 'Delta Amacuro'),(23, 'Miranda'),(24, 'La Guaira');

INSERT INTO empresa_envio (rif, nombre, contacto, status) VALUES ('123123', 'MRW', 'mrw@example.com', '1');

INSERT INTO banco(id_banco, nombre, codigo, status) VALUES (1 , 'Banco Central de Venezuela', '0001', 1);
INSERT INTO banco(id_banco, nombre, codigo, status) VALUES (2 , 'Banco de Venezuela (BDV)', '0102', 1);
INSERT INTO banco(id_banco, nombre, codigo, status) VALUES (3 , 'Banco Venezolano de Credito (BVC)', '0104', 1);
INSERT INTO banco(id_banco, nombre, codigo, status) VALUES (4 , 'Banco Mercantil', '0105', 1);
INSERT INTO banco(id_banco, nombre, codigo, status) VALUES (5 , 'Banco Provincial (BBVA)', '0108', 1);
INSERT INTO banco(id_banco, nombre, codigo, status) VALUES (6 , 'Bancaribe', '0114', 1);
INSERT INTO banco(id_banco, nombre, codigo, status) VALUES (7 , 'Banco Exterior', '0115', 1);
INSERT INTO banco(id_banco, nombre, codigo, status) VALUES (8 , 'Banco Caroni', '0128', 1);
INSERT INTO banco(id_banco, nombre, codigo, status) VALUES (9 , 'Banesco Banco Universal', '0134', 1);
INSERT INTO banco(id_banco, nombre, codigo, status) VALUES (10 , 'Sofitasa', '0137', 1);
INSERT INTO banco(id_banco, nombre, codigo, status) VALUES (11 , 'Banco Plaza', '0138', 1);
INSERT INTO banco(id_banco, nombre, codigo, status) VALUES (12 , 'Bangente', '0146', 1);
INSERT INTO banco(id_banco, nombre, codigo, status) VALUES (13 , 'Banco Fondo Comun (BFC)', '0151', 1);
INSERT INTO banco(id_banco, nombre, codigo, status) VALUES (14 , '100% Banco', '0156', 1);
INSERT INTO banco(id_banco, nombre, codigo, status) VALUES (15 , 'Del Sur Banco Universal', '0157', 1);
INSERT INTO banco(id_banco, nombre, codigo, status) VALUES (16 , 'Banco del Tesoro', '0163', 1);
INSERT INTO banco(id_banco, nombre, codigo, status) VALUES (17 , 'Banco Agricola de Venezuela', '0166', 1);
INSERT INTO banco(id_banco, nombre, codigo, status) VALUES (18 , 'Bancrecer', '0168', 1);
INSERT INTO banco(id_banco, nombre, codigo, status) VALUES (19 , 'Mi Banco, Banco Microfinanciero C.A', '0169', 1);
INSERT INTO banco(id_banco, nombre, codigo, status) VALUES (20 , 'Banco Activo', '0171', 1);
INSERT INTO banco(id_banco, nombre, codigo, status) VALUES (21 , 'Bancamiga', '0172', 1);
INSERT INTO banco(id_banco, nombre, codigo, status) VALUES (22 , 'Banplus', '0174', 1);
INSERT INTO banco(id_banco, nombre, codigo, status) VALUES (23 , 'Banco Bicentenario del Pueblo', '0175', 1);
INSERT INTO banco(id_banco, nombre, codigo, status) VALUES (24 , 'Banco de la Fuerza Armada Nacional Bolivariana (BANFANB)', '0177', 1);
INSERT INTO banco(id_banco, nombre, codigo, status) VALUES (25 , 'Banco Nacional de Credito (BNC)', '0191', 1);

INSERT INTO datos_cobro_farmacia (id_datos_cobro, num_cuenta, rif_cedula, telefono, id_banco, status) 
VALUES (NULL, '0108245678234662235852', '30374812', NULL, '5', '1'), 
	(NULL, NULL, '30125380', '04120503888', '2', '1');

-- INSERT INTO empresa_envio (rif, nombre, contacto,id_estado, status) VALUES ('123123', 'MRW', 'mrw@example.com', '1');
-- INSERT INTO sede_envio (ubicacion, id_empresa, status) VALUES ('Carrera 22 Con Cale 22 Andres Bello Local Nro 4 Barquisimeto', '1', '1'), ('Carrera 21, Entre Av. Moran Y Calle 8, C.c. Plaza Sevilla Local 28 Y 29. Barquisimeto', '1', '1');

INSERT INTO modulos(id_modulo, nombre, status) VALUES
(1, 'Clientes',1),
(2, 'Ventas',1),
(3, 'Compras',1),
(4, 'Metodo pago',1),
(5, 'Moneda',1),
(6, 'Producto',1),
(7, 'Laboratorio',1),
(8, 'Proveedor',1),
(9, 'Clase',1),
(10,'Tipo',1),
(11,'Presentacion',1),
(12,'Reportes',1),
(13,'Usuarios',1),
(14,'Bitacora',1),
(15,'Bancos',1),
(16,'Cuentas farmacia', 1),
(17,'Roles', 1),
(18,'Empresa de Envio',1),
(19,'Sedes de Envio',1),
(20,'Comprobar pago',1),
(21,'Envios',1);

INSERT INTO permisos(id_rol, id_modulo, nombre_accion, status) VALUES 
(1, 1, 'Registrar', '1'),
(1, 1, 'Editar', '1'),
(1, 1, 'Eliminar', '1'),
(1, 1, 'Consultar', '1'),
(1, 2, 'Registrar', '1'),
(1, 2, 'Editar', '0'),
(1, 2, 'Eliminar', '1'),
(1, 2, 'Consultar', '1'),
(1, 3, 'Registrar', '1'),
(1, 3, 'Editar', '1'),
(1, 3, 'Eliminar', '1'),
(1, 3, 'Consultar', '1'),
(1, 4, 'Registrar', '1'),
(1, 4, 'Editar', '1'),
(1, 4, 'Eliminar', '1'),
(1, 4, 'Consultar', '1'),
(1, 5, 'Registrar', '1'),
(1, 5, 'Editar', '1'),
(1, 5, 'Eliminar', '1'),
(1, 5, 'Consultar', '1'),
(1, 6, 'Registrar', '1'),
(1, 6, 'Editar', '1'),
(1, 6, 'Eliminar', '1'),
(1, 6, 'Consultar', '1'),
(1, 7, 'Registrar', '1'),
(1, 7, 'Editar', '1'),
(1, 7, 'Eliminar', '1'),
(1, 7, 'Consultar', '1'),
(1, 8, 'Registrar', '1'),
(1, 8, 'Editar', '1'),
(1, 8, 'Eliminar', '1'),
(1, 8, 'Consultar', '1'),
(1, 9, 'Registrar', '1'),
(1, 9, 'Editar', '1'),
(1, 9, 'Eliminar', '1'),
(1, 9, 'Consultar', '1'),
(1, 10, 'Registrar', '1'),
(1, 10, 'Editar', '1'),
(1, 10, 'Eliminar', '1'),
(1, 10, 'Consultar', '1'),
(1, 11, 'Registrar', '1'),
(1, 11, 'Editar', '1'),
(1, 11, 'Eliminar', '1'),
(1, 11, 'Consultar', '1'),
(1, 12, 'Consultar', '1'),
(1, 12, 'Exportar reporte', '1'),
(1, 12, 'Exportar reporte estadistico', '1'),
(1, 13, 'Registrar', '1'),
(1, 13, 'Editar', '1'),
(1, 13, 'Eliminar', '1'),
(1, 13, 'Consultar', '1'),
(1, 14, 'Consultar', '1'),
(1, 15, 'Registrar', '1'),
(1, 15, 'Editar', '1'),
(1, 15, 'Eliminar', '1'),
(1, 15, 'Consultar', '1'),
(1, 16, 'Registrar', '1'),
(1, 16, 'Editar', '1'),
(1, 16, 'Eliminar', '1'),
(1, 16, 'Consultar', '1'),
(1, 17, 'Modificar acceso', '1'),
(1, 17, 'Modificar acciones', '1'),
(1, 17, 'Consultar', '1'),
(1, 18, 'Registrar', '1'),
(1, 18, 'Editar', '1'),
(1, 18, 'Eliminar', '1'),
(1, 18, 'Consultar', '1'),
(1, 19, 'Registrar', '1'),
(1, 19, 'Editar', '1'),
(1, 19, 'Eliminar', '1'),
(1, 19, 'Consultar', '1'),
(1, 20, 'Consultar', '1'),
(1, 21, 'Consultar', '1'),
(1, 21, 'Asignar estado', '1');
INSERT INTO permisos(id_rol, id_modulo, nombre_accion, status) VALUES 
(2, 1, 'Registrar', '1'),
(2, 1, 'Editar', '1'),
(2, 1, 'Eliminar', '1'),
(2, 1, 'Consultar', '1'),
(2, 2, 'Registrar', '1'),
(2, 2, 'Editar', '1'),
(2, 2, 'Eliminar', '1'),
(2, 2, 'Consultar', '1'),
(2, 3, 'Registrar', '1'),
(2, 3, 'Editar', '1'),
(2, 3, 'Eliminar', '1'),
(2, 3, 'Consultar', '1'),
(2, 4, 'Registrar', '1'),
(2, 4, 'Editar', '1'),
(2, 4, 'Eliminar', '1'),
(2, 4, 'Consultar', '1'),
(2, 5, 'Registrar', '1'),
(2, 5, 'Editar', '1'),
(2, 5, 'Eliminar', '1'),
(2, 5, 'Consultar', '1'),
(2, 6, 'Registrar', '1'),
(2, 6, 'Editar', '1'),
(2, 6, 'Eliminar', '1'),
(2, 6, 'Consultar', '1'),
(2, 7, 'Registrar', '1'),
(2, 7, 'Editar', '1'),
(2, 7, 'Eliminar', '1'),
(2, 7, 'Consultar', '1'),
(2, 8, 'Registrar', '1'),
(2, 8, 'Editar', '1'),
(2, 8, 'Eliminar', '1'),
(2, 8, 'Consultar', '1'),
(2, 9, 'Registrar', '1'),
(2, 9, 'Editar', '1'),
(2, 9, 'Eliminar', '1'),
(2, 9, 'Consultar', '1'),
(2, 10, 'Registrar', '1'),
(2, 10, 'Editar', '1'),
(2, 10, 'Eliminar', '1'),
(2, 10, 'Consultar', '1'),
(2, 11, 'Registrar', '1'),
(2, 11, 'Editar', '1'),
(2, 11, 'Eliminar', '1'),
(2, 11, 'Consultar', '1'),
(2, 12, 'Consultar', '1'),
(2, 12, 'Exportar reporte', '1'),
(2, 12, 'Exportar reporte estadistico', '1'),
(2, 13, 'Registrar', '1'),
(2, 13, 'Editar', '1'),
(2, 13, 'Eliminar', '1'),
(2, 13, 'Consultar', '1'),
(2, 14, 'Consultar', '1'),
(2, 15, 'Registrar', '1'),
(2, 15, 'Editar', '1'),
(2, 15, 'Eliminar', '1'),
(2, 15, 'Consultar', '1'),
(2, 16, 'Registrar', '1'),
(2, 16, 'Editar', '1'),
(2, 16, 'Eliminar', '1'),
(2, 16, 'Consultar', '1'),
(2, 17, 'Modificar acceso', '1'),
(2, 17, 'Modificar acciones', '1'),
(2, 17, 'Consultar', '1'),
(2, 18, 'Registrar', '1'),
(2, 18, 'Editar', '1'),
(2, 18, 'Eliminar', '1'),
(2, 18, 'Consultar', '1'),
(2, 19, 'Registrar', '1'),
(2, 19, 'Editar', '1'),
(2, 19, 'Eliminar', '1'),
(2, 19, 'Consultar', '1'),
(2, 20, 'Consultar', '1'),
(2, 20, 'Comprobar pago', '1'),
(2, 21, 'Consultar', '1'),
(2, 21, 'Asignar estado', '1');
INSERT INTO permisos(id_rol, id_modulo, nombre_accion, status) VALUES 
(3, 1, 'Registrar', '1'),
(3, 1, 'Editar', '1'),
(3, 1, 'Eliminar', '1'),
(3, 1, 'Consultar', '1'),
(3, 2, 'Registrar', '1'),
(3, 2, 'Editar', '1'),
(3, 2, 'Eliminar', '1'),
(3, 2, 'Consultar', '1'),
(3, 3, 'Registrar', '1'),
(3, 3, 'Editar', '1'),
(3, 3, 'Eliminar', '1'),
(3, 3, 'Consultar', '1'),
(3, 4, 'Registrar', '1'),
(3, 4, 'Editar', '1'),
(3, 4, 'Eliminar', '1'),
(3, 4, 'Consultar', '1'),
(3, 5, 'Registrar', '1'),
(3, 5, 'Editar', '1'),
(3, 5, 'Eliminar', '1'),
(3, 5, 'Consultar', '1'),
(3, 6, 'Registrar', '1'),
(3, 6, 'Editar', '1'),
(3, 6, 'Eliminar', '1'),
(3, 6, 'Consultar', '1'),
(3, 7, 'Registrar', '1'),
(3, 7, 'Editar', '1'),
(3, 7, 'Eliminar', '1'),
(3, 7, 'Consultar', '1'),
(3, 8, 'Registrar', '1'),
(3, 8, 'Editar', '1'),
(3, 8, 'Eliminar', '1'),
(3, 8, 'Consultar', '1'),
(3, 9, 'Registrar', '1'),
(3, 9, 'Editar', '1'),
(3, 9, 'Eliminar', '1'),
(3, 9, 'Consultar', '1'),
(3, 10, 'Registrar', '1'),
(3, 10, 'Editar', '1'),
(3, 10, 'Eliminar', '1'),
(3, 10, 'Consultar', '1'),
(3, 11, 'Registrar', '1'),
(3, 11, 'Editar', '1'),
(3, 11, 'Eliminar', '1'),
(3, 11, 'Consultar', '1'),
(3, 12, 'Consultar', '1'),
(3, 12, 'Exportar reporte', '1'),
(3, 12, 'Exportar reporte estadistico', '1'),
(3, 13, 'Registrar', '1'),
(3, 13, 'Editar', '1'),
(3, 13, 'Eliminar', '1'),
(3, 13, 'Consultar', '1'),
(3, 14, 'Consultar', '1'),
(3, 15, 'Registrar', '1'),
(3, 15, 'Editar', '1'),
(3, 15, 'Eliminar', '1'),
(3, 15, 'Consultar', '1'),
(3, 16, 'Registrar', '1'),
(3, 16, 'Editar', '1'),
(3, 16, 'Eliminar', '1'),
(3, 16, 'Consultar', '1'),
(3, 17, 'Modificar acceso', '1'),
(3, 17, 'Modificar acciones', '1'),
(3, 17, 'Consultar', '1'),
(3, 18, 'Registrar', '1'),
(3, 18, 'Editar', '1'),
(3, 18, 'Eliminar', '1'),
(3, 18, 'Consultar', '1'),
(3, 19, 'Registrar', '1'),
(3, 19, 'Editar', '1'),
(3, 19, 'Eliminar', '1'),
(3, 19, 'Consultar', '1'),
(3, 20, 'Consultar', '1'),
(3, 20, 'Comprobar pago', '1'),
(3, 21, 'Consultar', '1'),
(3, 21, 'Asignar estado', '1');