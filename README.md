<p align="center"><img src="https://i.loli.net/2019/04/08/5caaea849eb1f.png" alt="BlankPhp.png" title="BlankPhp.png" /><p>

[![996.icu](https://img.shields.io/badge/link-996.icu-red.svg)](https://996.icu)
[![LICENSE](https://img.shields.io/badge/license-Anti%20996-blue.svg)](https://github.com/996icu/996.ICU/blob/master/LICENSE)
[![Build Status](https://travis-ci.org/blankqwq/BlankPhp.svg?branch=master)](https://travis-ci.org/blankqwq/BlankPhp)
<a href="https://github.com/blankqwq/BlankPhp"><img src="https://img.shields.io/badge/php-7.1%2B-blue.svg" alt="PHP Version"></a>
<a href="https://github.com/blankqwq/BlankPhp/releases"><img src="https://img.shields.io/badge/version-1.0.0-lightgrey.svg" alt="Version"></a>
#### 介绍
> 一个满足于基本开发的MVC轻量级框架

    1.本框架意义在于理解IOC容器，以及依赖注入的思想
    2.本框架富含基本容器以及依赖注入
    3.框架具有路由以及中间件和基本orm功能，满足一个基本的快速开发概念
    4.后期设计会采用到swoole，来增加速度
    5.安全方面目前还没有考虑
    
    书写该框架的流程，以及遇到的问题，会整理出来！

#### 软件架构
初步建设小型容器，满足基础的mvc服务，如何写出的会以文章形式公布


#### 安装教程

```
composer install
```

#### 更新说明
    3.13
    //组件化开发-->RouteServiceProvider
    
    3.14
    Route：分发
    Router:注册到,中间件，
    //从uri定义到的变量，注入到控制器
    //匹配路由=》获取闭包=》在管道模式中间件
    //结果传入response->send()返回最终结果！！
    ---
    增加一个存放类名对应的实例，这样就不会有上面的那种问题了
    
> 3.11  用反射解决容器中的依赖注入
    \ReflectionClass来解决依赖注入（从容器中获取实例）
    容器设计并没有完善，对于容器中实例是否共享以及是否覆盖还没有定义

> 3.13 用服务提供者来解决路由注册

    三大基础服务的注册通过bootstrap来进行注册，
    引导程序的后期执行

> 3.14 中间件逻辑设计完成===下一步设计Controller基类

    解决核心中的基础bootstrap,服务提供者注册组件->然后再通过多个组件完成一个功能
    
> 3.15 Controller基类设计，以及设计View

    controller内置middleware
    以及设计好session和cookie的加载
    解决核心中的基础bootstrap,服务提供者注册组件->然后再通过多个组件完成一个功能
    
> 3.17 orm的设计

    设计完model基类之后估摸着会休整一段时间,了解更多的设计模式以及思路，
    如何优化整个框架的运行，这也是我所需要是考的
    文章正在准备   预计先发送基本的设计模式（门面等）
    再写如何写出类似的框架
    最近也比较繁忙所以体谅一下更新的速度
    
    框架质量可能不是特别的优秀或者优雅，不过会坚持维护下去
    
    
> 4.4 Route个人认为一般不会改变，可以缓存起来做一个中间层,之后都从route中取出会快很多
 


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