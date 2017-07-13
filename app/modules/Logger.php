<?php
/**
 * Created by PhpStorm.
 * User: abraham
 * Date: 15/7/6
 * Time: 下午4:07
 */

class Logger {
    protected $file;

    protected $content;

    protected $writeFlag;

    protected $endRow;


    public function __construct($file,$endRow="\n",$writeFlag=FILE_APPEND) {

        $this->file=$file;

        $this->writeFlag=$writeFlag;

        $this->endRow=$endRow;

    }


    public function AddRow($content="",$newLines=1){

        $newRow = "";
        for ($m=0;$m<$newLines;$m++)
        {
            $newRow .= $this->endRow;
        }

        $this->content .= $content . $newRow;

    }


    public function Commit(){

        return file_put_contents($this->file,$this->content,$this->writeFlag);

    }

    public function LogError($error,$newLines=1)
    {
        if ($error!=""){
            $this->AddRow($error,$newLines);
            echo $error;
        }
    }

    public function grab_dump($var){
        ob_start();
        var_dump($var);
        return ob_get_clean();

    }

}