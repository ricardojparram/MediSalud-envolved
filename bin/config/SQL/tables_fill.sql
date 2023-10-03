-- INSERTA LOS NIVELES DE USUARIO 
INSERT INTO rol(nombre, status) VALUES ('Administrador', '1'), ('Gerente', '1'), ('Empleado', '1'), ('Cliente', '1');

-- INSERTA LOS PRODUCTOS
-- INSERT INTO producto (cod_producto, descripcion, composicion, contraindicaciones, ubicacion, posologia, stock, p_venta, vencimiento, status) VALUES
-- (1, 'Paracetamol', 'asdjgjdsag', 'sjdgjadsg', 'jsdgjdsg', 'jsdajdasg', '10', '5', '2023-01-25', 1),
-- (2, 'Acetominafen', 'asdjgjadsg', 'jsadjasdg', 'jsadjadsg', 'sajdadjsg', '8', '6', '2023-01-02', 1),
-- (3, 'Ibuprofeno', 'jadsjadsg', 'asjdjgds', 'jasdjgds', 'jasdgjds', '20', '9', '2023-01-16', 1);

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
(4,'Pago movil',1,1);

INSERT INTO moneda(id_moneda, nombre, status) VALUES(1, 'Dolar', 1), (2, 'Euro', 1);
INSERT INTO cambio(id_cambio, cambio, fecha, moneda, status) VALUES(DEFAULT, '35', DEFAULT, 1, 1), (DEFAULT, '40', DEFAULT, 2, 1);