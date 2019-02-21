<?php

namespace CSSTool;

class Filer 
{
    private $fileName;
    private $fileExtention;
    private $filePath = 'temp/';
    private $fileContent;

    public function __construct($stringPath=null){
        if(!is_null($stringPath)) return $this->load($stringPath);
    }

    public function load($stringPath){
        try {   
            $pathParts = pathinfo($stringPath);

            $this->filePath = $pathParts['dirname'];
            $this->fileExtention = $pathParts['extension'];
            $this->fileName = $pathParts['filename'];

            $this->fileContent = \file_get_contents($stringPath);
            
            return $this;
        } catch(\Exception $e){
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        return false;
    }

    
    public function get(){
        return $this->fileContent;   
    }

    public function set($stringContent){
        if(!is_string($stringContent)) return false;
        $this->fileContent = $stringContent;
        return true;
    }

    public function save($name,$path='',$createIfNotExist=true){
        try {          

            $pathParts = pathinfo($path.$name);

            $this->filePath = $pathParts['dirname'];
            $this->fileExtention = $pathParts['extension'];
            $this->fileName = $pathParts['filename'];

            if($createIfNotExist){
                $this->createPathIfNotExist();
            }   

            $finalFilePath = $this->filePath.'/'.$this->fileName.'.'.$this->fileExtention;
            return \file_put_contents($finalFilePath, $this->fileContent);
        } catch(\Exception $e){
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        return false;
    }

    public function setName($name){
        $name = explode('.', $name);
        $this->fileName = $name[0];
        $this->fileExtention = (isset($name[1])?$name[1]:'filerTemp');
    }

    public function setPath($path){
        if(empty($path)) return false;
        $this->filePath=$path;
    }

    public function hasContent(){
        return (boolean)(strlen($this->fileContent)>0);
    }

    private function createPathIfNotExist(){
        return $this->make_path($this->filePath.'/'.$this->fileName, true);
    }

    function make_path($pathname, $is_filename=false){
        if($is_filename){
            $pathname = substr($pathname, 0, strrpos($pathname, '/'));
        }
        // Check if directory already exists
        if (is_dir($pathname) || empty($pathname)) {
            return true;
        } 
        // Create the path recursively if it doesn't exists
        return mkdir($pathname,0777,TRUE);
    }


}