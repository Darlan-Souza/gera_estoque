/*
 Navicat Premium Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 100138
 Source Host           : localhost:3306
 Source Schema         : estoque

 Target Server Type    : MySQL
 Target Server Version : 100138
 File Encoding         : 65001

 Date: 08/04/2019 16:42:03
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for fornecedor
-- ----------------------------
DROP TABLE IF EXISTS `fornecedor`;
CREATE TABLE `fornecedor`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `cnpj` int(255) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of fornecedor
-- ----------------------------
INSERT INTO `fornecedor` VALUES (2, 'teste2', 12, '1212');
INSERT INTO `fornecedor` VALUES (3, 'Darlan Souza Silva ', 141435, 'darlan.sgf@gmail.com');

-- ----------------------------
-- Table structure for produto
-- ----------------------------
DROP TABLE IF EXISTS `produto`;
CREATE TABLE `produto`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `quantidade` int(11) NOT NULL,
  `tipo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `valor` float(255, 0) NOT NULL,
  `fk_usuario` int(11) NOT NULL,
  `fk_fornecedor` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `produto_usuario`(`fk_usuario`) USING BTREE,
  INDEX `fornecedor_produto`(`fk_fornecedor`) USING BTREE,
  CONSTRAINT `fornecedor_produto` FOREIGN KEY (`fk_fornecedor`) REFERENCES `fornecedor` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of produto
-- ----------------------------
INSERT INTO `produto` VALUES (2, 'teste2', 12, '2', 0, 0, 2);
INSERT INTO `produto` VALUES (6, 'catuaba1', 101, '0', 12, 17, 2);
INSERT INTO `produto` VALUES (7, 'teste aiaia', 12111, '1', 200, 17, 3);

-- ----------------------------
-- Table structure for usuario
-- ----------------------------
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario`  (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `cpf` int(255) NOT NULL,
  `senha` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of usuario
-- ----------------------------
INSERT INTO `usuario` VALUES (17, 'Darlan Souza Silva ', 141435, '$2y$10$StioLBJPzBkKdZUok.Piou5nVImK1nB0K/J6zVnerQWcrfMqW/7Wu', 'darlan@gmail.com');

SET FOREIGN_KEY_CHECKS = 1;
