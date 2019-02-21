<?php

namespace CSSTool;

class Optimizer
{
    private $prop_prefixes = [];

    public function __construct(){
        // Initialize the vendor prefixes
        $this->set_o_prefixes();
        $this->set_epub_prefixes();
        $this->set_ms_prefixes();
        $this->set_webkit_prefixes();
        $this->set_moz_prefixes();
    }

    static function from_parsed($parsedCSS){
        
        if(!is_array($parsedCSS)) return $parsedCSS;

        $responseCSS = [];
        $selfInstance = new self;
        
        // For every rule
        foreach($parsedCSS as $key=>$value){
          // If the value is an array
          if(is_array($value)){
            foreach($value as $selector=>$props){
                $aux_value = [];
                foreach($props as $prop=>$value){
                    foreach($selfInstance->prop_prefixes as $vendor=>$prefixes){
                        if(in_array($prop,$prefixes)){
                            $props = array_merge([$vendor.$prop => $value], $props);
                        }
                    }
                }
                $responseCSS[][$selector] = $props;
            }
          } else {
            // If isn't an array
            $responseCSS[$key]=$value;
          }
        }
        
        return $responseCSS;
    }

    public function set_webkit_prefixes(){
        $this->prop_prefixes['-webkit-'] = [
            'align-content','align-items','align-self','animation','animation-delay',
            'animation-direction','animation-duration','animation-fill-mode','animation-iteration-count',
            'animation-name','animation-play-state','animation-timing-function','app-region',
            'appearance','aspect-ratio','backface-visibility','background-clip','background-composite',
            'background-origin','background-size','border-after','border-after-color','border-after-style',
            'border-after-width','border-before','border-before-color','border-before-style',
            'border-before-width','border-bottom-left-radius','border-bottom-right-radius',
            'border-end','border-end-color','border-end-style','border-end-width','border-fit',
            'border-horizontal-spacing','border-image','border-radius','border-start','border-start-color',
            'border-start-style','border-start-width','border-top-left-radius','border-top-right-radius',
            'border-vertical-spacing','box-align','box-decoration-break','box-direction','box-flex',
            'box-flex-group','box-lines','box-ordinal-group','box-orient','box-pack','box-reflect',
            'box-shadow','box-sizing','clip-path','column-break-after','column-break-before',
            'column-break-inside','column-count','column-gap','column-rule','column-rule-color',
            'column-rule-style','column-rule-width','column-span','column-width','columns','filter',
            'flex','flex-basis','flex-direction','flex-flow','flex-grow','flex-shrink','flex-wrap',
            'font-feature-settings','font-size-delta','font-smoothing','highlight','hyphenate-character',
            'justify-content','line-box-contain','line-break','line-clamp','locale','logical-height',
            'logical-width','margin-after','margin-after-collapse','margin-before','margin-before-collapse',
            'margin-bottom-collapse','margin-collapse','margin-end','margin-start','margin-top-collapse',
            'mask','mask-box-image','mask-box-image-outset','mask-box-image-repeat','mask-box-image-slice',
            'mask-box-image-source','mask-box-image-width','mask-clip','mask-composite','mask-image',
            'mask-origin','mask-position','mask-position-x','mask-position-y','mask-repeat','mask-repeat-x',
            'mask-repeat-y','mask-size','max-logical-height','max-logical-width','min-logical-height',
            'min-logical-width','opacity','order','padding-after','padding-before','padding-end','padding-start',
            'perspective','perspective-origin','perspective-origin-x','perspective-origin-y','print-color-adjust',
            'rtl-ordering','ruby-position','shape-image-threshold','shape-margin','shape-outside',
            'tap-highlight-color','text-combine','text-decorations-in-effect','text-emphasis','text-emphasis-color',
            'text-emphasis-position','text-emphasis-style','text-fill-color','text-orientation','text-security',
            'text-size-adjust','text-stroke','text-stroke-color','text-stroke-width','transform','transform-origin',
            'transform-origin-x','transform-origin-y','transform-origin-z','transform-style','transition',
            'transition-delay','transition-duration','transition-property','transition-timing-function',
            'user-drag','user-modify','user-select','writing-mode'
        ];

        return $this->prop_prefixes;
    }

    public function set_moz_prefixes(){
        $this->prop_prefixes['-moz-'] = [
            'appearance','binding','border-bottom-colors','border-end','border-end-color','border-end-style',
            'border-end-width','border-left-colors','border-right-colors','border-start','border-start-color',
            'border-start-style','border-start-width','border-top-colors','box-align','box-direction',
            'box-flex','box-ordinal-group','box-orient','box-pack','column-count','column-fill','column-gap',
            'column-rule','column-rule-color','column-rule-style','column-rule-width','column-width','columns',
            'control-character-visibility','float-edge','force-broken-image-icon','hyphens','image-region',
            'margin-end','margin-start','math-display','math-variant','min-font-size-ratio','orient',
            'osx-font-smoothing','outline-radius','outline-radius-bottomleft','outline-radius-bottomright',
            'outline-radius-topleft','outline-radius-topright','padding-end','padding-start','script-level',
            'script-min-size','script-size-multiplier','stack-sizing','tab-size','text-align-last',
            'text-decoration-color','text-decoration-line','text-decoration-style','text-size-adjust',
            'top-layer','transform','user-focus','user-input','user-modify','user-select','window-dragging','window-shadow'
        ];
        return $this->prop_prefixes;
    }

    public function set_ms_prefixes(){
        $this->prop_prefixes['-ms-'] = [
           'accelerator','animation','animation-delay','animation-direction','animation-duration',
           'animation-fill-mode','animation-iteration-count','animation-name','animation-play-state',
           'animation-timing-function','backface-visibility','background-position-x','background-position-y',
           'behavior','block-progression','content-zoom-chaining','content-zoom-limit','content-zoom-limit-max',
           'content-zoom-limit-min','content-zoom-snap','content-zoom-snap-points','content-zoom-snap-type',
           'content-zooming','filter','flex','flex-align','flex-direction','flex-flow','flex-item-align',
           'flex-line-pack','flex-negative','flex-order','flex-pack','flex-positive','flex-preferred-size',
           'flex-wrap','flow-from','flow-into','font-feature-settings','grid-column','grid-column-align',
           'grid-column-span','grid-columns','grid-row','grid-row-align','grid-row-span','grid-rows',
           'high-contrast-adjust','hyphenate-limit-chars','hyphenate-limit-lines','hyphenate-limit-zone','hyphens',
           'ime-align','ime-mode','interpolation-mode','layout-flow','layout-grid','layout-grid-char',
           'layout-grid-line','layout-grid-mode','layout-grid-type','line-break','overflow-style','overflow-x',
           'overflow-y','perspective','perspective-origin','perspective-origin-x','perspective-origin-y',
           'scroll-chaining','scroll-limit','scroll-limit-x-max','scroll-limit-x-min','scroll-limit-y-max',
           'scroll-limit-y-min','scroll-rails','scroll-snap-points-x','scroll-snap-points-y','scroll-snap-type',
           'scroll-snap-x','scroll-snap-y','scroll-translation','scrollbar-3dlight-color','scrollbar-arrow-color',
           'scrollbar-base-color','scrollbar-darkshadow-color','scrollbar-face-color','scrollbar-highlight-color',
           'scrollbar-shadow-color','scrollbar-track-color','text-align-last','text-autospace','text-combine-horizontal',
           'text-justify','text-kashida-space','text-overflow','text-size-adjust','text-underline-position',
           'touch-action','touch-select','transform','transform-origin','transform-origin-x','transform-origin-y',
           'transform-origin-z','transform-style','transition','transition-delay','transition-duration',
           'transition-property','transition-timing-function','user-select','word-break','word-wrap','wrap-flow',
           'wrap-margin','wrap-through','writing-mode','zoom'
        ];
        return $this->prop_prefixes;
    }

    public function set_o_prefixes(){
        $this->prop_prefixes['-o-'] = [
            'object-fit'
        ];
        return $this->prop_prefixes;
    }

    public function set_epub_prefixes(){
        $this->prop_prefixes['-epub-'] = [
            'caption-side','text-combine','text-emphasis','text-emphasis-color','text-emphasis-style',
            'text-orientation','text-transform','word-break','writing-mode',
        ];
        return $this->prop_prefixes;
    }


    public function optimize_value($stringValue){
            if(!is_string($stringValue)) return $stringValue;
            // Replace 0[type] values with 0
            $stringValue = preg_replace('/^0(?:em|ex|ch|rem|vw|vh|vm|vmin|cm|mm|in|px|pt|pc|%)/i', '${1}0', $stringValue);
            // Replace xx.050[type] with xx.05[type]
            $stringValue = preg_replace('/0(em|ex|ch|rem|vw|vh|vm|vmin|cm|mm|in|px|pt|pc|%)/','${1}', $stringValue);
            // Replace -0.5 with -.5
            $stringValue = preg_replace('/^-0./','-.', $stringValue);
            // Remove newline characters and tabs
            $stringValue = str_replace(["\r\n", "\r", "\n", "\t"], '', $stringValue);
            // Remove two or more consecutive spaces
            $stringValue = preg_replace('# {2,}#', ' ', $stringValue);
            // Optimize rgb to hex
            $stringValue = $this->rgb_to_hex($stringValue);
            // Optimize hsl to hex
            $stringValue = $this->hsl_to_hex($stringValue);
            // Compress hex colors => #ffffff -> #fff
            if(preg_match_all('/#(?>[[:xdigit:]]{3}){1,2}$/', $stringValue, $hex_colors)){
                foreach($hex_colors[0] as $hex_color){
                    $stringValue = str_replace($hex_color, $this->compress_hex($hex_color), $stringValue);   
                }
            }
            return $stringValue;
    }

    public function optimize_props($arrayProps){
        // If isnt an array, return whatever it is
        if(!is_array($arrayProps)) return $arrayProps;
      
        $optimizedProps = [];
        foreach($arrayProps as $prop=>$value){
            if(is_string($value)){
                $optimizedProps[$prop] = $this->optimize_value($value);
            } elseif(is_array($value)) {
                $optimizedProps[$prop] = $this->optimize_props($value);
            }            
        }

        // Optimize to shorthanded versions :P
        $optimizedProps = $this->shorthand($optimizedProps);

        return $optimizedProps;
    }

    private function shorthand($arrayProps){
        
        // background: [color] [bg-image] [repeat] [attachment] [position [[top] [left]];
        if(!isset($arrayProps['background'])){
            $background_shorthanded = [];
            $props = ['background-color', 'background-image', 'background-repeat', 
                      'background-attachment', 'background-position'];
            
            foreach($props as $prop){
                if(isset($arrayProps[$prop])){
                    $background_shorthanded[] = $arrayProps[$prop];
                    unset($arrayProps[$prop]);
                }
            }
            
            if(count($background_shorthanded)){
                $arrayProps['background'] = implode(' ', $background_shorthanded);
            }
        }

        // border: border-width border-style (required) border-color
        if(!isset($arrayProps['border'])){
            if(isset($arrayProps['border-style'])){
                $borders_short = [];
                $props = ['border-width', 'border-style', 'border-color'];
                    
                foreach($props as $prop){
                    if(isset($arrayProps[$prop])){
                        $borders_short[] = $arrayProps[$prop];
                        unset($arrayProps[$prop]);
                    }
                }
                
                if(count($borders_short)){
                    $arrayProps['border'] = implode(' ', $borders_short);
                }
            }
        }
        // Not else :D        
        if(isset($arrayProps['border'])){
            // Replace "border: 0 [style] [color]" with "border: 0"
            if(preg_match('/^([0]+)\s+/s', $arrayProps['border'])){
                $arrayProps['border'] = '0';
            }   
        }


        // list-style: [list-style-type] [list-style-position] [list-style-image];
        if(!isset($arrayProps['list-style'])){
            $borders_short = [];
            $props = ['list-style-type', 'list-style-position', 'list-style-image'];
                
            foreach($props as $prop){
                if(isset($arrayProps[$prop])){
                    $borders_short[] = $arrayProps[$prop];
                    unset($arrayProps[$prop]);
                }
            }
            
            if(count($borders_short)){
                $arrayProps['list-style'] = implode(' ', $borders_short);
            }
        }

        // font: font-style font-variant font-weight font-size/line-height font-family;
        if(!isset($arrayProps['font']) AND
            isset($arrayProps['font-size']) AND
            isset($arrayProps['font-family'])
        ){
            $borders_short = [];

            if(isset($arrayProps['line-height'])){
                $arrayProps['font-size'] .= '/' . $arrayProps['line-height'];
                unset($arrayProps['line-height']);
            }

            $props = ['font-style', 'font-variant','font-weight','font-size','font-family'];
                
            foreach($props as $prop){
                if(isset($arrayProps[$prop])){
                    $borders_short[] = $arrayProps[$prop];
                    unset($arrayProps[$prop]);
                }
            }
            
            if(count($borders_short)){
                $arrayProps['font'] = implode(' ', $borders_short);
            }
        }

      // margin: top right bottom left;
      if(!isset($arrayProps['margin']) AND
          isset($arrayProps['margin-top']) AND
          isset($arrayProps['margin-right']) AND
          isset($arrayProps['margin-bottom']) AND
          isset($arrayProps['margin-left'])
      ){
        if($arrayProps['margin-top'] == $arrayProps['margin-bottom'] AND
           $arrayProps['margin-right'] == $arrayProps['margin-left']
        ){
            $arrayProps['margin'] = $arrayProps['margin-top'] . ' ' . $arrayProps['margin-right'];
        } else {
            $arrayProps['margin'] = $arrayProps['margin-top'] . ' '
                                  . $arrayProps['margin-right'] . ' '
                                  . $arrayProps['margin-bottom'] . ' ' 
                                  . $arrayProps['margin-left'];
        }
        unset($arrayProps['margin-top']);
        unset($arrayProps['margin-right']);
        unset($arrayProps['margin-bottom']);
        unset($arrayProps['margin-left']);
      }

        return $arrayProps;
    }
         
    
    protected function rgb_to_hex($stringValue) {
        preg_match_all('#rgb\s*\(\s*([0-9%,\.\s]+)\s*\)#s', $stringValue, $match);
        if (!empty($match[1])) {
          
            foreach ($match[1] as $key => $value) {
                $rgbcolors = explode(',', $value);
                $hexcolor  = '#';
                for ($i = 0; $i < 3; $i++) {
                    # Handling percentage values
                    if (strpos($rgbcolors[$i], '%') !== FALSE) {
                        $rgbcolors[$i] = substr($rgbcolors[$i], 0, -1);
                        $rgbcolors[$i] = (int) (256 * ($rgbcolors[$i] / 100));
                        $hexcolor .= str_pad(dechex($rgbcolors[$i]),  2, '0', STR_PAD_LEFT);
					} else {
                        # Process values in integers
                        $color = round($rgbcolors[$i]);
                        if ($color < 16) {
                            $hexcolor .= '0';
                        }
                        $hexcolor .= dechex($color);
                    }
                }
                $stringValue = str_replace($match[0][$key], $hexcolor, $stringValue);
            }
        }
        return $stringValue;
    }

    private function hsl_to_hex($stringValue) {
        preg_match_all('#hsl\s*\(\s*([0-9%,\.\s]+)\s*\)#s', $stringValue, $match);
        foreach ($match[1] as $key => $hls) {
            $values = explode(',', str_replace('%', '', $hls));
            $h = floatval($values[0]);
            $s = floatval($values[1]);
            $l = floatval($values[2]);
            $h = ((($h % 360) + 360) % 360) / 360;
            $s = min(max($s, 0), 100) / 100;
            $l = min(max($l, 0), 100) / 100;
            if ($s === 0) {
                $red = $green = $blue = intval(floor(floatval(255 * $l) + 0.5), 10);
             } else {
                $v2 = $l < 0.5 ? $l * (1 + $s) : ($l + $s) - ($s * $l);
                $v1 = 2 * $l - $v2;
                $red   = intval(floor(floatval(255 * $this->to_rgb($v1, $v2, $h + (1/3))) + 0.5), 10);
                $green = intval(floor(floatval(255 * $this->to_rgb($v1, $v2, $h)) + 0.5), 10);
                $blue  = intval(floor(floatval(255 * $this->to_rgb($v1, $v2, $h - (1/3))) + 0.5), 10);
            }
            $hexcolor = '#'.str_pad(dechex(round($red)), 2, '0', STR_PAD_LEFT).str_pad(dechex(round($green)), 2, '0', STR_PAD_LEFT).str_pad(dechex(round($blue)), 2, '0', STR_PAD_LEFT);
            $stringValue = str_replace($match[0][$key], $hexcolor, $stringValue);
        }
        return $stringValue;
    }
    
    private function to_rgb($v1, $v2, $hue) {
        $hue = $hue < 0 ? $hue + 1 : ($hue > 1 ? $hue - 1 : $hue);
        if ($hue * 6 < 1) return $v1 + ($v2 - $v1) * 6 * $hue;
        if ($hue * 2 < 1) return $v2;
        if ($hue * 3 < 2) return $v1 + ($v2 - $v1) * ((2/3) - $hue) * 6;
        return $v1;
    }

    private function compress_hex($original){
        if (strlen($original) == 7 && $original[1] == $original[2]
        && $original[3] == $original[4]  && $original[5] == $original[6]) {
          return "#" . $original[1] . $original[3] . $original[5];
        } else return $original;
    }
}