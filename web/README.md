## 介绍
SCUI 是一个中后台前端解决方案，基于VUE3和elementPlus实现。
使用最新的前端技术栈，提供各类实用的组件方便在业务开发时的调用，并且持续性的提供丰富的业务模板帮助你快速搭建企业级中后台前端任务。
## 安装教程

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
启动完成后浏览器访问 http://localhost:2800
## 接口

### （1）令牌

原始
```json
{
	"code": 200,
	"message": "",
	"data": {
		"token": "SCUI.Administrator.Auth",
		"userInfo": {
			"userId": "1",
			"userName": "Administrator",
			"dashboard": "0",
			"role": [
				"SA",
				"admin",
				"Auditor"
			]
		}
	},
}
```
新接口
```json
{
	"code": 200,
	"message": "",
	"data": {
		"token": "SCUI.Administrator.Auth",
		"userInfo": {
			"userId": "1",
			"userName": "Administrator",
			"dashboard": "0",
			"role": [
				"SA",
				"admin",
				"Auditor"
			]
		}
	},
}
```

### （2）菜单
原始 api/system/menu
```json
{
    "code": 200,
    "data": {
        "menu": [
            {
                "name": "home",
                "path": "/home",
                "meta": {
                    "title": "首页",
                    "icon": "el-icon-eleme-filled",
                    "type": "menu"
                },
                "children": [
                    {
                        "name": "dashboard",
                        "path": "/dashboard",
                        "meta": {
                            "title": "控制台",
                            "icon": "el-icon-menu",
                            "affix": true
                        },
                        "component": "home"
                    },
                    {
                        "name": "userCenter",
                        "path": "/usercenter",
                        "meta": {
                            "title": "个人信息",
                            "icon": "el-icon-user"
                        },
                        "component": "userCenter"
                    }
                ]
            }
        ],
        "permissions": [
            "list.add",
            "list.edit",
            "list.delete",
            "user.add",
            "user.edit",
            "user.delete"
        ]
    },
    "message": ""
}
```

###  （3）Demo

api/demo
```json
{"code":200,"data":"1.4.1","message":""}
```