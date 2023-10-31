# ♨️ 众口难调，用爱发电。

[![license](https://img.shields.io/github/license/Tinywan/webman-admin)]()
[![Build status](https://github.com/Tinywan/dnmp/workflows/CI/badge.svg)]()
[![webman-admin](https://img.shields.io/badge/build-passing-brightgreen.svg)]()

基于 [webman](https://www.workerman.net/doc/webman/) + [vue3](https://v3.vuejs.org/) + [element-plus](https://element-plus.gitee.io/zh-CN/) 的前后端分离解决方案。

## 🚀 特性

- 基于 [Webman](https://www.workerman.net/webman) 高性能HTTP服务框架
- 遵循 RESTful API 设计规范
- [基于 Casbin 的 RBAC 访问控制模型](https://www.workerman.net/plugin/6)
- [JWT 认证插件](https://www.workerman.net/plugin/10)
- [Validate 验证器插件](https://www.workerman.net/plugin/7)
- [简单多文件上传插件](https://www.workerman.net/plugin/21)
- [全局 Exception 异常插件（支持钉钉机器人接入）](https://www.workerman.net/plugin/16)
- [基于 Lua 脚本接口限流插件](https://www.workerman.net/plugin/37)
- 基于 [ThinkORM](https://github.com/top-think/think-orm) 的数据库存储
- 采用PHP7强类型 [（严格模式）](https://www.php.net/manual/zh/language.types.declarations.php#language.types.declarations.strict)

## 🔰 组件介绍

- 用户管理

## 🚤 快速开始

### 数据库

新建数据库`webman-admin`，导入 sql 文件地址：`db/webman-admin.sql`

### 后端安装

```sh
# 克隆项目
git clone git@github.com:Tinywan/webman-admin.git

# 进入目录
cd webman-admin

# 安装依赖
composer install

# 启动项目(开发模式)
php start.php start
```

启动完成后浏览器访问 `http://127.0.0.1:8888/`

### 前端安装

```sh
# 进入web目录
cd web

# 安装依赖
npm i

# 启动项目(开发模式)
npm run serve
```
启动完成后浏览器访问 http://127.0.0.1:2800

## 使用 Docker 运行服务（可选）

> 如果你本地没有PHP环境或者PHP扩展不方便安装，则可以选择使用Docker

```sh
docker run --rm -it -p 8888:8888 -v d:/dnmp/www/webman-admin:/app tinywan/docker-php-webman
```

以上表示挂载项目 `webman-admin`数据卷到容器`app`。同时映射宿主机和容器端口 `8888:8888` 

**运行后如下所示**

![docker](docker.png)

## [开发文档](https://github.tinywan.com/webman-admin-document/)

## Composer

移除阿里云镜像

```phpregexp
composer config -g --unset repos.packagist
```

## 命令行

Make CURD
```phpregexp
./webman make:curd api/manual
```
> 生成控制器和Model

/** nacos 服务端地址 */
'host' => '192.168.1.2', 

/** nacos 服务端端口 */
'port' => 8848,

/** nacos 认证用户名 */
'username' => 'nacos',

/** nacos 认证用户密码 */
'password' => 'nacos',

'config_listeners' => [
    [
        /** DataID */
        'payment.php',
        /** groupName */
        'DEFAULT_GROUP',
        /** namespaceId */
        '',
        /** filePath @desc 配置文件本地保存的地址 */
        config_path() . '/nacos/payment.php',
    ],
    [
        /** DataID */
        'application-dev.yml',
        /** groupName */
        'DEFAULT_GROUP',
        /** namespaceId */
        'b34ea59f-e240-413b-ba3d-bb040981d773',
        /** filePath @desc 配置文件本地保存的地址 */
        config_path() . '/nacos/application-dev.yml',
    ],
],