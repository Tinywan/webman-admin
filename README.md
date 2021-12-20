# webman-admin

[![license](https://img.shields.io/github/license/Tinywan/webman-admin)]()
[![Build status](https://github.com/Tinywan/dnmp/workflows/CI/badge.svg)]()
[![webman-admin](https://img.shields.io/badge/build-passing-brightgreen.svg)]()
[![webman-admin](https://img.shields.io/github/last-commit/tinywan/webman-admin/main)]()
[![webman-admin](https://img.shields.io/github/v/tag/tinywan/webman-admin?color=ff69b4)]()
![](https://img.shields.io/badge/developer-@Tinywan-blue)

基于 [webman](https://www.workerman.net/doc/webman/) + [vue3](https://v3.vuejs.org/) + [element-plus](https://element-plus.gitee.io/zh-CN/) 的前后端分离管理系统。


# 快速开始

## webman-admin 部署

#### 克隆项目

> 克隆目录：`D:\dnmp\www`

```sh
git clone git@github.com:Tinywan/webman-admin.git
```

#### 安装依赖

```sh
cd /d/dnmp/www/webman-admin

composer install
```

#### Docker 运行服务

```sh
docker run --rm -it -p 8888:8888 -v d:/dnmp/www/webman-admin:/app tinywan/docker-php-webman
```

以上表示挂载项目 `webman-admin`数据卷到容器`app`。同时映射宿主机和容器端口 `8888:8888` 

**运行后如下所示**

![docker](docker.png)

## webman-admin-ui 部署

```sh
# 克隆项目
git clone git@github.com:Tinywan/webman-admin-ui.git

# 进入项目目录
cd webman-admin-ui

# 安装依赖
npm i

# 启动项目(开发模式)
npm run serve
```

**运行后如下所示**

![ui](ui.png)

启动完成后浏览器访问 http://localhost:2800
