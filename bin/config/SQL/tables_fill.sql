-- INSERTA LOS NIVELES DE USUARIO 
INSERT INTO rol(nombre, status) VALUES ('Administrador', '1'), ('Gerente', '1'), ('Empleado', '1'), ('Cliente', '1');


-- INSERTA USUARIO ADMIN

INSERT INTO usuario (cedula, nombre, apellido, correo, password, rol, img, status) VALUES ('123123', 'admin', 'admin', 'admin@admin.com', '$2y$10$IQ3tD7JwCMoBHFwv6P4YteAgNOnlevdqxZYwtR8XfvkebK0It3RN.', '1', NULL, '1');

-- INSERTA LOS CLIENTES
INSERT INTO cliente(cedula, nombre, apellido, direccion, status) VALUES 
('30233547','Enmanuel','Torres','Tierra Negra',1),
('29727935','Michelle','Torres','Tierra Negra',1),
('28956745','Victor','Aparicio','Chivacoa',1);
INSERT INTO contacto_cliente (celular, correo, cedula) VALUES 
('04123893311', 'victor123@gmail.com', '28956745'), 
('04145443212', 'torresmichell213@hotmail.com', '29727935'), 
('04163889393', 'enmanuel551@email.es', '30233547');

-- INSERTA LOS LABORATORIOS
INSERT INTO laboratorio(rif, direccion, razon_social, status) VALUES 
(0000000,'ninguno','NO ASIGNADO',1),
(1234567,'Av. Venezuela','MedicalCare',1),
(7788564,'Pueblo Nuevo','Bayer',1),
(2394739,'Pueblo Nuevo','Geven',1);

INSERT INTO contacto_lab (telefono, contacto, cod_lab) VALUES 
('0251939333', NULL, '2'), ('04128883131', NULL, '4'), ('02510503132', NULL, '3');

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
INSERT INTO clase(des_clase, status) VALUES ('NO ASIGNADO',1);

INSERT INTO tipo_pago(id_tipo_pago, des_tipo_pago, online, status) VALUES 
(1,'Tarjeta de credito',0,1),
(2,'Efectivo',0,1),
(3,'Divisa',0,1),
(4,'Pago movil',1,1),
(5,'Transferencia',1,1);

INSERT INTO moneda(id_moneda, nombre, status) VALUES(1, 'Dolar', 1), (2, 'Euro', 1);

INSERT INTO cambio(id_cambio, cambio, fecha, moneda, status) VALUES(1, '35', DEFAULT, 1, 1), (2, '40', DEFAULT, 2, 1);

INSERT INTO cambio(cambio, fecha, moneda, status) VALUES('35', DEFAULT, 1, 1), ('40', DEFAULT, 2, 1);

INSERT INTO empresa_envio (rif, nombre, contacto, status) VALUES ('123123', 'MRW', 'mrw@example.com', '1');
INSERT INTO sede_envio (ubicacion, id_empresa, status) VALUES ('Carrera 22 Con Cale 22 Andres Bello Local Nro 4 Barquisimeto', '1', '1'), ('Carrera 21, Entre Av. Moran Y Calle 8, C.c. Plaza Sevilla Local 28 Y 29. Barquisimeto', '1', '1');

INSERT INTO `banco`(`id_banco`, `nombre`, `codigo`, `status`) VALUES (1 , 'Banco Central de Venezuela', '0001', 1);
INSERT INTO `banco`(`id_banco`, `nombre`, `codigo`, `status`) VALUES (2 , 'Banco de Venezuela (BDV)', '0102', 1);
INSERT INTO `banco`(`id_banco`, `nombre`, `codigo`, `status`) VALUES (3 , 'Banco Venezolano de Credito (BVC)', '0104', 1);
INSERT INTO `banco`(`id_banco`, `nombre`, `codigo`, `status`) VALUES (4 , 'Banco Mercantil', '0105', 1);
INSERT INTO `banco`(`id_banco`, `nombre`, `codigo`, `status`) VALUES (5 , 'Banco Provincial (BBVA)', '0108', 1);
INSERT INTO `banco`(`id_banco`, `nombre`, `codigo`, `status`) VALUES (6 , 'Bancaribe', '0114', 1);
INSERT INTO `banco`(`id_banco`, `nombre`, `codigo`, `status`) VALUES (7 , 'Banco Exterior', '0115', 1);
INSERT INTO `banco`(`id_banco`, `nombre`, `codigo`, `status`) VALUES (8 , 'Banco Caroni', '0128', 1);
INSERT INTO `banco`(`id_banco`, `nombre`, `codigo`, `status`) VALUES (9 , 'Banesco Banco Universal', '0134', 1);
INSERT INTO `banco`(`id_banco`, `nombre`, `codigo`, `status`) VALUES (10 , 'Sofitasa', '0137', 1);
INSERT INTO `banco`(`id_banco`, `nombre`, `codigo`, `status`) VALUES (11 , 'Banco Plaza', '0138', 1);
INSERT INTO `banco`(`id_banco`, `nombre`, `codigo`, `status`) VALUES (12 , 'Bangente', '0146', 1);
INSERT INTO `banco`(`id_banco`, `nombre`, `codigo`, `status`) VALUES (13 , 'Banco Fondo Comun (BFC)', '0151', 1);
INSERT INTO `banco`(`id_banco`, `nombre`, `codigo`, `status`) VALUES (14 , '100% Banco', '0156', 1);
INSERT INTO `banco`(`id_banco`, `nombre`, `codigo`, `status`) VALUES (15 , 'Del Sur Banco Universal', '0157', 1);
INSERT INTO `banco`(`id_banco`, `nombre`, `codigo`, `status`) VALUES (16 , 'Banco del Tesoro', '0163', 1);
INSERT INTO `banco`(`id_banco`, `nombre`, `codigo`, `status`) VALUES (17 , 'Banco Agricola de Venezuela', '0166', 1);
INSERT INTO `banco`(`id_banco`, `nombre`, `codigo`, `status`) VALUES (18 , 'Bancrecer', '0168', 1);
INSERT INTO `banco`(`id_banco`, `nombre`, `codigo`, `status`) VALUES (19 , 'Mi Banco, Banco Microfinanciero C.A', '0169', 1);
INSERT INTO `banco`(`id_banco`, `nombre`, `codigo`, `status`) VALUES (20 , 'Banco Activo', '0171', 1);
INSERT INTO `banco`(`id_banco`, `nombre`, `codigo`, `status`) VALUES (21 , 'Bancamiga', '0172', 1);
INSERT INTO `banco`(`id_banco`, `nombre`, `codigo`, `status`) VALUES (22 , 'Banplus', '0174', 1);
INSERT INTO `banco`(`id_banco`, `nombre`, `codigo`, `status`) VALUES (23 , 'Banco Bicentenario del Pueblo', '0175', 1);
INSERT INTO `banco`(`id_banco`, `nombre`, `codigo`, `status`) VALUES (24 , 'Banco de la Fuerza Armada Nacional Bolivariana (BANFANB)', '0177', 1);
INSERT INTO `banco`(`id_banco`, `nombre`, `codigo`, `status`) VALUES (25 , 'Banco Nacional de Credito (BNC)', '0191', 1);

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
(20,'Comprobar pago',1);

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
(1, 20, 'Comprobar pago', '1');
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
(2, 20, 'Comprobar pago', '1');
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
(3, 20, 'Comprobar pago', '1');