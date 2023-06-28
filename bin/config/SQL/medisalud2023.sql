
--  BASE DE DATOS PARA EL SISTEMA DE LA FARMACIA MEDISALUD C.A

DROP DATABASE IF EXISTS medisalud;

CREATE DATABASE  medisalud CHARACTER SET utf8mb4;
USE medisalud;

-- TABLA PARA NIVEL DE USUARIO 
CREATE TABLE `nivel`(
    `cod_nivel` int AUTO_INCREMENT PRIMARY KEY,
    `nombre` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
    `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- TABLA PARA CLIENTES 
CREATE TABLE `cliente`(
    `cedula` varchar(15) COLLATE utf8_spanish2_ci PRIMARY KEY,
    `nombre` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
    `apellido` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
    `direccion` varchar(180) COLLATE utf8_spanish2_ci NOT NULL,
    `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- TABLA PARA LABORATORIOS 
CREATE TABLE `laboratorio`(
    `cod_lab` int AUTO_INCREMENT PRIMARY KEY,
    `rif` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
    `direccion` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
    `razon_social` varchar(200) COLLATE utf8_spanish2_ci,
    `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- TABLA PARA PROVEEDOR 
CREATE TABLE `proveedor`(
    `cod_prove` int AUTO_INCREMENT PRIMARY KEY,
    `rif` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
    `direccion` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
    `razon_social` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
    `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- TABLA PARA PRODUCTOS 
CREATE TABLE `producto`(
    `cod_producto` int AUTO_INCREMENT PRIMARY KEY,
    `descripcion` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
    `composicion` varchar(80) COLLATE utf8_spanish2_ci NOT NULL,
    `contraindicaciones` varchar(60) COLLATE utf8_spanish2_ci NOT NULL,
    `ubicacion` varchar(50)COLLATE utf8_spanish2_ci NOT NULL,
    `posologia` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,
    `stock` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
    `p_venta` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
    `vencimiento` date NOT NULL,
    `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- TABLA PARA USUARIOS 
CREATE TABLE `usuario`(
    `cedula` int PRIMARY KEY,
    `nombre` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
    `apellido` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
    `correo` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
    `password` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
    `nivel` int NOT NULL,
    `img` varchar(120) COLLATE utf8_spanish2_ci,
    `status` int NOT NULL,
    FOREIGN KEY (`nivel`) REFERENCES `nivel`(`cod_nivel`) ON DELETE CASCADE ON UPDATE CASCADE 
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- TABLA PARA EL CONTACTO DE LOS CLIENTES 
CREATE TABLE `contacto_cliente`(
    `id_contacto` int AUTO_INCREMENT PRIMARY KEY,
    `celular` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
    `correo` varchar(60) COLLATE utf8_spanish2_ci,
    `cedula` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
    FOREIGN KEY (`cedula`) REFERENCES `cliente`(`cedula`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci; 

-- TABLA PARA EL CONTACTO DE LOS LABORATORIOS */
CREATE TABLE `contacto_lab`(
    `id_contacto_lab` int AUTO_INCREMENT PRIMARY KEY,
    `telefono` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
    `contacto` varchar(20) COLLATE utf8_spanish2_ci ,
    `cod_lab` int NOT NULL,
    FOREIGN KEY (`cod_lab`) REFERENCES `laboratorio`(`cod_lab`) ON DELETE CASCADE ON UPDATE CASCADE  
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- TABLA PARA EL CONTACTO DE LAS Proveedor 
CREATE TABLE `contacto_prove`(
    `id_contacto_prove` int AUTO_INCREMENT PRIMARY KEY,
    `telefono` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
    `contacto` varchar(200) COLLATE utf8_spanish2_ci ,
    `cod_prove` int NOT NULL,
    FOREIGN KEY (`cod_prove`) REFERENCES `proveedor`(`cod_prove`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- TABLA PARA LA PRESENTACIÓN DE LOS PRODUCTOS 
CREATE TABLE `presentacion`(
    `cod_pres` int AUTO_INCREMENT PRIMARY KEY,
    `cantidad` varchar(12) COLLATE utf8_spanish2_ci NOT NULL,
    `medida` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
    `peso` decimal(10,2) NOT NULL,
    `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- TABLA PARA LOS TIPOS DE PRODUCTOS 
CREATE TABLE `tipo`(
    `cod_tipo` int AUTO_INCREMENT PRIMARY KEY,
    `des_tipo` varchar(40) COLLATE utf8_spanish2_ci,
    `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- TABLA PARA LAS CLASES DE PRODUCTOS 
CREATE TABLE `clase` (
  `cod_clase` int AUTO_INCREMENT PRIMARY KEY,
  `des_clase` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- TABLA RELACION CLASE - PRODUCTO

CREATE TABLE `clase_producto` (
  `cod_clase` int NOT NULL,
  `cod_producto` int NOT NULL,
  FOREIGN KEY (`cod_clase`) REFERENCES `clase` (`cod_clase`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`cod_producto`) REFERENCES `producto` (`cod_producto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- TABLA DE LA RELACIÓN PRODUCTO - LABORATORIO 
CREATE TABLE `laboratorio_producto`(
    `cod_producto` int NOT NULL,
    `cod_lab` int NOT NULL,
    FOREIGN KEY (`cod_producto`) REFERENCES `producto`(`cod_producto`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`cod_lab`) REFERENCES `laboratorio`(`cod_lab`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;


-- TABLA PARA LA RELACIÓN PRODUCTO - PRESENTACION 
CREATE TABLE `presentacion_producto`(
    `cod_pres` int NOT NULL,
    `cod_producto` int NOT NULL,
    FOREIGN KEY (`cod_pres`) REFERENCES `presentacion`(`cod_pres`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`cod_producto`) REFERENCES `producto`(`cod_producto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- TABLA PARA LA RELACIÓN PRODUCTO - TIPO 
CREATE TABLE `tipo_producto`(
    `cod_tipo` int NOT NULL,
    `cod_producto` int NOT NULL,
    FOREIGN KEY (`cod_tipo`) REFERENCES `tipo`(`cod_tipo`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`cod_producto`) REFERENCES `producto`(`cod_producto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;


-- TABLA PARA LOS TIPOS PAGOS 
CREATE TABLE `tipo_pago`(
    `cod_tipo_pago` int AUTO_INCREMENT PRIMARY KEY,
    `des_tipo_pago` varchar(40) COLLATE utf8_spanish2_ci,
    `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;


-- TABLA PARA LA MONEDA 
CREATE TABLE `moneda`(
    `id_moneda` int AUTO_INCREMENT PRIMARY KEY,
    `nombre` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
    `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- TABLA PARA LA CAMBIO 
CREATE TABLE `cambio`(
    `id_cambio` int AUTO_INCREMENT PRIMARY KEY,
    `cambio` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
    `fecha` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `moneda` int NOT NULL,
    `status` int NOT NULL,
    FOREIGN KEY(`moneda`) REFERENCES `moneda`(`id_moneda`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- TABLA PARA LAS VENTAS 
CREATE TABLE `venta`(
    `num_fact` int AUTO_INCREMENT PRIMARY KEY,
    `fecha` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `monto` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
    `cedula_cliente` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
    `cod_tipo_pago` int NOT NULL,
    `cod_cambio` int NOT NULL,
    `status` int NOT NULL,
    FOREIGN KEY (`cedula_cliente`) REFERENCES `cliente`(`cedula`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`cod_tipo_pago`) REFERENCES `tipo_pago`(`cod_tipo_pago`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`cod_cambio`) REFERENCES `cambio`(`id_cambio`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;



-- TABLA PARA LA RELACIÓN VENTA - PRODUCTO 
CREATE TABLE `venta_producto`(
    `num_fact` int NOT NULL,
    `cod_producto` int NOT NULL,
    `cantidad` varchar(10)  NOT NULL,
    `precio_actual` varchar(10)  NOT NULL,
    FOREIGN KEY (`num_fact`) REFERENCES `venta`(`num_fact`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`cod_producto`) REFERENCES `producto`(`cod_producto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- TABLA PARA LAS COMPRA
CREATE TABLE `compra`(
    `cod_compra` int AUTO_INCREMENT PRIMARY KEY,
    `orden_compra` varchar(12) NOT NULL, 
    `fecha` date NOT NULL,
    `monto_total` varchar(20) NOT NULL,
    `cod_prove` int NOT NULL,
    `cod_cambio` int NOT NULL,
    `status` int NOT NULL,
    FOREIGN KEY (`cod_prove`) REFERENCES `proveedor`(`cod_prove`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`cod_cambio`) REFERENCES `cambio`(`id_cambio`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- TABLA PARA LAS COMPRA POR PRODUCTO 
CREATE TABLE `compra_producto`(
    `cod_compra` int NOT NULL,
    `cod_producto` int NOT NULL,
    `cantidad` int(12) NOT NULL,
    `precio_compra` varchar(15) NOT NULL,
    FOREIGN KEY (`cod_compra`) REFERENCES `compra`(`cod_compra`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`cod_producto`) REFERENCES `producto`(`cod_producto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- INSERTA LOS NIVELES DE USUARIO 
INSERT INTO nivel(nombre, status) VALUES ('Administrador', '1'), ('Gerente', '1'), ('Empleado', '1');

-- INSERTA LOS PRODUCTOS
INSERT INTO `producto` (`cod_producto`, `descripcion`, `composicion`, `contraindicaciones`, `ubicacion`, `posologia`, `stock`, `p_venta`, `vencimiento`, `status`) VALUES
(1, 'Paracetamol', 'asdjgjdsag', 'sjdgjadsg', 'jsdgjdsg', 'jsdajdasg', '10', '5', '2023-01-25', 1),
(2, 'Acetominafen', 'asdjgjadsg', 'jsadjasdg', 'jsadjadsg', 'sajdadjsg', '8', '6', '2023-01-02', 1),
(3, 'Ibuprofeno', 'jadsjadsg', 'asjdjgds', 'jasdjgds', 'jasdgjds', '20', '9', '2023-01-16', 1);

-- INSERTA LOS CLIENTES
INSERT INTO `cliente`(`cedula`, `nombre`, `apellido`, `direccion`, `status`) VALUES 
('30233547','Enmanuel','Torres','Tierra Negra',1),
('29727935','Michelle','Torres','Tierra Negra',1),
('28956745','Victor','Aparicio','Chivacoa',1);
INSERT INTO `contacto_cliente` (`celular`, `correo`, `cedula`) VALUES 
('04123893311', 'victor123@gmail.com', '28956745'), 
('04145443212', 'torresmichell213@hotmail.com', '29727935'), 
('04163889393', 'enmanuel551@email.es', '30233547');

-- INSERTA LOS LABORATORIOS
INSERT INTO `laboratorio`(`rif`, `direccion`, `razon_social`, `status`) VALUES 
(0000000,'ninguno','NO ASIGNADO',1),
(1234567,'Av. Venezuela','MedicalCare',1),
(7788564,'Pueblo Nuevo','Bayer',1),
(2394739,'Pueblo Nuevo','Geven',1);

INSERT INTO `contacto_lab` (`telefono`, `contacto`, `cod_lab`) VALUES 
('0251939333', NULL, '2'), ('04128883131', NULL, '4'), ('02510503132', NULL, '3');

-- INSERTA LAS PROVEEDOR
INSERT INTO `proveedor`(`rif`, `direccion`, `razon_social`, `status`) VALUES 
(12345678,'Av.Venezuela','DroNena',1),
(34534565,'Pueblo Nuevo','DroAra',1),
(12232432,'Centro','DroNose',1);

INSERT INTO `contacto_prove` (`telefono`, `contacto`, `cod_prove`) VALUES 
('02513993323', NULL, '1'), ('0412949331', NULL, '2'), ('02519393888', 'drogueriaAra.com', '3');

-- INSERTA LAS PRECENTACIONES
INSERT INTO `presentacion` (`cod_pres`, `cantidad`, `medida`, `peso`, `status`) VALUES
(1,'','NO ASIGNADO','',1),
(2, 30, 'mg', '250.00', 1),
(3, 50, 'mg', '500.00', 1),
(4, 20, 'lts', '1.00', 1),
(5, 100, 'mg', '20.00', 1);
-- INSERTA LAS TIPO
INSERT INTO `tipo`(`des_tipo`, `status`) VALUES 
('NO ASIGNADO',1),
('Adulto',1),
('Pediatrico',1);
-- INSERTA LAS CLASE
INSERT INTO `clase`(`des_clase`, `status`) VALUES ('NO ASIGNADO',1);

INSERT INTO `tipo_pago`(`cod_tipo_pago`, `des_tipo_pago`, `status`) VALUES 
(1,'Tarjeta de credito',1),
(2,'Efectivo',1),
(3,'Divisa',1),
(4,'Pago movil',1);

