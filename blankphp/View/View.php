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
    protected $templateDir = APP_PATH . 'public/template/';
    public $_valueArray = [];
    static $pregArray = [
        '#\{\\$([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)\}#',
        '#\{if (.*?)\}#',
        '#\{(else if|elseif) (.*?)\}#',
        '#\{else\}#',
        '#\{foreach \\$([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)}#',
        '#\{\/(foreach|if)}#',
        '#\{\\^(k|v)\}#',
    ];
    static $descArray = [
        "<?php echo \$this->_valueArray['\\1']; ?>",
        '<?php if (\\1) {?>',
        '<?php } else if (\\2) {?>',
        '<?php }else {?>',
        "<?php foreach (\$this->_valueMap['\\1'] as \$k => \$v) {?>",
        '<?php }?>',
        '<?php echo \$\\1?>'
    ];

    protected $fileName;
    protected $descFile;
    protected $cacheTime=0;

    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }

    public function setDescFile($fileName)
    {
        $this->descFile = hash_file('md5',$fileName) . '.php';
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
        if (file_exists($this->getDescFile()))
            return true;
        return false;
    }

    public function make($filename)
    {
        $this->setFileName($filename);
        $this->setDescFile($filename);
    }

    public function makeValueArray($data)
    {
        $this->_valueArray = $data;
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
        if ((!$this->existsFile() && is_file($this->getFile())) || $this->isRecompile()) {
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
        return filemtime($this->getFile()) - filemtime($this->getDescFile()) > $this->cacheTime;
    }
}