# 众口难调，用爱发电。

[![license](https://img.shields.io/github/license/Tinywan/webman-admin)]()
[![Build status](https://github.com/Tinywan/dnmp/workflows/CI/badge.svg)]()
[![webman-admin](https://img.shields.io/badge/build-passing-brightgreen.svg)]()

基于 [webman](https://www.workerman.net/doc/webman/) + [vue3](https://v3.vuejs.org/) + [element-plus](https://element-plus.gitee.io/zh-CN/) 的前后端分离管理系统。

## 组件介绍

- 遵循 RESTful API 设计规范
- 基于Webman高性能HTTP服务框架
- 基于Casbin的 RBAC 访问控制模型
- JWT 认证插件
- Validate 验证器插件
- 简单多文件上传插件
- 全局 Exception 异常插件（支持钉钉机器人接入）
- 基于 ThinkORM 的数据库存储，可扩展多种类型数据库

## 快速开始

### 后端安装

#### 克隆项目

```sh
git clone git@github.com:Tinywan/webman-admin.git
```

#### 安装依赖

```sh
cd /d/dnmp/www/webman-admin

composer install

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

```sh
docker run --rm -it -p 8888:8888 -v d:/dnmp/www/webman-admin:/app tinywan/docker-php-webman
```

以上表示挂载项目 `webman-admin`数据卷到容器`app`。同时映射宿主机和容器端口 `8888:8888` 

**运行后如下所示**

![docker](docker.png)

## [开发文档](https://github.tinywan.com/webman-admin-document/)

## Composer

移除阿里云镜像
```php
composer config -g --unset repos.packagist
```