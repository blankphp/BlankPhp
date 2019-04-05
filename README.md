# BlankFramework

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
    //结果传入response=》返回最终结果！！
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

Document Path:          /11
Document Length:        156590 bytes

Concurrency Level:      100
Time taken for tests:   50.264 seconds
Complete requests:      2000
Failed requests:        0
Total transferred:      313790000 bytes
HTML transferred:       313180000 bytes
Requests per second:    39.79 [#/sec] (mean)
Time per request:       2513.181 [ms] (mean)
Time per request:       25.132 [ms] (mean, across all concurrent requests)
Transfer rate:          6096.57 [Kbytes/sec] received

Connection Times (ms)
              min  mean[+/-sd] median   max
Connect:        0    1   1.2      1      15
Processing:   201 2461 3961.6   1639   20548
Waiting:       20 2451 3937.2   1635   20528
Total:        202 2461 3961.5   1639   20548

Percentage of the requests served within a certain time (ms)
  50%   1639
  66%   1667
  75%   1682
  80%   1693
  90%   1727
  95%   1864
  98%  19916
  99%  20192
 100%  20548 (longest request)

C:\Users\Administrator\Downloads\Apache24\bin>
C:\Users\Administrator\Downloads\Apache24\bin>ab.exe -n 2000 -c 100 "http://www.stu.stu/11"
This is ApacheBench, Version 2.3 <$Revision: 1843412 $>
Copyright 1996 Adam Twiss, Zeus Technology Ltd, http://www.zeustech.net/
Licensed to The Apache Software Foundation, http://www.apache.org/

Benchmarking www.stu.stu (be patient)
Completed 200 requests
Completed 400 requests
Completed 600 requests
Completed 800 requests
Completed 1000 requests
Completed 1200 requests
Completed 1400 requests
Completed 1600 requests
Completed 1800 requests
Completed 2000 requests
Finished 2000 requests


Server Software:        nginx/1.15.5
Server Hostname:        www.stu.stu
Server Port:            80

Document Path:          /11
Document Length:        156590 bytes

Concurrency Level:      100
Time taken for tests:   35.807 seconds
Complete requests:      2000
Failed requests:        0
Total transferred:      313790000 bytes
HTML transferred:       313180000 bytes
Requests per second:    55.86 [#/sec] (mean)
Time per request:       1790.325 [ms] (mean)
Time per request:       17.903 [ms] (mean, across all concurrent requests)
Transfer rate:          8558.10 [Kbytes/sec] received

Connection Times (ms)
              min  mean[+/-sd] median   max
Connect:        0    1   1.1      1      15
Processing:   204 1747 293.5   1722    2494
Waiting:       20 1743 293.7   1719    2490
Total:        205 1748 293.4   1723    2494

Percentage of the requests served within a certain time (ms)
  50%   1723
  66%   1790
  75%   1865
  80%   1936
  90%   2072
  95%   2233
  98%   2331
  99%   2355
 100%   2494 (longest request)

C:\Users\Administrator\Downloads\Apache24\bin>ab.exe -n 2000 -c 100 "http://www.stu.stu/11"
This is ApacheBench, Version 2.3 <$Revision: 1843412 $>
Copyright 1996 Adam Twiss, Zeus Technology Ltd, http://www.zeustech.net/
Licensed to The Apache Software Foundation, http://www.apache.org/

Benchmarking www.stu.stu (be patient)
Completed 200 requests
Completed 400 requests
Completed 600 requests
Completed 800 requests
Completed 1000 requests
Completed 1200 requests
Completed 1400 requests
Completed 1600 requests
Completed 1800 requests
Completed 2000 requests
Finished 2000 requests


Server Software:        nginx/1.15.5
Server Hostname:        www.stu.stu
Server Port:            80

Document Path:          /11
Document Length:        156590 bytes

Concurrency Level:      100
Time taken for tests:   34.539 seconds
Complete requests:      2000
Failed requests:        0
Total transferred:      313790000 bytes
HTML transferred:       313180000 bytes
Requests per second:    57.91 [#/sec] (mean)
Time per request:       1726.934 [ms] (mean)
Time per request:       17.269 [ms] (mean, across all concurrent requests)
Transfer rate:          8872.24 [Kbytes/sec] received

Connection Times (ms)
              min  mean[+/-sd] median   max
Connect:        0    1   1.1      1      17
Processing:   201 1677 216.0   1703    2170
Waiting:       94 1672 216.3   1699    2166
Total:        202 1678 215.8   1704    2172

Percentage of the requests served within a certain time (ms)
  50%   1704
  66%   1751
  75%   1777
  80%   1793
  90%   1842
  95%   1887
  98%   1954
  99%   2008
 100%   2172 (longest request)

```