<?php

namespace CSSTool;

class CSS
{
    private $parsedCSS = [];

    public function get(){
        // Just return the array of parsed CSS
        return $this->parsedCSS;
    }
    public function set($cssInput){
        // Set a new array
        $this->parsedCSS = [];
        // Append the $cssInput
        return $this->add($cssInput);
    }

    public function load($cssFilepath){
        $Filer = new Tools\Filer($cssFilepath);
        $this->set($Filer->get());
    }

    public function parse($cssStringInput){
        // Create an instance of CSSTool\Tools\Parser
        $Parser = new Tools\Parser();
        // Return an set of associative array of parsed CSS
        return $Parser->parse($cssStringInput);
    }

    public function append($cssInput){
        // Call add method
        return $this->add($cssInput);
    }

    public function prepend($cssInput){
        // Call add method and pass "false" in the $append argument
        return $this->add($cssInput, false);
    }

    private function add($cssInput,$append=true){
        // If it isn't a string or an array, return false
        if(!is_string($cssInput) AND !is_array($cssInput)) return false;
        // If it is an string, parse it
        if(is_string($cssInput)) $cssInput = $this->parse($cssInput);
        if($append){
            // It's to append
            $this->parsedCSS = array_merge($this->parsedCSS, $cssInput);
        }
        else {
            // It's to prepend
            $this->parsedCSS = array_merge($cssInput,$this->parsedCSS);
        }
        // Return true
        return true;
    }
    
}