<?php

namespace CSSTool\Tools;

class Filer 
{
    private $fileName;
    private $fileExtention;
    private $filePath = 'temp/';
    private $fileContent;

    public function __construct($stringPath){
        return $this->load($stringPath);
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

    public function save($name,$path,$createIfNotExist=true){
        try {            
            $this->setName($name);
            $this->setPath($path);

            if($createIfNotExist){
                $this->createPathIfNotExist();
            }   
            $finalFilePath = $this->filePath.$this->fileName.$this->fileExtention;
            return \file_put_contents($finalFilePath, $this->fileContent);
        } catch(\Exception $e){
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        return false;
    }

    public function setName($name){
        $name = explode('.', $name);
        $this->fileName = $name;
        $this->fileExtention = (isset($name[1])?$name[1]:'filerTemp');
    }

    public function setPath($path){
        $this->filePath=$path;
    }

    public function hasContent(){
        return (boolean)(strlen($this->fileContent)>0);
    }

    private function createPathIfNotExist(){
        echo 'Create path if not exist';
    }


}