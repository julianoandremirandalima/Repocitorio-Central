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
