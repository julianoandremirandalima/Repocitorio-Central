-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.27-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.3.0.6589
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Copiando estrutura para tabela matriciamentonovo.equipes
CREATE TABLE IF NOT EXISTS `equipes` (
  `idequipe` int(11) NOT NULL AUTO_INCREMENT,
  `localequipe` int(10) NOT NULL DEFAULT 0,
  `idprofissional` int(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`idequipe`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela matriciamentonovo.equipes: ~16 rows (aproximadamente)
INSERT INTO `equipes` (`idequipe`, `localequipe`, `idprofissional`) VALUES
	(76, 9, 480),
	(77, 33, 480),
	(78, 11, 480),
	(79, 22, 480),
	(80, 10, 480),
	(84, 9, 8449),
	(85, 33, 8449),
	(86, 13, 8449),
	(87, 1, 8449),
	(88, 9, 95),
	(89, 33, 95),
	(90, 2, 95),
	(91, 30, 95),
	(92, 23, 8452),
	(93, 24, 8452),
	(94, 17, 8452);

-- Copiando estrutura para tabela matriciamentonovo.general_log
CREATE TABLE IF NOT EXISTS `general_log` (
  `event_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_host` mediumtext NOT NULL,
  `thread_id` bigint(21) unsigned NOT NULL,
  `server_id` int(10) unsigned NOT NULL,
  `command_type` varchar(64) NOT NULL,
  `argument` mediumtext NOT NULL
) ENGINE=CSV DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='General log';

-- Copiando dados para a tabela matriciamentonovo.general_log: 0 rows
/*!40000 ALTER TABLE `general_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `general_log` ENABLE KEYS */;

-- Copiando estrutura para tabela matriciamentonovo.local
CREATE TABLE IF NOT EXISTS `local` (
  `idlocal` int(11) NOT NULL AUTO_INCREMENT,
  `nomelocal` varchar(255) NOT NULL,
  `enderecolocal` text NOT NULL,
  `contatolocal` int(11) NOT NULL,
  `quadrante` int(11) NOT NULL,
  PRIMARY KEY (`idlocal`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela matriciamentonovo.local: ~32 rows (aproximadamente)
INSERT INTO `local` (`idlocal`, `nomelocal`, `enderecolocal`, `contatolocal`, `quadrante`) VALUES
	(1, 'ESF Vila Mendes', '', 0, 1),
	(2, 'ESF Bom Pastor', '', 0, 1),
	(3, 'ESF Mont Serrat', '', 0, 1),
	(4, 'ESF Jardim Aurea', '', 0, 1),
	(6, 'ESF Pinheiros', '', 0, 1),
	(7, 'ESF Girassol', '', 0, 1),
	(8, 'ESF corcetti', '', 0, 1),
	(9, 'ESF Barcelona', '', 0, 2),
	(10, 'ESF Zona Rural', '', 0, 2),
	(11, 'ESF CAICII', '', 0, 2),
	(12, 'ESF Jardim Colonial', '', 0, 2),
	(13, 'ESF Vargem', '', 0, 2),
	(14, 'ESF Sagrado Coração', '', 0, 2),
	(15, 'ESF Novo Tempo', '', 0, 2),
	(16, 'ESF Sion', '', 0, 3),
	(17, 'ESF Florescer', '', 0, 3),
	(18, 'ESF Santana', '', 0, 3),
	(19, 'ESF Padre Vitor', '', 0, 3),
	(20, 'ESF Damasco-Santa Monica', '', 0, 3),
	(21, 'ESF Centenario', '', 0, 3),
	(22, 'ESF Canaa', '', 0, 4),
	(23, 'ESF Fatima I', '', 0, 4),
	(24, 'ESF Fatima II', '', 0, 4),
	(25, 'ESF Rio Verde', '', 0, 4),
	(26, 'ESF Pro Saude', '', 0, 4),
	(27, 'ESF Eldorado', '', 0, 4),
	(28, 'ESF Imaculada', '', 0, 4),
	(29, 'ESF Imaculada', '', 0, 4),
	(30, 'ESF CAIC I', '', 0, 4),
	(31, 'ESF ESTRELAS', '', 0, 1),
	(32, 'ESF NOVA VARGINHA', '', 0, 4),
	(33, 'ESF BOGANVILLE', '', 0, 4);

-- Copiando estrutura para tabela matriciamentonovo.slow_log
CREATE TABLE IF NOT EXISTS `slow_log` (
  `start_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_host` mediumtext NOT NULL,
  `query_time` time NOT NULL,
  `lock_time` time NOT NULL,
  `rows_sent` int(11) NOT NULL,
  `rows_examined` int(11) NOT NULL,
  `db` varchar(512) NOT NULL,
  `last_insert_id` int(11) NOT NULL,
  `insert_id` int(11) NOT NULL,
  `server_id` int(10) unsigned NOT NULL,
  `sql_text` mediumtext NOT NULL,
  `thread_id` bigint(21) unsigned NOT NULL
) ENGINE=CSV DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Slow log';

-- Copiando dados para a tabela matriciamentonovo.slow_log: 0 rows
/*!40000 ALTER TABLE `slow_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `slow_log` ENABLE KEYS */;

-- Copiando estrutura para tabela matriciamentonovo.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `imagem` varchar(150) NOT NULL,
  `usuario` varchar(150) NOT NULL,
  `senha` varchar(150) NOT NULL,
  `tipo_user` varchar(50) DEFAULT NULL,
  `datainsert` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status_user` varchar(50) DEFAULT NULL,
  `id_identificador` int(11) DEFAULT NULL,
  `id_identificador_logista` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=8453 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Copiando dados para a tabela matriciamentonovo.usuarios: ~4 rows (aproximadamente)
INSERT INTO `usuarios` (`id`, `nome`, `imagem`, `usuario`, `senha`, `tipo_user`, `datainsert`, `status_user`, `id_identificador`, `id_identificador_logista`) VALUES
	(95, 'JULIANO MIRANDA', '1397550786.png', '4489', 'e10adc3949ba59abbe56e057f20f883e', 'administrador', '2023-01-30 00:29:55', NULL, 95, NULL),
	(3527, 'LOURIVAL ALVES CHAGAS', 'padrao.png', '107972', 'e10adc3949ba59abbe56e057f20f883e', 'colaborador', '2023-01-29 19:10:26', 'ativo', 3040, NULL),
	(8449, 'ANDERSON JOSÉ', '648047379.jpg', 'anderson@jose.com', 'e10adc3949ba59abbe56e057f20f883e', 'administrador', '2023-01-28 22:59:54', NULL, NULL, NULL),
	(8452, 'PEDRO PEDREIRO', '1183099274.png', 'pedro@pedreiro.com', 'e10adc3949ba59abbe56e057f20f883e', 'gestor', '2023-01-29 19:11:45', NULL, NULL, NULL);

-- Copiando estrutura para tabela matriciamentonovo.variaveis
CREATE TABLE IF NOT EXISTS `variaveis` (
  `atendimento` text DEFAULT NULL,
  `endereco` text DEFAULT NULL,
  `telefone1` text DEFAULT NULL,
  `telefone2` text DEFAULT NULL,
  `wattsapp` text DEFAULT NULL,
  `facebook` text DEFAULT NULL,
  `instagram` text DEFAULT NULL,
  `descontoempresa` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Copiando dados para a tabela matriciamentonovo.variaveis: ~1 rows (aproximadamente)
INSERT INTO `variaveis` (`atendimento`, `endereco`, `telefone1`, `telefone2`, `wattsapp`, `facebook`, `instagram`, `descontoempresa`) VALUES
	('Segunda a sexta-feira, das 08h às 18h', 'Rua Alferes Joaquim Antônio, 165 - Vila Pinto.', '(35) 3260-2034', '(35) 3606-4322', '(35) 99724-7785', 'https://www.facebook.com/semus/', 'https://www.instagram.com/semus/', 4);

-- Copiando estrutura para view matriciamentonovo.viewequivelocal
-- Criando tabela temporária para evitar erros de dependência de VIEW
CREATE TABLE `viewequivelocal` (
	`idequipe` INT(11) NOT NULL,
	`localequipe` INT(10) NOT NULL,
	`idprofissional` INT(10) NOT NULL,
	`id` INT(11) NOT NULL,
	`nome` VARCHAR(150) NOT NULL COLLATE 'utf8_general_ci',
	`imagem` VARCHAR(150) NOT NULL COLLATE 'utf8_general_ci',
	`usuario` VARCHAR(150) NOT NULL COLLATE 'utf8_general_ci',
	`senha` VARCHAR(150) NOT NULL COLLATE 'utf8_general_ci',
	`tipo_user` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`datainsert` DATETIME NOT NULL,
	`status_user` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`id_identificador` INT(11) NULL,
	`id_identificador_logista` INT(11) NULL,
	`idlocal` INT(11) NOT NULL,
	`nomelocal` VARCHAR(255) NOT NULL COLLATE 'utf8mb4_general_ci',
	`enderecolocal` TEXT NOT NULL COLLATE 'utf8mb4_general_ci',
	`contatolocal` INT(11) NOT NULL,
	`quadrante` INT(11) NOT NULL
) ENGINE=MyISAM;

-- Copiando estrutura para trigger matriciamentonovo.TG_colaboradores_AFTER_INSERT
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
DELIMITER //
CREATE TRIGGER `TG_colaboradores_AFTER_INSERT` AFTER INSERT ON `colaboradores` FOR EACH ROW BEGIN
INSERT INTO usuarios (nome, imagem, usuario, senha, tipo_user, status_user, id_identificador) VALUES (new.nome, 'padrao.png', new.matricula, 'e10adc3949ba59abbe56e057f20f883e', 'colaborador', 'ativo', new.id);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Copiando estrutura para trigger matriciamentonovo.TG_colaboradores_before_DELETE
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
DELIMITER //
CREATE TRIGGER `TG_colaboradores_before_DELETE` BEFORE DELETE ON `colaboradores` FOR EACH ROW BEGIN

END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Copiando estrutura para view matriciamentonovo.viewequivelocal
-- Removendo tabela temporária e criando a estrutura VIEW final
DROP TABLE IF EXISTS `viewequivelocal`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `viewequivelocal` AS SELECT equipes.*, usuarios.*, local.* FROM equipes
INNER JOIN local ON equipes.localequipe = local.idlocal
INNER JOIN usuarios ON equipes.idprofissional = usuarios.id ;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
