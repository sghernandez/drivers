-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2021 at 04:28 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `drivers`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('8c497b0963e6cb3b0c3157431bf11119d66d2f2b', '191.156.155.179', 1625827084, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632353832373038343b696e666f7c733a303a22223b5f5f63695f766172737c613a313a7b733a343a22696e666f223b733a333a226f6c64223b7d746f6b656e7c733a33323a223632663863373537343764643530653032656165623130373139643866333538223b),
('8554a82f673b332ad7ffb22952c967cbef6044af', '191.156.152.6', 1625827442, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632353832373434323b746f6b656e7c733a33323a223062343635663236346631623638643436643933643537366162373638343635223b),
('47e6205c10cbbd51fc62c6fe77c150e932744d96', '191.156.144.29', 1625827974, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632353832373937343b746f6b656e7c733a33323a223935613931363765616134666339663137303634643432646164316163333965223b),
('17d1a82454fca27e0e156cf8d38e3be616d4fb33', '191.156.144.29', 1625832632, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632353833323633323b746f6b656e7c733a33323a223065333839373361326533626432383837366230333536656631363935613363223b737563636573737c733a33373a22456c20726567697374726f207365206775617264c3b320636f7272656374616d656e74652e223b5f5f63695f766172737c613a323a7b733a373a2273756363657373223b733a333a226f6c64223b733a343a22696e666f223b733a333a226e6577223b7d696e666f7c733a303a22223b),
('80da400342fdfbae896de926983d97b2b394db55', '191.156.146.195', 1625833239, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632353833333233373b746f6b656e7c733a33323a223636376536633437643063373361383764333931343236366361613533666138223b69735f6c6f677565645f696e7c623a313b69645f7573756172696f7c733a323a223134223b726f6c657c733a313a2232223b726f6c655f6e6f6d6272657c733a393a22434f4e445543544f52223b69645f677275706f7c733a313a2233223b677275706f7c733a393a2255424552424c41434b223b757365727c733a383a226a6f686e5f646f65223b6e6f6d6272657c733a31313a224c6f72656e61204c617261223b6c61747c4e3b6c6e677c4e3b7573756172696f5f6163746976696461647c733a31393a22323032312d30372d30392031323a32303a3339223b64697361626c65647c733a303a22223b),
('f288b38c87972e215cfba54a650dc5eea6b3174f', '191.156.152.108', 1625833241, ''),
('0fb7c3848a8d1e0876eb34686f5d7ba8b377c48e', '191.156.159.190', 1625833241, ''),
('4f92a376cc1da20f3ab8454a10bacefc34b9ef35', '191.156.154.30', 1625833337, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632353833333333373b696e666f7c733a303a22223b5f5f63695f766172737c613a313a7b733a343a22696e666f223b733a333a226e6577223b7d746f6b656e7c733a33323a226164343234353966313264643966646335343934313036333762366364653938223b),
('rf6milj0epbfahkdpkviteuajrb9f7oh', '::1', 1625840921, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632353834303731363b746f6b656e7c733a33323a223162303430386533343537363162333231373561373364633532663632396165223b69735f6c6f677565645f696e7c623a313b69645f7573756172696f7c733a313a2236223b726f6c657c733a313a2233223b726f6c655f6e6f6d6272657c733a383a22504153414a45524f223b69645f677275706f7c733a313a2233223b677275706f7c733a393a2255424552424c41434b223b757365727c733a373a226c696c69616e61223b6e6f6d6272657c733a31323a224c696c69616e61204261657a223b6c61747c733a393a22342e36353936303936223b6c6e677c733a31313a222d37342e31313436363234223b7573756172696f5f6163746976696461647c733a31393a22323032312d30372d30392031363a32383a3431223b64697361626c65647c733a303a22223b);

-- --------------------------------------------------------

--
-- Table structure for table `Estados`
--

CREATE TABLE `Estados` (
  `id_Estados` int(11) NOT NULL COMMENT 'ActivoInactivo',
  `Estados_nombre` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Estados`
--

INSERT INTO `Estados` (`id_Estados`, `Estados_nombre`) VALUES
(1, 'Activo'),
(2, 'Inactivo'),
(3, 'Estado3'),
(4, 'Estado4'),
(5, 'Estado5'),
(6, '6'),
(7, '7');

-- --------------------------------------------------------

--
-- Table structure for table `Grupos`
--

CREATE TABLE `Grupos` (
  `id_Grupos` int(3) NOT NULL,
  `Grupos_nombre` varchar(45) DEFAULT NULL,
  `Grupos_descripcion` varchar(130) DEFAULT NULL,
  `Estados_id` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Grupos`
--

INSERT INTO `Grupos` (`id_Grupos`, `Grupos_nombre`, `Grupos_descripcion`, `Estados_id`) VALUES
(1, 'UBERXL', '', 1),
(2, 'SELECT', '', 1),
(3, 'UBERBLACK', '', 1),
(4, 'UBERX', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `LoginAttempts`
--

CREATE TABLE `LoginAttempts` (
  `ip` varchar(20) NOT NULL,
  `attempts` int(11) NOT NULL,
  `login_attempt` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Roles`
--

CREATE TABLE `Roles` (
  `id_Roles` int(2) NOT NULL,
  `Roles_nombre` varchar(30) DEFAULT NULL,
  `Roles_descripcion` varchar(130) DEFAULT NULL,
  `Estados_id` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Roles`
--

INSERT INTO `Roles` (`id_Roles`, `Roles_nombre`, `Roles_descripcion`, `Estados_id`) VALUES
(1, 'ADMIN', 'Principal usuario del Sistema.', 1),
(2, 'CONDUCTOR', '', 1),
(3, 'PASAJERO', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Servicios`
--

CREATE TABLE `Servicios` (
  `Conductor_id` int(11) NOT NULL,
  `Pasajero_id` int(11) NOT NULL DEFAULT 0,
  `Servicios_estado` enum('LIBRE','OCUPADO','FUERA_SERVICIO') COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'LIBRE'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `Servicios`
--

INSERT INTO `Servicios` (`Conductor_id`, `Pasajero_id`, `Servicios_estado`) VALUES
(5, 0, 'LIBRE'),
(4, 0, 'LIBRE'),
(14, 0, 'LIBRE');

-- --------------------------------------------------------

--
-- Table structure for table `Servicios_espera`
--

CREATE TABLE `Servicios_espera` (
  `Conductor_id` int(11) NOT NULL,
  `Pasajero_id` int(11) NOT NULL,
  `Servicios_espera_estado` enum('ESPERANDO','ATENDIENDO_SERVICIO') COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'ESPERANDO'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Usuarios`
--

CREATE TABLE `Usuarios` (
  `id_Usuarios` int(11) NOT NULL,
  `Usuarios_nombre` varchar(45) DEFAULT NULL,
  `Usuarios_apellido` varchar(45) DEFAULT NULL,
  `Usuarios_usuario` varchar(45) DEFAULT NULL,
  `Usuarios_email` varchar(70) DEFAULT NULL,
  `Usuarios_password` varchar(70) DEFAULT NULL COMMENT 'Tabla de registros de usuarios.',
  `Usuarios_enLinea` varchar(20) DEFAULT NULL,
  `Usuarios_codigo` varchar(9) DEFAULT NULL,
  `Usuarios_lat` decimal(11,7) DEFAULT NULL,
  `Usuarios_lng` decimal(11,7) DEFAULT NULL,
  `Usuarios_geotime` timestamp NOT NULL DEFAULT current_timestamp(),
  `Grupos_id` int(3) NOT NULL,
  `Roles_id` int(2) NOT NULL,
  `Estados_id` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Usuarios`
--

INSERT INTO `Usuarios` (`id_Usuarios`, `Usuarios_nombre`, `Usuarios_apellido`, `Usuarios_usuario`, `Usuarios_email`, `Usuarios_password`, `Usuarios_enLinea`, `Usuarios_codigo`, `Usuarios_lat`, `Usuarios_lng`, `Usuarios_geotime`, `Grupos_id`, `Roles_id`, `Estados_id`) VALUES
(1, 'Pablo Andrés', 'Castro', 'castro', 'castro@gmail.co', '$2y$12$EBqXa0KhY3/Fi13h04bVMeUO86CuR71hGVSWaVGSDM6lS3f0cFZni', '', '0', '4.6596096', '-74.1146624', '2021-07-09 21:25:15', 1, 2, 1),
(2, 'administrador', 'administrator', 'sandrohernandez414', 'sandrohernandez414@gmail.com', '$2y$12$zVSX/GKoQr3cBCXEh5hThuIoQ4YfnukJCQqQaupnbrGT3oXjlvo26', '', '0', '0.0000000', '0.0000000', '2021-06-11 15:31:24', 1, 1, 1),
(3, 'Sandro Giovanni', 'Hernández', 'hernandezs_', 'hernandezs_@technorium.co', '$2y$12$h/rDZH8YWqdQ9JTPkSD0f.7lHb1ykQ33vDwt8.Tx0G9hnGGhMMdRi', NULL, NULL, '0.0000000', '0.0000000', '2021-06-11 15:31:24', 4, 3, 1),
(4, 'David Antonio', 'Peña', 'penad', 'dave@tech.co', '$2y$12$/8odzmHQDxH5yCDVCFMsr.a.VOJJoFl1B4WV12SP7REO456e8epnO', '', NULL, '4.6596096', '-74.1146624', '2021-07-09 21:23:55', 3, 2, 1),
(5, 'Hernandezs', 'Hernández', 'hernandezs', 'hernandezs@techn.co', '$2y$12$236RY5hIWWNYEpsxJ4o.Pe8O/ryjvO4pMxhFyLBLio0xkY6T3p3y.', '2021-06-15 16:12:24', NULL, '5.9262460', '-73.6143720', '2021-06-15 21:12:24', 4, 2, 1),
(6, 'Liliana', 'Baez', 'liliana', 'liliana@gmail.com', '$2y$12$wAVOH3tQpMEmVbkcC5Dgn.C.DXmT/JeY.fL792qiMwpfRb0eMHRpK', '2021-07-09 16:28:41', NULL, '4.6596096', '-74.1146624', '2021-07-09 21:28:01', 3, 3, 1),
(7, 'Carlos', 'Mesa', 'mesacarlos', 'mesacarlos@gmail.com', '$2y$12$YOj8W3VpatvOhdLe3NPiYO9nWUCdA3i6cJvPbA5t5HvAEiPoUfA1G', NULL, NULL, '5.9262460', '-73.6143720', '2021-06-15 17:49:58', 4, 3, 1),
(8, 'karol', 'Peña', 'karol', 'karol@outlook.com', '$2y$12$cDIxIcT4v7aGQRaOEZdCOeMxj.FP335PuhXXnJUKjrNVB2E38aFNe', NULL, NULL, NULL, NULL, '2021-06-13 11:57:38', 3, 3, 1),
(9, 'Admin', 'Perez', 'admin', 'admin@gmail.com', '$2y$12$cZqD9RqnDwe74JJsvKA9W.guc70pGKSyCjE4S2UzuYP/VgNJjuyvK', NULL, NULL, NULL, NULL, '2021-06-15 11:28:29', 4, 3, 1),
(14, 'Lorena', 'Lara', 'john_doe', 'john_doe@example.com', '$2y$12$NrrJV1/o8naSOfOdyDol2uXmo8LEPLpWTbie0M685urIy31WVxa3W', '2021-07-09 12:20:39', NULL, NULL, NULL, '2021-07-09 10:53:05', 3, 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `Estados`
--
ALTER TABLE `Estados`
  ADD PRIMARY KEY (`id_Estados`);

--
-- Indexes for table `Grupos`
--
ALTER TABLE `Grupos`
  ADD PRIMARY KEY (`id_Grupos`,`Estados_id`),
  ADD KEY `fk_Grupos_Estados1_idx` (`Estados_id`);

--
-- Indexes for table `Roles`
--
ALTER TABLE `Roles`
  ADD PRIMARY KEY (`id_Roles`,`Estados_id`),
  ADD KEY `fk_Roles_Estados1_idx` (`Estados_id`);

--
-- Indexes for table `Servicios`
--
ALTER TABLE `Servicios`
  ADD UNIQUE KEY `conductor_id` (`Conductor_id`);

--
-- Indexes for table `Usuarios`
--
ALTER TABLE `Usuarios`
  ADD PRIMARY KEY (`id_Usuarios`,`Estados_id`,`Grupos_id`,`Roles_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Estados`
--
ALTER TABLE `Estados`
  MODIFY `id_Estados` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ActivoInactivo', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `Grupos`
--
ALTER TABLE `Grupos`
  MODIFY `id_Grupos` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Roles`
--
ALTER TABLE `Roles`
  MODIFY `id_Roles` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Usuarios`
--
ALTER TABLE `Usuarios`
  MODIFY `id_Usuarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
