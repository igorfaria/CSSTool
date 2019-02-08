<?php

namespace CSSTool\Tools;

class Parser
{
    private $CSS = [];
    private $config = [];

    public function __construct(){
        return $this;
    }

    public function parse($cssInputString){
        // If it isn't an string...
        if(!is_string($cssInputString)) return false;
        // Remove comments before parsing
        $cssText = preg_replace('@\\s*/\\*.*\\*/\\s*@sU','', $cssInputString);
        // Remove html comments
        $cssText = preg_replace('/([^\'"]+?)(\<!--|--\>)([^\'"]+?)/ms', '$1$3', $cssText);
        // Remove empty selectors
        $cssText = preg_replace('/(?<=(\}|;))[^\{\};]+\{\s*\}/', '', $cssText);
    
        $reMedia = "/(@\w+[^{]+)\{([\s\S]+?})\s*}/";
        preg_match_all($reMedia, $cssText, $matchesMedia);

        $cssTextAux = $this->replaceMedias($reMedia, $cssText);
        
        # Initial Source: https://stackoverflow.com/questions/33547792/php-css-from-string-to-array
        $reCSS = "/([^{]+)\s*\{\s*([^}]+)\s*}/";
        preg_match_all($reCSS, $cssTextAux, $matches);
        
        //Create an array to hold the returned values
        $return = array();
        for($i = 0; $i<count($matches[0]); $i++){
            //Get the ID/class
            $name = trim($matches[1][$i]);
            //Get the rules
            $rules = trim($matches[2][$i]);
            //Format rules into array
            $rules_a = array();
            $rules_x = explode(";", $rules);
            foreach($rules_x as $r){
                if(trim($r)!=""){
                    $s = explode(":", $r);
                    if(empty($s[1]) AND strlen($s[1]) == 0) continue;

                    $property = trim($s[0]);
                    $value = trim($s[1]);
                   
                    // Add property to the rules
                    $rules_a[$property] = $value;
                }
            }
            // Media queries
            if(preg_match('/\@media-(\d+)/',$name, $mediaRule)) {
                // Check if there is the number that identify the media
                if(isset($mediaRule[1]) AND isset($matchesMedia[0][$mediaRule[1]])){
                    // @media print, @keyframes, @media all and (max-width: ...)
                    $mediaName = $matchesMedia[1][$mediaRule[1]];
                    $name = trim($mediaName);
                    // CSS string related to the media
                    $mediaCSS = $matchesMedia[2][$mediaRule[1]];
                    // Parse the CSS string
                    $rules_a[] = $this->parse($mediaCSS); 
                } 
            }
            
            
            //Add the name and its values to the array
            $return[][$name] = $rules_a;
        }

        $this->CSS[] = $return;

        //Return the array with rules
        return $return;
    }

    /*
        Int to count the @medias and @keyframes
    */
    private $_countMedias = 0;
    private function replaceMedias($pattern, $text) {
        $this->_countMedias = 0;
        return preg_replace_callback($pattern, array($this, '_callbackMedias'), $text);
    }
    public function _callbackMedias($matches) {
        return '@media-' . $this->_countMedias++ . '{media:'.$this->_countMedias.'}';
    }

}