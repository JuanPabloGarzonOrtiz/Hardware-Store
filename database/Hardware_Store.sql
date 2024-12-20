CREATE DATABASE Hardware_Store;
USE Hardware_Store;
/*Tablas*/
CREATE TABLE Proveedores(
	id_Proveedor INTEGER PRIMARY KEY AUTO_INCREMENT,
	nombre VARCHAR(50) NOT NULL UNIQUE,
	telefono VARCHAR(15) NOT NULL UNIQUE,
	email VARCHAR(255) NOT NULL UNIQUE,
	logo TEXT
);
CREATE TABLE Productos(
	id_Producto INTEGER PRIMARY KEY AUTO_INCREMENT,
	nombre VARCHAR(50) NOT NULL,
	precio DECIMAL(10, 2) NOT NULL,
	descuento INTEGER NOT NULL,
	cantidad_Stock INT NOT NULL,
	clasificacion VARCHAR(50) NOT NULL,
	descripcion VARCHAR(500) NOT NULL,
	id_Proveedor INTEGER NOT NULL,
	FOREIGN KEY(id_Proveedor) REFERENCES Proveedores(id_Proveedor)
);
CREATE TABLE Clientes(
	id_Cliente INTEGER PRIMARY KEY AUTO_INCREMENT,
	nombre VARCHAR(50) NOT NULL,
	email VARCHAR(255) NOT NULL UNIQUE,
	contraseña VARCHAR(255) NOT NULL
);
CREATE TABLE Historial_Productos (
	id_Historial  INTEGER PRIMARY KEY AUTO_INCREMENT,
	id_Cliente INTEGER NOT NULL,
	id_Producto INTEGER NOT NULL,
	comprado BOOLEAN NOT NULL DEFAULT false,
	FOREIGN KEY(id_Cliente) REFERENCES  Clientes(id_Cliente),
	FOREIGN KEY(id_Producto) REFERENCES Productos(id_Producto)
);
CREATE TABLE Pedidos(
	id_Pedido INTEGER PRIMARY KEY AUTO_INCREMENT,
	fecha DATETIME NOT NULL,
	id_Cliente INTEGER NOT NULL,
	total DECIMAL(10, 2) NOT NULL,
	FOREIGN KEY(id_Cliente) REFERENCES Clientes(id_Cliente)
);
CREATE TABLE Detalles_Pedido(
	id_Detalle_Pedido INTEGER PRIMARY KEY AUTO_INCREMENT,
	id_Pedido INTEGER NOT NULL,
	id_Producto INTEGER NOT NULL,
	cantidad INT NOT NULL,
	FOREIGN KEY(id_Pedido) REFERENCES Pedidos(id_Pedido),
	FOREIGN KEY(id_Producto) REFERENCES Productos(id_Producto)
);
CREATE TABLE Cotizaciones(
	id_Cotizacion INTEGER PRIMARY KEY AUTO_INCREMENT,
	id_Cliente INTEGER NOT NULL,
	fecha DATETIME NOT NULL,
	estado_Cotizacion VARCHAR(50) NOT NULL,
	FOREIGN KEY(id_Cliente) REFERENCES Clientes(id_Cliente)
);
CREATE TABLE Detalles_Cotizacion(
	id_Detalles_Cotizacion INTEGER PRIMARY KEY AUTO_INCREMENT,
	id_Cotizacion INTEGER NOT NULL,
	id_Producto INTEGER NOT NULL,
	cantidad INT NOT NULL,
	FOREIGN KEY(id_Cotizacion) REFERENCES Cotizaciones(id_Cotizacion),
	FOREIGN KEY(id_Producto) REFERENCES Productos(id_Producto)
);

/*Valores*/
INSERT INTO Proveedores(nombre, telefono, email, logo) 
	VALUES
		('Structure','+57 3201324565', 'structure.hotmail.com','/static/imgs/Logo_Structure.png'),
		('Imperio Mineral','+57 3107686534', 'imperio_minerla.hotmail.com','/static/imgs/Logo_Imperio-Mineral.png'),
		('Boodywork and Paiting','+57 3199875634', 'boodywokandPaiting.hotmail.com','/static/imgs/Logo_Boodywork-and-Paiting.png'),			
		('Picasso','+57 3114368719', 'picasoopaint.hotmail.com','/static/imgs/Logo_Picasso.png');
INSERT INTO Productos (nombre, precio, descuento, cantidad_Stock, clasificacion, descripcion, id_Proveedor)
	VALUES
		('Aldabon',200.000,45.000,500,'Ornamentacion','Aldabón de puerta fabricado en acero inoxidable, diseñado para abrir y cerrar puertas con facilidad. Resistente a la corrosión, ideal para exteriores y con un acabado elegante y duradero.',1),
		('Plancha de Ollas',130.000,45,200,'Ornamentacion','Plancha de estufa de leña con dos puestos, hecha de hierro fundido para distribuir el calor de manera uniforme. Ideal para cocinar sobre fuego a leña, resistente a altas temperaturas y diseñada para soportar ollas y sartenes pesados.',1),
		('Plancha de Chimenea',80.000,0.000,100,'Ornamentacion','Plancha de chimenea para estufa de leña, fabricada en hierro fundido para soportar el calor intenso. Se coloca en la base de la chimenea o estufa de leña para ayudar a distribuir el calor y proteger el área de la acumulación de cenizas. Ideal para mejorar la eficiencia térmica de la estufa.',1),
		('Tanque de Estufa',125.000,26.000,100,'Ornamentacion','Tanque de estufa de leña diseñado para calentar agua, ideal para preparar cocidos. Está integrado en la estructura de la estufa y permite aprovechar el calor de la leña para calentar el agua eficientemente. Fabricado en acero resistente, es una pieza esencial en cocinas tradicionales a leña.',1),
		('Chimenea de Estufa',60.000,16.000,100,'Ornamentacion','Chimenea de estufa de leña diseñada para canalizar el humo generado durante la combustión. Fabricada en acero o hierro, asegura una correcta ventilación y evita la acumulación de gases. Su diseño permite un flujo de aire eficiente, mejorando el rendimiento de la estufa y brindando calidez al ambiente.',1),
		('Reja de Jardin',150.000,9.000,50,'Ornamentacion','Reja de jardín fabricada en acero, ideal para delimitar espacios y proteger áreas verdes. Disponible en varias alturas y estilos, se vende por metro. Su diseño resistente asegura durabilidad y una estética atractiva, perfecta para embellecer y organizar el jardín.',1),
		('Perfil',105.000,59.000,100,'Ornamentacion','Perfil de acero utilizado en construcción, disponible en diversas formas y tamaños, como vigas, canales y ángulos. Su alta resistencia y durabilidad lo hacen ideal para estructuras metálicas, soportes y marcos. Perfecto para proyectos de edificación y reformas, ofrece una base sólida y confiable.',1),
		('Pied de Amigo',27.000,10.000,250,'Ornamentacion','Soporte metálico ajustable que se utiliza para sostener y estabilizar estructuras como andamios o estanterías. Facilita la nivelación y brinda seguridad en la construcción y mantenimiento de obras.',1),
		('Pasador de Puerta',15.000,4.000,50,'Ornamentacion','Pasador de puerta de acero, ideal para asegurar puertas. Fabricado con acero resistente, ofrece durabilidad y seguridad. Fácil de instalar y usar.',1),
		('Cemento',37.500,8.000,100,'Construccion','Material en polvo que se utiliza como aglutinante en la construcción. Al mezclarse con agua, arena y grava, forma el concreto, un material resistente y duradero.',2),
		('Arena',15.700,5.000,100,'Construccion','Material granular utilizado en la construcción, obtenido de la descomposición de rocas. Se emplea en mezclas de concreto, mortero y para el nivelado de superficies.',2),
		('Ladrillo',1.200,1.000,500,'Construccion','Unidad de construcción de arcilla cocida, utilizada en la construcción de muros y estructuras. Es versátil, duradero y proporciona un buen aislamiento térmico y acústico.',2),
		('Bloque',5.000,2.000,500,'Construccion','Unidad de construcción hecha de arcilla, cemento o materiales similares, utilizada para levantar muros y estructuras. Es resistente y ofrece buena capacidad de aislamiento térmico y acústico.',2),
		('Barilla',24.000,9.000,300,'Construccion','Varilla de acero utilizada en construcción para reforzar el concreto. Proporciona resistencia estructural y se emplea en la fabricación de columnas, vigas y losas.',2),
		('Masilla',21.600,6.000,50,'Construccion','Sustancia espesa utilizada para sellar, rellenar o reparar superficies en construcción. Ideal para juntas, grietas y acabados, mejora la adherencia y proporciona un acabado liso.',2),
		('Asfalto',71.900,16.000,500,'Construccion','Material negro y pegajoso, utilizado en la construcción de pavimentos y techos. Ofrece impermeabilidad y durabilidad, siendo ideal para calles, carreteras y superficies resistentes al agua.',2),
		('Alambre Negro',120.500,42.000,200,'Construccion','Alambre de acero recubierto de pintura negra, utilizado en diversas aplicaciones de construcción y jardinería. Ideal para cercas, atar plantas o sujetar elementos. Resistente y duradero.',2),
		('Polisombra',1.000,0.000,2000,'Construccion','Tejido de sombra de polietileno, diseñado para bloquear la luz solar. Usado en jardines y patios, proporciona sombra y protección contra los rayos UV. Ideal para cubrir áreas al aire libre.',2),
		('Malla Eslabonada',37.500,9.000,200,'Construccion','Malla eslabonada de acero, utilizada para cercas y delimitaciones. Proporciona seguridad y visibilidad, siendo resistente a la corrosión y fácil de instalar. Ideal para jardines y propiedades.',2),
		('Aspiradora Electrica',900.000,54.000,30,'Latoneria','Aspiradora eléctrica potente, diseñada para limpiar eficientemente diversos tipos de superficies. Ideal para uso doméstico o en talleres, cuenta con diferentes accesorios para alcanzar rincones difíciles y recoger polvo, suciedad y escombros.',3),
		('Equipo de Soldadura',900.000,55.0000,30,'Latoneria','Equipo de soldadura completo, ideal para trabajos de metal. Incluye máquina de soldar, electrodos y accesorios necesarios. Perfecto para profesionales y aficionados que buscan unir piezas metálicas con calidad y precisión.',3),
		('Prensa de Banco',260.000,32.000,50,'Latoneria','Prensa de banco robusta y duradera, diseñada para sujetar firmemente piezas de trabajo. Ideal para trabajos de carpintería, metalurgia y afilado, proporciona estabilidad y precisión en tus proyectos.',3),
		('Pulidora de Felpa',400.000,171.000,30,'Latoneria','Pulidora de felpa, ideal para dar acabado brillante a superficies, fabricada con materiales de alta calidad y compatible con herramientas eléctricas estándar. Perfecta para trabajos de pulido en metal, madera y plásticos.',3),
		('Careta',70.000,19.000,150,'Latoneria','Careta de soldar con visor ajustable y protección UV, diseñada para resguardar el rostro y los ojos de las chispas y radiaciones durante el proceso de soldadura.',3),
		('Cierra Circular',450.000,39.000,100,'Latoneria','Sierra circular potente, diseñada para cortes rápidos y precisos en madera y materiales similares. Ideal para proyectos de carpintería y construcción.',3),
		('Martillo de Goma',20.000,2.000,130,'Latoneria','Martillo de goma resistente, ideal para trabajos que requieren un golpe suave sin dañar la superficie. Perfecto para ensamblar piezas y trabajar en acabados delicados.',3),
		('Lima Truangular',7.000,2.000,300,'Latoneria','Lima triangular ideal para afilar y dar forma a materiales. Perfecta para trabajos de precisión en metal, madera y plástico.',3),
		('Brocha',12.000,3.000,500,'Pintura','Brocha de cerdas resistentes, ideal para aplicar pintura en superficies grandes y obtener un acabado uniforme y profesional en tus proyectos de pintura.',4),
		('Pincel',25.000,3.000,700,'Pintura','Pincel de cerdas suaves, perfecto para lograr un acabado preciso en detalles y áreas pequeñas, ideal para pintura y retoques en cualquier proyecto.',4),
		('Rodillo',15.000,7.000,200,'Pintura','Rodillo de pintura de alta calidad diseñado para una aplicación rápida y uniforme en diversas superficies, ideal para proyectos de pintura en interiores y exteriores.',4),
		('Cinta Adesiva',15.000,5.000,500,'Pintura','Cinta adhesiva, un material versátil y práctico utilizado para unir, sellar o reparar. Disponible en diferentes grosores y tipos, como cinta transparente y cinta de embalaje, es ideal para manualidades, trabajos de oficina y proyectos de hogar. Su adhesivo de alta calidad asegura una fijación duradera en diversas superficies.',4),
		('Mesclador de Pintura',5.000,2.000,300,'Pintura','Mezclador de pintura, herramienta esencial para lograr una consistencia uniforme en pinturas y recubrimientos. Su diseño ergonómico permite una fácil manipulación y su capacidad para mezclar eficientemente garantiza un acabado profesional. Ideal para trabajos de pintura en interiores y exteriores.',4),
		('Lapiz',1.000,0.000,100,'Pintura','Lápiz de construcción, diseñado para marcar superficies duras como madera, concreto y metal. Su mina resistente asegura líneas claras y duraderas, mientras que su diseño ergonómico permite un agarre cómodo. Ideal para mediciones y trazos en proyectos de construcción y bricolaje',4),
		('Aerosol',45.000,1.000,600,'Pintura','Pintura en aerosol, ideal para aplicaciones rápidas y precisas. Ofrece un acabado uniforme y suave en una variedad de superficies. Disponible en una amplia gama de colores, es perfecta para proyectos de manualidades, reparaciones y decoración. Secado rápido y fácil de usar, solo agita y aplica.',4),
		('Pintura en Agua',247.000,33.000,200,'Pintura','Pintura a base de agua, ideal para interiores y exteriores. Rápida de secar y de bajo olor, facilita la limpieza con agua y jabón. Ofrece una buena cobertura y es respetuosa con el medio ambiente. Disponible en una amplia gama de colores y acabados.',4),
		('Pintura en Aceite',170.000,19.000,200,'Pintura','Pintura a base de aceite, perfecta para superficies que requieren durabilidad y resistencia. Proporciona un acabado suave y brillante, ideal para muebles y exteriores. Su secado es más lento, pero ofrece una excelente adherencia y cobertura. Resistente al agua y fácil de limpiar con disolventes.',4),
		('Pintura Electroestatica',400.000,66.000,100,'Pintura','Pintura electrostática de alta durabilidad, diseñada para aplicaciones en metal y otros materiales. Proporciona un acabado uniforme y resistente a la corrosión, ideal para muebles, maquinaria y productos industriales. Fácil de aplicar y disponible en una variedad de colores.',4);
INSERT INTO Clientes(nombre, email, contraseña)
	VALUES
		('Juan Perez','juan.perez@gmail.com','Juan1234'),
		('Patricia Ruiz','patricia.ruiz@gmail.com','Patricia#2004'),
		('Maria Gomez','maria.gomez@hotmail.com','Maria_@123'),
		('Carlos Rodrigez','carlos.rodriguez@gmail.com','Carloska%&'),
		('Ana Martinez','laura.lopez@gmail.com','Laura\2'),
		('Luiz Feranado','lucho@gmail.com','Juan1234'),
		('Jose Sanchez','jose.sanchez@gmail.com','Johsua545'),
		('Marta Morales','marta.morales@hotmail.com','Marta@343'),
		('Sergio Torrez','sergio.torres@gmail.com','Sergi763');
INSERT INTO Historial_Productos(id_Cliente, id_Producto, comprado)
	VALUES 
		(1,1,true),(1,5,true),(1,37,false),(1,6,true),(1,8,true),(1,15,true),(1,7,true),(1,25,true),(1,20,true),(1,30,true),(1,19,true),
		(2,5,true),(2,3,true),(2,15,true),
		(3,9,false),(3,14,false),(3,20,false),
		(4,35,true),(4,21,true),(4,37,false),(4,31,false),
		(5,4,false),(5,15,false),(5,19,false),(5,16,false),(5,22,false),
		(6,2,true),(6,15,true),(6,29,true),(6,32,true),
		(7,21,false),(7,33,true),
		(8,5,true),(8,25,false),(8,35,false),(8,15,true),(8,20,true),(8,30,true),(8,19,true),
		(9,1,false),(9,5,false),(9,37,false);