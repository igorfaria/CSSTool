<?php

namespace CSSTool;

class Minifier
{
    static function css($stringCSS){
        $selfInstance = new self();
        // Remove block comments /* ... */
        $stringCSS = $selfInstance->remove_block_comments($stringCSS);
        // Remove empty selectors p{}
        $stringCSS = $selfInstance->remove_empty_selectors($stringCSS);
        // Replace double spaces
        $stringCSS = $selfInstance->replace_double_spaces($stringCSS);
        // Remove space before characters :;,"\'{}()...  
        $stringCSS = $selfInstance->remove_space_before_chars($stringCSS);
        // Remove last semicolon
        $stringCSS = $selfInstance->remove_last_semicolon($stringCSS);
        // Return minified string
        return $stringCSS;
    }

    static function json($stringJSON){
        $selfInstance = new self();
        // Remove block comments /* ... */
        $stringJSON = $selfInstance->remove_block_comments($stringJSON);
        // Replace double spaces
        $stringJSON = $selfInstance->replace_double_spaces($stringJSON);
        return $stringJSON;
    }

    private function remove_block_comments($stringInput){
        return preg_replace('@\\s*/\\*.*\\*/\\s*@sU','', $stringInput);
    }

    private function remove_empty_selectors($stringInput){
        return preg_replace('/(?<=(\}|;))[^\{\};]+\{\s*\}/', '', $stringInput);
    }

    private function replace_double_spaces($stringInput){
        return preg_replace('/\\s{2,}/',' ', $stringInput);
    }

    private function remove_space_before_chars($stringInput){
       // Remove space before characters :;,"\'{}()...  
       return preg_replace('@\s*([\:;,."\'{}()])\s*@',"$1",$stringInput);   
    }

    private function remove_last_semicolon($stringInput){
        return preg_replace('@;}@','}',$stringInput);;
    }
}