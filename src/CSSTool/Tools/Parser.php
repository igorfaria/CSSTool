<?php

namespace CSSTool\Tools;

class Parser
{
    private $CSS = [];
    private $config = [];

    public function __construct(){
        return $this;
    }

    public function parse($css_text){
        // If it isn't an string...
        if(!is_string($css_text)) return false;
        // Remove comments before parsing
        $css_text = preg_replace('@\\s*/\\*.*\\*/\\s*@sU','', $css_text);
        // Remove html comments
        $css_text = preg_replace('/([^\'"]+?)(\<!--|--\>)([^\'"]+?)/ms', '$1$3', $css_text);
        /* Remove empty selectors
        $css_text = preg_replace('/(?<=(\}|;))[^\{\};]+\{\s*\}/', '', $css_text)*/
    
        $re_media = "/(@\w+[^{]+)\{([\s\S]+?})\s*}/";
        preg_match_all($re_media, $css_text, $matches_media);

        $css_text_aux = $this->replaceMedias($re_media, $css_text);
        
        # Initial Source: https://stackoverflow.com/questions/33547792/php-css-from-string-to-array
        //$re_css = "/\s*([^{]+)\s*\{\s*([^}]*?)\s*}/";
        $re_css = "/([^{]+)\s*\{\s*([^}]+)\s*}/";
        preg_match_all($re_css, $css_text_aux, $matches);
        
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
                    if(empty($s[1])) continue;
                    $property = trim($s[0]);
                    $value = trim($s[1]);
                    
                    // Autoprefixer :D
                    if(isset($this->config['autoprefixer']) AND $this->config['autoprefixer']){
                        // Check if is there is an array with prefixes
                        if(is_array($this->config['prefixes'])){
                            // Iterates over 
                            foreach($this->config['prefixes'] as $prefix=>$pre_prop){
                                // If the property is defined in the array
                                if(in_array($property, $pre_prop)){
                                    // Add property with prefix to the rules
                                    $rules_a[$prefix . $property] = $value;
                                }
                            }
                        }
                    }
                    // Add property to the rules
                    $rules_a[$property] = $value;
                }
            }
            // Media queries
            if(preg_match('/\@media-(\d+)/',$name, $media_query)) {
                // Check if there is the number that identify the media
                if(isset($media_query[1]) AND isset($matches_media[0][$media_query[1]])){
                    // @media print, @keyframes, @media all and (max-width: ...)
                    $media_query_name = $matches_media[1][$media_query[1]];
                    $name = trim($media_query_name);
                    // CSS string related to the media
                    $media_query_css = $matches_media[2][$media_query[1]];
                    // Parse the CSS string
                    $rules_a = $this->parse($media_query_css); 
                    // If autoprefixer is true, there is the -webkit- prefix and is @keyframes
                    if(isset($this->config['autoprefixer']) 
                    AND $this->config['autoprefixer'] 
                    AND isset($this->config['autoprefixer']['prefixes']['-webkit-']) 
                    AND strpos($name,'@keyframes') !== false){
                        // Add the webkit prefix to @keyframes
                        $name_webkit = preg_replace('/@keyframes/i','@-webkit-keyframes', $name);
                        // Append to the array
                        $return[][$name_webkit] = $rules_a;
                        
                    }
                } 
            }
            
            
            //Add the name and its values to the array
            $return[][$name] = $rules_a;
        }
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