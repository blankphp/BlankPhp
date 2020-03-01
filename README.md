<p align="center"><img src="https://i.loli.net/2019/04/08/5caaea849eb1f.png" alt="BlankPhp.png" title="BlankPhp.png" /><p>

[![996.icu](https://img.shields.io/badge/link-996.icu-red.svg)](https://996.icu)
[![LICENSE](https://img.shields.io/badge/license-Anti%20996-blue.svg)](https://github.com/996icu/996.ICU/blob/master/LICENSE)
[![Build Status](https://travis-ci.org/blankphp/BlankPhp.svg?branch=master)](https://travis-ci.org/blankphp/BlankPhp)
<a href="https://github.com/blankphp/BlankPhp"><img src="https://img.shields.io/badge/php-7.2%2B-blue.svg" alt="PHP Version"></a>
<a href="https://github.com/blankphp/BlankPhp/releases"><img src="https://img.shields.io/badge/version-1.0.0-lightgrey.svg" alt="Version"></a>
<a href="https://github.com/blankphp/BlankPhp"><img src="https://poser.pugx.org/fastd/fastd/license" /></a>
[![codecov](https://codecov.io/gh/blankphp/BlankPhp/branch/master/graph/badge.svg)](https://codecov.io/gh/blankphp/BlankPhp)
#### 介绍

> 一个满足于基本开发的MVC轻量级框架`route` `IOC` `DB` `view` `middleware`已经设计完基本使用

    1.本框架意义在于理解IOC容器，以及依赖注入的思想
    2.本框架富含基本容器以及依赖注入
    3.框架具有路由以及中间件和基本orm功能，满足一个基本的快速开发概念
    4.blankphp-swoole扩展正在书写中
    5.安全方面目前考虑较少<正在学习php安全相关>
    书写该框架的流程，以及遇到的问题，会整理出来！


#### 安装教程

```
composer create-project blankqwq/blankphp:"dev-master" <目录名称>
```

## 参与开发

<a href="https://github.com/blankphp/framework">核心包</a>


> `php blank config:cache` 生成/更新配置文件

```nginx
   root "<目录>/public";
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
//nginx配置好重写规则

```


#### 软件架构
    初步建设小型容器，满足基础的mvc服务，如何写出的会以文章形式公布
    1.web路由在routes/web.php中注册
    2.api路由在routes/api.php注册
    3.中间件注册在MiddleWareProvider中注册
    3.模型设计完成一部分，暂不支持多对多，一对多等关系

## 目录结构

初始的目录结构如下：

~~~
├─app           应用目录
│  ├─Controllers         控制器目录
│  ├─Middleware          中间件目录
│  │  ├─StartSession.php      session启动中间件
│  ├─Models             模型目录
│  ├─Observer           模型观察者目录
│  ├─Provider           服务提供者目录
│
├─public                WEB目录（对外访问目录）
│  ├─index.php          入口文件
│  ├─static             静态目录
│  └─.htaccess          用于apache的重写
│
│
├─route                 路由注册目录
│  ├─web.php           web
│  ├─api.php           api
|
├─config                 配置文件目录
│  ├─app.php           核心配置
│  ├─db.php           数据库配置
|
│
├─cache                 缓存目录
├─resource              资源文件目录
├─vendor                第三方类库目录（Composer依赖库）
├─blank.php             命令行操作入口
├─composer.json         composer 定义文件
├─LICENSE               授权说明文件
├─README.md             README 文件
~~~




#### 更新说明
    
> 基本完成
       


```ab
<!--1H2G Homestead 暂未优化-->
Server Software:        nginx/1.15.5
Server Hostname:        www.stu.stu
Server Port:            80

Document Path:          /
Document Length:        504 bytes

Concurrency Level:      100
Time taken for tests:   154.578 seconds
Complete requests:      10000
Failed requests:        0
Total transferred:      7770000 bytes
HTML transferred:       5040000 bytes
Requests per second:    64.69 [#/sec] (mean)
Time per request:       1545.784 [ms] (mean)
Time per request:       15.458 [ms] (mean, across all concurrent requests)
Transfer rate:          49.09 [Kbytes/sec] received

Connection Times (ms)
              min  mean[+/-sd] median   max
Connect:        0    1   0.7      1      15
Processing:   138 1538 115.6   1530    2110
Waiting:       61 1538 115.7   1530    2109
Total:        138 1539 115.6   1531    2111

Percentage of the requests served within a certain time (ms)
  50%   1531
  66%   1557
  75%   1576
  80%   1590
  90%   1640
  95%   1708
  98%   1777
  99%   1825
 100%   2111 (longest request)
```