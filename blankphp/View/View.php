<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/15
 * Time: 14:30
 */

namespace Blankphp\View;


class View
{
    //缓存的目录
    protected $cacheDir = APP_PATH . 'cache/view/';
    //模板文件目录
    protected $templateDir = APP_PATH . 'resource/template/';
    public $_valueArray = [];
    static $pregArray = [
        '#\{{\\$(.+?)\}}#',
        '#\{{if (.*?)\}}#',
        '#\{{(else if|elseif) (.*?)\}}#',
        '#\{{else\}}#',
        '#\{{foreach \\$([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)}}#',
        '#\{{(endforeach|endif)}}#',
        '#\{{^(k|v)\}}#',
        '#\{{[^\$](.+?)\}}#',

    ];
    static $descArray = [
        "<?php \$this->getValue(\$this->_\\1); ?>",
        '<?php if (\\1) {?>',
        '<?php } else if (\\2) {?>',
        '<?php }else {?>',
        "<?php foreach (\$this->_valueMap['\\1'] as \$k => \$v) {?>",
        '<?php }?>',
        '',
        '<?php \\1; ?>',
    ];

    protected $fileName;
    protected $descFile;
    protected $cacheTime = 0;

    public function setFileName($fileName)
    {
        $fileName=explode('.',$fileName);
        $this->fileName = implode('/',$fileName) . '.php';
    }

    public function setDescFile($fileName)
    {
        $this->descFile = md5($this->getFile()) . '.php';
    }

    public function getDescFile()
    {
        return $this->cacheDir . $this->descFile;
    }

    public function getFile()
    {
        return $this->templateDir . $this->fileName;
    }

    //判断是否存在缓存文件
    public function existsFile()
    {
        if (is_file($this->getDescFile()))
            return true;
        return false;
    }

    public function getValue($result)
    {
        if (is_array($result)) {
            var_dump($result);
        } else {
            echo $result;
        }
    }

    public function makeValueArray($datas)
    {
        foreach ($datas as $key => $value) {
            $this->{'_' . $key} = $value;
        }
    }

    public function make($filename)
    {
        $this->setFileName($filename);
        $this->setDescFile($filename);
    }


    public function cacheFile($content)
    {
        $file = $this->getDescFile();
        if (!is_file($file)) {
            $f = fopen($file, 'w');
            fclose($f);
        }
        return file_put_contents($file, $content);
    }

    public function view($filename, $data = [])
    {
        $this->make($filename);
        $this->makeValueArray($data);
        //1.查找是否具有视图文件的缓存，有直接载入，无，编译
        if (!$this->existsFile() || $this->isRecompile()) {
            $this->deleteCache();
            $this->compile();
        }
        //载入内容,返回内容
        ob_start();
        ob_clean();
        include($this->getDescFile());
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    protected function compile()
    {
        $content = file_get_contents($this->getFile());
        $content = $this->compileContent($content);
        $this->cacheFile($content);
    }

    protected function compileContent($content)
    {
        return preg_replace(self::$pregArray, self::$descArray, $content);
    }


    private function isRecompile()
    {
        return filectime($this->getFile()) - filectime($this->getDescFile()) > $this->cacheTime;
    }

    private function deleteCache()
    {
        //刪除文件
    }




}