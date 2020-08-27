-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 01, 2020 at 04:27 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `AgenciaTuristica`
--

-- --------------------------------------------------------

--
-- Table structure for table `Articulo`
--

CREATE TABLE `Articulo` (
  `IDArticulo` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Marca` varchar(40) NOT NULL,
  `Precio` float NOT NULL,
  `Disponibles` int(5) NOT NULL,
  `Proveedor` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Articulo`
--

INSERT INTO `Articulo` (`IDArticulo`, `Nombre`, `Marca`, `Precio`, `Disponibles`, `Proveedor`) VALUES
(1, 'Guayabera Campeche', 'Campeche Amor con Corazon SA', 297, 45, 'Luis Miguel Perez'),
(2, 'Short Maya', 'Campeche Amor con Corazon SA', 311, 50, 'Sergio Fernando Canche'),
(3, 'Sombrero Artesanal', 'Mayas de la Montaña SA de CV', 143, 98, 'Jorge Mario Puuc'),
(4, 'Collar Maya Jade', 'Patrimonio Hopelchen SA', 229, 157, 'Jorge Carlos Hurtado'),
(5, 'Gorra Campeche', 'Campeche Amor con Corazon SA', 59, 347, 'Luis Miguel Perez'),
(6, 'Caracola Artesanal', 'Mayas de la Montaña SA de CV', 221, 31, 'Jorge Mario Puuc'),
(7, 'Artesania Angel Maya', 'Patrimonio Hopelchen SA', 138, 182, 'Jorge Carlos Hurtado'),
(8, 'Blusa Tipica Campeche', 'Campeche Amor con Corazon SA', 267, 47, 'Luis Miguel Perez');

-- --------------------------------------------------------

--
-- Table structure for table `CompraA`
--

CREATE TABLE `CompraA` (
  `IDCompraA` int(11) NOT NULL,
  `IDArticulo` int(11) NOT NULL,
  `IDUsuario` int(11) NOT NULL,
  `Cantidad` int(5) NOT NULL,
  `Total` float NOT NULL,
  `Confirmacion` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `CompraA`
--

INSERT INTO `CompraA` (`IDCompraA`, `IDArticulo`, `IDUsuario`, `Cantidad`, `Total`, `Confirmacion`) VALUES
(1, 8, 1, 2, 534, '1870900012'),
(2, 5, 1, 3, 177, '1267000011'),
(3, 7, 2, 10, 1380, '1604500029'),
(4, 6, 1, 4, 884, '1736100011'),
(5, 7, 1, 3, 414, '1708100018');

-- --------------------------------------------------------

--
-- Table structure for table `ContratacionSE`
--

CREATE TABLE `ContratacionSE` (
  `IDContratacionSE` int(11) NOT NULL,
  `IDServEspecial` int(11) NOT NULL,
  `IDReserva` int(11) NOT NULL,
  `Cantidad` int(5) NOT NULL,
  `Total` float NOT NULL,
  `Confirmacion` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ContratacionSE`
--

INSERT INTO `ContratacionSE` (`IDContratacionSE`, `IDServEspecial`, `IDReserva`, `Cantidad`, `Total`, `Confirmacion`) VALUES
(1, 1, 4, 6, 330, '2274400013'),
(2, 4, 3, 2, 396, '2059700015'),
(3, 3, 1, 2, 448, '2736700017'),
(4, 1, 6, 6, 330, '2955000021'),
(5, 2, 4, 4, 792, '2820900018'),
(6, 5, 1, 1, 235, '2055900019');

-- --------------------------------------------------------

--
-- Table structure for table `CuentaUsuario`
--

CREATE TABLE `CuentaUsuario` (
  `IDUsuario` int(11) NOT NULL,
  `Nombre` varchar(40) NOT NULL,
  `Apellido` varchar(40) NOT NULL,
  `FechaNacimiento` date NOT NULL,
  `Sexo` varchar(15) NOT NULL,
  `Telefono` varchar(10) NOT NULL,
  `CorreoElectronico` varchar(50) NOT NULL,
  `Contrasena` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `CuentaUsuario`
--

INSERT INTO `CuentaUsuario` (`IDUsuario`, `Nombre`, `Apellido`, `FechaNacimiento`, `Sexo`, `Telefono`, `CorreoElectronico`, `Contrasena`) VALUES
(1, 'Jose', 'Gil', '1998-09-24', 'Hombre', '9818320583', 'josgiort@hotmail.com', 'pepe10'),
(2, 'Maria Fernanda', 'Ortega', '2008-09-24', 'Mujer', '9826732019', 'maria@hotmail.com', 'maria10');

-- --------------------------------------------------------

--
-- Stand-in structure for view `mostrarCSE`
-- (See below for the actual view)
--
CREATE TABLE `mostrarCSE` (
`IDContratacionSE` int(11)
,`Nombre` varchar(40)
,`IDReserva` int(11)
,`Cantidad` int(5)
,`Total` float
,`Confirmacion` varchar(10)
);

-- --------------------------------------------------------

--
-- Table structure for table `ParteRuta`
--

CREATE TABLE `ParteRuta` (
  `IDParteRuta` int(11) NOT NULL,
  `IDRuta` int(11) NOT NULL,
  `Tipo` int(1) NOT NULL,
  `Duracion` time NOT NULL,
  `Denominativo` varchar(100) NOT NULL,
  `Secuencia` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ParteRuta`
--

INSERT INTO `ParteRuta` (`IDParteRuta`, `IDRuta`, `Tipo`, `Duracion`, `Denominativo`, `Secuencia`) VALUES
(1, 1, 1, '01:54:00', 'Traslado Campeche - Miguel Colorado', 1),
(2, 1, 2, '04:00:00', 'Visita Miguel Colorado', 2),
(3, 1, 1, '03:11:00', 'Traslado Miguel Colorado - Palizada', 3),
(4, 1, 2, '14:00:00', 'Descanso Palizada', 4),
(5, 1, 1, '03:16:00', 'Traslado Palizada - El Tigre', 5),
(6, 1, 2, '03:00:00', 'Visita El Tigre', 6),
(7, 1, 1, '03:17:00', 'Traslado El Tigre - Champoton', 7),
(8, 1, 2, '02:30:00', 'Comida Champoton', 8),
(9, 1, 1, '00:51:00', 'Traslado Champoton - Campeche', 9),
(10, 2, 1, '03:17:00', 'Traslado Campeche - Balamku', 1),
(11, 2, 2, '03:00:00', 'Visita Balamku', 2),
(12, 2, 1, '00:40:00', 'Traslado Balamku - Chicanna', 3),
(13, 2, 2, '16:50:00', 'Descanso Chicanna', 4),
(14, 2, 1, '00:06:00', 'Traslado Chicanna - Becan', 5),
(15, 2, 2, '03:00:00', 'Visita Becan', 6),
(16, 2, 1, '00:12:00', 'Traslado Becan - Xpuhil', 7),
(17, 2, 2, '18:00:00', 'Descanso Xpuhil', 8),
(18, 2, 1, '02:14:00', 'Traslado Xpuhil - Calakmul', 9),
(19, 2, 2, '04:00:00', 'Visita Calakmul', 10),
(20, 2, 1, '04:50:00', 'Traslado Calakmul - Campeche', 11),
(21, 3, 1, '00:47:00', 'Traslado Campeche - Edzna', 1),
(22, 3, 2, '03:00:00', 'Visita Edzna', 2),
(23, 3, 1, '02:00:00', 'Traslado Edzna - Santa Rosa Xtampak', 3),
(24, 3, 2, '02:00:00', 'Visita Santa Rosa Xtampak', 4),
(25, 3, 1, '01:00:00', 'Traslado Santa Rosa Xtampak - Hopelchen', 5),
(26, 3, 2, '16:00:00', 'Descanso Hopelchen', 6),
(27, 3, 1, '00:27:00', 'Traslado Hopelchen - Grutas de Xtacumbilxunaan', 7),
(28, 3, 2, '02:00:00', 'Visita Grutas de Xtacumbilxunaan', 8),
(29, 3, 1, '01:00:00', 'Traslado Grutas de Xtacumbilxunaan - Xcalumkin', 9),
(30, 3, 2, '01:00:00', 'Visita Xcalumkin', 10),
(31, 3, 1, '00:23:00', 'Traslado Xcalumkin - Hecelchakan', 11),
(32, 3, 2, '02:30:00', 'Comida Hecelchakan', 12),
(33, 3, 1, '00:58:00', 'Traslado Hecelchakan - Campeche', 13);

-- --------------------------------------------------------

--
-- Table structure for table `Reserva`
--

CREATE TABLE `Reserva` (
  `IDReserva` int(11) NOT NULL,
  `IDUsuario` int(11) NOT NULL,
  `IDRuta` int(11) NOT NULL,
  `Personas` int(3) NOT NULL,
  `Total` float NOT NULL,
  `Confirmacion` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Reserva`
--

INSERT INTO `Reserva` (`IDReserva`, `IDUsuario`, `IDRuta`, `Personas`, `Total`, `Confirmacion`) VALUES
(1, 1, 1, 2, 1498, '3945300012'),
(2, 1, 1, 2, 1498, '3744300019'),
(3, 1, 1, 2, 1498, '3550000017'),
(4, 1, 2, 3, 4347, '3317900018'),
(5, 1, 3, 2, 1898, '3508800012'),
(6, 2, 1, 4, 2996, '3121500024'),
(7, 1, 2, 5, 7245, '3662600017'),
(8, 1, 1, 2, 1498, '3106900011');

-- --------------------------------------------------------

--
-- Table structure for table `Ruta`
--

CREATE TABLE `Ruta` (
  `IDRuta` int(11) NOT NULL,
  `Nombre` varchar(40) NOT NULL,
  `FechaRealizacion` datetime NOT NULL,
  `Cupo` int(3) NOT NULL,
  `PrecioPersona` float NOT NULL,
  `Guia` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Ruta`
--

INSERT INTO `Ruta` (`IDRuta`, `Nombre`, `FechaRealizacion`, `Cupo`, `PrecioPersona`, `Guia`) VALUES
(1, 'Desde La Aventura', '2021-07-09 07:00:00', 18, 749, 'Santos Noe Huchin'),
(2, 'Mayas Ancestrales', '2021-03-21 10:30:00', 32, 1449, 'Jose Manuel Gil'),
(3, 'Tentacion Campechana', '2021-05-31 09:15:00', 38, 949, 'Santos Noe Huchin');

-- --------------------------------------------------------

--
-- Table structure for table `ServEspecial`
--

CREATE TABLE `ServEspecial` (
  `IDServEspecial` int(11) NOT NULL,
  `Nombre` varchar(40) NOT NULL,
  `Precio` float NOT NULL,
  `Disponibles` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ServEspecial`
--

INSERT INTO `ServEspecial` (`IDServEspecial`, `Nombre`, `Precio`, `Disponibles`) VALUES
(1, 'Audioguia', 55, 438),
(2, 'Scooter electrico', 198, 21),
(3, 'Transporte y asistencia: adultos mayores', 224, 13),
(4, 'Fotografia durante ruta', 198, 10),
(5, 'Cuidador de niños', 235, 9);

-- --------------------------------------------------------

--
-- Table structure for table `SitioTuristico`
--

CREATE TABLE `SitioTuristico` (
  `IDSitioTuristico` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `SitioTuristico`
--

INSERT INTO `SitioTuristico` (`IDSitioTuristico`, `Nombre`, `Descripcion`) VALUES
(1, 'Zona arqueológica de Calakmul', 'Calakmul fue una de las ciudades más importantes de la civilización maya. Sus majestuosos edificios se han dejado conquistar por la selva creando un panorama onírico difícil de olvidar. Parte de la excelente conservación de la zona se debe a que forma parte de la Reserva de la Biósfera de Calakmul, considerada como el segundo pulmón más grande del continente y la mayor reserva ecológica tropical en México. \r\nCon más de 70 kilómetros cuadrados de extensión y cerca de 6,000 estructuras, Calakmul fue uno de los grandes poderes regionales del periodo Clásico maya junto con Palenque, El Mirador y Tikal. Prepárate para vivir una experiencia única en medio de la selva y acércate a un pueblo ancestral de guerreros.'),
(2, 'Ciudad de Campeche', 'Campeche surgió como un puerto estratégico de intercambio comercial entre Europa y el Nuevo Mundo. La ciudad fue continuamente asediada por piratas por lo que tuvo que rodearse de una muralla, conformada por 500 metros de valla, dos puertas, dos fuertes y ocho baluartes, todo en forma de pentágono, dicha construcción se mantiene en pie hasta nuestros días.Este destino, declarado Patrimonio de la Humanidad por la Unesco, mantiene íntegro su pasado que se refleja en sus calles, plazas, iglesias y casonas.\r\nAdmira su arquitectura colonial, militar y religiosa, con un estilo urbano barroco hispanoamericano. Recorre las calles de esta ciudad, rodeadas de casonas de decoración morisca y española del siglo XVIII y coloridas fachadas. En el centro histórico podrás conocer sus siete baluartes, algunos de los cuales se han convertido en museos: el Museo de la Ciudad Casa del Teniente Rey, el Museo de la Arquitectura Maya – Baluarte San Carlos y el Museo Regional de Campeche Casa de Artesanías Tukulná – Fuerte de San José.'),
(3, 'Grutas de X’tacumbilxuna’an', 'Se localizan en el poblado de Bolonchén de Rejón, municipio de Hopelchén, a 100 kilómetros de la ciudad de Campeche. Su formación data de unos siete millones de años y están catalogadas como las más importantes en su tipo en la Península de Yucatán gracias a la disposición casi vertical de algunas de sus cámaras.Estas grutas, consideradas como un lugar sagrado para los mayas, tienen una extensión de 200 metros y 80 metros de profundidad. El exterior está rodeado de exuberante vegetación y en su interior encontrarás impresionantes formaciones de estalactitas y estalagmitas de caprichosas formas. Una de las más populares es el “Balcón de la bruja” desde donde se puede apreciar una gran bóveda con un agujero por el cual penetra la luz que ilumina el recinto.'),
(4, 'Isla Arena', 'Ubicada en el municipio de Calkiní, isla Arena forma parte de Reserva de la Biosfera de Celestún. Si eres amante de los encuentros con la naturaleza, en sus esteros podrás observar impresionantes colonias de flamencos rosas que dan fama a esta región, al igual que una enorme diversidad de aves marinas como cormoranes, fragatas y pelícanos.En isla Arena hay pequeñas playas y un largo muelle con diversas embarcaciones. Relájate en sus blancos arenales o recorre en lancha sus extensos manglares.'),
(5, 'Palizada', 'Pueblo Mágico de coloridas casas con techos de dos aguas de teja francesa, bellos portales, iglesias y callejuelas donde aún se puede sentir el sabor provinciano. El pueblo de Palizada está rodeado por el río del mismo nombre cuya desembocadura llega a la Laguna de Términos. Recorre el río y observa su flora y fauna en la que destacan manatíes y monos aulladores.También puedes visitar sus ranchos ganaderos a través de senderos a caballo, y desde luego, probar su deliciosa gastronomía con ingredientes como el pejelagarto, el robalo, el mango o el chicozapote. Deléitate con la mezcla de la tradición yucateca y tabasqueña que hacen de Palizada uno de los sitios con mayor diversidad en Campeche.'),
(6, 'Champotón', 'Este es otro excelente lugar para disfrutar de la historia y la naturaleza. Aunque no hay playas propiamente dichas en el poblado de Champotón; si viajas 15 km al sur encontrarás una gran zona arenosa con playas importantes, como lo son Punta Xen y Chenkán, que incluso cuentan con un campamento tortuguero.\r\nDentro de la oferta turística de Champotón destacan las fiestas de la Virgen de la Candelaria, quese celebra del 28 de enero al 8 de febrero, en la localidad de Hool, y la de la fiesta de la virgen Inmaculada de la Purísima Concepción, que se realiza del 30 de noviembre al 8 de diciembre en Champotón. Anota en tu agenda estas fechas pues el pueblo se viste de fiesta para recibir a los turistas.'),
(7, 'Zona arqueológica de Balamkú', 'El nombre del sitio deriva de las palabras mayas Balam (jaguar) y Kú (templo), significando “Templo del Jaguar”. Dicho nombre alude a uno de los jaguares plasmados en el friso de estuco modelado y policromado que corona la Sub-estructura I-A del Grupo Central, que caracteriza a esta ciudad prehispánica.\r\nEn Balamkú se encuentra un friso de estuco modelado y pintado único en el área maya, que fue elaborado entre 550 y 600 d. C. En el friso se aprecian 4 escenas de ascensión alternadas con tres jaguares. Cada una comprende un animal con la cabeza volteada hacia atrás, sentado en la hendidura frontal de un mascarón del Monstruo de la Tierra; su boca, da paso a un rey sobre su trono. Además de ilustrar en detalle los aspectos opuestos y complementarios del inframundo, el conjunto muestra que el ciclo dinástico es equiparado al ciclo solar. En esta concepción, la accesión al trono es ilustrada por el rey saliendo de las fauces del monstruo terrestre, como el Sol sale de la boca de la Tierra; la muerte del rey es vista como una puesta de Sol, cuando cae en la boca del Monstruo Terrestre. Ubicación cronológica principal: Clásico, 300 a 1000 d. C.'),
(8, 'Zona arqueológica de Becán', 'La existencia de un foso que rodea el área nuclear de Becán determinó su nombre, que en maya yucateco significa “Camino o cavidad dejada por el correr del agua”, nombre que hace referencia al rasgo más notable del sitio: un foso que rodea los principales conjuntos arquitectónicos comprendidos por los edificios más voluminosos y elevados del sitio.\r\nUbicada en el Estado de Campeche en la región conocida como Río Bec. Esta región se caracteriza por presentar en su arquitectura grandes paneles en damero o tablero de ajedrez, además de altas y angostas torres a los lados de los templos principales. Estas torres tienen escalinatas y templos aparentes, los vanos de estos últimos están simulados con nichos. Sin embargo en la lejanía las torres parecen ser espacios totalmente útiles y no solo un elemento decorativo. Becán es un sitio de singular importancia al estar rodeado por un foso artificial que para algunos investigadores es evidencia de la elevada actividad bélica entre este y otros sitios vecinos. Para ingresar a la zona monumental rodeada por el foso hay siete entradas, por las que podía acceder la población asentada fuera de este y dedicada a las labores agrícolas y artesanales. Por su importancia y localización, Becán está considerada como capital regional, es decir que encabezaba la organización político territorial de otros asentamientos menores. Cronología: 600 a. C. a 1400 d. C. Ubicación cronológica principal: Clásico Tardío a Posclásico Temprano, 600 a 1000 d. C.'),
(9, 'Zona arqueológica de Chicanná', 'Chicanná significa en maya yucateco “en la casa de la boca de la serpiente” (Chi: boca, Can: serpiente, Ná: casa), nombrado así por su descubridor, el ingeniero Jack Eaton, refiriéndose a la Estructura II, que tiene en su fachada oeste un gran mascarón que representa al Monstruo de la Tierra.\r\nChicanná es el sitio que cuenta con el mayor número de edificios tipo “Río Bec” en buen estado de conservación. Los paneles de mascarones que tienen las Estructuras I, VI y XX, son buenos ejemplos de la iconografía regional y muestran la evolución de las representaciones del Monstruo de la Tierra; por otro lado, el análisis de los materiales arqueológicos de Chicanná hacen que sea posible la interpretación sobre las relaciones existentes entre la antigua ciudad de Becán y este centro periférico tan cercano a la metrópoli regional. El abandono del asentamiento está estrechamente ligado a la caída de Becán, en los inicios del siglo XIII, del cual fue dependiente durante todo su desarrollo. Cronología: 300 a. C. a 1100 d.C. Ubicación cronológica principal: Clásico Tardío, 500 a 700 d.C.'),
(10, 'Zona arqueológica de Edzná', 'Itzá es el nombre de un linaje de origen chontal que se estableció en el sitio. Por extensión, los pobladores de otros asentamientos se referían a los habitantes de esta antigua ciudad maya como “Itzáes”; de aquí proviene su nombre: Ytzná / Edzná: “Casa de los Itzáes”.\r\nEl asentamiento precolombino tuvo una extensión promedio de 25 km². Las primeras evidencias de presencia humana datan del año 600 a. C. Una pequeña comunidad creció, se desarrolló y conformó, poco antes del inicio de nuestra era, un gobierno centralizado. Se construyó un eficiente sistema de captación, almacenamiento y desecho pluvial; se concentró la producción, se erigieron grandes edificios y se dominó a los pueblos de los alrededores. Edzná constituyó una poderosa capital regional del occidente peninsular entre los años 400 y 1000 d. C. Los siguientes cuatro siglos perdieron fuerza política y económica hasta su abandono alrededor del año 1450 d. C. Como en otros sitios del mundo maya, las primeras edificaciones de Edzná fueron revestidas con grandes bloques de caliza, regularmente cortados, cubiertos con gruesos aplanados de estuco y pintados de rojo intenso. Muchas fachadas fueron decoradas con rostros de dioses, con animales míticos y símbolos; los motivos eran de estuco modelado (similar al yeso) y eran pintados de varios colores. Todos estos elementos se consideran característicos de la arquitectura Petén. El desarrollo del sitio llevó luego a crear edificios con otros estilos arquitectónicos como Chenes, Puuc y Tardíos. De modo que en Edzná encontramos una larga secuencia de construcciones a lo largo de poco más de 15 siglos.'),
(11, 'Zona arqueológica del tigre', '“El Tigre” ha sido identificado por diversos autores como el Itzamkanac de las fuentes históricas. El nombre con el que se le conoce actualmente corresponde al del ejido en el que se encuentra. Acalán, o “Lugar de Canoas”, es el nombre con el que se conocía a la provincia prehispánica del grupo maya chontal asentado a orillas del Río Candelaria.\r\nDebido a lo imponente de las construcciones y la extensión de la zona, se piensa que El Tigre corresponde al Itzamkanac de las fuentes históricas, capital de los acalanes y lugar donde Hernán Cortés asesinó a Cuauhtémoc. En el centro ceremonial se buscan hoy vestigios que indiquen la advocación de los templos, presuntamente consagrados a deidades de origen chontal como Ixchel e Itzamná. Este último fue el dios más adorado por las clases dirigentes, quienes pudieron haber intentado instaurar un monoteísmo. Sobre un lomerío junto al Río Candelaria se asienta el sitio de Itzamkanac o El Tigre; con una larga secuencia de ocupación que va desde el Preclásico Medio (600-300 a. C.) hasta el Protohistórico (ca. 1557 d. C.). Conformado por 6 grupos arquitectónicos, el área central del sitio no ha mostrado un estilo definido. Una de las plazas está rodeada por basamentos piramidales y mascarones antropomorfos del Preclásico. El asentamiento cuenta con varios estilos arquitectónicos: Petén, Río Bec y Tardío.'),
(12, 'Zona arqueológica de Santa Rosa Xtampak', 'Xtampak significa en lengua maya, “Muros Viejos”. \r\nAlgunos consideran a Santa Rosa Xtampak como, tal vez, la capital regional más importante de los Chenes; ahí plasmaron tal poderío, que es de los pocos sitios de la región que posee altares, estelas esculpidas con fechas de eventos acontecidos, esculturas exentas, construcción de basamentos piramidales y en tiempos más tardíos, quizá alrededor del año 900 al 1100 de nuestra era, la introducción de lo que se ha reportado como un sacbé o camino que une dos de los conjuntos arquitectónicos principales y la remodelación e incremento de la más notable, pero no más volumétrica, de sus construcciones: El Palacio. En resumen, en esa antigua ciudad, se encuentra todo lo “atípico” para la región, aspecto relevante para los especialistas para considerarla como una capital regional, es decir el poseer elementos esenciales que las pequeñas ciudades periféricas no poseen, por estar supeditadas al control y la dependencia de una capital. Aunado a ello, la extensión territorial del asentamiento (30 kilómetros cuadrados) y que su radio de poder e influencia se ha calculado en 400 kilómetros cuadrados, colocan a Santa Rosa Xtampak como uno de los sitios más espectaculares de la provincia Chenes.'),
(13, 'Zona arqueológica de Xpuhil', 'El nombre del sitio se debe a la antigua existencia de una planta llamada “cola de gato” (xpuh, en maya yucateco); il es un sufijo que indica “lugar de”). La planta crecía alrededor de una aguada hoy prácticamente desaparecida por el crecimiento urbano.\r\nLas primeras evidencias de ocupación datan del 400 a. C. pero su etapa más importante llega hacia el Clásico Terminal, aunque es posible que desde el Clásico Temprano, Xpuhil y toda la región de Río Bec se empiece a constituir como un bloque peninsular bien definido étnicamente. Una característica que resalta en el sitio es que el llamado Edificio 1 es atípico en cuanto a su arquitectura ya que presenta tres torres en lugar de las dos típicas del estilo Río Bec. Cronología: 400 a. C. a 1200 d. C. Ubicación cronológica principal: Clásico Tardío, 600 a 800 d. C. Recientemente, el Arqlgo. Vicente Suárez Aguilar ha realizado trabajos de investigación, conservación y salvamento arqueológico de los grupos 3 y 20 localizados dentro de la zona urbana y actual periferia de la cabecera municipal de Xpujil. Estos asentamientos, en total 24, forman parte de la gran urbe prehispánica conocida como zona arqueológica de Xpuhil, la cual cubre 6 kilómetros de este a oeste por 2 de norte a sur.'),
(14, 'Cenotes Miguel Colorado', 'Cenote es un término que tiene su origen en el vocablo maya tz’onot y que significa pozo o abismo. Un cenote es un depósito de agua manantial con una cierta profundidad. Los cenotes surgieron en cavernas tras los derrumbes de techo de una o más cuevas. Con la acumulación de aguas subterráneas, se formaron estanques que pueden ser más o menos profundos. Para los mayas, los cenotes eran lugares sagrados.\r\nMiguel Colorado es un conjunto de cenotes localizados en la densa selva campechana. La ruta de los cenotes, son tres: el cenote azul, el de los patos y el del K41.\r\nCenote Azul\r\nEstá ubicado a tan solo una hora de Campeche por Champotón. En este parque ecológico, puedes realizar una caminata, ascendiendo por los cerros que lo rodean. Tiene 250 metros de diámetro.\r\nCenote De Los Patos\r\nDespués de 400 metros se llega al cenote de los Patos, donde ciertamente habitan muchas de estas aves, como el Patillo pijiji originario de la región y dos especies migratorias como el Pato cerceta y moscovich, que llegaron para quedarse y hacer de este cenote su hogar.\r\nEl Cenote de los Patos tiene un diámetro de 200 metros. Hasta ahora nadie ha bajado al fondo ya que en las paredes hay grandes enjambres de abejas africanas, que pueden ser una amenaza seria en caso de querer descender.\r\nCenote K41\r\nLlamado así por estar ubicado a orillas de las vías del tren en el kilómetro 41. El Cenote K41 es sin duda el más impactante de la zona, está oculto en la selva.\r\nLo particular de este lugar es su profundidad de cerca de 115 metros y que es el hogar de miles de murciélagos, si lo visitas al anochecer puedes disfrutar de la forma en que los mamíferos salen a buscar comida.'),
(15, 'Hopelchén', 'Hopelchén (en maya yucateco: Lugar de los cinco pozos) es una ciudad del estado mexicano de Campeche, situada al este del territorio cercana a la frontera con el Estado de Yucatán, en la denominada Región de los Chenes. Es cabecera del Municipio de Hopelchén. La región donde se asienta la ciudad de Hopelchén fue una importante zona de la cultura maya, por lo que su población era muy elevada, Hopelchén fue fundada aproximadamente en 1621 como un pueblo de congregación, es decir un asentamiento para atraer y evangelizar a los pobladores mayas de la región, pronto llegó a conjuntar a más de 20,000; sin embargo, como en el resto de la península, los mayas fueron sumamente reacios a aceptar la conquista española y Hopelchén fue uno de los centros de esa rebeldía, aunque por su posición fue una población intermedia entre las zonas plenamente conquistadas del camino que unía a San Francisco de Campeche con Mérida y el interior de la península donde se refugiaban los mayas rebeldes. Pronto Hopelchén constituyó un importante centro de intercambio comercial donde diversos grupos mayas intercambiaban los productos que producían en diversas regiones.\r\nHacia inicios del Siglo XVIII la población se acrencentó con españoles, datando de esta época los principales monumentos arquitectónicos coloniales de la ciudad, que se convirtió en el centro de la llamada Región de los Chenes, es decir, Región de los Pozos en maya, conocida así por los pozos o aguadas que existían y que se convirtieron en focos de población.'),
(16, 'Zona arqueológica de Xcalumkín', 'Según Maler, el toponímico puede traducirse como “Suelo Doblemente Bueno Expuesto al Sol”, aunque el historiador norteamericano Ralph Roys propone que el nombre del sitio puede ser Calomkín, que significa “Ventana por donde entra el Sol”. \r\nLa secuencia cerámica de Xcalumkín principia con algunos materiales del Preclásico Tardío, escasa presencia del Clásico Temprano y fuerte ocupación del Clásico Tardío y Terminal. Las fechas registradas en las inscripciones jeroglíficas de Xcalumkín van del 731 al 771 de nuestra era. Aparentemente no hay elementos del Posclásico. Xcalumkín fue un asentamiento maya importante del periodo Clásico, en especial del 600 al 1000 de nuestra era. Sus vestigios se extienden en una superficie promedio de 10 km². En sus inmuebles se ha documentado la sucesión de tres fases arquitectónicas propias del estilo Puuc. Cabe comentar que sólo unos cuantos edificios de Xcalumkín fueron usados como templos; no existen basamentos piramidales de gran altura y tampoco se ha registrado juego de pelota.'),
(17, 'Hecelchakán', 'La ciudad de Hecelchakán se localiza al noroeste del estado a 82 kms. de la ciudad de la ciudad de Campeche. Su nombre se traduce del maya al español como “Sabana del Descanso”, debido a que fue un lugar donde los viajeros se detenían para descansar de su largo recorrido; el sitio era ideal porque contaba con un cenote para abastecerse de agua y árboles frondosos que les proporcionaban sombra y frutos. Fue fundada por los habitantes de la extinta población de Xacalumkin entre los años de 1550 y 1600. \r\nUno de los atractivos más visitados de la ciudad de Hecelchakán es la iglesia de San Francisco de Asís, una imponente construcción religiosa del siglo XVII hecha a base de cantera y sahcab por la orden franciscana. Esta edificación del Virreinato es testimonio de la conquista espiritual que sufrieron los antiguos mayas durante la colonización española; hoy en día sigue siendo un referente de la fe católica.\r\nHacia el norte, sobre la misma plaza principal, uno puede sentir el olor del guiso más tradicional de Hecelchakán: la cochinita. Existen una serie de espacios habilitados para la venta de este platillo, que es degustado por cientos de visitantes al día. También se elabora el famoso pan de Pomuch del cual se dice es el mejor de la región. ');

-- --------------------------------------------------------

--
-- Structure for view `mostrarCSE`
--
DROP TABLE IF EXISTS `mostrarCSE`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `mostrarCSE`  AS  select `ContratacionSE`.`IDContratacionSE` AS `IDContratacionSE`,`ServEspecial`.`Nombre` AS `Nombre`,`ContratacionSE`.`IDReserva` AS `IDReserva`,`ContratacionSE`.`Cantidad` AS `Cantidad`,`ContratacionSE`.`Total` AS `Total`,`ContratacionSE`.`Confirmacion` AS `Confirmacion` from (`ContratacionSE` join `ServEspecial` on(`ServEspecial`.`IDServEspecial` = `ContratacionSE`.`IDServEspecial`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Articulo`
--
ALTER TABLE `Articulo`
  ADD PRIMARY KEY (`IDArticulo`);

--
-- Indexes for table `CompraA`
--
ALTER TABLE `CompraA`
  ADD PRIMARY KEY (`IDCompraA`),
  ADD KEY `IDArticulo` (`IDArticulo`),
  ADD KEY `IDUsuario` (`IDUsuario`);

--
-- Indexes for table `ContratacionSE`
--
ALTER TABLE `ContratacionSE`
  ADD PRIMARY KEY (`IDContratacionSE`),
  ADD KEY `IDServEspecial` (`IDServEspecial`),
  ADD KEY `IDReserva` (`IDReserva`);

--
-- Indexes for table `CuentaUsuario`
--
ALTER TABLE `CuentaUsuario`
  ADD PRIMARY KEY (`IDUsuario`);

--
-- Indexes for table `ParteRuta`
--
ALTER TABLE `ParteRuta`
  ADD PRIMARY KEY (`IDParteRuta`),
  ADD KEY `IDRuta` (`IDRuta`);

--
-- Indexes for table `Reserva`
--
ALTER TABLE `Reserva`
  ADD PRIMARY KEY (`IDReserva`),
  ADD KEY `IDUsuario` (`IDUsuario`),
  ADD KEY `IDRuta` (`IDRuta`);

--
-- Indexes for table `Ruta`
--
ALTER TABLE `Ruta`
  ADD PRIMARY KEY (`IDRuta`);

--
-- Indexes for table `ServEspecial`
--
ALTER TABLE `ServEspecial`
  ADD PRIMARY KEY (`IDServEspecial`);

--
-- Indexes for table `SitioTuristico`
--
ALTER TABLE `SitioTuristico`
  ADD PRIMARY KEY (`IDSitioTuristico`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Articulo`
--
ALTER TABLE `Articulo`
  MODIFY `IDArticulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `CompraA`
--
ALTER TABLE `CompraA`
  MODIFY `IDCompraA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ContratacionSE`
--
ALTER TABLE `ContratacionSE`
  MODIFY `IDContratacionSE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `CuentaUsuario`
--
ALTER TABLE `CuentaUsuario`
  MODIFY `IDUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ParteRuta`
--
ALTER TABLE `ParteRuta`
  MODIFY `IDParteRuta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `Reserva`
--
ALTER TABLE `Reserva`
  MODIFY `IDReserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `Ruta`
--
ALTER TABLE `Ruta`
  MODIFY `IDRuta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ServEspecial`
--
ALTER TABLE `ServEspecial`
  MODIFY `IDServEspecial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `SitioTuristico`
--
ALTER TABLE `SitioTuristico`
  MODIFY `IDSitioTuristico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `CompraA`
--
ALTER TABLE `CompraA`
  ADD CONSTRAINT `CompraA_ibfk_1` FOREIGN KEY (`IDArticulo`) REFERENCES `Articulo` (`IDArticulo`),
  ADD CONSTRAINT `CompraA_ibfk_2` FOREIGN KEY (`IDUsuario`) REFERENCES `CuentaUsuario` (`IDUsuario`);

--
-- Constraints for table `ContratacionSE`
--
ALTER TABLE `ContratacionSE`
  ADD CONSTRAINT `ContratacionSE_ibfk_1` FOREIGN KEY (`IDServEspecial`) REFERENCES `ServEspecial` (`IDServEspecial`),
  ADD CONSTRAINT `ContratacionSE_ibfk_2` FOREIGN KEY (`IDReserva`) REFERENCES `Reserva` (`IDReserva`);

--
-- Constraints for table `ParteRuta`
--
ALTER TABLE `ParteRuta`
  ADD CONSTRAINT `ParteRuta_ibfk_1` FOREIGN KEY (`IDRuta`) REFERENCES `Ruta` (`IDRuta`);

--
-- Constraints for table `Reserva`
--
ALTER TABLE `Reserva`
  ADD CONSTRAINT `Reserva_ibfk_1` FOREIGN KEY (`IDUsuario`) REFERENCES `CuentaUsuario` (`IDUsuario`),
  ADD CONSTRAINT `Reserva_ibfk_2` FOREIGN KEY (`IDRuta`) REFERENCES `Ruta` (`IDRuta`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
