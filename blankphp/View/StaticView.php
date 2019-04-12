<?php


namespace Blankphp\View;


class StaticView extends View
{
    protected $cacheDir = APP_PATH . 'cache/static/';

    public function cacheFile($content)
    {
        $file = $this->getDescFile();
        if (!is_file($file)) {
            $f = fopen($file, 'w');
            fclose($f);
        }
        return file_put_contents($file, $content);
    }

    public function setDescFile($fileName)
    {
        $this->descFile = $fileName. '.shtml';
    }

    public function view($filename, $data = [],$time=3000)
    {
        $this->make($filename);
        $this->makeValueArray($data);
        $this->cacheTime=$time;
        //1.查找是否具有视图文件的缓存，有直接载入，无，编译
        if (!$this->existsFile() || $this->isRecompile()) {
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
    private function isRecompile(){
        return time() - filectime($this->getDescFile()) > $this->cacheTime;
    }
}