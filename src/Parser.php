<?php

namespace CSSTool;

class Parser
{
    private $CSS = [];
    private $config = [];

    public function __construct(){
        return $this;
    }

    static function parse($cssInputString,$fromMedia=false){
        // If it isn't an string...
        if(!is_string($cssInputString)) return false;
        // Remove comments before parsing
        $cssText = preg_replace('@\\s*/\\*.*\\*/\\s*@sU','', $cssInputString);
        // Remove html comments
        $cssText = preg_replace('/([^\'"]+?)(\<!--|--\>)([^\'"]+?)/ms', '$1$3', $cssText);
        // Remove empty selectors
        $cssText = preg_replace('/(?<=(\}|;))[^\{\};]+\{\s*\}/', '', $cssText);
    
        // @imports
        $reImports = "/(\@import\s+[^;]+;?)/";
        preg_match_all($reImports, $cssText, $matchesImports);

        // If the is @imports
        if(isset($matchesImports[1]) and count($matchesImports[1])>0){
            foreach($matchesImports[1] as $import){
                // Clean it
                $aux_import = preg_replace('/\@import\s+/i','', $import); 
                $aux_import = preg_replace('/url\(/i','', $aux_import); 
                $aux_import = str_replace(array('"',"'",")",'http:','https:'),'', $aux_import);
                // Replace it from CSS text
                $cssText = str_replace($import, "@import {url:{$aux_import}}", $cssText);
            }
        }

        $reMedia = "/(@(?!import)\w+[^{]+)\{([\s\S]+?})\s*}/";
        preg_match_all($reMedia, $cssText, $matchesMedia);

        // An instance with new self(), because the method is now static :D
        $SelfInstanceParser = new self();
        $cssTextAux = $SelfInstanceParser->replaceMedias($reMedia, $cssText);
        
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
                    $rules_a[] = $SelfInstanceParser->parse($mediaCSS,true); 
                    unset($rules_a['media']);
                } 
            }
            
            if($fromMedia){
                $return[$name] = $rules_a;
            } else {
                //Add the name and its values to the array
                $return[][$name] = $rules_a;
            }
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
         return '@media-' . $this->_countMedias++ . '{media:'.$this->_countMedias.';}';
    }

    static function toString($cssInputArray,$minify=true){

        if(!is_array($cssInputArray)) {
            return false;
        }

        $css_text = "";
        $ident_space = "    ";
        $break_line = PHP_EOL;
        
        // Placeholder to @imports
        $imports = [];
        
        // Iterates over the array with rules like a crazy
        foreach($cssInputArray as $rule){
            foreach($rule as $selector1=>$properties1){
              if(!is_array($properties1)) continue;

              // If its an @import
              if(strpos($selector1,'@import') !== FALSE){
                 if(isset($properties1['url']) and !empty($properties1['url'])){
                     $imports[] = $properties1['url'];
                 }
                 // Continue because all @import will be prepended at end
                 continue;
              }

              $css_text .= $selector1 . ' {' . $break_line;
			
							
              // Media Queries
              if(strpos($selector1,'@media') !== FALSE){
                foreach($properties1 as $media_rule){
                    if(!is_array($media_rule)) continue;
                    foreach($media_rule as $selector2=>$properties2){
                        if(!is_array($properties2)) continue;
                        $css_text .= $ident_space . $selector2 . ' {' . $break_line;
                        foreach($properties2 as $prop=>$value){
                            $css_text .= $ident_space . $ident_space . $prop . ': ' . $value . ';' . $break_line; 
                        }
                        $css_text .= $ident_space . '}' . $break_line;
                    }
                }  
				
              } else {
                  // :D 
                  foreach($properties1 as $prop=>$value){
                      if(is_array($value)){ 
                          // To support to @keyframes
                        foreach($value as $keyframes=>$props2){
                            if(!is_array($props2)) continue;
                            $css_text .=  $ident_space . $keyframes . ' {' . $break_line;
							
							
                            foreach($props2 as $selector2=>$properties2){
                                    if(is_array($properties2)){
                                        $css_text .= $ident_space . $ident_space . $selector2 . ' {' . $break_line;
                                        foreach($properties2 as $prop2=>$value2){
                                            $css_text .= $ident_space . $ident_space . $ident_space . $prop2 . ': ' . $value2 . ';' . $break_line; 
                                        }
                                        $css_text .= $ident_space . $ident_space . '}' . $break_line;
                                    } else {
                                        $css_text .= $ident_space . $ident_space . $selector2 . ': ' . $properties2 . ';' . $break_line; 
                                    }
                            }
                            $css_text .= $ident_space . '}' . $break_line;
                        }
                      } else {
                          // Normal css :)
                          $css_text .= $ident_space . $prop . ': ' . $value . ';' . $break_line; 
			          }
                  }
				  
              }
              $css_text .= '}' . $break_line . $break_line;
            }
			
			// Keyframes...
			if(strpos($selector1, '@-web') !== FALSE){  
				$css_text .= $ident_space . '}' . $break_line . $break_line;
			 }
        }


        // If there are @imports
        $total_imports = count($imports);
        if($total_imports > 0){
            $css_text = $break_line . $css_text;
            for($i=0;$i<count($imports);$i++){
                $import = $imports[$i];
                // Prepend each @import 
                $css_text = "@import '{$import}';" . $break_line . $css_text;
            }
        }
        
        return $css_text;
    }

}