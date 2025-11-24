-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.32-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para sweet_cookie
CREATE DATABASE IF NOT EXISTS `sweet_cookie` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `sweet_cookie`;

-- Copiando estrutura para tabela sweet_cookie.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(80) NOT NULL,
  `email` varchar(150) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `cep` varchar(9) NOT NULL,
  `bairro` varchar(80) NOT NULL,
  `endereco` varchar(150) NOT NULL,
  `numero` varchar(10) NOT NULL DEFAULT '',
  `complemento` varchar(150) DEFAULT '',
  `senha` varchar(255) NOT NULL DEFAULT '',
  `autenticacao` varchar(100) NOT NULL DEFAULT '',
  `nivel` enum('1','2') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela sweet_cookie.usuarios: ~1 rows (aproximadamente)
DELETE FROM `usuarios`;
INSERT INTO `usuarios` (`id`, `nome`, `email`, `cpf`, `cep`, `bairro`, `endereco`, `numero`, `complemento`, `senha`, `autenticacao`, `nivel`, `created_at`, `updated_at`) VALUES
	(1, 'Master', 'master@sweetcookie.com', '', '', '', '', '', '', '$2y$10$2strfpCdo0CeFCK12ta2X.HZ8FRa6vBceRiQHrOJQm0wCXZuxaTYi', '', '2', '2025-11-22 01:27:37', '2025-11-22 01:27:56');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
