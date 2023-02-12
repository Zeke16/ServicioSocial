-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-02-2023 a las 17:57:54
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `servicio_social`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('MasterRol', '1', 1646099809),
('UsuarioConsultorRol', '22', 1674767206),
('UsuarioEstandarRol', '16', 1674765330),
('UsuarioEstandarRol', '21', 1674766903),
('UsuarioEstandarRol', '24', 1675043643),
('UsuarioEstandarRol', '3', 1672955153),
('UsuarioSupervisorRol', '2', 1646099817),
('UsuarioSupervisorRol', '23', 1674767286);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('/categorias/*', 2, NULL, NULL, NULL, 1646099417, 1646099417),
('/debug/*', 2, NULL, NULL, NULL, 1646099442, 1646099442),
('/gii/*', 2, NULL, NULL, NULL, 1646099450, 1646099450),
('/gridview/*', 2, NULL, NULL, NULL, 1646099465, 1646099465),
('/inicio/*', 2, NULL, NULL, NULL, 1646099380, 1646099380),
('/inicio/index', 2, NULL, NULL, NULL, 1646100390, 1646100390),
('/inicio/resta', 2, NULL, NULL, NULL, 1646100390, 1646100390),
('/inicio/suma', 2, NULL, NULL, NULL, 1646100390, 1646100390),
('/productos/*', 2, NULL, NULL, NULL, 1646099423, 1646099423),
('/rbac/*', 2, NULL, NULL, NULL, 1646099493, 1646099493),
('/site/*', 2, NULL, NULL, NULL, 1646099406, 1646099406),
('/tbl-comisiones/*', 2, NULL, NULL, NULL, 1672940630, 1672940630),
('/tbl-estado-incidencia/*', 2, NULL, NULL, NULL, 1674665062, 1674665062),
('/tbl-incidencias/*', 2, NULL, NULL, NULL, 1672940625, 1672940625),
('/tbl-tipo-incidencias/*', 2, NULL, NULL, NULL, 1672940628, 1672940628),
('/usuarios/*', 2, NULL, NULL, NULL, 1646099428, 1646099428),
('/usuarios/update', 2, NULL, NULL, NULL, 1646100607, 1646100607),
('/usuarios/view', 2, NULL, NULL, NULL, 1646100568, 1646100568),
('MasterAccess', 2, 'Permiso para acceder a todas las rutas del sistema como SuperAdmin', NULL, NULL, 1646099558, 1646099558),
('MasterRol', 1, 'Rol Master', NULL, NULL, 1646099694, 1646099771),
('UsuarioConsultorAccess', 2, 'Permisos para un usuario visitante', NULL, NULL, 1672954779, 1672954779),
('UsuarioConsultorRol', 1, NULL, NULL, NULL, 1672954647, 1672954647),
('UsuarioEstandarAccess', 2, 'Acceso limitado de usuario a crear una incidencia', NULL, NULL, 1646099606, 1672954708),
('UsuarioEstandarRol', 1, 'Rol de usuario estandar', NULL, NULL, 1672954688, 1672954688),
('UsuarioSupervisorAccess', 2, 'Permisos de un usuario supervisor', NULL, NULL, 1672954948, 1672954948),
('UsuarioSupervisorRol', 1, 'Rol de usuario', NULL, NULL, 1646099726, 1672954624);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('MasterAccess', '/categorias/*'),
('MasterAccess', '/debug/*'),
('MasterAccess', '/gii/*'),
('MasterAccess', '/gridview/*'),
('MasterAccess', '/inicio/*'),
('MasterAccess', '/productos/*'),
('MasterAccess', '/rbac/*'),
('MasterAccess', '/site/*'),
('MasterAccess', '/tbl-comisiones/*'),
('MasterAccess', '/tbl-estado-incidencia/*'),
('MasterAccess', '/tbl-incidencias/*'),
('MasterAccess', '/tbl-tipo-incidencias/*'),
('MasterAccess', '/usuarios/*'),
('MasterRol', 'MasterAccess'),
('UsuarioConsultorAccess', '/site/*'),
('UsuarioConsultorAccess', '/usuarios/update'),
('UsuarioConsultorAccess', '/usuarios/view'),
('UsuarioConsultorRol', 'UsuarioConsultorAccess'),
('UsuarioEstandarAccess', '/site/*'),
('UsuarioEstandarAccess', '/tbl-incidencias/*'),
('UsuarioEstandarAccess', '/usuarios/update'),
('UsuarioEstandarAccess', '/usuarios/view'),
('UsuarioEstandarRol', 'UsuarioEstandarAccess'),
('UsuarioSupervisorAccess', '/site/*'),
('UsuarioSupervisorAccess', '/tbl-incidencias/*'),
('UsuarioSupervisorAccess', '/usuarios/update'),
('UsuarioSupervisorAccess', '/usuarios/view'),
('UsuarioSupervisorRol', 'UsuarioSupervisorAccess');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1644760080),
('m130524_201442_init', 1644760082),
('m140506_102106_rbac_init', 1646099002),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1646099002),
('m180523_151638_rbac_updates_indexes_without_prefix', 1646099002),
('m200409_110543_rbac_update_mssql_trigger', 1646099002);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_categorias`
--

CREATE TABLE `tbl_categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `fecha_ing` datetime NOT NULL,
  `fecha_mod` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_categorias`
--

INSERT INTO `tbl_categorias` (`id_categoria`, `nombre`, `fecha_ing`, `fecha_mod`, `id_usuario`, `estado`) VALUES
(1, 'VideoJuegos', '2022-02-20 15:00:10', '2022-02-20 09:15:38', 1, 1),
(2, 'Juegos de Mesa', '2022-02-20 15:00:33', '2022-02-20 15:00:33', 1, 1),
(3, 'Cocina', '2022-02-20 15:02:22', '2022-02-20 15:02:22', 10, 1),
(4, 'Jardin', '2022-02-20 15:06:26', '2022-02-20 09:42:23', 1, 0),
(5, 'Consolas', '2022-02-20 15:08:35', '2022-02-20 15:08:35', 1, 1),
(6, 'Audio', '2022-02-20 09:11:08', '2022-02-20 09:40:23', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_comisiones`
--

CREATE TABLE `tbl_comisiones` (
  `id_comision` int(11) NOT NULL,
  `nombre_comision` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_comisiones`
--

INSERT INTO `tbl_comisiones` (`id_comision`, `nombre_comision`) VALUES
(1, 'PNC'),
(2, 'MOP'),
(3, 'FOVIAL'),
(4, 'SALUD'),
(5, 'BOMBEROS'),
(6, 'MARN'),
(7, 'CUERPOS DE SOCORRO'),
(8, 'PERSONA NATURAL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_departamentos`
--

CREATE TABLE `tbl_departamentos` (
  `id_departamento` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `codigo` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_departamentos`
--

INSERT INTO `tbl_departamentos` (`id_departamento`, `nombre`, `codigo`) VALUES
(1, 'AHUACHAPAN', 'AH'),
(2, 'SANTA ANA', 'SA'),
(3, 'SONSONATE', 'SO'),
(4, 'CHALATENANGO', 'CH'),
(5, 'LA LIBERTAD', 'LL'),
(6, 'SAN SALVADOR', 'SS'),
(7, 'CUSCATLAN', 'CU'),
(8, 'LA PAZ', 'LP'),
(9, 'CABAÑAS', 'CA'),
(10, 'SAN VICENTE', 'SV'),
(11, 'USULUTAN', 'US'),
(12, 'SAN MIGUEL', 'SM'),
(13, 'MORAZAN', 'MO'),
(14, 'LA UNION', 'LU');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_estado_incidencia`
--

CREATE TABLE `tbl_estado_incidencia` (
  `id_estado_incidencia` int(11) NOT NULL,
  `id_incidencia` int(11) NOT NULL,
  `estado` tinyint(11) NOT NULL,
  `retroalimentacion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_estado_incidencia`
--

INSERT INTO `tbl_estado_incidencia` (`id_estado_incidencia`, `id_incidencia`, `estado`, `retroalimentacion`) VALUES
(7, 7, 0, 'Incidencia en proceso de resolución');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_incidencias`
--

CREATE TABLE `tbl_incidencias` (
  `id_incidencia` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_municipio` int(11) NOT NULL,
  `id_tipo_incidencia` int(11) NOT NULL,
  `descripcion_incidencia` text NOT NULL,
  `ubicacion_incidencia` text NOT NULL,
  `imagen_incidencia` text NOT NULL,
  `fecha_registro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_incidencias`
--

INSERT INTO `tbl_incidencias` (`id_incidencia`, `id_usuario`, `id_municipio`, `id_tipo_incidencia`, `descripcion_incidencia`, `ubicacion_incidencia`, `imagen_incidencia`, `fecha_registro`) VALUES
(7, 2, 3, 2, 'a', '13.5024217, -88.1779086', '/servicioSocial/web/avatars/sLmTANsriPowDZEkaozmjXErWDFplRpq.jpg', '2023-02-12 10:56:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_municipios`
--

CREATE TABLE `tbl_municipios` (
  `id_municipio` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `id_departamento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_municipios`
--

INSERT INTO `tbl_municipios` (`id_municipio`, `nombre`, `id_departamento`) VALUES
(1, 'Ahuachapán', 1),
(2, 'Jujutla', 1),
(3, 'Atiquizaya', 1),
(4, 'Concepción de Ataco', 1),
(5, 'El Refugio', 1),
(6, 'Guaymango', 1),
(7, 'Apaneca', 1),
(8, 'San Francisco Menéndez', 1),
(9, 'San Lorenzo', 1),
(10, 'San Pedro Puxtla', 1),
(11, 'Tacuba', 1),
(12, 'Turín', 1),
(13, 'Candelaria de la Frontera', 2),
(14, 'Chalchuapa', 2),
(15, 'Coatepeque', 2),
(16, 'El Congo', 2),
(17, 'El Porvenir', 2),
(18, 'Masahuat', 2),
(19, 'Metapán', 2),
(20, 'San Antonio Pajonal', 2),
(21, 'San Sebastián Salitrillo', 2),
(22, 'Santa Ana', 2),
(23, 'Santa Rosa Guachipilín', 2),
(24, 'Santiago de la Frontera', 2),
(25, 'Texistepeque', 2),
(26, 'Acajutla', 3),
(27, 'Armenia', 3),
(28, 'Caluco', 3),
(29, 'Cuisnahuat', 3),
(30, 'Izalco', 3),
(31, 'Juayúa', 3),
(32, 'Nahuizalco', 3),
(33, 'Nahulingo', 3),
(34, 'Salcoatitán', 3),
(35, 'San Antonio del Monte', 3),
(36, 'San Julián', 3),
(37, 'Santa Catarina Masahuat', 3),
(38, 'Santa Isabel Ishuatán', 3),
(39, 'Santo Domingo de Guzmán', 3),
(40, 'Sonsonate', 3),
(41, 'Sonzacate', 3),
(42, 'Alegría', 11),
(43, 'Berlín', 11),
(44, 'California', 11),
(45, 'Concepción Batres', 11),
(46, 'El Triunfo', 11),
(47, 'Ereguayquín', 11),
(48, 'Estanzuelas', 11),
(49, 'Jiquilisco', 11),
(50, 'Jucuapa', 11),
(51, 'Jucuarán', 11),
(52, 'Mercedes Umaña', 11),
(53, 'Nueva Granada', 11),
(54, 'Ozatlán', 11),
(55, 'Puerto El Triunfo', 11),
(56, 'San Agustín', 11),
(57, 'San Buenaventura', 11),
(58, 'San Dionisio', 11),
(59, 'San Francisco Javier', 11),
(60, 'Santa Elena', 11),
(61, 'Santa María', 11),
(62, 'Santiago de María', 11),
(63, 'Tecapán', 11),
(64, 'Usulután', 11),
(65, 'Carolina', 12),
(66, 'Chapeltique', 12),
(67, 'Chinameca', 12),
(68, 'Chirilagua', 12),
(69, 'Ciudad Barrios', 12),
(70, 'Comacarán', 12),
(71, 'El Tránsito', 12),
(72, 'Lolotique', 12),
(73, 'Moncagua', 12),
(74, 'Nueva Guadalupe', 12),
(75, 'Nuevo Edén de San Juan', 12),
(76, 'Quelepa', 12),
(77, 'San Antonio del Mosco', 12),
(78, 'San Gerardo', 12),
(79, 'San Jorge', 12),
(80, 'San Luis de la Reina', 12),
(81, 'San Miguel', 12),
(82, 'San Rafael Oriente', 12),
(83, 'Sesori', 12),
(84, 'Uluazapa', 12),
(85, 'Arambala', 13),
(86, 'Cacaopera', 13),
(87, 'Chilanga', 13),
(88, 'Corinto', 13),
(89, 'Delicias de Concepción', 13),
(90, 'El Divisadero', 13),
(91, 'El Rosario (Morazán)', 13),
(92, 'Gualococti', 13),
(93, 'Guatajiagua', 13),
(94, 'Joateca', 13),
(95, 'Jocoaitique', 13),
(96, 'Jocoro', 13),
(97, 'Lolotiquillo', 13),
(98, 'Meanguera', 13),
(99, 'Osicala', 13),
(100, 'Perquín', 13),
(101, 'San Carlos', 13),
(102, 'San Fernando (Morazán)', 13),
(103, 'San Francisco Gotera', 13),
(104, 'San Isidro (Morazán)', 13),
(105, 'San Simón', 13),
(106, 'Sensembra', 13),
(107, 'Sociedad', 13),
(108, 'Torola', 13),
(109, 'Yamabal', 13),
(110, 'Yoloaiquín', 13),
(111, 'La Unión', 14),
(112, 'San Alejo', 14),
(113, 'Yucuaiquín', 14),
(114, 'Conchagua', 14),
(115, 'Intipucá', 14),
(116, 'San José', 14),
(117, 'El Carmen (La Unión)', 14),
(118, 'Yayantique', 14),
(119, 'Bolívar', 14),
(120, 'Meanguera del Golfo', 14),
(121, 'Santa Rosa de Lima', 14),
(122, 'Pasaquina', 14),
(123, 'Anamoros', 14),
(124, 'Nueva Esparta', 14),
(125, 'El Sauce', 14),
(126, 'Concepción de Oriente', 14),
(127, 'Polorós', 14),
(128, 'Lislique', 14),
(129, 'Antiguo Cuscatlán', 5),
(130, 'Chiltiupán', 5),
(131, 'Ciudad Arce', 5),
(132, 'Colón', 5),
(133, 'Comasagua', 5),
(134, 'Huizúcar', 5),
(135, 'Jayaque', 5),
(136, 'Jicalapa', 5),
(137, 'La Libertad', 5),
(138, 'Santa Tecla', 5),
(139, 'Nuevo Cuscatlán', 5),
(140, 'San Juan Opico', 5),
(141, 'Quezaltepeque', 5),
(142, 'Sacacoyo', 5),
(143, 'San José Villanueva', 5),
(144, 'San Matías', 5),
(145, 'San Pablo Tacachico', 5),
(146, 'Talnique', 5),
(147, 'Tamanique', 5),
(148, 'Teotepeque', 5),
(149, 'Tepecoyo', 5),
(150, 'Zaragoza', 5),
(151, 'Agua Caliente', 4),
(152, 'Arcatao', 4),
(153, 'Azacualpa', 4),
(154, 'Cancasque', 4),
(155, 'Chalatenango', 4),
(156, 'Citalá', 4),
(157, 'Comapala', 4),
(158, 'Concepción Quezaltepeque', 4),
(159, 'Dulce Nombre de María', 4),
(160, 'El Carrizal', 4),
(161, 'El Paraíso', 4),
(162, 'La Laguna', 4),
(163, 'La Palma', 4),
(164, 'La Reina', 4),
(165, 'Las Vueltas', 4),
(166, 'Nueva Concepción', 4),
(167, 'Nueva Trinidad', 4),
(168, 'Nombre de Jesús', 4),
(169, 'Ojos de Agua', 4),
(170, 'Potonico', 4),
(171, 'San Antonio de la Cruz', 4),
(172, 'San Antonio Los Ranchos', 4),
(173, 'San Fernando', 4),
(174, 'San Francisco Lempa', 4),
(175, 'San Francisco Morazán', 4),
(176, 'San Ignacio', 4),
(177, 'San Isidro Labrador', 4),
(178, 'Las Flores', 4),
(179, 'San Luis del Carmen', 4),
(180, 'San Miguel de Mercedes', 4),
(181, 'San Rafael', 4),
(182, 'Santa Rita', 4),
(183, 'Tejutla', 4),
(184, 'Cojutepeque', 7),
(185, 'Candelaria', 7),
(186, 'El Carmen (Cuscatlán)', 7),
(187, 'El Rosario (Cuscatlán)', 7),
(188, 'Monte San Juan', 7),
(189, 'Oratorio de Concepción', 7),
(190, 'San Bartolomé Perulapía', 7),
(191, 'San Cristóbal', 7),
(192, 'San José Guayabal', 7),
(193, 'San Pedro Perulapán', 7),
(194, 'San Rafael Cedros', 7),
(195, 'San Ramón', 7),
(196, 'Santa Cruz Analquito', 7),
(197, 'Santa Cruz Michapa', 7),
(198, 'Suchitoto', 7),
(199, 'Tenancingo', 7),
(200, 'Aguilares', 6),
(201, 'Apopa', 6),
(202, 'Ayutuxtepeque', 6),
(203, 'Cuscatancingo', 6),
(204, 'Ciudad Delgado', 6),
(205, 'El Paisnal', 6),
(206, 'Guazapa', 6),
(207, 'Ilopango', 6),
(208, 'Mejicanos', 6),
(209, 'Nejapa', 6),
(210, 'Panchimalco', 6),
(211, 'Rosario de Mora', 6),
(212, 'San Marcos', 6),
(213, 'San Martín', 6),
(214, 'San Salvador', 6),
(215, 'Santiago Texacuangos', 6),
(216, 'Santo Tomás', 6),
(217, 'Soyapango', 6),
(218, 'Tonacatepeque', 6),
(219, 'Zacatecoluca', 8),
(220, 'Cuyultitán', 8),
(221, 'El Rosario (La Paz)', 8),
(222, 'Jerusalén', 8),
(223, 'Mercedes La Ceiba', 8),
(224, 'Olocuilta', 8),
(225, 'Paraíso de Osorio', 8),
(226, 'San Antonio Masahuat', 8),
(227, 'San Emigdio', 8),
(228, 'San Francisco Chinameca', 8),
(229, 'San Pedro Masahuat', 8),
(230, 'San Juan Nonualco', 8),
(231, 'San Juan Talpa', 8),
(232, 'San Juan Tepezontes', 8),
(233, 'San Luis La Herradura', 8),
(234, 'San Luis Talpa', 8),
(235, 'San Miguel Tepezontes', 8),
(236, 'San Pedro Nonualco', 8),
(237, 'San Rafael Obrajuelo', 8),
(238, 'Santa María Ostuma', 8),
(239, 'Santiago Nonualco', 8),
(240, 'Tapalhuaca', 8),
(241, 'Cinquera', 9),
(242, 'Dolores', 9),
(243, 'Guacotecti', 9),
(244, 'Ilobasco', 9),
(245, 'Jutiapa', 9),
(246, 'San Isidro (Cabañas)', 9),
(247, 'Sensuntepeque', 9),
(248, 'Tejutepeque', 9),
(249, 'Victoria', 9),
(250, 'Apastepeque', 10),
(251, 'Guadalupe', 10),
(252, 'San Cayetano Istepeque', 10),
(253, 'San Esteban Catarina', 10),
(254, 'San Ildefonso', 10),
(255, 'San Lorenzo', 10),
(256, 'San Sebastián', 10),
(257, 'San Vicente', 10),
(258, 'Santa Clara', 10),
(259, 'Santo Domingo', 10),
(260, 'Tecoluca', 10),
(261, 'Tepetitán', 10),
(262, 'Verapaz', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_productos`
--

CREATE TABLE `tbl_productos` (
  `id_producto` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `fecha_ing` datetime NOT NULL,
  `fecha_mod` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `estado` tinyint(4) NOT NULL,
  `campo_extra` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_productos`
--

INSERT INTO `tbl_productos` (`id_producto`, `id_categoria`, `nombre`, `descripcion`, `imagen`, `fecha_ing`, `fecha_mod`, `id_usuario`, `estado`, `campo_extra`) VALUES
(2, 5, 'PS4', 'Role-based access control (RBAC) and attribute-based access control (ABAC) are two ways of controlling the authentication process and authorizing users. The primary difference between RBAC and ABAC is RBAC provides access to resources or information based on user roles, while ABAC provides access rights based on user, environment, or resource attributes. Essentially, when considering RBAC vs. ABAC, RBAC controls broad access across an organization, while ABAC takes a fine-grain approach.', '', '2022-02-20 10:16:07', '2022-02-20 10:16:07', 1, 1, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_incidencias`
--

CREATE TABLE `tbl_tipo_incidencias` (
  `id_tipo_incidencia` int(11) NOT NULL,
  `nombre_incidencia` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_tipo_incidencias`
--

INSERT INTO `tbl_tipo_incidencias` (`id_tipo_incidencia`, `nombre_incidencia`) VALUES
(1, 'Incendio'),
(2, 'Accidente automovilístico'),
(4, 'Otro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_usuarios`
--

CREATE TABLE `tbl_tipo_usuarios` (
  `id_tipo_usuario` int(11) NOT NULL,
  `nombre_tipo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_tipo_usuarios`
--

INSERT INTO `tbl_tipo_usuarios` (`id_tipo_usuario`, `nombre_tipo`) VALUES
(1, 'Usuario estandar'),
(2, 'Usuario de consulta'),
(3, 'Usuario supervisor'),
(4, 'Usuario administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuarios`
--

CREATE TABLE `tbl_usuarios` (
  `id_usuario` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nombres` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `apellidos` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dni` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `id_departamento` int(11) NOT NULL,
  `id_municipio` int(11) NOT NULL,
  `lugar_residencia` text COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `id_tipo_usuario` int(11) NOT NULL,
  `id_comision` int(11) NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imagen` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_usuarios`
--

INSERT INTO `tbl_usuarios` (`id_usuario`, `username`, `nombres`, `apellidos`, `dni`, `id_departamento`, `id_municipio`, `lugar_residencia`, `email`, `telefono`, `id_tipo_usuario`, `id_comision`, `auth_key`, `password_hash`, `password_reset_token`, `imagen`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'admin', 'admin', 'admin', '06045720-5', 9, 245, 'Colonia, barrio x', 'admin@admin.com', '213415464', 4, 8, 'Ss28K09BJeNt6p5cr9jOjhU68p7sf_ve', '$2y$13$Hkpi4vzKpl.0cT1P7T.wVOJZRMBjvR6PHkJYrBmn/pO6z7d7wnPyi', NULL, '/servicioSocial/web/avatars/dBC4_WA9QZx9sk7sYn3f8vrVcvQpqV-k.gif', 1, 1672782642, 1672957579, NULL),
(2, 'ezequielramirez', 'ezequiel', 'ramirez', '06045720-8', 5, 129, 'Colonia x', 'correo@gmail.com', '123456789', 1, 8, 'Ss28K09BJeNt6p5cr9jOjhU68p7sf_ve', '$2y$13$d96oRl3qDZ69sUx.w0H55.9iclN2Ymwi/mNrE/7CqDLgfHTVImilG', NULL, '/servicioSocial/web/avatars/default.png', 1, 1672782642, 1672782642, NULL),
(3, 'isaiherrera', 'isai', 'herrera', '435354', 5, 132, 'Colonia x', 'correo22@gmail.com', '34535345345', 3, 4, 'cumjC9JkXVZtYr4Rf8KVauomVEFmAOQi', '$2y$13$HAneNgFmBZ3X40yJ5kLpPuPoQRB.6kXUywjAB0lzUvQKxG3aihIV6', NULL, '/servicioSocial/web/avatars/default.png', 1, 1672954077, 1672954077, NULL),
(4, 'pruebade usuario', 'prueba', 'de usuario', '1231231542', 5, 131, 'Colonia x', 'kr2000456.16@gmail.com', '1231423453', 3, 3, 'lAdY-e6wmgVXk4pk8yitMHmK9UkqAEgr', '$2y$13$0vwUYLKNYy06GUs0SZaae.W6dD1N5DgfnlhLk2aBJWD02pud9JvYq', NULL, '/servicioSocial/web/avatars/default.png', 1, 1672955372, 1672957451, NULL),
(5, 'ezequiel ramirez 2de usuario', 'ezequiel ramirez 2', 'de usuario', '4353542342', 2, 13, 'Colonia x', 'corre342342oo@gmail.com', '123234', 1, 2, '-TKrkRB6cDZpsVsHclTYbci8tZ65SkRB', '$2y$13$AgPArWyATx5dx94uIOy/YexuSei.Lab3y6i/7G/JkJ8KatXSu0MLm', NULL, '/Nueva carpeta/ServicioSocial/web/avatars/z3fS-yUx4Egqvm1Zd1iiKabaKaR_NB6h.jpg', 1, 1674241812, 1674241812, NULL),
(6, 'pruebaramirez', 'prueba', 'ramirez', '5646464', 4, 154, 'Colonia x', 'co34534rreoo@gmail.com3', '123456', 3, 2, '5SCrqWYlL8ZopuclI4pmDSATWenrubrd', '$2y$13$XCL5Y3Sf882Q2u14iicwPuVZsn8YcS4AjKhRWwDZ5SVc8z9zHocs6', NULL, '/Nueva carpeta/ServicioSocial/web/avatars/Wsx5dFrZBUrrpJ2Q2hzKSU5ZoMhsivKf.jpg', 1, 1674241881, 1674241881, NULL),
(7, 'ezequiel ramirez 2ramirez', 'ezequiel ramirez 2', 'ramirez', '5675433243', 4, 153, 'Colonia x', 'corre3452342oo@gmail.com', '1231423453', 1, 8, 'PfrcfyAvBIvi2TjouubnLh9GzsAlbCWb', '$2y$13$xf.K9gMixYA.2pbbB0gUMeyKqQcpWfOrju1ORZ7FDFmoUv3ovmgLq', NULL, '/Nueva carpeta/ServicioSocial/web/avatars/xVbyFbPhMqrz1GNhGeV4haqDKDM4OqmB.jpg', 1, 1674241980, 1674241980, NULL),
(8, 'ezequielde usuario', 'ezequiel', 'de usuario', '3223432424', 3, 26, 'Colonia x', 'corr32eoo@gmail.com', '34535345345', 1, 8, 'p3mw1BlrcMniLidjfOwiX7H8_PtHz-AT', '$2y$13$0QGTnwphlk9DmsPJeNaBju1CnbvM4XDAFXFpLAm0GeaPaW5jjzGZG', NULL, '/servicioSocial/web/avatars/default.png', 1, 1674244293, 1674244293, NULL),
(9, 'ezffaafasfas', 'ezffa', 'afasfas', '3453242', 3, 27, 'casda', 'asasafa@gmail.com', '34234242', 3, 3, 'FDQGyJtwEH3oJ28Cy3FeE5hdbapKuZvv', '$2y$13$TpB55HpNhCxcVDVe7P308eb4nrf8UogJRZjRoRpZOiHRxQJL5GT5i', NULL, '/servicioSocial/web/avatars/default.png', 1, 1674246218, 1674246218, NULL),
(10, 'prueba deusuario con rol', 'prueba de', 'usuario con rol', '3252543252', 2, 14, 'Colonia x', 'kr2323000.16@gmail.com', '12332123', 1, 8, 'c7aqJeGT9uiiNpCeTPXt71saAzDZtddk', '$2y$13$f6KAFgmnVcCi3EYddqSAuuqshLd02SqVpiZjQ4Z1bkd8c5Qoy6At.', NULL, '/ServicioSocial/web/avatars/UIj_vTgehHvdwXFgncscSc60XoIhw6EO.jpg', 1, 1674762254, 1674762254, NULL),
(11, 'ezequiel ramirez 2asdfsdfsd', 'ezequiel ramirez 2', 'asdfsdfsd', '1233243542', 3, 30, 'Colonia x', 'corre2oo@gmail.com', '1241432', 1, 8, '8X97H8dXvUgRp4AAUXsLhxhLskLRnKOT', '$2y$13$wAouGClfJbJsPphZJCqljOMSISoGr4yVqTqHuaPYH3dRmhRQnTs1u', NULL, '/ServicioSocial/web/avatars/IxmDs7nj6M_QSMGuzxXD4zwgGg2BXon8.jpg', 1, 1674762966, 1674762966, NULL),
(13, 'ezequiel ramirezasramirez', 'ezequiel ramirezas', 'ramirez', '1231231435', 2, 15, 'Colonia x', 'correoo1@gmail.com', '123234', 1, 8, '2yPbQeqMKWRGweoxQVQT9HpilBsbCkis', '$2y$13$gc3Xq0CvwtEXKfOdgwOyG.6ixMCRcSy3bBApPZpw7cXKovyzzx1ce', NULL, '/ServicioSocial/web/avatars/default.png', 1, 1674763360, 1674763360, NULL),
(14, 'ezequiel ramirezas2134ramirez', 'ezequiel ramirezas2134', 'ramirez', '1231231423', 1, 2, 'Colonia x', 'correo1@gmail.com', '123234', 1, 8, 'LcuL04mJ2ipQsw4jsMvPSE9w1HNk1U6Y', '$2y$13$7CSiHjID4FaJTTskV5s/jOw98HlPh90JsvWzsXlOy0yAdaGlfBZ7C', NULL, '/ServicioSocial/web/avatars/default.png', 1, 1674763497, 1674763497, NULL),
(15, 'prueba32423de usuario', 'prueba32423', 'de usuario', '4353543243', 5, 133, 'Colonia x', 'corre1oo@gmail.com', '12354', 1, 8, 'XknDTLA9QnIRDSO5SPnscmjfXiRhHzPQ', '$2y$13$08AL/PATW9Fw/lXJRNP8tO6pDhu7jg7iabRDeKGsYeQB4lWHfNVDq', NULL, '/ServicioSocial/web/avatars/default.png', 1, 1674764974, 1674764974, NULL),
(16, 'pruebade usuario', 'prueba', 'de usuario', '4353544353', 5, 133, 'Colonia x', 'corre231oo@gmail.com', '12354', 1, 8, '318lH4_SFTCBarr1GezT4wxYqlB6TIHZ', '$2y$13$oQq/NkPr8ZGLfUlKEtSkxeSrZHpH4TYag09KUFxctxAS38PUygkQW', NULL, '/ServicioSocial/web/avatars/default.png', 1, 1674765262, 1674765262, NULL),
(17, 'ezequiel ramirez 2de usuario', 'ezequiel ramirez 2', 'de usuario', '3245546546', 2, 15, 'Colonia x', 'corre2o3242o@gmail.com', '324242', 1, 8, 'Hs4JLnfpoIrLoxLtqrlhHI4KQXgiL5mr', '$2y$13$Bva6mDoY5nsvyj4HM75S0etjZxFGYpchsMbuFzqgflrejsx9nJT1W', NULL, '/ServicioSocial/web/avatars/default.png', 1, 1674765640, 1674765640, NULL),
(18, 'ezequiel ramirez 2de usuario', 'ezequiel ramirez 2', 'de usuario', '2342432432', 1, 2, 'Colonia x', 'corre2o33424234242o@gmail.com', '324242', 1, 8, 't7BTmOmGarFa_8PjCWcp2CQViX5M8Z7q', '$2y$13$KG6daSieCeu2fK7ThWu5ke2.Zo9f2Ua2milOc3xuAJ9KihckQMIWm', NULL, '/ServicioSocial/web/avatars/default.png', 1, 1674765704, 1674765704, NULL),
(19, 'ezequiel ramirez 2ramirez', 'ezequiel ramirez 2', 'ramirez', '1255465476', 4, 154, 'Colonia x', 'correo324243253256o@gmail.com', '12345667', 1, 8, 'kuKsdgIFmnOee_51YoqIedI_zmgAHiG_', '$2y$13$XULNcApgnkb7CQTMGODta.LsphxmmAHsR1Jv4D1.Y.RuUIgBlgLP6', NULL, '/ServicioSocial/web/avatars/default.png', 1, 1674765794, 1674765794, NULL),
(20, 'pruebaasdfsdfsd', 'prueba', 'asdfsdfsd', '2356547658', 4, 154, 'Colonia x', 'corre2oo3534324@gmail.com', '34535345345', 1, 8, 'c7G68BBdSpmlLm249lx5lFaf_5Eu0OY0', '$2y$13$HgpdmNNH.q0BE5ULAh1S5uJN5h9otGUyIwwStWkCWcADmaAAaUrZ.', NULL, '/ServicioSocial/web/avatars/default.png', 1, 1674765970, 1674765970, NULL),
(21, 'ezequiel ramirez 2de usuario', 'ezequiel ramirez 2', 'de usuario', '3423465475', 3, 28, 'Colonia x', 'correo3242343243256o@gmail.com', '34535345345', 1, 8, '43XGPUOlMH7Un06-SKnYkdjn3AFqvBDb', '$2y$13$Hkpi4vzKpl.0cT1P7T.wVOJZRMBjvR6PHkJYrBmn/pO6z7d7wnPyi', NULL, '/ServicioSocial/web/avatars/default.png', 1, 1674766903, 1674766903, NULL),
(22, 'ezffadgsdgafasfas', 'ezffadgsdg', 'afasfas', '3453242464', 1, 1, 'casda', '123456@gmail.com', '34234242', 2, 1, 'Zaa0ArrSGDF2bAXKFGKeGDHxMHb2_cSG', '$2y$13$hP.UbZCDH4Je8VPo4LrsWuwAXJc6Ofx2QsVmwcE4miKSrizIsolUG', NULL, '/ServicioSocial/web/avatars/default.png', 1, 1674767206, 1674794942, NULL),
(23, 'ezffadgsdgegerafasfas', 'ezffadgsdgeger', 'afasfas', '3453262532', 4, 153, 'casda', '1234567@gmail.com', '34234242', 3, 4, 'ieo03tiu8Ilij30zKH3luD-5R95gZrBL', '$2y$13$D7MjqyWY4myd4QqvQqdaTeJS3Sz7w75MAPdqaBgijySY9xGIhJo32', NULL, '/ServicioSocial/web/avatars/default.png', 1, 1674767286, 1674767286, NULL),
(24, 'ezequiel ramirez 2de usuario', 'ezequiel ramirez 2', 'de usuario', '4356346534', 4, 156, 'sd', 'corr3453453eoo@gmail.com', 'fdgfdgdfgfdg', 1, 8, 'SJtvlKLy5tmup4skKFxr0MjBrjHxD-pW', '$2y$13$9mzIbb8TgzAOEV7O2QbLZuEfwgMrxNZM3Yb3sfLEYeQuistqw.wvS', NULL, '/ServicioSocial/web/avatars/daWhYCwta7QZz4_EeQzbAovwTTPAaawV.png', 1, 1675043643, 1675043643, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `idx-auth_assignment-user_id` (`user_id`);

--
-- Indices de la tabla `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indices de la tabla `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indices de la tabla `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indices de la tabla `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `tbl_categorias`
--
ALTER TABLE `tbl_categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `tbl_comisiones`
--
ALTER TABLE `tbl_comisiones`
  ADD PRIMARY KEY (`id_comision`);

--
-- Indices de la tabla `tbl_departamentos`
--
ALTER TABLE `tbl_departamentos`
  ADD PRIMARY KEY (`id_departamento`);

--
-- Indices de la tabla `tbl_estado_incidencia`
--
ALTER TABLE `tbl_estado_incidencia`
  ADD PRIMARY KEY (`id_estado_incidencia`),
  ADD KEY `id_incidencia` (`id_incidencia`);

--
-- Indices de la tabla `tbl_incidencias`
--
ALTER TABLE `tbl_incidencias`
  ADD PRIMARY KEY (`id_incidencia`),
  ADD KEY `id_municipio` (`id_municipio`),
  ADD KEY `id_tipo_incidencia` (`id_tipo_incidencia`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `tbl_municipios`
--
ALTER TABLE `tbl_municipios`
  ADD PRIMARY KEY (`id_municipio`),
  ADD KEY `id_departamento` (`id_departamento`);

--
-- Indices de la tabla `tbl_productos`
--
ALTER TABLE `tbl_productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `tbl_tipo_incidencias`
--
ALTER TABLE `tbl_tipo_incidencias`
  ADD PRIMARY KEY (`id_tipo_incidencia`);

--
-- Indices de la tabla `tbl_tipo_usuarios`
--
ALTER TABLE `tbl_tipo_usuarios`
  ADD PRIMARY KEY (`id_tipo_usuario`);

--
-- Indices de la tabla `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`),
  ADD KEY `id_comision` (`id_comision`),
  ADD KEY `id_departamento` (`id_departamento`),
  ADD KEY `id_municipio` (`id_municipio`),
  ADD KEY `id_tipo_usuario` (`id_tipo_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_categorias`
--
ALTER TABLE `tbl_categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tbl_comisiones`
--
ALTER TABLE `tbl_comisiones`
  MODIFY `id_comision` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tbl_departamentos`
--
ALTER TABLE `tbl_departamentos`
  MODIFY `id_departamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `tbl_estado_incidencia`
--
ALTER TABLE `tbl_estado_incidencia`
  MODIFY `id_estado_incidencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tbl_incidencias`
--
ALTER TABLE `tbl_incidencias`
  MODIFY `id_incidencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tbl_municipios`
--
ALTER TABLE `tbl_municipios`
  MODIFY `id_municipio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=263;

--
-- AUTO_INCREMENT de la tabla `tbl_productos`
--
ALTER TABLE `tbl_productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo_incidencias`
--
ALTER TABLE `tbl_tipo_incidencias`
  MODIFY `id_tipo_incidencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo_usuarios`
--
ALTER TABLE `tbl_tipo_usuarios`
  MODIFY `id_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_estado_incidencia`
--
ALTER TABLE `tbl_estado_incidencia`
  ADD CONSTRAINT `tbl_estado_incidencia_ibfk_1` FOREIGN KEY (`id_incidencia`) REFERENCES `tbl_incidencias` (`id_incidencia`);

--
-- Filtros para la tabla `tbl_incidencias`
--
ALTER TABLE `tbl_incidencias`
  ADD CONSTRAINT `tbl_incidencias_ibfk_1` FOREIGN KEY (`id_municipio`) REFERENCES `tbl_municipios` (`id_municipio`),
  ADD CONSTRAINT `tbl_incidencias_ibfk_2` FOREIGN KEY (`id_tipo_incidencia`) REFERENCES `tbl_tipo_incidencias` (`id_tipo_incidencia`),
  ADD CONSTRAINT `tbl_incidencias_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `tbl_usuarios` (`id_usuario`);

--
-- Filtros para la tabla `tbl_municipios`
--
ALTER TABLE `tbl_municipios`
  ADD CONSTRAINT `tbl_municipios_ibfk_1` FOREIGN KEY (`id_departamento`) REFERENCES `tbl_departamentos` (`id_departamento`);

--
-- Filtros para la tabla `tbl_productos`
--
ALTER TABLE `tbl_productos`
  ADD CONSTRAINT `tbl_productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `tbl_categorias` (`id_categoria`);

--
-- Filtros para la tabla `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  ADD CONSTRAINT `tbl_usuarios_ibfk_1` FOREIGN KEY (`id_comision`) REFERENCES `tbl_comisiones` (`id_comision`),
  ADD CONSTRAINT `tbl_usuarios_ibfk_2` FOREIGN KEY (`id_departamento`) REFERENCES `tbl_departamentos` (`id_departamento`),
  ADD CONSTRAINT `tbl_usuarios_ibfk_3` FOREIGN KEY (`id_municipio`) REFERENCES `tbl_municipios` (`id_municipio`),
  ADD CONSTRAINT `tbl_usuarios_ibfk_4` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `tbl_tipo_usuarios` (`id_tipo_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
