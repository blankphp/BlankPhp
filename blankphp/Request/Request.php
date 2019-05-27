<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/11
 * Time: 13:14
 */

namespace Blankphp\Request;

use Blankphp\Contract\Request as RequestContract;

class Request implements RequestContract
{
    //端口存储以及其他信息的存储！！--》  表单验证功能的实现
    public $uri;
    public $method;
    public $request = [
        'get' => '',
        'post' => '',
        'files' => '',
        'input'=>'',
    ];
    public $session = [];
    public $cookie = [];
    //php://input
    public $input = [];
//    用户ip;
    public $user_ip;
    //访问所需的ip
    public $server_ip;
    public $http;
    public $https;
    public $userAgent;
    public $userIp;
    public $language;

    public function __construct()
    {
        $this->getUri();
        $this->getMethod();
    }

    public function stripSlashesDeep($value)
    {
        //递归方式解决不安全字符
        $value = is_array($value) ? array_map([$this, 'stripSlashesDeep'], $value) : stripslashes($value);
        return $value;
    }

    public function get($name = '', array $optionm = []){
        $this->{'_'.strtolower($this->method)}();
        if (isset($this->request[strtolower($this->method)][$name])){
            return $this->request[strtolower($this->method)][$name];
        }else{
            $this->getRequest();
            foreach ($this->request as $item){
                if (isset($item[$name]))
                    return $item[$name];
            }
            return null;
        }
    }




    public function capture()
    {
        return $this;
    }




    public function getUri()
    {
        if (is_null($this->uri)) {
            $url = $_SERVER['REQUEST_URI'];
            // 清除?之后的内容,计算？出现的位置position(定位)
            $position = strpos($url, '?');
            //是否截取其中的代码
            $url = $position === false ? $url : substr($url, 0, $position);
            $url = trim($url, '/');
            $urlArray = explode('/', $url);
            $urlArray = array_filter($urlArray);
            $file = explode('/', str_replace('\\', '/', APP_PATH . 'index.php'));
            $urlArray = array_diff($urlArray, $file);
            //去除两边的东西
            if ($urlArray) {
                $this->uri = '/' . implode('/', $urlArray);
            } else {
                $this->uri = '/';
            }
        }
        return $this->uri;

    }

    public function getMethod()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method === 'POST')
            $method = isset($this->request['post']['_method']) ? strtoupper($this->request['post']['_method']) : 'POST';
        $this->method = $method;
        return $this->method;
    }



    public function file($name = '')
    {
        if (empty($this->request['files'])) {
            $this->request['files'] = !is_null($_FILES) ? $_FILES : '';
//            unset($_FILES);
        }
        if (isset($this->request['files'][$name]))
            return $this->request['files'][$name];
        else
            return '';
    }

    public function __get($name)
    {
        if (!isset($this->$name)) {
          return $this->get($name);
        }
        return $this->$name;
    }

    private function getRequest(){
        $this->_get();
        $this->_post();
        $this->_input();
    }


    public function getUserAgent()
    {
        if (empty($this->userAgent))
             $this->userAgent = $_SERVER['HTTP_USER_AGENT'];
        return  $this->userAgent;
    }

    public function userIp()
    {
        if (empty($this->user_ip))
            $this->user_ip = $_SERVER['REMOTE_ADDR'];
        return  $this->user_ip;
    }

    public function getLanguage()
    {
        if (empty($this->language))
            $this->language = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
        return  $this->language;
    }

    public function getHttp(){

    }

    public function getServicePort(){

    }

    private function _get($name = '', array $optionm = [])
    {
        if (empty($this->request['get'])) {
            //是否进行过滤？递归的效率很成问题
            $this->request['get'] = !is_null($_GET) ? $this->stripSlashesDeep($_GET) : '';
        }
        if (isset($this->request['get'][$name]))
            return $this->request['get'][$name];
        else
            return '';
    }
    private function _post($name = '', array $optionm = [])
    {
        if (empty($this->request['post'])) {
            $this->request['post'] = !is_null($_POST) ? $this->stripSlashesDeep($_POST) : '';
        }
        if (isset($this->request['post'][$name]))
            return $this->request['post'][$name];
        else
            return '';
    }
    private function _input($name='',array $args=[])
    {
        if (empty($this->request['input'])) {
            $this->input=file_get_contents('php://input');
            if (strstr($this->input,'{')){
                $this->request['input']=json_decode( $this->input,true);
            }else{
                parse_str( $this->input,$this->request['input']);
            }
        }
        if (isset($this->request['input'][$name]))
            return $this->request['input'][$name];
        else
            return '';
    }

}