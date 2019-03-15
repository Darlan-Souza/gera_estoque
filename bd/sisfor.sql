/*
 Navicat Premium Data Transfer

 Source Server         : LocalHost
 Source Server Type    : MySQL
 Source Server Version : 100137
 Source Host           : localhost:3306
 Source Schema         : sisfor

 Target Server Type    : MySQL
 Target Server Version : 100137
 File Encoding         : 65001

 Date: 24/01/2019 16:27:55
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for comentarios
-- ----------------------------
DROP TABLE IF EXISTS `comentarios`;
CREATE TABLE `comentarios`  (
  `id_comentario` int(11) NOT NULL AUTO_INCREMENT,
  `fk_forum` int(11) NOT NULL,
  `fk_usuario` int(11) NOT NULL,
  `comentario` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` datetime(0) NOT NULL,
  PRIMARY KEY (`id_comentario`) USING BTREE,
  INDEX `fk_forum`(`fk_forum`) USING BTREE,
  INDEX `fk_usuario1`(`fk_usuario`) USING BTREE,
  CONSTRAINT `fk_forum` FOREIGN KEY (`fk_forum`) REFERENCES `foruns` (`id_forum`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `fk_usuario1` FOREIGN KEY (`fk_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for foruns
-- ----------------------------
DROP TABLE IF EXISTS `foruns`;
CREATE TABLE `foruns`  (
  `id_forum` int(11) NOT NULL AUTO_INCREMENT,
  `titulo_forum` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `descricao` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `fk_usuario` int(11) NOT NULL,
  `created_at` datetime(0) NOT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id_forum`) USING BTREE,
  INDEX `fk_usuario`(`fk_usuario`) USING BTREE,
  CONSTRAINT `fk_usuario` FOREIGN KEY (`fk_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for usuario
-- ----------------------------
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario`  (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `genero` int(11) NOT NULL,
  `data_nasc` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `matricula` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `curso` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `periodo` int(20) NOT NULL,
  `senha` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id_usuario`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of usuario
-- ----------------------------
INSERT INTO `usuario` VALUES (5, 'Gabriel Durães', 0, '11/03/1996', '20141016034', 'gduraes10@gmail.com', 'Sistemas de Informação', 10, '$2y$10$nYy4U56WAPdkKGbWkNxhjeGJBMqOGZXuQOymBEk9xLDHVtSMqwzhy', '2019-01-24 16:26:29', NULL);

SET FOREIGN_KEY_CHECKS = 1;
