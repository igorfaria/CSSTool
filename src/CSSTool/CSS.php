<?php

namespace CSSTool;

class CSS
{
    private $parsed_css = [];

    public function get(){
        // Just return the array of parsed CSS
        return $this->parsed_css;
    }
    public function set($css_input){
        // Set a new array
        $this->parsed_css = [];
        // Append the $css_input
        return $this->add($css_input);
    }

    public function parse($string_css){
        // Create an instance of CSSTool\Tools\Parser
        $Parser = new Tools\Parser();
        // Return an set of associative array of parsed CSS
        return $Parser->parse($string_css);
    }

    public function append($css_input){
        // Call add method
        return $this->add($css_input);
    }

    public function prepend($css_input){
        // Call add method and pass "false" in the $append argument
        return $this->add($css_input, false);
    }

    private function add($css_input,$append=true){
        // If it isn't a string or an array, return false
        if(!is_string($css_input) AND !is_array($css_input)) return false;
        // If it is an string, parse it
        if(is_string($css_input)) $css_input = $this->parse($css_input);
        if($append){
            // It's to append
            $this->parsed_css = array_merge($this->parsed_css, $css_input);
        }
        else {
            // It's to prepend
            $this->parsed_css = array_merge($css_input,$this->parsed_css);
        }
        // Return true
        return true;
    }
    
}