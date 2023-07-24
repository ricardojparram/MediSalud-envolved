
--  BASE DE DATOS PARA EL SISTEMA DE LA FARMACIA MEDISALUD C.A

DROP DATABASE IF EXISTS medisalud;

CREATE DATABASE  medisalud CHARACTER SET utf8mb4;
USE medisalud;

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

-- TABLA PARA NIVEL DE USUARIO 
CREATE TABLE `nivel`(
    `cod_nivel` int AUTO_INCREMENT PRIMARY KEY,
    `nombre` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
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


-- TABLA PARA MODULOS DE USUARIO

CREATE TABLE `modulos` (
    `id` int AUTO_INCREMENT PRIMARY KEY,
    `nombre` varchar(30) NOT NULL,
    `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

CREATE TABLE `permisos`(
    `cod_nivel` int NOT NULL,
    `id_modulo` int NOT NULL,
    `registrar` int NOT NULL,
    `editar` int NOT NULL,
    `consultar` int NOT NULL,
    `eliminar` int NOT NULL,
    `status` int NOT NULL ,
    FOREIGN KEY (`cod_nivel`) REFERENCES `nivel`(`cod_nivel`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`id_modulo`) REFERENCES `modulos`(`id`) ON DELETE CASCADE ON UPDATE CASCADE 
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- TABLA PARA BITACORA 
CREATE TABLE `bitacora` (
<<<<<<< HEAD
  `id` int(11) AUTO_INCREMENT PRIMARY KEY,
  `modulo` varchar(20) NOT NULL,
  `usuario` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `fecha` datetime NOT NULL,
=======
  `id` int AUTO_INCREMENT PRIMARY KEY,
  `modulo` varchar(20) NOT NULL,
  `usuario` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `fecha` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
>>>>>>> c899b019fe2b7656c154b6c866d0f4627dcd92ec
  `status` int(11) NOT NULL,
  FOREIGN KEY (`usuario`) REFERENCES `usuario` (`cedula`) ON DELETE CASCADE ON UPDATE CASCADE
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
    `online` int NOT NULL,
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

-- TABLA PARA CARRITO 

 CREATE TABLE `carrito`(
    `cedula` int NOT NULL,
    `cod_producto` int NOT NULL,
    `cantidad` varchar(10) NOT NULL,
    `precioActual` varchar(10) NOT NULL,
     FOREIGN KEY (`cedula`) REFERENCES `usuario` (`cedula`) ON DELETE CASCADE ON UPDATE CASCADE,
     FOREIGN KEY (`cod_producto`) REFERENCES `producto` (`cod_producto`) ON DELETE CASCADE ON UPDATE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- TABLA PARA EMPRESA ENVIO
 
   CREATE TABLE `empresa_envio`(
    `id_empresa` int AUTO_INCREMENT PRIMARY KEY,
    `rif` varchar(15) NOT NULL,
    `nombre` varchar(15) NOT NULL,
    `contacto` varchar(15) ,
    `status` int NOT NULL    
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- TABLA PARA SEDE EMVIO
   
    CREATE TABLE `sede_envio`(
    `id_sede` int AUTO_INCREMENT PRIMARY KEY,
    `ubicacion` varchar(40) NOT NULL,
    `id_empresa` int NOT NULL,
    `status` int NOT NULL,
    FOREIGN KEY (`id_empresa`) REFERENCES `empresa_envio` (`id_empresa`) ON DELETE CASCADE ON UPDATE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

    -- TABLA PARA BANCO
    
    CREATE TABLE `banco`(
    `id_banco` int AUTO_INCREMENT PRIMARY KEY,
    `tipo_pago` int NOT NULL,
    `nombre` varchar(20) NOT NULL,
    `cedulaRif` varchar(20) NOT NULL,
    `telefono` varchar(20) ,
    `NumCuenta` varchar(20) ,
    `CodBanco` varchar(20),
    `status` int NOT NULL,
    FOREIGN KEY (`tipo_pago`) REFERENCES `tipo_pago` (`cod_tipo_pago`) ON DELETE CASCADE ON UPDATE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
   
    -- TABLA PARA FACTURACION
   
    CREATE TABLE `facturacion`(
    `id_fact` int AUTO_INCREMENT PRIMARY KEY,
    `cedula_cliente` int NOT NULL,
    `sede_envio` int NOT NULL,
    `banco` int NOT NULL,
    `fecha` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `numReferencia` varchar(15) NOT NULL,
    `direccion_cliente` varchar(50),
    `status` int NOT NULL,
     FOREIGN KEY (`cedula_cliente`) REFERENCES `usuario` (`cedula`) ON DELETE CASCADE ON UPDATE CASCADE,
     FOREIGN KEY (`sede_envio`) REFERENCES `sede_envio` (`id_sede`) ON DELETE CASCADE ON UPDATE CASCADE,
     FOREIGN KEY (`banco`) REFERENCES `banco` (`id_banco`) ON DELETE CASCADE ON UPDATE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
    
    -- TABLA PARA DETALLE FACTURACION

     CREATE TABLE `detalle_facturacion`(
    `cod_producto` int NOT NULL,
    `id_fact` int NOT NULL,
    `cantidad` varchar(10) NOT NULL,
    `precioActual` varchar(10) NOT NULL,
    FOREIGN KEY (`cod_producto`) REFERENCES `producto` (`cod_producto`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`id_fact`) REFERENCES `facturacion` (`id_fact`) ON DELETE CASCADE ON UPDATE CASCADE                           
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
INSERT INTO nivel(nombre, status) VALUES ('Administrador', '1'), ('Gerente', '1'), ('Empleado', '1'), ('Cliente', '1');

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

INSERT INTO `tipo_pago`(`cod_tipo_pago`, `des_tipo_pago`, `online`, `status`) VALUES 
(1,'Tarjeta de credito',0,1),
(2,'Efectivo',0,1),
(3,'Divisa',0,1),
(4,'Pago movil',1,1);

INSERT INTO `modulos`(`id`, `nombre`, `status`) VALUES
(1,'Clientes',1),
(2,'Ventas',1),
(3,'Compras',1),
(4,'Metodo pago',1),
(5,'Moneda',1),
(6,'Producto',1),
(7,'Laboratorio',1),
(8,'Proveedor',1),
(9,'Clase',1),
(10,'Tipo',1),
(11,'Presentacion',1),
(12,'Reportes',1),
(13,'Usuarios',1),
(14,'Bitacora',1),
(15,'Bancos',1),
(16,'Roles',1),
(17,'Empresa de Envio',1),
(18,'Sedes de Envio',1);

INSERT INTO `permisos`(`cod_nivel`, `id_modulo`, `registrar`, `editar`, `consultar`, `eliminar`, `status`) VALUES 
(1,1,1,1,1,1,1),
(1,2,1,1,1,1,1),
(1,3,1,1,1,1,1),
(1,4,1,1,1,1,1),
(1,5,1,1,1,1,1),
(1,6,1,1,1,1,1),
(1,7,1,1,1,1,1),
(1,8,1,1,1,1,1),
(1,9,1,1,1,1,1),
(1,10,1,1,1,1,1),
(1,11,1,1,1,1,1),
(1,12,1,1,1,1,1),
(1,13,1,1,1,1,1),
(1,14,1,1,1,1,1),
(1,15,1,1,1,1,1),
(1,16,1,1,1,1,1),
(1,17,1,1,1,1,1),
(1,18,1,1,1,1,1),
(2,1,0,0,0,0,1),
(2,2,0,0,0,0,1),
(2,3,0,0,0,0,1),
(2,4,0,0,0,0,1),
(2,5,0,0,0,0,1),
(2,6,0,0,0,0,1),
(2,7,0,0,0,0,1),
(2,8,0,0,0,0,1),
(2,9,0,0,0,0,1),
(2,10,0,0,0,0,1),
(2,11,0,0,0,0,1),
(2,12,0,0,0,0,1),
(2,13,0,0,0,0,1),
(2,14,0,0,0,0,1),
(2,15,0,0,0,0,1),
(2,16,0,0,0,0,1),
(2,17,0,0,0,0,1),
(2,18,0,0,0,0,1),
(3,1,0,0,0,0,1),
(3,2,0,0,0,0,1),
(3,3,0,0,0,0,1),
(3,4,0,0,0,0,1),
(3,5,0,0,0,0,1),
(3,6,0,0,0,0,1),
(3,7,0,0,0,0,1),
(3,8,0,0,0,0,1),
(3,9,0,0,0,0,1),
(3,10,0,0,0,0,1),
(3,11,0,0,0,0,1),
(3,12,0,0,0,0,1),
(3,13,0,0,0,0,1),
(3,14,0,0,0,0,1),
(3,15,0,0,0,0,1),
(3,16,0,0,0,0,1),
(3,17,0,0,0,0,1),
(3,18,0,0,0,0,1)
