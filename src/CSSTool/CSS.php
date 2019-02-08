<?php

namespace CSSTool;

class CSS
{
    private $parsed_css = [];

    public function get(){
        return $this->parsed_css;
    }
    public function set($css_input){
        $this->parsed_css = [];
        return $this->add($css_input);
    }

    public function parse($string_css){
        $Parser = new Tools\Parser();
        return $Parser->parse($string_css);
    }

    public function append($css_input){
        return $this->add($css_input, true);
    }

    public function prepend($css_input){
        return $this->add($css_input, false);
    }

    private function add($css_input,$append=true){
        if(!is_string($css_input) AND !is_array($css_input)) return false;
        if(is_string($css_input)) $css_input = $this->parse($css_input);

        if($append){
            $this->parsed_css = array_merge($this->parsed_css, $css_input);
        }
        else {
            $this->parsed_css = array_merge($css_input,$this->parsed_css);
        }
        
        return true;
    }
    
}