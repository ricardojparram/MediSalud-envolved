-- INSERTA LOS NIVELES DE USUARIO
INSERT INTO rol(nombre, status) VALUES ('Administrador', '1'), ('Gerente', '1'), ('Empleado', '1'), ('Cliente', '1');


-- INSERTA USUARIO ADMIN

INSERT INTO usuario (cedula, nombre, apellido, correo, password, rol, img, status) VALUES
('O9OnH0ox4pHUYNZMrowa2Q==', 'Admin', 'Admin', 'mE/+zG67/LRq502a/iv4tA==', '$2y$10$Vt8b5Zt/dgSIUliGJjavhOry4AHII29ercr1UYgGKDRUXz9P8SN8G', 1, NULL, 1);

-- INSERTA LOS CLIENTES
INSERT INTO cliente (cedula, nombre, apellido, direccion, status) VALUES
('TBaiIL0EALWh6IxCa82CfA==', 'Enmanuel', 'Torres', 'rzArk3I23XwqgwUDHhzexA==', 1),
('Wc5p28Squ4mTK6V8vwTR9g==', 'Victor', 'Aparicio', 'clrTuFnbO7r7OLQDgf6Bh6xsSCMrUioDnfusyjtP+UQ=', 1);

INSERT INTO contacto_cliente (id_contacto, celular, correo, cedula) VALUES
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

INSERT INTO sede_envio (id_sede, nombre, ubicacion, id_estado, id_empresa, status) VALUES
('01a1d01d26', 'Juan Griego', 'CALLE GUEVARA, NRO 12 B, ENTRE CALLES LA MARINA Y MARCANO, DIAGONAL A COMERCIAL JUAN GRIEGO.', 15, 1, 1),
('027d4164e7', 'Anaco', 'AV. JOSE ANTONIO ANZOATEGUI, C.C. ANACO CENTER, LOCAL 79-C. ANACO EDO. ANZOATEGUI', 3, 1, 1),
('0ef4f38474', 'Guacara', 'AV CARABOBO CON CALLE VARGAS Y LOVERA, C.C. CARABOBO, NIVEL P.B, LOCAL 15, GUACARA, ESTADO CARABOBO.', 8, 1, 1),
('0fbc36edd9', 'El Tigre ', 'AV. FCO. DE MIRANDA CON CALLE 18 SUR. EDIF. LOS GERANIOS # 2 Y 3 FRENTE A LA PANADERIA SIRIA', 3, 1, 1),
('11d362635f', 'La Victoria', 'AV. VICTORIA LOCAL #2 PB, FRENTE DEL ESTADIO FRANCISCO DE MIRANDA , LA VICTORIA EDO. ARAGUA', 5, 1, 1),
('14c16adc8b', 'El Recreo', 'AV. LIBERTADOR. C.C. EL ROSARIO. LOCAL 5. FRENTE AL IPASME. CODIGO POSTAL 3001', 12, 1, 1),
('15f84a84f4', 'Las Garzas', 'AV JORGE RODRIGUEZ, LOCAL MRW 1, SECTOR LAS GARZAS LECHERIA, ANZOATEGUI. ', 3, 1, 1),
('169872aa81', 'Machiques', 'AV. ARTES ESQ, CALLE PAZ, FRENTE AL BANCO AGRICOLA. MACHIQUES ESO. ZULIA', 21, 1, 1),
('1cf0eb26cf', 'Cua', 'URBANIZACION JARDINES DE SANTA ROSA, C. C. EL COLONIAL, LOCAL 26-A,  CUA, MIRANDA.', 23, 1, 1),
('20227c3285', 'Plaza Las Americas', 'CENTRO COMERCIAL PLAZA LAS AMERICAS, NIVEL ORO, LOCAL 107-A, EL CAFETAL. GPS: 10.458950, -66.828896', 1, 1, 1),
('206092451f', 'Turmero', 'CALLE MARINO C/C CALLE PENALVER C.C MARINO PLAZA P.B LOCAL 02, TURMERO EDO. ARAGUA.', 5, 1, 1),
('21e0c20fd6', 'Maracay La Romana', 'AV. BOLIVAR OSESTE, NUMERO 165, EDIFICIO GUEY 2 CALLE RIO GUEY, SECTOR LA ROMANA MARACAY.', 5, 1, 1),
('26380e137b', 'Higuerote', 'CALLE EL RIO, CC MARTI PLAZA, LOCAL 1, HIGUEROTE EDO. MIRANDA.', 23, 1, 1),
('279b62b60e', 'Chacao El Muneco', 'CALLE EL MU&Ntilde;ECO ENTRE AV. FCO. DE MIRANDA Y AV. LIBERTADOR EDIF. GUAN, PB, LOCAL 7. CHACAO', 1, 1, 1),
('2c402e9f2f', 'Guigue', 'AV. MIRANDA CON AV. MICHELENA, LOCAL 8-54 SECTOR GUIGUE, VALENCIA - EDO CARABOBO', 8, 1, 1),
('2dfb719015', 'Cumana Urdaneta', '4TA TRANSVERSAL DE LA AVENIDA GRAN MARISCAL. EDIFICIO CUE, P.B. LOCAL 1 ', 17, 1, 1),
('34bdb231f3', 'Chuao', 'AV ERNESTO BLON CC  CIUDAD TAMANACO NIVEL PB LOCAL F SECTOR CHUAO CARACAS (CHACAO) MIRANDA', 1, 1, 1),
('381c0ba649', 'San Carlos', 'CALLE SUCRE ENTRE ZAMORA Y LIBERTAD LOCAL #8-33, EDO. COJEDES.', 9, 1, 1),
('3dbc619043', 'Maracay Zona Ind.', 'AV BERMUDEZ CC MARACAY PLAZA NIVEL PB LOCAL PB-82F URB CENTRO MARACAY ARAGUA.', 5, 1, 1),
('3ee0a2d88b', 'Av. Venezuela', 'AV VENEZUELA CON CALLE 21, EDIFICIO LAZIO, LOCAL NRO. 02, BQTO. EDO. LARA. CODIGO POSTAL 3001', 12, 1, 1),
('404bf515d7', 'Tucupido', 'CALLE SALOM NRO 24 DIAGONAL A LA ALCALDIA, ENTRE SAN PABLO Y ZARAZA, LOCAL MRW PB.', 11, 1, 1),
('4077f084a0', 'Centro', 'AV. UNIVERSIDAD, ESQ. DE SOCIEDAD A GRADILLAS, EDIF. HUMBOLT P.B. LOCAL 4 MRW', 1, 1, 1),
('411a6fc4f9', 'Maracay Santa Rosa', 'CALLE CARABOBO, NRO 75-A, SECTOR SANTA ROSA. MARACAY, ESTADO ARAGUA.', 5, 1, 1),
('48b331449d', 'Barinas', 'CALLE CEDENO C.C. GIAMMA NIVEL PLANTA BAJA LOCAL 6 SECTOR CENTRO. BARINAS, ESTADO BARINAS. ', 6, 1, 1),
('4adb1f882c', 'Los Olivos', 'AV 28 LA LIMPIA CON AVENIDA 69 LOCAL 69B-09 SECTOR LOS ACEITUNOS AL LADO DE LA E/S LOS ACEITUNOS.', 21, 1, 1),
('4ca58245b8', 'Cumana', 'CALLE MARINO, EDF TUNIMIQUIRE LOCAL NO 01, CUMANA.', 17, 1, 1),
('4f05874059', 'Quibor', 'Calle 8 entre avenida 8 y 9 a 200mts. del supermercado La Plama.', 12, 1, 1),
('50f55bd04c', 'Carupano', 'AV UNIVERSITARIA EDIF PROSEIN PISO MEZANINA LOCAL B SECTOR LOS MOLINOS CARUPANO, EDO SUCRE', 17, 1, 1),
('510169de3e', 'Bejuma', 'AV. CARABOBO ENTRE CALLE PIAR Y CALLE VALENCIA, LOCAL NRO S/N, SECTOR UNION BEJUMA, EDO. CARABOBO', 8, 1, 1),
('510a0640d8', 'Turen', 'AV 6, ESQUINA CALLE 5, SECTOR CENTRO', 16, 1, 1),
('518549d963', 'Bocono', 'AV. MIRANDA C/C C. ANDRES BELLO. LOCAL 2. SECTOR CENTRO BOCONO EDO TRUJILLO', 19, 1, 1),
('5592b1f3d8', 'Temblador', 'CALLE BOLIVAR. NO 70-A. SECTOR LA PLAZA AL LADO DE LA CARNICERIA EL BRAHMON. MONAGAS', 14, 1, 1),
('596bb76ffb', 'Guatire', 'GUATIRE, CALLE ZAMORA NUMERO 47, LOCAL PB-1, EDIFICIO QUINTA ARELIS. ', 23, 1, 1),
('5af49dcdbc', 'Nueva Barcelona', 'PROLONG. AV. FUERZAS ARMADAS. C.C. LOS CHAGUARAMOS LOCAL 4, SECTOR NUEVA BARCELONA, ANZOATEGUI.', 3, 1, 1),
('609259a783', 'Valencia La Candelaria', 'AV. ARANZAZU, EDIFICIO VORMA, PISO P.B., LOCAL PB-3, LA CANDELARIA. VALENCIA EDO. CARABOBO.', 8, 1, 1),
('6279758241', 'Tovar', 'CR 4TA. CC EL LLANO NIVEL PB LOCAL 4 SECTOR EL LLANO TOVAR, EDO.MERIDA.', 13, 1, 1),
('6310ae01c5', 'Paramillo', 'AV LOS AGUSTINOS ESQ CALLE 4 LOCAL NRO 3-70 URB EL LOBO, SECTOR PARAMILLO SAN CRISTOBAL.', 18, 1, 1),
('63931086c6', 'S.sebastian D Los Reyes', 'CALLE BOLIVAR LOCAL NRO 18-2  SECTOR CENTRO SAN SEBASTIAN DE LOS REYES ARAGUA', 5, 1, 1),
('66a7e68841', 'El Cementerio', 'AV LOS TOTUMOS ENTRE AV LOUIS BRAILLET Y FLORESTA, CASA 20 LOCAL UNICO, PRADO DE MARIA EL CEMENTERIO', 1, 1, 1),
('68fe322620', 'Valera', 'CALLE 5 ENTRE AV. BOLIVAR Y 9. EDIF. PROFESIONAL DON PEPE. PB, LOCAL MRW. VALERA ESTADO TRUJILLO', 19, 1, 1),
('6aba442534', 'Caja Seca', 'NUEVA BOLIVIA MERIDA, CTRA. PANAMERICANA, SECTOR LA CHERTOZA, C.C STILO, PLANTA BAJA LOCAL 2.', 21, 1, 1),
('6b8d8efc17', 'Manzanillo', 'CALLE 10 LA UNION CON AV. 24, C.C. B & B, P.B. LOCAL 2 SECTOR MANZANILLO. MARACAIBO, EDO. ZULIA.', 21, 1, 1),
('6be14469aa', 'Barcelona', 'AV. FUERZAS ARMADAS. ESQUINA CALLE EULALIA BUROZ, EDIF AZGAN PISO PB LOCAL 02 SECTOR CENTRO', 3, 1, 1),
('6cde627a55', 'Los Rosales', 'AV. LOS LAURELES CON AV. ROOSEVELT, RES. TIUNA LOCAL E. PB FRENTE A PLAZA TIUNA LOS ROSALES. ', 1, 1, 1),
('6e39fe0c27', 'Andres Bello', 'AV ANDRES BELLO COLEGIO NACIONAL DE PERIODISTA LOCAL 4 PB FRENTE A POLLOS RIVIERA.', 1, 1, 1),
('717257c8c5', 'Barinas Sabaneta', 'CALLE 1, ENTRE BAYON Y OBISPO, C.C. TRICOLOR, NUMERO 2, SECTOR 9 DE DICIEMBRE DE SABANETA.', 6, 1, 1),
('72cfc4bedc', 'El Junquito', 'C.C. CASA JUNKO PB, LOCAL A7. KILOMETRO 18 DEL JUNQUITO, ANTIGUA BOMBA.', 1, 1, 1),
('72e1fa4494', 'San Antonio De Los Altos', 'CARRETA PANAMERICANA, KILOMETRO 16, C.C. LA CASONA II, PISO 1, LOCAL #2-17 AL LADO DE CINEX.', 23, 1, 1),
('78fd44a146', 'Av. Moran', 'CARRERA 21, ENTRE AV. MORAN Y CALLE 8, C.C. PLAZA SEVILLA LOCAL 28 Y 29. BARQUISIMETO', 12, 1, 1),
('79be53bcd1', 'Carache', 'AV. PRINCIPAL CASA S/N SECTOR PALO NEGRO, CARACHE ESTADO TRUJILLO', 19, 1, 1),
('7a23e633b7', 'Maturin Plaza El Indio', 'AV. BICENTENARIO EDIF. ZAMORA, P.B. AL LADO DE LA LINEA DE TAXI LO MEJOR DE LO MEJOR', 14, 1, 1),
('7fd7c602d7', 'Santa Sofia', 'AV. PPAL. SANTA SOFIA. C.C. STA. SOFIA. LOCAL Z-3. P.B. SANTA SOFIA.', 1, 1, 1),
('8048f1ab60', 'Valencia Zona Ind.', 'AV.PROLONGACION MICHELENA C.C. MYCRA LOCAL 10 ZONA INDUSTRIAL VALENCIA. ', 8, 1, 1),
('82984ad1c4', 'Porlamar Centro', 'CALLE VELAZQUEZ CON ESQUINA FAJARDO, CASA S/N, SECTOR CENTRO PORLAMAR, NUEVA ESPARTA. ', 15, 1, 1),
('86e786aba5', 'Plaza Atlantico', 'Centro Comercial Plaza Atlantico Mall, final Av. Atlantico, local PB-12.', 7, 1, 1),
('8803dc80fa', 'Villa De Cura', 'CALLE URDANETA  NORTE  SECTOR CENTRO VILLA DE CURA ARAGUA ZAMORA, ESTADO ARAGUA.', 5, 1, 1),
('90c79ca1c6', 'La Isabelica', 'AV. 04 SECTOR 10, VEREDA 14, LOCAL 01, URB. LA ISABELICA. VALENCIA - CARABOBO. ', 8, 1, 1),
('934ef34dab', 'La Florida', 'URB. LA FLORIDA. AV. LOS CHAGUARAMOS.QTA COROLI. CARACAS.', 1, 1, 1),
('943c8cbdc3', 'Baruta', 'CALLE NEGRO PRIMERO C/C SUCRE N 15-04 AL LADO DE EUROSWEATERS-BARUTA. ', 1, 1, 1),
('95e43d18fc', 'La Candelaria', 'PERICO A PUENTE YANEZ EDF. SERRANO PB. LOCAL 3 LA CANDELARIA.', 1, 1, 1),
('961a21fb61', 'Santa Barbara Del Zulia', 'AV 8 CASA NRO 5-127 SECTOR BOLIVAR, SANTA BARBARA ZULIA. ', 21, 1, 1),
('978fd22753', 'Ciudad Bolivar ', 'AVENIDA REPUBLICA. EDIF. FRANCO, PB LOCALES 1 Y 2, AL LADO DE BANESCO. CIUDAD BOLIVAR', 7, 1, 1),
('985007e6c8', 'Catia', 'AV. SUCRE, C.C. OESTE NIVEL 3 LOCAL 038 SECTOR CATIA,  CARACAS.', 1, 1, 1),
('9b8412c17c', 'Puerta Maraven', 'CALLE SAN ROMAN ENTRE AV. GENERAL PELAYO Y AV. OLLARVIDES, DIAGONAL A RIAS ALTAS.', 10, 1, 1),
('9f5a05fe45', 'San Juan De Colon', 'CARRERA 5 ESQUINA CALLE 7 # 4-79 SAN JUAN DE COLON EDO TACHIRA', 18, 1, 1),
('9f740f809e', 'Punta De Mata', 'CALLE 5 DE JULIO C/C NUEVA LOCAL MRW DETRAS DEL BANCO CARONI', 14, 1, 1),
('a149c3f751', 'Tinaquillo', 'AV. MADARIAGA, ENTRE CALLE CEDENO Y CALLE NEGRO PRIMERO, TINAQUILLO - ESTADO COJEDES', 9, 1, 1),
('a51b7009b6', 'Canaima', 'AV. PEDRO LEON TORRES ENTRE CALLES 55 Y 55-A, C.C. CANAIMA, LOCAL F-02, ZONA ESTE DE BARQUISIMETO.', 12, 1, 1),
('a8db0574dd', 'Valencia El Parral', 'LAS 4 AVENIDAS, C.C. PROFESIONAL CERAVICA PB, LOCAL 2, URB.  EL PARRAL - EDO. CARABOBO.', 8, 1, 1),
('a96dd1c603', 'El Pinal', 'CALLE 1 VIA LA MORITA ZONA COMERCIAL EL MIRADOR, EL PINAL MUNICIPIO FERNANDEZ FEO, EDO. TACHIRA.', 18, 1, 1),
('aa94fc056e', 'Sta Teresa Del Tuy', 'CALLE AYACUCHO EDIF DON GUILLERMO PISO 1 OF 4 ZONA CENTRO SANTA TERESA DEL TUY MIRANDA.', 23, 1, 1),
('ac1ad7a34d', 'La Piramide', 'AV RIO CAURA CENTRO EMPRESARIAL LA PIRAMIDE PB LOCAL 32C  PRADO DEL ESTE', 1, 1, 1),
('afa00f1a30', 'Montalban', 'MORTALBAN II, 2DA TRANSVERSAL CENTRO COMERCIAL LA VILLA', 1, 1, 1),
('b0fd5849a5', 'Valencia Av. Lara', 'AV. LARA CON CALLE USLAR, LOCAL 87-107. FRENTE A MOLINARI CACCIA GUERRA, VALENCIA CARABOBO.', 8, 1, 1),
('b50106d0ab', 'Punto Fijo Av.monagas', 'CALLE MONAGAS ENTRE GARCES Y ZAMORA EDIF. LUCRISCAR PLANTA BAJA, PUNTO FIJO-EDO.FALCON. ', 10, 1, 1),
('b989f6b1ab', 'Altamira', 'AV SAN JUAN BOSCO DE ALTAMIRA CON 1ERA TRANSVERSAL , RES, EXCELSIOR PB LOCAL 2 ALTAMIRA - MIRANDA.', 1, 1, 1),
('ba9e80dda1', 'Ocumare Del Tuy', 'AVENIDA MIRANDA CON CALLE TORIBIO MOTA, EDIF. TELEVISA, PB. FRENTE A LA PARADA DE PAROSCA.', 23, 1, 1),
('beab521e8e', 'Forum', 'AV. 23 DE ENERO CON AV GUAICAIPURO C.C. FORUM LOCAL 52, BARINAS', 6, 1, 1),
('bf75daef65', 'Maracay La Democracia', 'AV AYACUCHO NORTE NRO 83, BARRIO LA DEMOCRACIA, MARACAY EDO ARAGUA', 5, 1, 1),
('c1aaa99460', 'Av. Moran', 'CARRERA 21, ENTRE AV. MORAN Y CALLE 9, C.C. PLAZA SEVILLA LOCAL 28Y 29. BARQUISIMETO.', 12, 1, 1),
('c330ad60bb', 'Maturin Zona Industrial', 'CALLE PRINCIPAL DE LA CRUZ DE LA PALOMA C/C LA MACARENAS PB LOCAL 5.', 14, 1, 1),
('c924dd1d0e', 'Centro Los Llanos', 'CALLE 31 CON AV 28 C.C LOS LLANOS LOCAL 5 PLANTA BAJA. CODIGO POSTAL 3301.', 16, 1, 1),
('c933408795', 'Pto La Cruz Centro', 'CALLE RICAUTER EDIF. D JORGE PISO PB LOCAL NRO 1 SECTOR CASCO CENTRAL PUERTO LA CRUZ ANZOATEGUI', 3, 1, 1),
('cca66c36f2', 'Chacaito', 'AV. PICHINCHA ENTRE SALIDA DEL METRO Y AV. TAMANACO CC UNICO NIVEL PB LOCAL 5 Y 6 URB EL ROSAL.', 1, 1, 1),
('cedafb3174', 'San Fernando ', 'CALLE BOLIVAR  ENTRE CALLE PIAR Y GIRARDOT, LOCAL NRO S/N SECTOR CENTRO, SAN FERNANDO DE APURE', 4, 1, 1),
('d05d5bfc2a', 'El Valle', 'AV. INTERCOMUNAL DEL VALLE, CC EL PALMAR, RESIDENCIAS DON PEDRO, TORRE F, LOCAL MRW PB,EL VALLE.', 1, 1, 1),
('d27c609102', 'Ciudad Ojeda Centro', 'CALLE FARIA ESQ CALLE LARA C.C TED NIVEL PB LOCAL 03 SECTOR CASCO CENTRAL CIUDAD OJEDA EDO. ZULIA', 21, 1, 1),
('d4dfdba40e', 'Curva De Molina', 'CALLE 79 NRO 92-58 FRENTE AL MODULO LIBERTADOR, AL LADO DE LA FERRETERIA RANYE', 21, 1, 1),
('d5190f1b31', 'Clarines', 'AV. FERNANDEZ PADILLA, MINI C.C. LOS COCOS. C.C. MTC. LOCAL 5 P.B. CLARINES.', 3, 1, 1),
('d7c5081fdc', 'Valle De La Pascua', 'CALLE GONZALEZ PADRON, CENTRO COMERCIAL STAR CENTER, LOCAL B-10, VALLE DE LA PASCUA, ESTADO GUARIDO.', 11, 1, 1),
('d804c7fce8', 'La Fria', 'CARRERA 11 ENTRE CALLES 5 Y 6 NRO 4-49 MUNICIPIO GARCIA DE HEVIA LA FRI+A  LA FRIA EDO. TACHIRA.', 18, 1, 1),
('db5de9f1b4', 'Maracay Base Aragua', 'AV. LAS DELICIAS  C.C. HOTEL PASEO LAS DELICIAS II NIVEL PB LOCAL 12 URB BASE ARAGUA MARACAY.', 5, 1, 1),
('df52e83016', 'Cabudare Sur ', 'Av. el placer CC el trigalpa planta baja local 5 Cabudare', 12, 1, 1),
('e0f456280d', 'Mda Los Proceres', 'AV LOS PROCERES, CALLE LA ORQUIDEA , MINICENTRO COMERCIAL , DON LUIS, LOCAL 2B O MRW.', 13, 1, 1),
('e396c3cc07', 'Valencia San Diego', 'AV. DON JULIO CENTENO C.C. METRO PLAZA P.B LOCAL 33 SAN DIEGO EDO. CARABOBO.', 8, 1, 1),
('e5add2c1f5', 'Cabimas', 'AV INTERCOMUNAL, ESQUINA CUMANA EDIF INTERCUMANA LOCAL N 02 PB CABIMAS EDO ZULIA. ', 21, 1, 1),
('e66cdc882e', 'Moron', 'AVDA. YARACUY - NRO 52, FRENTE AL BANCO BANESCO, AL LADO DEL BANCO BOD. MORON ESTADO CARABOBO.', 8, 1, 1),
('e916751b76', 'Los Chaguaramos', 'AV. EL PARQUE, C.C. LOS CHAGUARAMOS, NIVEL P.B, LOCAL 10, URB. LAS CHAGUARAMOS, CARACAS,', 1, 1, 1),
('e9e57d9b27', 'Calabozo', 'CARRERA 12 ENTRE CALLE 4 Y 5 C.C COROMOTO FRENTE A LA PLAZA BOLIVAR . CALABOZO. CODIGO POSTAL 2312.', 11, 1, 1),
('eba8a02e92', 'Las Mercedes', 'AV. VERACRUZ. EDIF. MATISCO. P.B. DIAGONAL A CONATEL, URB. LAS MERCEDES, CARACAS MIRANDA .', 1, 1, 1),
('ef42039919', 'Cdad Bolivar Zona Ind.', 'AV. NUEVA GRANADA. EDIF. GRAN SABANA. P.B., LOCAL 1 CIUDAD BOLIVAR. EDO. BOLIVA.', 7, 1, 1),
('efdfd5ae8f', 'El Vigia', 'CALLE 3 CON AV. DON PEPE ROJAS, LOCAL GALPON NRO. S/N BARRIO BOLIVAR EL VIGIA EDO, MERIDA.', 13, 1, 1),
('f9300dd86d', 'Merida Milla', 'AV 5 CON ESQUINA CALLE 16 LOCAL NRO 14-106, SECTOR BELEN MUNICIPIO LIBERTADOR MERIDA.', 13, 1, 1),
('fbbdb21d85', 'Turmero Zona Industrial', 'AV INTERCOMUNAL MARACAY TURMERO C.C. COCHE ARAGUA LOCAL NRO 30 Y 82 SECTOR LA MORITA I', 5, 1, 1),
('fbe638f96a', 'Andres Bello', 'CARRERA 22 CON CALE 22 ANDRES BELLO LOCAL NRO 4  BARQUISIMETO', 12, 1, 1),
('fc72e1952e', 'El Hatillo', 'CALLE MATADERO, CENTRO COMERCIAL PRISCOS, NIVEL PB OF 904-4 URB EL HATILLO CARACAS. ', 1, 1, 1),
('ff0bc235d3', 'Babilom', 'CALLE 19 CON AV  LIBERTADOR ZONA INDUSTRIAL I C.C LIBERTADOR LOCAL 13-B.', 12, 1, 1);


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