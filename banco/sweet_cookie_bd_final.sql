
CREATE DATABASE IF NOT EXISTS `sweet_cookie`;
USE `sweet_cookie`;

-- ----------------------------
-- Table structure for logs
-- ----------------------------
DROP TABLE IF EXISTS `logs`;
CREATE TABLE `logs`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(0) NULL DEFAULT NULL,
  `acao` varchar(255) NOT NULL,
  `data` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
);

-- ----------------------------
-- Table structure for pedido_itens
-- ----------------------------
DROP TABLE IF EXISTS `pedido_itens`;
CREATE TABLE `pedido_itens`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `pedido_id` int(0) NOT NULL,
  `produto_id` int(0) NOT NULL,
  `quantidade` int(0) NOT NULL,
  `preco_unitario` decimal(10, 2) NOT NULL,
  `subtotal` decimal(10, 2) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `pedido_id`(`pedido_id`) USING BTREE,
  INDEX `produto_id`(`produto_id`) USING BTREE,
  CONSTRAINT `pedido_itens_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `pedido_itens_ibfk_2` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
);

-- ----------------------------
-- Table structure for pedidos
-- ----------------------------
DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE `pedidos`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(0) NOT NULL,
  `data_pedido` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `valor_total` decimal(10, 2) NOT NULL,
  `status` enum('aguardando_pagamento','pago','preparando','enviado','entregue','cancelado') NULL DEFAULT 'aguardando_pagamento',
  `forma_pagamento` varchar(50) NULL DEFAULT NULL,
  `transacao_id` varchar(255)  NULL DEFAULT NULL,
  `parcelas` int(0) NULL DEFAULT 1,
  `cep` varchar(10) NULL DEFAULT NULL,
  `logradouro` varchar(255)  NOT NULL,
  `numero` varchar(20) NOT NULL,
  `complemento` varchar(255) NULL DEFAULT NULL,
  `bairro` varchar(100)  NOT NULL,
  `cidade` varchar(100)  NOT NULL,
  `estado` char(2)  NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `usuario_id`(`usuario_id`) USING BTREE,
  CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
);

-- ----------------------------
-- Table structure for produtos
-- ----------------------------
DROP TABLE IF EXISTS `produtos`;
CREATE TABLE `produtos`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100)  NOT NULL,
  `descricao` varchar(255) NULL DEFAULT NULL,
  `tipo` varchar(80)NOT NULL,
  `categoria` varchar(100)  NOT NULL,
  `preco` decimal(10, 2) NOT NULL,
  `imagem` varchar(255) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
);

-- ----------------------------
-- Table structure for usuarios
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `nome` varchar(80)  NOT NULL,
  `email` varchar(150)  NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `cep` varchar(9) NOT NULL,
  `bairro` varchar(80)  NOT NULL,
  `endereco` varchar(150) NOT NULL,
  `numero` varchar(10)  NOT NULL DEFAULT '',
  `complemento` varchar(150)  DEFAULT '',
  `senha` varchar(255) DEFAULT '',
  `autenticacao` varchar(100)  DEFAULT '',
  `nivel` enum('1','2')  NOT NULL DEFAULT '1',
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
);

INSERT INTO `usuarios` (`nome`, `email`, `senha`, `nivel`, `created_at`, `updated_at`) VALUES
	('Master', 'master@sweetcookie.com', '$2y$10$2strfpCdo0CeFCK12ta2X.HZ8FRa6vBceRiQHrOJQm0wCXZuxaTYi', '2', '2025-11-22 01:27:37', '2025-11-22 01:27:56');