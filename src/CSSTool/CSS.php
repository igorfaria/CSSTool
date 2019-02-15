<?php

namespace CSSTool;

class CSS
{
    private $parsedCSS = [];
    private $config = [];

    public function __construct($config=[]){
        // Set initial configs
        $this->set_config($config);
    }

    private function set_config($config){
        $this->config = array(
            // Optimize output
            'optimize' => true,
            // Auto Prefixes - add prefixes automatically if not yet defined to specified properties that you define
            'autoprefixer' => true,
            # just add prefixes to properties :x
            # http://shouldiprefix.com
            'prefixes' => array(
                '-webkit-' => array(
                    'animation', 'background-clip', 'box-reflect', 'filter', 'flex', 'box-flex',
                    'font-feature-settings','hyphens','mask-image','column-count', 'column-gap', 
                    'column-rule','flow-from','flow-into','transform','appearance',
					'animation-duration', 'animation-duration', 'animation-name'
                ), 
                '-moz-' => array(
					'animation-duration', 'animation-duration', 'animation-name', 'transform',
                    'font-feature-settings', 'hyphens','column-count','column-gap','column-rule','appearance'
                ), 
                '-ms-' => array(
                    'word-break', 'hyphens','flow-from','flow-into','transform'
                ),
                '-o-' => array(
                    'object-fit'
                ),
            ),
             
        );
        // If $config is an array, overwrites the default value
        if(is_array($config)){
            // Iterate over the array
            foreach($config as $key=>$value){
                // Verify if the $key is a valid config key
                if(array_key_exists($key,$this->config)){
                    // Overwrite the original value
                    $this->config[$key] = $value;
                }
            }
        }
    }

    public function set($cssInput){
        // Set a new array
        $this->parsedCSS = [];
        // Append the $cssInput
        return $this->add($cssInput);
    }

    public function load($cssFilepath){
        $Filer = new Filer($cssFilepath);
        $this->set($Filer->get());
    }

    public function save($cssFilepath){
        $Filer = new Filer();
        $Filer->set($this->get('string'));
        return $Filer->save($cssFilepath);
    }

    public function parse($cssStringInput){
        // Return an set of associative array of parsed CSS
        return Parser::parse($cssStringInput);
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

    public function get($format='array',$minified=true){
        switch($format){
            case 'string':
                $stringCSS = Parser::toString($this->parsedCSS);
                // If its to minify, we minify
                if($minified){
                    $stringCSS = Minifier::css($stringCSS);
                }
                return $stringCSS;
                break;
            case 'json':
                $FLAGS_JSON = JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE;
                // If it isn't to minify, well return the pretty print version :D
                $FLAGS_JSON .= (!$minified)?(JSON_PRETTY_PRINT):''; 
                // Return a json with CSS rules and properties 
                return json_encode($this->parsedCSS, $FLAGS_JSON);
                break;
            case 'array':      
            default:          
                // Just return the array of parsed CSS
                return $this->parsedCSS;
                break;
        }
    }
    
}