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

 Date: 03/04/2019 18:01:36
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
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for produto
-- ----------------------------
DROP TABLE IF EXISTS `produto`;
CREATE TABLE `produto`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `quantidade` int(11) NOT NULL,
  `tipo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fk_usuario` int(11) NOT NULL,
  `fk_produto` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `produto_usuario`(`fk_usuario`) USING BTREE,
  INDEX `fornecedor_produto`(`fk_produto`) USING BTREE,
  CONSTRAINT `fornecedor_produto` FOREIGN KEY (`fk_produto`) REFERENCES `fornecedor` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 26 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

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
