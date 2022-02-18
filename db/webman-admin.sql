/*
 Navicat Premium Data Transfer

 Source Server         : docker
 Source Server Type    : MySQL
 Source Server Version : 50736
 Source Host           : localhost:3308
 Source Schema         : webman-admin

 Target Server Type    : MySQL
 Target Server Version : 50736
 File Encoding         : 65001

 Date: 18/02/2022 22:11:50
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for casbin_rule
-- ----------------------------
DROP TABLE IF EXISTS `casbin_rule`;
CREATE TABLE `casbin_rule`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ptype` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `v0` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `v1` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `v2` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `v3` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `v4` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `v5` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idx_ptype`(`ptype`) USING BTREE,
  INDEX `idx_v0`(`v0`) USING BTREE,
  INDEX `idx_v1`(`v1`) USING BTREE,
  INDEX `idx_v2`(`v2`) USING BTREE,
  INDEX `idx_v3`(`v3`) USING BTREE,
  INDEX `idx_v4`(`v4`) USING BTREE,
  INDEX `idx_v5`(`v5`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '策略规则表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for resty_user
-- ----------------------------
DROP TABLE IF EXISTS `resty_user`;
CREATE TABLE `resty_user`  (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '自动递增',
  `email` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '邮箱',
  `mobile` char(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '手机号码',
  `username` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '用户名',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '密码',
  `avatar` varchar(200) CHARACTER SET utf32 COLLATE utf32_general_ci NOT NULL COMMENT '头像',
  `website_name` varchar(64) CHARACTER SET utf32 COLLATE utf32_general_ci NOT NULL DEFAULT '' COMMENT '站点名称',
  `website_url` varchar(200) CHARACTER SET utf32 COLLATE utf32_general_ci NOT NULL DEFAULT '' COMMENT '站点地址',
  `is_enabled` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '是否启用（0：未开启，1：已开启）',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '创建时间',
  `update_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '更新时间',
  `delete_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '删除时间',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `uk_email`(`email`) USING BTREE,
  UNIQUE INDEX `uk_mobile`(`mobile`) USING BTREE,
  UNIQUE INDEX `idx_username`(`username`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20220002 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '用户表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of resty_user
-- ----------------------------
INSERT INTO `resty_user` VALUES (20220001, 'Tinywan@163.com', '13669361192', 'webman', '$2y$10$FmJkDIWbV7hCLItUeujhiOGbl1.Tv0R4W4BghXYYcdq8PLbU6neLe', 'https://live-oss.baidu.com/assets/images/avatars/6avatar.jpg', 'webman', 'https://github.tinywan.com/', 1, 1636685339, 0, 0);

SET FOREIGN_KEY_CHECKS = 1;
