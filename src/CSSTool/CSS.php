<?php

namespace CSSTool;

class CSS
{
    private $parsedCSS = [];

    public function get($format='array'){
        switch($format){
            case 'string':
                return Tools\Parser::toString($this->parsedCSS);
                break;
            case 'json':
                return json_encode($this->parsedCSS, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                break;
            case 'array':      
            default:          
                // Just return the array of parsed CSS
                return $this->parsedCSS;
                break;
        }
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
        // Return an set of associative array of parsed CSS
        return Tools\Parser::parse($cssStringInput);
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
        if(is_string($cssInput)) {
            $cssInput = $this->parse($cssInput);
        } else {
            // If it is an array
            if(count($cssInput) > 0 AND is_array($cssInput)){
                // Check to see if it's an set
                if(!isset($cssInput[0])){
                    return $this->add([$cssInput],$append);
                }
            } else {
                // If it's not an array or is empty at this point, we have nothing to merge 
                return false;
            }
        }
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