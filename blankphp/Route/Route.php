<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/10
 * Time: 21:32
 */

namespace Blankphp\Route;

use Blankphp\Application;
use Blankphp\Cache\FileCache;
use Blankphp\Contract\Route as Contract;
use Blankphp\Route\Traits\SetMiddleWare;
use Blankphp\Route\Traits\ResolveSomeDepends;

//后期应该使用迭代器模式来进行优化
class Route implements Contract
{
    use ResolveSomeDepends, SetMiddleWare;
    public static $verbs = ['GET', 'HEAD', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS'];
    protected $route;
    protected $app;
    protected $container;
    protected $controllerNamespace;
    protected $prefix;
    protected $group;
    protected $groupMiddleware;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }


    public function get($uri, $action)
    {
        $this->init();
        return $this->addRoute(['GET'], $uri, $action);
    }

    public function delete($uri, $action)
    {
        $this->init();
        return $this->addRoute(['DELETE'], $uri, $action);
    }

    public function put($uri, $action)
    {
        $this->init();
        return $this->addRoute(['PUT'], $uri, $action);
    }

    public function post($uri, $action)
    {
        $this->init();
        return $this->addRoute(['POST'], $uri, $action);
    }

    public function any($uri, $action)
    {
        $this->init();
        return $this->addRoute(self::$verbs, $uri, $action);
    }

    public function addRoute($methods, $uri, $action)
    {
        foreach ($methods as $method) {
            $uri = empty($this->prefix) ? $uri : '/' . $this->prefix . $uri;
            $this->route[$method][$uri] = ['action' => $action];
            $this->setCurrentController($method, $uri);
            $this->setOneMiddleWare($method, $uri);
            empty($this->groupMiddleware) ?: $this->route[$method][$uri]['middleware']['group'] = $this->groupMiddleware;
        }

        return $this;
    }

    public function middleware()
    {
        //引用中间件别名[然后获取]
        $middleware = func_get_args();
        if (!empty($this->currentController)) {
            foreach ($middleware as $item) {
                $this->tempMiddleware = $item;
                $this->setOneMiddleWare(...$this->currentController);

            }
            $this->tempMiddleware = '';
        }
        return $this;
    }


    public function file($file)
    {
        require $file;
    }

    public function prefix($prefix)
    {
        $this->prefix = $prefix;
        return $this;
    }

    public function group($group)
    {
        $this->group = $group;
        return $this;
    }

    public function GroupMiddleware($groupMiddleware)
    {
        $this->groupMiddleware = $groupMiddleware;
        return $this;
    }


    public function setNamespace($namespace)
    {
        $this->controllerNamespace = $namespace;
        return $this;
    }


    public function findRoute($request)
    {
        //判断方法
        $method = $request->method;
        //获取访问的uri
        $uri = $request->uri;
        //分组之后emmm把以前导入的方式转换一下
        if (isset($this->route[$method][$uri])) {
            //获取控制器
            $temp = $this->route[$method][$uri];
            $controller = $this->getController($temp['action']);
            $middleware = $this->getOneMiddleWare($temp);
            !empty($middleware) ? $this->setMiddleWare($middleware) : '';
            return $controller;
        } else {
            $temps = array_filter(explode('/', $uri));
            $parameters = [];
            for ($i = 1; $i <= count($temps); $i++) {
                if (is_numeric($temps[$i])) {
                    $parameters[] = $temps[$i];
                    $temps[$i] = '<id>';
                }
            }
            $uri = '/' . implode('/', $temps);
            if (isset($this->route[$method][$uri])) {
                $temp = $this->route[$method][$uri];
                $controller = $this->getController($temp['action']);
                $middleware = $this->getOneMiddleWare($temp);
                !empty($middleware) ? $this->setMiddleWare($middleware) : '';
                array_push($controller, $parameters);
                return $controller;
            }
        }
        throw new \Exception('该路由暂无控制器', 5);
    }

    public function getController($controller)
    {
        //如过传递的是闭包
        if ($controller instanceof \Closure)
            return array('Closure', $controller);
        //如果不是闭包
        $controller = explode('@', $controller);
        $controllerName = !is_null($controller[0]) ? $this->controllerNamespace . '\\' . $controller[0] : '';
        $method = !is_null($controller[1]) ? $controller[1] : '';
        if (!is_null($controllerName) || !is_null($method))
            return array($controllerName, $method);
        throw new \Exception('控制器方法错误', 4);
    }


    public function runController($controller, $method, $parameters = [])
    {
        $parameters = $this->resolveClassMethodDependencies(
            $parameters, $controller, $method
        );
        if ($controller === 'Closure')
            return $method(...array_values($parameters));
        //解决方法的依赖
        $controller = $this->app->build($controller);
        //获取控制器的对象,返回结果
        return $controller->{$method}(...array_values($parameters));
    }


    public function run($request)
    {
        //路由分发
        return $this->runController(...$this->findRoute($request));
    }

    public function putCache()
    {
        FileCache::putCache($this->route, 'route.php');
    }

    public function getCache()
    {
//        if ($this->isReBuild()) {
//            return true;
//        }
        if (!empty($route = $this->app->getSignal('route'))) {
            $this->route = $route;
            return false;
        }
        return true;
    }

    private function isReBuild()
    {
        return FileCache::canRebuild(APP_PATH . 'routes/web.php', 'route.php');
    }

}