<p align="center"><img src="https://i.loli.net/2019/04/08/5caaea849eb1f.png" alt="BlankPhp.png" title="BlankPhp.png" /><p>

[![996.icu](https://img.shields.io/badge/link-996.icu-red.svg)](https://996.icu)
[![LICENSE](https://img.shields.io/badge/license-Anti%20996-blue.svg)](https://github.com/996icu/996.ICU/blob/master/LICENSE)
[![Build Status](https://travis-ci.org/blankqwq/BlankPhp.svg?branch=master)](https://travis-ci.org/blankqwq/BlankPhp)
<a href="https://github.com/blankqwq/BlankPhp"><img src="https://img.shields.io/badge/php-7.1%2B-blue.svg" alt="PHP Version"></a>
<a href="https://github.com/blankqwq/BlankPhp/releases"><img src="https://img.shields.io/badge/version-1.0.0-lightgrey.svg" alt="Version"></a>
<a href="https://github.com/blankqwq/BlankPhp"><img src="https://poser.pugx.org/fastd/fastd/license" /></a>
[![codecov](https://codecov.io/gh/blankqwq/BlankPhp/branch/master/graph/badge.svg)](https://codecov.io/gh/blankqwq/BlankPhp)
#### 介绍

> 一个满足于基本开发的MVC轻量级框架`route` `IOC` `DB` `view` `middleware`已经设计完基本使用

![hahah.png](https://i.loli.net/2019/04/08/5cab51b97a61b.png)

    1.本框架意义在于理解IOC容器，以及依赖注入的思想
    2.本框架富含基本容器以及依赖注入
    3.框架具有路由以及中间件和基本orm功能，满足一个基本的快速开发概念
    4.后期设计会采用到swoole，来增加速度
    5.安全方面目前还没有考虑<正在学习php安全相关>
    
    书写该框架的流程，以及遇到的问题，会整理出来！
    文档正在书写中，但是有点忙，请等待

#### 软件架构
    初步建设小型容器，满足基础的mvc服务，如何写出的会以文章形式公布
    1.web路由在routes/web.php中注册
    2.api路由在routes/api.php注册
    3.中间件注册在MiddleWareProvider中注册
    3.模型设计暂未完成,但是基本的Database设计完成
    4.暂时方便测试所以就没怎么测试

#### 安装教程

```
composer create-project blankqwq/blankphp:"dev-master" <name>
```

```nginx
   root "<目录>/public";
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
nginx配置好重写规则

```

#### 更新说明
    
    
> 4.4 Route个人认为一般不会改变，可以缓存起来做一个中间层,之后都从route中取出会快很多
 
> 4.8 完成整体的运行流程以及缓存的自动生成自动替换

> 4.11 orm模型映射开始设计

```ab
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